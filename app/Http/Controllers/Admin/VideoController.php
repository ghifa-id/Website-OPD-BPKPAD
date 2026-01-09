<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\models\playlist;
use App\Models\video;

use Illuminate\Support\Facades\Storage;


class VideoController extends Controller
{
    // Start Video
    public function video()
    {
        $video = Video::orderBy('id_video', 'desc')->get();
        return view('admin.mod_video.video', compact('video'));
    }

    public function tambah_video()
    {
        $playlist = Playlist::all();
        return view('admin.mod_video.videoCreate', compact('playlist'));
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
            'username' => Session::get('username'),
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

    public function edit_video($id_video)
    {
        $video = Video::findOrFail($id_video);
        $playlist = Playlist::all();

        return view('admin.mod_video.videoEdit', compact('video', 'playlist'));
    }

    public function update_video(Request $request, $id_video)
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

        $video = Video::findOrFail($id_video);

        // Upload gambar baru jika ada
        $namaFile = $video->gbr_video;
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($video->gbr_video) {
                Storage::delete('public/gambar_video/' . $video->gbr_video);
            }

            $file = $request->file('gambar');
            $namaFile = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/gambar_video', $namaFile);
        }

        // Update data video
        $video->update([
            'id_playlist'   => $request->id_playlist,
            'jdl_video'     => $request->judul_video,
            'video_seo'     => Str::slug($request->judul_video),
            'keterangan'    => $request->keterangan,
            'gbr_video'     => $namaFile,
            'youtube'       => $request->youtube ?? $video->youtube,
            'tagvid'        => $request->tag ?? $video->tagvid,
            'tanggal'       => now()->format('Y-m-d'),
            'jam'          => now()->format('H:i:s')
        ]);

        return redirect()->route('video')->with('success', 'Video berhasil diperbarui!');
    }

    public function delete_Video($id_video)
    {
        $video = video::findOrFail($id_video);
        $video->delete();

        return redirect()->route('video')->with('success', 'Video berhasil dihapus!');
    }
    // End Video
}
