<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Playlist;


class PlaylistController extends Controller
{
    // Start Playlist
    public function Playlist()
    {

        $playlist = Playlist::orderBy('id_playlist', 'desc')->get();
        return view('admin.mod_playlist.playlist', compact('playlist'));
    }

    public function tambah_Playlist()
    {
        $playlist = Playlist::all();
        return view('admin.mod_playlist.playlistCreate', compact('playlist'));
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
        return redirect()->route('playlist')->with('success', 'Playlist berhasil ditambahkan.');
    }

    public function edit_Playlist($id_playlist)
    {
        $playlist = Playlist::findOrFail($id_playlist);
        return view('admin.mod_playlist.playlistEdit', compact('playlist'));
    }

    public function update_Playlist(Request $request, $id_playlist)
    {
        // Ambil data playlist yang akan diupdate
        $playlist = Playlist::findOrFail($id_playlist);

        // Validasi input
        $request->validate([
            'jdl_playlist' => 'required|string|max:255',
            'gbr_playlist' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Data yang akan diupdate
        $data = [
            'jdl_playlist'   => $request->jdl_playlist,
            'username'       => Auth::user()->username ?? 'admin',
            'playlist_seo'   => Str::slug($request->jdl_playlist),
        ];

        // Jika ada file gambar baru diunggah
        if ($request->hasFile('gbr_playlist')) {
            $file = $request->file('gbr_playlist');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('asset/img_playlist'), $filename);

            // Hapus gambar lama jika bukan default
            if ($playlist->gbr_playlist !== 'default.jpg' && file_exists(public_path('asset/img_playlist/' . $playlist->gbr_playlist))) {
                unlink(public_path('asset/img_playlist/' . $playlist->gbr_playlist));
            }

            $data['gbr_playlist'] = $filename;
        }

        // Update data playlist
        $playlist->update($data);

        // Redirect dengan pesan sukses
        return redirect()->route('playlist')->with('success', 'Playlist berhasil diperbarui.');
    }

    public function delete_Playlist($id_playlist)
    {
        $playlist = Playlist::findOrFail($id_playlist);
        $playlist->delete();

        return redirect()->route('playlist')->with('success', 'Playlist berhasil dihapus!');
    }

    // End Playlist
}
