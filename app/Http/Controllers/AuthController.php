<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index()
    {
        // Redirect jika sudah login - HANYA CEK SESSION YANG VALID
        if (Session::has('is_login') && Session::get('is_login') === true && Session::has('user_id')) {
            return redirect()->route('administrator.beranda');
        }

        // Clear any invalid session data
        if (!Session::has('is_login') || Session::get('is_login') !== true) {
            Session::forget(['is_login', 'user_id', 'username', 'nm_lengkap', 'level']);
        }

        return view('admin.login');
    }

    public function aksi_login(Request $request)
    {
        // Security headers
        $this->addSecurityHeaders();

        // Throttle key berdasarkan IP dan user agent untuk keamanan tambahan
        $throttleKey = 'login_attempts:' . $request->ip() . ':' . md5($request->userAgent());

        // Rate limiting yang lebih ketat
        if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
            $seconds = RateLimiter::availableIn($throttleKey);

            // Log suspicious activity
            Log::warning('Too many login attempts', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'username' => $request->username,
                'timestamp' => now()
            ]);

            return response()->json([
                'success' => false,
                'message' => "Terlalu banyak percobaan login. Coba lagi dalam $seconds detik."
            ], 429);
        }

        // Validasi input yang lebih ketat
        $request->validate([
            'username' => 'required|string|max:50|regex:/^[a-zA-Z0-9_]+$/',
            'password' => 'required|string|min:6|max:50',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.max' => 'Username tidak boleh lebih dari 50 karakter.',
            'username.regex' => 'Username hanya boleh berisi huruf, angka, dan underscore.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.max' => 'Password tidak boleh lebih dari 50 karakter.',
        ]);

        // Sanitize input
        $username = trim(strtolower($request->username));

        // Cari user dengan timing attack protection
        $user = User::where('username', $username)->first();

        // Selalu lakukan hash check meskipun user tidak ditemukan (timing attack protection)
        $passwordHash = $user ? $user->password : '$2y$10$dummy.hash.to.prevent.timing.attack';
        $passwordValid = Hash::check($request->password, $passwordHash);

        if (!$user || !$passwordValid) {
            // Tambah penalti untuk failed attempt
            RateLimiter::hit($throttleKey, 300); // 5 menit

            // Log failed login attempt
            Log::warning('Failed login attempt', [
                'username' => $username,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'timestamp' => now()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Username atau Password salah!'
            ], 401);
        }

        // Check if user is active (tambahkan kolom is_active di tabel users jika ada)
        if (isset($user->is_active) && !$user->is_active) {
            Log::warning('Login attempt for inactive user', [
                'username' => $username,
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Akun tidak aktif. Hubungi administrator.'
            ], 403);
        }

        // Reset throttle counter untuk IP ini
        RateLimiter::clear($throttleKey);

        // PENTING: Regenerate session ID untuk mencegah session fixation
        $request->session()->regenerate();

        // Update last login (tambahkan kolom last_login_at di tabel users jika ada)
        if (method_exists($user, 'update')) {
            try {
                $user->update([
                    'last_login_at' => now(),
                    'last_login_ip' => $request->ip()
                ]);
            } catch (\Exception $e) {
                // Kolom mungkin belum ada, skip update
            }
        }

        // CRITICAL: Simpan data user di session dengan flag yang jelas
        Session::put([
            'user_id' => $user->id,
            'username' => $user->username,
            'nm_lengkap' => $user->nama_lengkap ?? $user->username,
            'level' => $user->level ?? 'user',
            'is_login' => true, // Flag utama
            'login_time' => time(),
            'last_activity' => time()
        ]);

        // Save session immediately
        Session::save();

        // Log successful login
        Log::info('Successful login', [
            'user_id' => $user->id,
            'username' => $user->username,
            'ip' => $request->ip(),
            'timestamp' => now()
        ]);

        // Determine redirect route based on user level
        $redirectRoute = 'administrator.beranda'; // default route

        if (isset($user->level)) {
            if ($user->level === 'Kontributor') {
                $redirectRoute = 'kontributor.beranda';
            }
            // You can add more levels here if needed
            // elseif ($user->level === 'Editor') {
            //     $redirectRoute = 'editor.beranda';
            // }
        }

        return response()->json([
            'success' => true,
            'redirect' => route($redirectRoute),
            'message' => 'Login berhasil!'
        ]);
    }

    public function logout(Request $request)
    {
        // Log logout activity
        if (Session::get('is_login')) {
            Log::info('User logout', [
                'user_id' => Session::get('user_id'),
                'username' => Session::get('username'),
                'ip' => $request->ip(),
                'timestamp' => now()
            ]);
        }

        // Jika menggunakan Laravel Auth
        // Auth::logout();

        // Hapus semua session data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Thu, 01 Jan 1970 00:00:00 GMT',
            'X-Frame-Options' => 'DENY',
            'X-Content-Type-Options' => 'nosniff'
        ])->with('success', 'Anda telah logout.');
    }

    private function addSecurityHeaders()
    {
        $headers = [
            'X-Frame-Options' => 'DENY',
            'X-Content-Type-Options' => 'nosniff',
            'X-XSS-Protection' => '1; mode=block',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
            'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains'
        ];

        foreach ($headers as $key => $value) {
            header("$key: $value");
        }
    }
}