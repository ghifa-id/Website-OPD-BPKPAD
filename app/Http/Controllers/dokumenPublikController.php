<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dokperenlitbang;

class dokumenPublikController extends Controller
{
    public function showDokumenAll()
    {
        // Ambil data dokumen publik dari yang terbaru ke lama, 15 per halaman
        $dokumenPublik = dokperenlitbang::orderBy('id_dokperenlitbang', 'desc')->paginate(15);

        return view('guest.dokumenPublik.dokumenPublikAll', compact('dokumenPublik'));
    }

    private function get_jenis_dokumen_singkat($jenis)
    {
        $singkatan = [
            1 => 'RPJPD',
            2 => 'RTR',
            3 => 'RPJMD',
            4 => 'RPKD',
            5 => 'ROADMAP',
            6 => 'RENSTRA',
            7 => 'RKPD',
            8 => 'MUSRENBANG',
            9 => 'RENJA',
            10 => 'PERKIN',
            11 => 'RKT',
            12 => 'KUA-PPAS',
            13 => 'RKA',
            14 => 'EVAL RPJMD',
            15 => 'EVAL RKPD',
            16 => 'EVAL RENJA',
            17 => 'EVAL DAK',
            18 => 'SERAPAN',
            19 => 'PENELITIAN',
            20 => 'INOVASI',
            21 => 'MONEV',
            22 => 'IDSD',
            23 => 'KAJIAN PERDA',
            24 => 'KAJIAN PERBUP',
            25 => 'KAJIAN KEPALA BADAN',
        ];

        if ($jenis === null) {
            return '~ Belum di Unggah';
        }

        return $singkatan[$jenis] ?? 'Tidak Diketahui';
    }

    public function showDokumen($id)
    {
        $record = Dokperenlitbang::where('jenis', $id)
            ->orderBy('id_dokperenlitbang', 'DESC')
            ->first();

        if (!$record) {
            abort(404, 'Dokumen tidak ditemukan');
        }

        $jenisList = [
            1 => 'Rencana Pembangunan Jangka Panjang Daerah',
            2 => 'Rencana Tata Ruang Wilayah',
            3 => 'Rencana Pembangunan Jangka Menengah Daerah',
            4 => 'Rencana Penanggulangan Kemiskinan Daerah',
            5 => 'Roadmap Pembangunan Ekonomi',
            6 => 'Rencana Strategis',
            7 => 'Rencana Kerja Pemerintah Daerah',
            8 => 'Musyawarah Perencanaan Pembangunan',
            9 => 'Rencana Kerja',
            10 => 'Perjanjian Kinerja',
            11 => 'Rencana Kerja Tahunan',
            12 => 'KUA dan PPAS',
            13 => 'Rencana Kebijakan Anggaran',
            14 => 'Evaluasi RPJMD',
            15 => 'Evaluasi RKPD',
            16 => 'Evaluasi Renja',
            17 => 'Evaluasi Pelaksanaan DAK',
            18 => 'Serapan Anggaran',
            19 => 'Penelitian',
            20 => 'Inovasi',
            21 => 'Monev',
            22 => 'Indeks Daya Saing Daerah (IDSD)',
            23 => 'Kajian - Peraturan Daerah',
            24 => 'Kajian - Peraturan Bupati',
            25 => 'Kajian - Peraturan Kepala Badan',
            26 => 'Rencana Kerja Pemerintah Daerah Perubahan',
        ];

        $jeniss = $jenisList[$record->jenis] ?? '~ Dokumen Belum di Unggah';

        return view('guest.dokumenPublik.detail', [
            'record' => $record,
            'jeniss' => $jeniss
        ]);
    }
}
