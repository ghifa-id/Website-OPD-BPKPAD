<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class SessionAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('username')) {
            return redirect()->route('login')->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);
        }

        $path = $request->path();
        $level = Session::get('level');

        if (Str::startsWith($path, 'administrator') && $level !== 'Admin') {
            return redirect()->route('kontributor.beranda')->with('error', 'Anda tidak memiliki akses ke area admin');
        }

        if (Str::startsWith($path, 'kontributor') && $level !== 'Kontributor') {
            return redirect()->route('administrator.beranda')->with('error', 'Anda tidak memiliki akses ke area kontributor');
        }

        return $next($request);
    }
}
