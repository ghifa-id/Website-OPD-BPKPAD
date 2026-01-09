<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Berita;
use App\Models\Kategori;



class BeritaController extends Controller
{
    // Start List Berita

    public function listBerita()
    {
        $listberita = Berita::with(['user', 'kategori'])
            ->orderBy('id_berita', 'desc')
            ->get();

        return view('admin.mod_berita.berita', compact('listberita'));
    }

    public function tambah_listBerita()
    {
        $listberita = Berita::all();
        $kategori = Kategori::all();
        return view('admin.mod_berita.beritaCreate', compact('listberita', 'kategori'));
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
        $data['jam'] = Carbon::now()->format('H:i:s');
        $data['judul_seo'] = seo_title($data['judul']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('asset/foto_berita'), $filename);
            $data['gambar'] = $filename;
        }


        $data['username'] = session('username') ?? 'admin';
        Berita::create($data);

        return redirect()->route('listberita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit_listBerita($id_berita)
    {
        $berita = Berita::findOrFail($id_berita);
        $kategori = Kategori::all();
        return view('admin.mod_berita.beritaEdit', compact('berita', 'kategori'));
    }

    public function update_listBerita(Request $request, $id_berita)
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

        $berita = Berita::findOrFail($id_berita);

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
        $data['jam'] = Carbon::now()->format('H:i:s');
        $data['judul_seo'] = seo_title($data['judul']);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && file_exists(public_path('asset/foto_berita/' . $berita->gambar))) {
                unlink(public_path('asset/foto_berita/' . $berita->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('asset/foto_berita'), $filename);
            $data['gambar'] = $filename;
        }

        $data['username'] = session('username') ?? 'admin';

        $berita->update($data);

        return redirect()->route('listberita', $id_berita)->with('success', 'Berita berhasil diperbarui.');
    }

    public function delete_listBerita($id_berita)
    {
        $listberita = Berita::findOrFail($id_berita); // sesuai nama kolom
        $listberita->delete();

        return redirect()->route('listberita')->with('success', 'Berita berhasil dihapus');
    }
    // End List Berita

    // Start Kategori Berita
    public function kategoriBerita()
    {
        $kategori = kategori::orderBy('id_kategori', 'desc')->get();
        return view('admin.mod_kategori.kategori', compact('kategori'));
    }

    public function tambah_kategoriBerita()
    {
        return view('admin.mod_kategori.kategoriCreate');
    }

    public function simpan_kategoriBerita(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'sidebar' => 'required|in:1,0',
            'aktif' => 'required|in:Y,N',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'username' => Auth::user()->username ?? 'admin',
            'kategori_seo' => Str::slug($request->nama_kategori),
            'sidebar' => $request->sidebar,
            'aktif' => $request->aktif,
        ]);

        return redirect()->route('kategoriberita')->with('success', 'Kategori berhasil ditambahkan');
        return redirect()->back()->with('error', 'Gagal Menambah kategori');
    }

    public function edit_kategoriBerita($id_kategori)
    {
        $kategori = Kategori::findOrFail($id_kategori);
        return view('admin.mod_kategori.kategoriEdit', compact('kategori'));
    }

    public function update_kategoriBerita(Request $request, $id_kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'sidebar' => 'required|in:1,0',
            'aktif' => 'required|in:Y,N',
        ]);

        $kategori = Kategori::findOrFail($id_kategori);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'kategori_seo' => Str::slug($request->nama_kategori),
            'sidebar' => $request->sidebar,
            'aktif' => $request->aktif,
        ]);

        return redirect()->route('kategoriberita')->with('success', 'Kategori berhasil diperbarui');
        return redirect()->back()->with('error', 'Gagal memperbarui kategori');
    }

    public function delete_kategoriBerita($id_kategori)
    {
        $kategori = kategori::findOrFail($id_kategori);
        $kategori->delete();

        return redirect()->route('kategoriberita')->with('success', 'Kategori berhasil dihapus!');
    }

    // End Kategori Berita
}
