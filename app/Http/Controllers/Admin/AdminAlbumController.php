<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Album;


class AdminAlbumController extends Controller
{
    // Start album
    public function Album()
    {
        $album = Album::orderBy('id_album', 'desc')->get();
        return view('admin.mod_album.album', compact('album'));
    }

    public function tambah_Album()
    {
        return view('admin.mod_album.albumCreate');
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

    public function edit_Album($id_album)
    {
        $album = Album::findOrFail($id_album);
        return view('admin.mod_album.abumEdit', compact('album'));
    }

    public function update_Album(Request $request, $id_album)
    {
        // Validasi data
        $request->validate([
            'jdl_album'     => 'required|string|max:100',
            'keterangan'    => 'required|string',
            'tgl_kegiatan'  => 'required|date',
            'tempat'        => 'required|string|max:100',
            'gbr_album'     => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
        ]);

        $album = Album::findOrFail($id_album);

        // Cek dan upload gambar baru
        if ($request->hasFile('gbr_album')) {
            $file = $request->file('gbr_album');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destination = public_path('asset/img_album');
            $file->move($destination, $filename);

            // Hapus gambar lama jika ada dan bukan default
            if ($album->gbr_album && $album->gbr_album !== 'default.jpg') {
                $oldPath = public_path('asset/img_album/' . $album->gbr_album);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $album->gbr_album = $filename;
        }

        // Update data album
        $album->update([
            'jdl_album'     => $request->jdl_album,
            'album_seo'     => Str::slug($request->jdl_album),
            'keterangan'    => $request->keterangan,
            'tgl_kegiatan'  => $request->tgl_kegiatan,
            'tempat'        => $request->tempat,
            'aktif'         => $request->aktif,
            'hari'          => now()->isoFormat('dddd'),
            'jam'           => Carbon::now()->toTimeString(),
            'tgl_posting'   => Carbon::now()->toDateString(),
            'username'      => Auth::user()->username ?? 'admin',
        ]);

        return redirect()->route('album')->with('success', 'Album berhasil diperbarui.');
    }

    public function delete_Album($id_album)
    {
        $album = Album::findOrFail($id_album);
        $album->delete();

        return redirect()->route('album')->with('success', 'Album berhasil dihapus!');
    }
    // End album
}
