<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\master_user_pajak;
use App\Models\master_role_user;
use Illuminate\Support\Facades\Hash;

class RegistAkunController extends Controller
{
    /**
     * Menampilkan form registrasi
     */
    public function index()
    {
        // Menggunakan Model Eloquent yang benar
        $role = master_role_user::all();
        
        $data = [
            'title' => 'Form Registrasi Akun Wajib Pajak',
            'subjudul' => 'PAJAK RETRIBUSI',
            'header' => '-',
            'role' => $role
        ];
        
        return view('guest.Registakun.Registakun', $data);
    }

    /**
     * Menyimpan data registrasi
     */
    public function add(Request $request)
    {
        // Validasi input - disesuaikan dengan kolom tabel
        $request->validate([
            'nip' => 'required|string|max:50|unique:master_user_pajak,nip',
            'nama' => 'required|string|max:100',
            'pass' => 'required|string|min:6',
            'jab' => 'required|string'
        ], [
            'nip.required' => 'NIP/Username harus diisi',
            'nip.max' => 'NIP/Username maksimal 50 karakter',
            'nip.unique' => 'NIP/Username sudah terdaftar',
            'nama.required' => 'Nama lengkap harus diisi',
            'pass.required' => 'Kata sandi harus diisi',
            'pass.min' => 'Kata sandi minimal 6 karakter',
            'jab.required' => 'Jabatan harus dipilih'
        ]);

        try {
            // Split jabatan value (format: id_role_user_nama_role)
            $jabatanData = explode('_', $request->jab, 2);
            $idRoleUser = $jabatanData[0];
            $namaRole = $jabatanData[1] ?? 'User';

            // Simpan data menggunakan Model master_user_pajak
            $user = master_user_pajak::create([
                'nip' => $request->nip,
                'password' => md5($request->pass), // MD5 untuk kompatibilitas sistem lama
                'nama_pegawai' => $request->nama,
                'id_role_user' => $idRoleUser,
                'jabatan' => $namaRole,
                'status_user' => true, // atau 1
            ]);

            if ($user) {
                return redirect()->route('Registakun')
                    ->with('message', 'success')
                    ->with('success', 'Registrasi berhasil! Akun Anda telah terdaftar.');
            }

        } catch (\Exception $e) {
            return redirect()->route('Registakun')
                ->with('message', 'error')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->route('Registakun')
            ->with('message', 'error')
            ->with('error', 'Gagal melakukan registrasi. Silakan coba lagi.');
    }

    /**
     * Menampilkan data registrasi (untuk admin)
     */
    public function show()
    {
        // Menggunakan Model dengan eager loading relasi
        $users = master_user_pajak::with('role')
            ->where('status_user', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.regist_akun_list', [
            'title' => 'Data Registrasi Akun Wajib Pajak',
            'users' => $users
        ]);
    }

    /**
     * Menampilkan form edit registrasi
     */
    public function edit($nip)
    {
        // Menggunakan Model yang benar
        $user = master_user_pajak::where('nip', $nip)->first();
        $role = master_role_user::all();

        if (!$user) {
            return redirect()->route('regist_akun.show')
                ->with('message', 'error')
                ->with('error', 'Data tidak ditemukan.');
        }

        return view('admin.regist_akun_edit', [
            'title' => 'Edit Data Akun Wajib Pajak',
            'user' => $user,
            'role' => $role
        ]);
    }

    /**
     * Update data registrasi
     */
    public function update(Request $request, $nip)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'jab' => 'required|string'
        ]);

        try {
            // Cari user menggunakan Model yang benar
            $user = master_user_pajak::where('nip', $nip)->first();
            
            if (!$user) {
                return redirect()->route('regist_akun.show')
                    ->with('message', 'error')
                    ->with('error', 'Data tidak ditemukan.');
            }

            // Split jabatan value
            $jabatanData = explode('_', $request->jab, 2);
            $idRoleUser = $jabatanData[0];
            $namaRole = $jabatanData[1] ?? 'User';

            $data = [
                'nama_pegawai' => $request->nama,
                'jabatan' => $namaRole,
                'id_role_user' => $idRoleUser,
            ];

            // Jika password diisi, update password
            if ($request->filled('pass')) {
                $data['password'] = md5($request->pass);
            }

            // Update menggunakan Model
            $user->update($data);

            return redirect()->route('regist_akun.show')
                ->with('message', 'success')
                ->with('success', 'Data berhasil diupdate!');

        } catch (\Exception $e) {
            return redirect()->route('regist_akun.show')
                ->with('message', 'error')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus data registrasi
     */
    public function destroy($nip)
    {
        try {
            // Cari dan hapus menggunakan Model yang benar
            $user = master_user_pajak::where('nip', $nip)->first();
            
            if (!$user) {
                return redirect()->route('regist_akun.show')
                    ->with('message', 'error')
                    ->with('error', 'Data tidak ditemukan.');
            }

            $user->delete();

            return redirect()->route('regist_akun.show')
                ->with('message', 'success')
                ->with('success', 'Data berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('regist_akun.show')
                ->with('message', 'error')
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}