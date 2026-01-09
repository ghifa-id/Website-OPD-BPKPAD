<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class Statistik extends Model
{
    protected $table = 'statistik';
    public $timestamps = false;

    // Tambahkan ini agar tidak error karena tidak ada kolom id
    protected $primaryKey = null;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['ip', 'tanggal', 'hits', 'online'];
    protected $dates = ['tanggal'];
    public static function getVisitationStats($days = 7)
    {
        $endDate = now();
        $startDate = now()->subDays($days - 1);

        $statistik = self::selectRaw('DATE(tanggal) as tanggal, SUM(hits) as total')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(tanggal)'))
            ->orderBy('tanggal')
            ->get();

        $labels = [];
        $data = [];

        for ($i = $days - 1; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $dayName = now()->subDays($i)->translatedFormat($days === 7 ? 'l' : 'd M');
            $labels[] = $dayName;

            $found = $statistik->firstWhere('tanggal', $date);
            $data[] = $found ? $found->total : 0;
        }

        return compact('labels', 'data');
    }
}
