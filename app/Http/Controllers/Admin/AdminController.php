<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Agenda;
use App\Models\Berita;
use App\Models\HalamanStatis;
use App\Models\User;
use App\Models\Identitas;
use App\Models\Menu;
use App\Models\penghargaan;
use App\Models\Statistik;
use App\Models\KepuasanPublik;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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


        return view('admin.beranda', [
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

        $validated = $request->validate([
            'judul' => 'required|max:255',
            'isi_berita' => 'required',
        ]);

        $beritaData = array_merge($validated, [
            'judul_seo' => Str::slug($validated['judul']),
            'hari' => date('l'),
            'tanggal' => date('Y-m-d'),
            'jam' => date('H:i:s'),
            'keterangan_gambar' => '-',
            'gambar' => '-',
            'tag' => '-',
            'username' => Session::get('username'),
            'utama' => 'N',
            'id_kategori' => 1,
        ]);

        Berita::create($beritaData);

        return redirect()->route('administrator.beranda')->with('success', 'Berita berhasil ditambahkan!');
    }
    // End Berita Cepat



    // Start Identitas Website
    public function identitasWebsite()
    {
        $identitas = Identitas::first(); // ambil data pertama dari tabel
        return view('admin.mod_identitas.identitas', compact('identitas'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_website' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telp' => 'required',
            'facebook' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $identitas = Identitas::where('id_identitas', $request->id)->first();

        if ($identitas) {
            $identitas->update($data);
            return response()->json(['success' => true, 'message' => 'Identitas Website berhasil diperbarui.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
        }
    }
    // End Identitas Website

    // Start Menu Website
    public function menuWebsite()
    {
        // Ambil semua data menu

        $menus = Menu::orderBy('urutan')->paginate(10);


        return view('admin.mod_menu.menu', compact('menus'));
    }

    public function tambah_menuWebite()
    {
        $menus = Menu::all(); // Ambil semua menu dari database
        return view('admin.mod_menu.menuCreate', compact('menus'));
    }

    public function simpan_MenuWebsite(Request $request)
    {
        $request->validate([
            'level_menu' => 'required',
            'nama_menu' => 'required',
            'link_menu' => 'required',
            'position' => 'required',
            'urutan' => 'required|integer',
        ]);

        // Simpan ke database menggunakan model
        Menu::create([
            'id_parent' => $request->level_menu,
            'nama_menu' => $request->nama_menu,
            'link' => $request->link_menu,
            'aktif' => 'Ya',
            'position' => $request->position,
            'urutan' => $request->urutan,
        ]);

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan.');
    }


    public function edit_menuWebsite($id)
    {
        $menu = Menu::findOrFail($id);
        $menus = Menu::all();

        return view('admin.mod_menu.menuEdit', compact('menu', 'menus'));
    }

    public function update_menuWebsite(Request $request, $id)
    {
        $request->validate([
            'link_menu' => 'required',
            'level_menu' => 'required',
            'nama_menu' => 'required',
            'position' => 'required',
            'urutan' => 'required|integer',
            'aktif' => 'required|in:Ya,Tidak',
        ]);

        $menu = Menu::findOrFail($id);
        $menu->link = $request->link_menu;
        $menu->id_parent = $request->level_menu;
        $menu->nama_menu = $request->nama_menu;
        $menu->position = $request->position;
        $menu->urutan = $request->urutan;
        $menu->aktif = $request->aktif;
        $menu->save();

        return redirect()->route('tambah_menuwebsite')->with('success', 'Menu berhasil diupdate.');
    }

    public function delete_menuWebsite($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('judulmenu')->with('success', 'Menu berhasil dihapus');
    }
    // End Menu Website

    // Start Halaman Baru
    public function halamanBaru()
    {
        $halaman = HalamanStatis::orderBy('id_halaman', 'desc')->get();

        return view('admin.mod_halaman.halaman', compact('halaman'));
    }

    public function tambah_halamanBaru()
    {
        $halaman = HalamanStatis::all(); // Contoh ambil data menu, supaya dropdown level menu bisa diisi
        return view('admin.mod_halaman.halamanCreate', compact('halaman'));
    }


    public function simpan_halamanBaru(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi_halaman' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
            'link_menu' => 'nullable|string',
            'level_menu' => 'nullable|integer',
            'nama_menu' => 'nullable|string',
            'position' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        $seo = Str::slug($request->judul);
        $fileName = null;

        if ($request->hasFile('gambar')) {
            $nama = 'HLMST';
            $acak = Str::random(10);
            $angka = rand(10000, 99999);
            $fileName = $nama . '_' . $acak . '_' . $angka . '.' . $request->gambar->getClientOriginalExtension();
            $request->gambar->move(public_path('asset/foto_statis'), $fileName);
        }

        HalamanStatis::create([
            'judul' => $request->judul,
            'judul_seo' => $seo,
            'isi_halaman' => $request->isi_halaman,
            'tgl_posting' => now()->format('Y-m-d'),
            'gambar' => $fileName,
            'username' => Auth::user()->username ?? 'admin',
            'dibaca' => 0,
            'jam' => now()->format('H:i:s'),
            'hari' => hariIni(now()->dayOfWeek),
            'link_menu' => $request->link_menu,
            'level_menu' => $request->level_menu,
            'nama_menu' => $request->nama_menu,
            'position' => $request->position,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('tambah_halamanbaru')->with('success', 'Halaman berhasil ditambahkan');
    }

    public function edit_halamanBaru($id_menu)
    {
        $halaman = HalamanStatis::findOrFail($id_menu);
        return view('admin.mod_halaman.halamanEdit', compact('halaman'));
    }

    // Update data halaman setelah diedit
    public function update_halamanBaru(Request $request, $id_menu)
    {
        $request->validate([
            'judul' => 'required',
            'isi_halaman' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:3000',
            'link_menu' => 'nullable|string',
            'level_menu' => 'nullable|integer',
            'nama_menu' => 'nullable|string',
            'position' => 'nullable|string',
            'urutan' => 'nullable|integer',
        ]);

        $halaman = HalamanStatis::findOrFail($id_menu);

        $seo = Str::slug($request->judul);
        $fileName = $halaman->gambar;

        if ($request->hasFile('gambar')) {

            if ($halaman->gambar && file_exists(public_path('asset/foto_statis/' . $halaman->gambar))) {
                unlink(public_path('asset/foto_statis/' . $halaman->gambar));
            }

            $nama = 'HLMST';
            $acak = Str::random(10);
            $angka = rand(10000, 99999);
            $fileName = $nama . '_' . $acak . '_' . $angka . '.' . $request->gambar->getClientOriginalExtension();
            $request->gambar->move(public_path('asset/foto_statis'), $fileName);
        }

        $halaman->update([
            'judul' => $request->judul,
            'judul_seo' => $seo,
            'isi_halaman' => $request->isi_halaman,
            'tgl_posting' => now()->format('Y-m-d'),
            'gambar' => $fileName,
            'username' => Auth::user()->username ?? 'admin',
            'jam' => now()->format('H:i:s'),
            'hari' => hariIni(now()->dayOfWeek),
            'link_menu' => $request->link_menu,
            'level_menu' => $request->level_menu,
            'nama_menu' => $request->nama_menu,
            'position' => $request->position,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('tambah_halamanbaru')->with('success', 'Halaman berhasil diperbarui');
    }

    public function delete_halamanBaru($id_menu)
    {
        $halaman = HalamanStatis::findOrFail($id_menu);
        $halaman->delete();

        return redirect()->route('kontenmenu')->with('success', 'Halaman Berhasil Dihapus');
    }
    // End Halaman Baru

    // Start Penghargaan
    public function penghargaan()
    {
        $penghargaan = Penghargaan::orderBy('tgl_posting', 'desc')->get();
        return view('admin.mod_penghargaan.penghargaan', compact('penghargaan'));
    }
    public function edit_penghargaan($id_penghargaan)
    {
        $penghargaan = Penghargaan::findOrFail($id_penghargaan);
        return view('admin.mod_penghargaan.penghargaanEdit', compact('penghargaan'));
    }

    public function update_penghargaan(Request $request, $id_penghargaan)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'pemberi'   => 'required|string|max:255',
            'tahun'     => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'tingkat'   => 'required|in:Nasional,Provinsi,Kabupaten',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:3072', // 3MB
        ]);

        $penghargaan = Penghargaan::findOrFail($id_penghargaan);


        if ($request->hasFile('gambar')) {
            if ($penghargaan->gambar && file_exists(public_path('asset/penghargaan/' . $penghargaan->gambar))) {
                unlink(public_path('asset/penghargaan/' . $penghargaan->gambar));
            }

            $gambar     = $request->file('gambar');
            $gambarName = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('asset/penghargaan'), $gambarName);
            $penghargaan->gambar = $gambarName;
        }

        $penghargaan->judul     = $request->judul;
        $penghargaan->deskripsi = strip_tags($request->deskripsi);
        $penghargaan->pemberi   = $request->pemberi;
        $penghargaan->tahun     = $request->tahun;
        $penghargaan->tingkat   = $request->tingkat;
        $penghargaan->save();

        return redirect()->route('administrator.penghargaan')->with('success', 'Penghargaan berhasil diperbarui!');
    }

    public function tambah_penghargaan()
    {
        return view('admin.mod_penghargaan.penghargaanCreate');
    }

    public function simpan_penghargaan(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'pemberi'   => 'required|string|max:255',
            'tahun'     => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'tingkat'   => 'required|in:Nasional,Provinsi,Kabupaten',
            'gambar'    => 'nullable|image|mimes:jpg,jpeg,png|max:3072', // 5MB
        ]);

        $gambarName = null;

        if ($request->hasFile('gambar')) {
            $gambar     = $request->file('gambar');
            $gambarName = time() . '_' . Str::slug($request->judul) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('asset/penghargaan'), $gambarName);
        }

        Penghargaan::create([
            'judul'     => $request->judul,
            'deskripsi' => strip_tags($request->deskripsi),
            'pemberi'   => $request->pemberi,
            'tahun'     => $request->tahun,
            'tingkat'   => $request->tingkat,
            'gambar'    => $gambarName,
            'tgl_posting' => date('Y-m-d'),
            'jam'         => date('H:i:s'),
            'username'    => Auth::user()->username ?? 'admin', // fallback jika tidak login
            'dibaca'      => 1,
        ]);

        return redirect()->back()->with('success', 'Penghargaan berhasil ditambahkan!');
    }

    public function delete_penghargaan($id_penghargaan)
    {
        $penghargaan = Penghargaan::findOrFail($id_penghargaan);


        if ($penghargaan->gambar && file_exists(public_path('asset/penghargaan/' . $penghargaan->gambar))) {
            unlink(public_path('asset/penghargaan/' . $penghargaan->gambar));
        }

        $penghargaan->delete();

        return redirect()->route('administrator.penghargaan')->with('success', 'Penghargaan berhasil dihapus!');
    }
}
