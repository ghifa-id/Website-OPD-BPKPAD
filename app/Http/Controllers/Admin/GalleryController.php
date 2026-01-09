<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use App\Models\Gallery;


class GalleryController extends Controller
{
    // Start Gallery
    public function gallery()
    {
        $gallery = Gallery::with('album')->orderBy('id_gallery', 'desc')->get();
        return view('admin.mod_gallery.gallery', compact('gallery'));
    }

    public function tambah_Gallery()
    {
        $album = Album::all();
        return view('admin.mod_gallery.galleryCreate', compact('album'));
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

        return redirect()->route('gallery')->with('success', 'Foto gallery berhasil disimpan.');
    }

    public function edit_Gallery($id_gallery)
    {
        $gallery = Gallery::findOrFail($id_gallery);
        $album = Album::all();
        return view('admin.mod_gallery.galleryEdit', compact('gallery', 'album'));
    }

    public function update_Gallery(Request $request, $id_gallery)
    {
        $gallery = Gallery::findOrFail($id_gallery);

        $request->validate([
            'id_album' => 'required|exists:album,id_album',
            'slider' => 'required|in:Y,N',
            'jdl_gallery' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename = $gallery->gbr_gallery;

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            $oldPath = public_path('asset/img_gallery/' . $filename);
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }

            // Upload foto baru
            $photo = $request->file('photo');
            $filename = time() . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('asset/img_gallery'), $filename);
        }

        // Update data gallery
        $gallery->update([
            'id_album' => $request->id_album,
            'slider' => $request->slider,
            'username' => Auth::user()->username ?? 'admin',
            'jdl_gallery' => $request->jdl_gallery,
            'gallery_seo' => Str::slug($request->jdl_gallery),
            'gbr_gallery' => $filename,
            'keterangan' => $request->keterangan ?? '-',
        ]);

        return redirect()->route('gallery')->with('success', 'Data gallery berhasil diperbarui.');
    }

    public function delete_Gallery($id_gallery)
    {
        $gallery = gallery::findOrFail($id_gallery);
        $gallery->delete();

        return redirect()->route('album')->with('success', 'Album berhasil dihapus!');
    }
    // End Gallery
}
