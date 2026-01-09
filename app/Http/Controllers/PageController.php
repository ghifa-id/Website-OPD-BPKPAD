<?php



namespace App\Http\Controllers;

use App\Http\Controllers\Controller;



use App\Models\Menu;

use App\Models\HalamanStatis;

use App\Models\Berita;

use App\Models\Pejabat;

use App\models\dokperenlitbang;

use App\Models\Komentar;

use Illuminate\Http\Request;



class PageController extends Controller

{



    public function index()

    {

        $menus = Menu::where('aktif', 'Ya')->orderBy('urutan', 'asc')->get();

        $pejabats = Pejabat::all();





        return view('guest.pejabat.pejabatPage', compact('menus', 'pejabats'));
    }



    public function detail($slug)

    {

        $menus = Menu::where('aktif', 'Ya')->orderBy('urutan', 'asc')->get();

        $page = HalamanStatis::where('judul_seo', $slug)->first();



        if (!$page) {

            abort(404);
        }



        $beritaTerpopuler = Berita::orderBy('dibaca', 'desc')

            ->take(6)

            ->get();



        $beritaTerbaru = Berita::orderBy('tanggal', 'desc')

            ->orderBy('jam', 'desc')

            ->take(6)

            ->get();



        return view('guest.pageDetail.page', compact('menus', 'page', 'beritaTerbaru', 'beritaTerpopuler'));
    }



    public function showPejabatAll()
    {
        // Kepala BAPEDALITBANG (id 1)
        $kepala = \App\Models\Pejabat::find(1);

        // Sekretaris dan Kepala Bidang (id 2,3,4,5)
        $sekretarisDanKepalaBidang = Pejabat::with('jabatan')
            ->whereIn('jabatan_id', [2, 3, 4, 5])
            ->get();

        // Kepala Sub Bagian (id 6,7,8)
        $KepalaSubBagian = \App\Models\Pejabat::with('jabatan')
            ->whereIn('jabatan_id', [6, 7, 8])
            ->get();

        // Kirim ke view
        return view('guest.pejabat.pejabatPage', compact('kepala', 'sekretarisDanKepalaBidang', 'KepalaSubBagian'));
    }




    public function show($slug)
    {
        $pejabat = \App\Models\Pejabat::where('slug', $slug)->firstOrFail();

        // Ambil satu <table> pertama (jika ada)
        preg_match('/<table.*?<\/table>/is', $pejabat->riwayat, $matches);

        $table1 = $matches[0] ?? ''; // Ambil tabel pertama atau kosong jika tidak ada

        // Ambil teks biasa di luar tag <table>
        $riwayatWithoutTables = preg_replace('/<table.*?<\/table>/is', '', $pejabat->riwayat);

        // Hapus semua tag HTML (seperti <strong>, <span>, <p>, dll)
        $riwayatWithoutTables = preg_replace('/<.*?>/', '', $riwayatWithoutTables);

        // Ganti &nbsp; jadi spasi biasa
        $riwayatWithoutTables = preg_replace('/(&nbsp;)+/', ' ', $riwayatWithoutTables);

        // Bersihkan baris kosong
        $riwayatWithoutTables = preg_replace('/\s+(\r\n|\r|\n)/', "\n", $riwayatWithoutTables);

        // Trim spasi awal dan akhir
        $riwayatWithoutTables = trim($riwayatWithoutTables);

        return view('guest.pejabat.pejabatShow', compact(
            'pejabat',
            'table1',
            'riwayatWithoutTables'
        ));
    }
}
