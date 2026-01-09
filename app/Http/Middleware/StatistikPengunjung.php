<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Statistik;
use Carbon\Carbon;

class StatistikPengunjung
{
    public function handle(Request $request, Closure $next)
    {
        // 1. Abaikan request dari bot/crawler
        $userAgent = strtolower($request->header('User-Agent', ''));
        if (preg_match('/bot|crawl|spider|slurp|facebookexternalhit|pingdom/', $userAgent)) {
            return $next($request);
        }

        // 2. Batasi hanya satu kali hitung per session
        if (!session()->has('sudah_dihitung_pengunjung')) {
            $ip = $request->ip();
            $tanggal = Carbon::today();

            $statistik = Statistik::where('ip', $ip)
                ->whereDate('tanggal', $tanggal)
                ->first();

            if ($statistik) {
                $statistik->increment('hits');
                $statistik->update(['online' => now()->timestamp]);
            } else {
                Statistik::create([
                    'ip' => $ip,
                    'tanggal' => $tanggal,
                    'hits' => 1,
                    'online' => now()->timestamp,
                ]);
            }

            session()->put('sudah_dihitung_pengunjung', true);
        }

        return $next($request);
    }
}
