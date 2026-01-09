<?php

namespace App\Http\Controllers;

use App\Models\HalamanStatis;
use App\Models\Berita;
use App\Models\TbDaftarinfo;

class IpController extends Controller
{
    public function detail($jenis)
    {
        $host = request()->getHost();
        $hostParts = explode('.', $host);

        $subdomain = ($hostParts[0] === 'www') ? $hostParts[1] : $hostParts[0];

        $subdomainToIdSkpd = [
            'setda' => 1,
            'dprd' => 2,
            'inspekda' => 3,
            'bappedalitbang' => 4,
            'bkpsdm' => 5,
            'dpmdppkb' => 6,
            'dinaspangan' => 7,
            'dlh' => 8,
            'dpmpptsp' => 9,
            'bpbd' => 10,
            'disdukcapil' => 11,
            'disdikbud' => 12,
            'dishub' => 13,
            'bpkd' => 14,
            'bapenda' => 15,
            'dinkes' => 16,
            'disperindagkopumkm' => 17,
            'disparpora' => 18,
            'dkp' => 19,
            'disnakkeswan' => 20,
            'distanhortbun' => 21,
            'dispsda' => 22,
            'dispupr' => 23,
            'dinsosppa' => 24,
            'satpolpp' => 25,
            'diskerpus' => 26,
            'rsudmzein' => 27,
            'kotoxitarusankec' => 29,
            'bayangkec' => 30,
            'ivnagaribayangutarakec' => 31,
            'ivjuraikec' => 32,
            'batangkapaskec' => 33,
            'suterakec' => 34,
            'lengayangkec' => 35,
            'ranahpesisirkec' => 36,
            'linggosaribagantikec' => 37,
            'airpurakec' => 38,
            'pancungsoalkec' => 39,
            'rahultapankec' => 40,
            'babtapankec' => 41,
            'lunangkec' => 42,
            'silautkec' => 43,
            'disperkimtan' => 44,
            'diskominfo' => 45,
            'dinakertrans' => 46,
            'rsudpratamatapan' => 48,
        ];


        if (!array_key_exists($subdomain, $subdomainToIdSkpd)) {
            abort(404);
        }

        $id_skpd_ppid = $subdomainToIdSkpd[$subdomain];

        $data = TbDaftarinfo::where('id_skpd', $id_skpd_ppid)
            ->where('id_kat', $jenis)
            ->where('aktif', 1)
            ->orderByDesc('tgl')
            ->paginate(10);

        $infoterbaru = Berita::orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->limit(6)
            ->get();

        return view('guest.informasi_publik.informasi_publik', [
            'record' => $data,
            'infoterbaru' => $infoterbaru
        ]);
    }
}
