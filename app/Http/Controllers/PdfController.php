<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokperenlitbang;
use App\Models\Berita;
use App\Models\HalamanStatis;
use App\Models\Ppidkonten;

class PdfController extends Controller
{

    public function detail($jenis)
    {
        $record = Ppidkonten::where('jenis', $jenis)
            ->orderByDesc('id_ppidkonten')
            ->first();


        if (!$record) {
            abort(404, 'Konten tidak ditemukan.');
        }

        $infoterbaru = Berita::orderBy('tanggal', 'desc')
        ->orderBy('jam', 'desc')
        ->take(6)->get();

    $jenisMap = [
        '1' => 'SK PPID',
        '2' => 'Struktur PPID',
        '3' => 'Tugas & Fungsi PPID',
        '4' => 'Pedoman Pelayanan Informasi Publik',
        '5' => 'Form Permohonan Informasi',
        '6' => 'Form Pengajuan Keberatan',
        '7' => 'Maklumat Pelayanan',
        '8' => 'SOP Permohonan Informasi Publik',
        '9' => 'SOP Penanganan Keberatan Informasi Publik',
        '10' => 'Tata Cara Pengaduan',
        '11' => 'SK DIP',
        '99' => 'Informasi Dikecualikan',
    ];

    $jeniss = $jenisMap[$record->jenis] ?? '~ Jenis Tidak Dikenal';

    return view('guest.pdf.pdf', compact('record', 'infoterbaru', 'jeniss'));
    }
}
