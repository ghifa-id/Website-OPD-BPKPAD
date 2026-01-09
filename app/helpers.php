<?php
if (!function_exists('hariIni')) {
    function hariIni($dayOfWeek)
    {
        $hari = [
            0 => 'Minggu',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
        ];

        return $hari[$dayOfWeek] ?? 'Tidak diketahui';
    }
}

if (! function_exists('seo_title')) {
    function seo_title($s)
    {
        $c = array(' ');
        $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+', '–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }
}
if (!function_exists('get_jenis_dokumen_mapping')) {
    function get_jenis_dokumen_mapping()
    {
        return [
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
        ];
    }
}
if (!function_exists('get_jenis_dokumen_singkat')) {
    function get_jenis_dokumen_singkat($jenis)
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
}

if (!function_exists('get_jenis_label')) {
    function get_jenis_label($id)
    {
        $list = get_jenis_dokumen_mapping();
        return $list[$id] ?? 'Tidak diketahui';
    }
}

if (!function_exists('get_jenis_id_by_slug')) {
    function get_jenis_id_by_slug($slug)
    {
        $mapping = [
            'rpjpd' => 1,
            'rtr' => 2,
            'rpjmd' => 3,
            'rpkd' => 4,
            'roadmap' => 5,
            'renstra' => 6,
            'rkpd' => 7,
            'musrenbang' => 8,
            'renja' => 9,
            'perkin' => 10,
            'rkt' => 11,
            'kua-ppas' => 12,
            'rka' => 13,
            'evaluasi-rpjmd' => 14,
            'evaluasi-rkpd' => 15,
            'evaluasi-renja' => 16,
            'evaluasi-dak' => 17,
            'serapan-anggaran' => 18,
            'penelitian' => 19,
            'inovasi' => 20,
            'monev' => 21,
            'idsd' => 22,
            'kajian-perda' => 23,
            'kajian-perbup' => 24,
            'kajian-kepala-badan' => 25,
        ];

        return $mapping[$slug] ?? null;
    }
}

if (!function_exists('get_jenis_ids_by_slugs')) {
    function get_jenis_ids_by_slugs(array $slugs)
    {
        $mapping = [
            'rpjpd' => 1,
            'rtr' => 2,
            'rpjmd' => 3,
            'rpkd' => 4,
            'roadmap' => 5,
            'renstra' => 6,
            'rkpd' => 7,
            'musrenbang' => 8,
            'renja' => 9,
            'perkin' => 10,
            'rkt' => 11,
            'kua-ppas' => 12,
            'rka' => 13,
            'evaluasi-rpjmd' => 14,
            'evaluasi-rkpd' => 15,
            'evaluasi-renja' => 16,
            'evaluasi-dak' => 17,
            'serapan-anggaran' => 18,
            'penelitian' => 19,
            'inovasi' => 20,
            'monev' => 21,
            'idsd' => 22,
            'kajian-perda' => 23,
            'kajian-perbup' => 24,
            'kajian-kepala-badan' => 25,
        ];

        $result = [];
        foreach ($slugs as $slug) {
            if (isset($mapping[$slug])) {
                $result[] = $mapping[$slug];
            }
        }
        return $result;
    }
}
