<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Statistik;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class ViewComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {
            $stats = Cache::remember('visitor_stats', now()->addHours(1), function () {
                $currentYear = Carbon::now()->year;
                return [
                    'todayVisitors' => Statistik::whereDate('tanggal', today())->sum('hits') ?: 0,
                    'yesterdayVisitors' => Statistik::whereDate('tanggal', today()->subDay())->sum('hits') ?: 0,
                    'totalVisitorYear' => Statistik::whereYear('tanggal', $currentYear)->sum('hits') ?: 0,
                    'totalHits' => Statistik::sum('hits') ?: 0,
                    'currentIp' => request()->ip()
                ];
            });

            $view->with($stats);
        });
    }
}
