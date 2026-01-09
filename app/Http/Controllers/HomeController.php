<?php



namespace App\Http\Controllers;



use App\Models\Menu;

use App\Models\Berita;

use App\Models\Agenda;

use App\Models\Pejabat;

use App\Models\Statistik;

use App\Models\dokperenlitbang;

use App\Models\announcement;

use Carbon\Carbon;



class HomeController extends Controller

{

    public function index()

    {

        $menus = Menu::where('aktif', 'Ya')->orderBy('urutan', 'asc')->get();

        $beritaInfografis = Berita::where('id_kategori', 62)->get();

        $beritaTerbaru = Berita::orderBy('tanggal', 'desc')->take(4)->get();

        $beritaTerpopuler = Berita::orderBy('dibaca', 'desc')->take(4)->get();

        $berita = Berita::orderBy('tanggal', 'desc')->get();

        $agendas = Agenda::whereDate('tgl_mulai', '>=', now()->startOfDay())

            ->orderBy('tgl_mulai', 'asc')

            ->get();

        $pejabat = Pejabat::take(4)->get();

        $jenisSlugUtama = ['rtr', 'rpjpd', 'rpjmd', 'renstra', 'rkpd', 'renja', 'kajian-perbup', 'inovasi'];

        $jenisIds = get_jenis_ids_by_slugs($jenisSlugUtama);

        $jenisIds = range(1, 25); // dari 1 sampai 25
        $dokumenPublik = collect();

        foreach ($jenisIds as $jenis) {
            $dokumen = dokperenlitbang::where('jenis', $jenis)
                ->orderBy('id_dokperenlitbang', 'desc') // ambil yang terbaru
                ->first();

            if ($dokumen) {
                $dokumenPublik->push($dokumen);
            }
        }
        $dokumenPublik = $dokumenPublik->sortBy('jenis')->take(8)->values();


        $pengumuman = Announcement::orderBy('tanggal_posting', 'desc')

            ->take(5)

            ->get();

        $artikel = Berita::orderBy('tanggal', 'desc')->take(5)->get();

        $todayVisitors = Statistik::whereDate('tanggal', today())->sum('hits') ?: 0;

        $yesterdayVisitors = Statistik::whereDate('tanggal', today()->subDay())->sum('hits') ?: 0;

        $currentYear = Carbon::now()->year;

        $totalVisitorYear = Statistik::whereYear('tanggal', $currentYear)->sum('hits');

        $totalHits = Statistik::sum('hits') ?: 0;

        return view('guest.beranda', compact(

            'menus',

            'berita',

            'beritaTerbaru',

            'beritaTerpopuler',

            'agendas',

            'pejabat',

            'dokumenPublik',

            'pengumuman',

            'artikel',

            'beritaInfografis',

            'todayVisitors',

            'yesterdayVisitors',

            'totalVisitorYear'
        ));
    }



    public function show($slug)

    {

        $berita = Berita::where('slug', $slug)->firstOrFail();

        $beritaTerbaru = Berita::orderBy('tanggal', 'desc')->take(6)->get();



        return view('guest.berita.beritaShow', compact('berita', 'beritaTerbaru'));
    }



    public function create()

    {

        return view('menu.create');
    }
}
