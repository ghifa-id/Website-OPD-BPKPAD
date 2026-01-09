<?php

namespace App\Http\Controllers;


use App\Models\Menu;
use App\Models\HalamanStatis;
use App\Models\Berita;
use App\Models\Komentar;
use App\Models\Kategori;
use App\Models\BeritaLike;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BeritaUserController extends Controller
{
    public function showBeritaAll()
    {
        $berita = Berita::orderBy('tanggal', 'desc')->paginate(15);
        return view('guest.berita.beritaPage', compact('berita'));
    }

    public function showBerita($slug)
    {
        $menus = Menu::where('aktif', 'Ya')->orderBy('urutan', 'asc')->get();

        $berita = Berita::withCount([
            'likes as likes_count' => fn($q) => $q->where('tipe', 'like'),
            'likes as dislikes_count' => fn($q) => $q->where('tipe', 'dislike'),
        ])
            ->with(['komentar', 'kategori'])
            ->where('judul_seo', $slug)
            ->first();

        if (!$berita) {
            abort(404);
        }

        $page = HalamanStatis::where('judul_seo', $slug)->first();

        $beritaTerpopuler = Berita::orderBy('dibaca', 'desc')
            ->take(6)
            ->get();

        $beritaTerbaru = Berita::orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->take(6)
            ->get();

        $allKategori = Kategori::where('aktif', 'Y')->get();

        return view('guest.berita.beritaShow', compact('beritaTerbaru', 'beritaTerpopuler', 'berita', 'allKategori'));
    }


    public function kategori($slug)
    {

        $kategori = Kategori::where('kategori_seo', $slug)->first();

        if (!$kategori) {
            return redirect('/');
        }

        $berita = Berita::withCount('komentar')
            ->where('id_kategori', $kategori->id_kategori)
            ->orderBy('tanggal', 'desc')
            ->paginate(5);

        $utama = Berita::latest('tanggal')->take(15)->get();

        $beritaTerpopuler = Berita::orderBy('dibaca', 'desc')->take(6)->get();
        $beritaTerbaru = Berita::orderBy('tanggal', 'desc')->orderBy('jam', 'desc')->take(6)->get();

        return view('guest.berita.beritaKategori', [
            'berita' => $berita,
            'utama' => $utama,
            'kategori' => $kategori,
            'title' => $kategori->nama_kategori,
            'description' => $kategori->nama_kategori,
            'keywords' => $kategori->nama_kategori,
            'beritaTerbaru' => $beritaTerbaru,
            'beritaTerpopuler' => $beritaTerpopuler,
        ]);
    }


    public function postKomentar(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|exists:berita,id_berita',
            'nama_pengguna' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'isi_komentar' => 'required|string',
        ]);

        $komentar = new Komentar();
        $komentar->id_berita = $validated['id'];
        $komentar->nama_pengguna = $validated['nama_pengguna'];
        $komentar->email = $validated['email'];
        $komentar->isi_komentar = $validated['isi_komentar'];
        $komentar->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Komentar berhasil dikirim!',
            'komentar' => $komentar,
        ]);
    }

    public function beritaLike(Request $request)
    {
        $validated = $request->validate([
            'berita_id' => 'required|exists:berita,id_berita',
            'tipe' => 'required|in:like,dislike'
        ]);

        $existing = BeritaLike::where('berita_id', $validated['berita_id'])
            ->where('ip_address', $request->ip())
            ->first();

        if ($existing) {
            if ($existing->tipe === $validated['tipe']) {
                return response()->json(['status' => 'info', 'message' => 'Kamu sudah memberikan tanggapan.']);
            }
            $existing->update(['tipe' => $validated['tipe']]);
        } else {
            BeritaLike::create([
                'berita_id' => $validated['berita_id'],
                'tipe' => $validated['tipe'],
                'ip_address' => $request->ip(),
            ]);
        }

        return response()->json([
            'status' => 'success',
            'likes' => BeritaLike::where('berita_id', $validated['berita_id'])->where('tipe', 'like')->count(),
            'dislikes' => BeritaLike::where('berita_id', $validated['berita_id'])->where('tipe', 'dislike')->count(),
        ]);
    }
}
