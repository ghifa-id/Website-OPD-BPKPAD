<?php

namespace App\Http\Controllers\Kontributor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\HalamanStatis;
use App\Models\User;
use App\Models\Identitas;
use App\Models\Menu;
use App\Models\penghargaan;
use App\Models\Statistik;
use App\Models\Kategori;
use App\Models\Album;
use App\Models\Gallery;
use App\Models\Playlist;
use App\Models\video;
use App\Models\announcement;
use App\Models\Download;
use App\Models\KepuasanPublik;
use Illuminate\Support\Facades\DB;



class KontributorController extends Controller
{
    public function index()
    {
        $jumlahBerita = Berita::count();
        $jumlahHalaman = HalamanStatis::count();
        $jumlahAgenda = Agenda::count();
        $jumlahUser = User::count();
        $statistikKunjungan = $this->getStatistikKunjungan();
        $data = KepuasanPublik::select('skor', DB::raw('count(*) as total'))
            ->groupBy('skor')
            ->pluck('total', 'skor') // hasil: [1 => 10, 2 => 15, ...]
            ->toArray();

        // Buat array lengkap skor 1–5, isi 0 jika tidak ada
        $statistikKepuasan = [
            1 => $data[1] ?? 0, // Sangat Tidak Puas
            2 => $data[2] ?? 0, // Tidak Puas
            3 => $data[3] ?? 0, // Cukup
            4 => $data[4] ?? 0, // Puas
            5 => $data[5] ?? 0, // Sangat Puas
        ];


        return view('kontributor.beranda', [
            'jumlahBerita' => $jumlahBerita,
            'jumlahHalaman' => $jumlahHalaman,
            'jumlahAgenda' => $jumlahAgenda,
            'jumlahUser' => $jumlahUser,
            'statistikKunjungan' => $statistikKunjungan,
            'statistikKepuasan' => array_values($statistikKepuasan),
        ]);
    }

    private function getStatistikKunjungan()
    {
        return Statistik::getVisitationStats(7);
    }

    public function getStatistikApi(Request $request)
    {
        $days = $request->query('days', 7);
        $stats = Statistik::getVisitationStats($days);

        return response()->json($stats);
    }

    // Berita Cepat
    public function beritaCepat(Request $request)
    {
        dd($request->all());
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi_berita' => 'required',
        ]);

        $beritaData = array_merge($validated, [
            'judul_seo' => Str::slug($validated['judul']),
            'hari' => date('l'),
            'tanggal' => date('Y-m-d'),
            'jam' => date('H:i:s'),
            'username' => Session::get('username'),
            'utama' => 'N',
            'id_kategori' => 1,
        ]);

        Berita::create($beritaData);

        return redirect()->route('kontributor.beranda')->with('success', 'Berita berhasil ditambahkan!');
    }
    // End Berita Cepat

    // Start List berita
    public function listBerita()
    {
        $listberita = Berita::with(['user', 'kategori'])
            ->orderBy('id_berita', 'desc')
            ->get();

        return view('kontributor.mod_berita.berita', compact('listberita'));
    }

    public function tambah_listBerita()
    {
        $listberita = Berita::all();
        $kategori = Kategori::all();
        return view('kontributor.mod_berita.beritaCreate', compact('listberita', 'kategori'));
    }


    public function simpan_listBerita(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'sub_judul' => 'nullable|string|max:255',
            'isi_berita' => 'required|min:600',
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'youtube' => 'nullable|url',
            'utama' => 'required|in:Y,N',
            'gambar' => 'nullable|image|max:3072',
            'keterangan_gambar' => 'nullable|string|max:255',
        ]);

        // Buat data dasar
        $data = $request->only([
            'judul',
            'sub_judul',
            'isi_berita',
            'id_kategori',
            'youtube',
            'utama',
            'keterangan_gambar'
        ]);

        $tagInput = $request->input('tag');
        if (is_array($tagInput)) {
            $tag = implode(',', $tagInput);
        } else {
            $tag = $tagInput ?? '';
        }

        $data['tag'] = $tag;
        $data['hari'] = hariIni(date('w'));
        $data['tanggal'] = date('Y-m-d');
        $data['jam'] = Carbon::now()->format('H:i:s'); // <-- di sini pakai Carbon
        $data['judul_seo'] = seo_title($data['judul']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('asset/foto_berita'), $filename);
            $data['gambar'] = $filename;
        }


        $data['username'] = session('username') ?? 'kontributor';
        Berita::create($data);

        return redirect()->route('kontributor_tambah_listberita')->with('success', 'Berita berhasil ditambahkan.');
        return redirect()->back()->with('error', 'Gagal Menambahkan Berita');
    }

    // End List Berita

    // Start Album
    public function Album()
    {
        $album = Album::orderBy('id_album', 'desc')->get();
        return view('kontributor.mod_album.album', compact('album'));
    }

    public function tambah_Album()
    {
        return view('kontributor.mod_album.albumCreate');
    }


    public function simpan_Album(Request $request)
    {
        // Validasi input
        $request->validate([
            'jdl_album'     => 'required|string|max:100',
            'keterangan'    => 'required|string',
            'tgl_kegiatan'  => 'required|date',
            'tempat'        => 'required|string|max:100',
            'gbr_album'     => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        // Upload gambar jika ada
        $gambar = null;
        $gambar = null;
        if ($request->hasFile('gbr_album')) {
            $file = $request->file('gbr_album');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('asset/img_album');
            $file->move($destination, $filename);
            $gambar = $filename;
        }


        // Simpan ke database
        Album::create([
            'jdl_album'     => $request->jdl_album,
            'album_seo'     => Str::slug($request->jdl_album),
            'keterangan'    => $request->keterangan,
            'gbr_album'     => $gambar ?? 'default.jpg',
            'aktif'         => 'Y',
            'hits_album'    => 1,
            'tgl_posting'   => Carbon::now()->toDateString(),
            'jam'           => Carbon::now()->toTimeString(),
            'hari'          => now()->isoFormat('dddd'),
            'username' => Session::get('username'),
            'tgl_kegiatan'  => $request->tgl_kegiatan,
            'tempat'        => $request->tempat,
        ]);

        return redirect()->back()->with('success', 'Album berhasil ditambahkan.');
    }
    // End Album

    // Start Gallery
    public function gallery()
    {
        $gallery = Gallery::with('album')->orderBy('id_gallery', 'desc')->get();
        return view('kontributor.mod_gallery.gallery', compact('gallery'));
    }

    public function tambah_Gallery()
    {
        $album = Album::all();
        return view('kontributor.mod_gallery.galleryCreate', compact('album'));
    }


    public function simpan_Gallery(Request $request)
    {
        $request->validate([
            'id_album' => 'required|exists:album,id_album',
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slider' => 'required|in:Y,N',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                $judul = $request->jdl_gallery[$index] ?? 'Tanpa Judul';
                $filename = time() . '_' . $photo->getClientOriginalName();
                $photo->move(public_path('asset/img_gallery'), $filename);

                Gallery::create([
                    'id_album' => $request->id_album,
                    'gbr_gallery' => $filename,
                    'slider' => $request->slider,
                    'username' => Auth::user()->username ?? 'admin',
                    'jdl_gallery' => $judul,
                    'gallery_seo' => Str::slug($judul),
                    'keterangan' => '-', // fallback default
                ]);
            }
        }

        return redirect()->route('kontributor_gallery')->with('success', 'Foto gallery berhasil disimpan.');
    }
    // End Gallery

    // Start Playlist
    public function Playlist()
    {

        $playlist = Playlist::orderBy('id_playlist', 'desc')->get();
        return view('kontributor.mod_playlist.playlist', compact('playlist'));
    }

    public function tambah_Playlist()
    {
        $playlist = Playlist::all();
        return view('kontributor.mod_playlist.playlistCreate', compact('playlist'));
    }

    public function simpan_Playlist(Request $request)
    {
        // Validasi input
        $request->validate([
            'jdl_playlist' => 'required|string|max:255',
            'gbr_playlist' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Data awal
        $data = [
            'jdl_playlist'   => $request->jdl_playlist,
            'username'       => Auth::user()->username ?? 'admin',
            'playlist_seo'   => Str::slug($request->jdl_playlist),
            'aktif'          => 'Y',
        ];

        // Jika ada file gambar diunggah
        if ($request->hasFile('gbr_playlist')) {
            $file = $request->file('gbr_playlist');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('asset/img_playlist'), $filename);
            $data['gbr_playlist'] = $filename;
        } else {
            $data['gbr_playlist'] = 'default.jpg'; // file default ini harus ada di asset/img_playlist
        }

        // Simpan ke database
        Playlist::create($data);

        // Redirect dengan pesan sukses
        return redirect()->route('kontributor_playlist')->with('success', 'Playlist berhasil ditambahkan.');
    }
    // End Playlist

    // Start Video
    public function video()
    {
        $video = Video::orderBy('id_video', 'desc')->get();
        return view('kontributor.mod_video.video', compact('video'));
    }

    public function tambah_video()
    {
        $playlist = Playlist::all();
        return view('kontributor.mod_video.videoCreate', compact('playlist'));
    }

    public function simpan_video(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_playlist'   => 'required|exists:playlist,id_playlist',
            'judul_video'   => 'required|string|max:255',
            'keterangan'    => 'required|string',
            'gambar'        => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'tag'           => 'nullable|string',
            'youtube'       => 'nullable|string',
        ]);

        // Upload gambar jika ada
        $namaFile = null;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $namaFile = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar_video', $namaFile);
        }

        // Simpan ke database
        Video::create([
            'id_playlist'   => $request->id_playlist,
            'jdl_video'     => $request->judul_video,
            'video_seo'     => Str::slug($request->judul_video),
            'keterangan'    => $request->keterangan,
            'gbr_video'     => $namaFile,
            'video'         => '', // Kosong sesuai logika lama
            'youtube'       => $request->youtube ?? '',
            'dilihat'       => 0,
            'hari'          => $this->hari_ini(date('w')),
            'tanggal'       => now()->format('Y-m-d'),
            'jam'           => now()->format('H:i:s'),
            'tagvid'        => $request->tag ?? ''
        ]);

        return redirect()->back()->with('success', 'Video berhasil ditambahkan!');
    }

    // Fungsi bantu: Nama hari Indonesia
    private function hari_ini($hari)
    {
        $arrayHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        return $arrayHari[$hari] ?? '';
    }

    // Start Pengumuman Admin
    public function pengumumanKontributor()
    {
        $pengumuman = announcement::orderBy('id_announcement', 'desc')->get();
        return view('kontributor.mod_pengumuman.pengumuman', compact('pengumuman'));
    }

    public function tambah_pengumumanKontributor()
    {
        $pengumuman = announcement::all();
        return view('kontributor.mod_pengumuman.pengumumanCreate', compact('pengumuman'));
    }

    public function simpan_pengumumanKontributor(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_posting' => 'required|date',
            'perihal' => 'required|string|max:255',
            'deskripsi_pengumuman' => 'required|string',
            'file_pendukung' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120', // 5MB
            'keterangan' => 'nullable|string'
        ]);

        try {
            // Handle file upload jika ada
            $filename = null;
            if ($request->hasFile('file_pendukung')) {
                $file = $request->file('file_pendukung');
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '-' . time() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke public/asset/files
                $file->move(public_path('asset/files'), $filename);
            }

            // Simpan data ke database
            $pengumuman = announcement::create([
                'judul' => $validated['judul'],
                'judul_seo' => Str::slug($validated['judul']),
                'tanggal_posting' => $validated['tanggal_posting'],
                'deadline' => $validated['tanggal_posting'],
                'perihal' => $validated['perihal'],
                'deskripsi_pengumuman' => $validated['deskripsi_pengumuman'],
                'file_pendukung' => $filename ? $filename : null,
                'keterangan' => $validated['keterangan'] ?? null,
                'username' => Session::get('username')
            ]);

            return redirect()->route('kontributor_pengumuman')->with([
                'success' => 'Pengumuman berhasil ditambahkan',
                'pengumuman_id' => $pengumuman->id
            ]);
        } catch (\Exception $e) {
            // Hapus file jika sudah terupload tapi error saat menyimpan data
            if (!empty($filename) && file_exists(public_path('asset/files/' . $filename))) {
                unlink(public_path('asset/files/' . $filename));
            }

            return back()->withInput()->withErrors([
                'error' => 'Gagal menyimpan pengumuman. Error: ' . $e->getMessage()
            ]);
        }
    }

    // Start Download
    public function download()
    {
        $download = Download::orderBy('id_download', 'desc')->get();
        return view('kontributor.mod_download.download', compact('download'));
    }

    public function tambah_downloadKontributor()
    {
        $download = Download::all();
        return view('kontributor.mod_download.dowloadCreate', compact('download'));
    }

    public function simpan_downloadKontributor(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
        ]);

        try {
            $file = $request->file('file');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '-' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke public/asset/files
            $file->move(public_path('asset/files'), $filename);

            Download::create([
                'judul' => $request->judul,
                'nama_file' => $filename,
                'hits' => 0,
                'tgl_posting' => now(),
            ]);

            return redirect()->route('kontributor_download')->with('success', 'File download berhasil ditambahkan');
        } catch (\Exception $e) {
            // Hapus file jika sudah terupload tapi error saat menyimpan data
            if (!empty($filename) && file_exists(public_path('asset/files/' . $filename))) {
                unlink(public_path('asset/files/' . $filename));
            }

            return back()->withInput()->withErrors([
                'error' => 'Gagal menyimpan file. Error: ' . $e->getMessage()
            ]);
        }
    }

    // Start Agenda Admin
    public function agendaKontributor()
    {
        $agendakontributor = agenda::orderBy('id_agenda', 'desc')->get();
        return view('kontributor.mod_agenda.agenda', compact('agendakontributor'));
    }

    public function tambah_agendaKontributor()
    {
        $agendakontributor = Agenda::all();
        return view('kontributor.mod_agenda.agendaCreate');
    }

    public function simpan_agendaKontributor(Request $request)
    {
        $request->validate([
            'tema' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tempat' => 'required|string|max:255',
            'jam' => 'required|string|max:255',
            'tanggal' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
        ]);

        // Process date range
        $dateRange = explode(' - ', $request->tanggal);
        $tgl_mulai = \Carbon\Carbon::createFromFormat('d F Y', trim($dateRange[0]))->format('Y-m-d');
        $tgl_selesai = \Carbon\Carbon::createFromFormat('d F Y', trim($dateRange[1]))->format('Y-m-d');

        $data = [
            'tema' => $request->tema,
            'tema_seo' => Str::slug($request->tema),
            'isi_agenda' => $request->isi,
            'tempat' => $request->tempat,
            'pengirim' => $request->pengirim,
            'jam' => $request->jam,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'tgl_posting' => now()->format('Y-m-d'),
            'dibaca' => 0,
            'username' => Session::get('username')
        ];

        // Handle file upload using move()
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Buat direktori jika belum ada
            if (!file_exists(public_path('asset/files'))) {
                mkdir(public_path('asset/files'), 0777, true);
            }

            $file->move(public_path('asset/files'), $filename);
            $data['gambar'] = 'asset/files/' . $filename;
        }

        Agenda::create($data);

        return redirect()->route('kontributor_agenda')
            ->with('success', 'Agenda berhasil ditambahkan');
    }

    // Start Edit Profil
    public function editProfilKontributor()
    {

        $username = Session::get('username');
        $user = User::where('username', $username)->firstOrFail();

        return view('kontributor.mod_profile.profileEdit', compact('user'));
    }

    public function updateProfilKontributor(Request $request)
    {
        $username = Session::get('username');
        $user = User::where('username', $username)->firstOrFail();

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        // Handle upload foto
        if ($request->hasFile('foto')) {
            if ($user->foto && file_exists(public_path('storage/profiles/' . $user->foto))) {
                unlink(public_path('storage/profiles/' . $user->foto));
            }

            $filename = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('storage/profiles'), $filename);
            $validated['foto'] = $filename;
        }

        // Jika password diisi, hash dan simpan
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('Kontributor_edit_profil')->with('success', 'Profil berhasil diperbarui');
    }

    public function kepuasanPublikKontributor()
    {
        $dataKepuasan = KepuasanPublik::latest()->paginate(20);
        return view('kontributor.mod_kepuasanPublik.kepuasanPublik', compact('dataKepuasan'));
    }
}
