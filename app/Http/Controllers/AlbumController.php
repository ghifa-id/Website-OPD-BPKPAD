<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\Gallery;
use App\Models\Playlist;
use App\Models\video;

use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function Foto()
    {
        $foto = album::orderBy('tgl_posting', 'desc')->paginate(15);
        return view('guest.galeriFoto.foto', compact('foto'));
    }

    public function showAlbum($seo)
    {
        $album = Album::where('album_seo', $seo)->firstOrFail();
        $galeri = Gallery::where('id_album', $album->id_album)->get();

        return view('guest.galeriFoto.fotoDetail', compact('album', 'galeri'));
    }

    public function Video()
    {
        $video = Playlist::orderBy('id_playlist', 'desc')->paginate(15);
        return view('guest.playlist.playlist', compact('video'));
    }

    public function showVideo($seo)
    {
        // Cari berdasarkan playlist_seo jika video_seo tidak ada
        $playlist = Playlist::where('playlist_seo', $seo)
            ->where('aktif', 'Y')
            ->firstOrFail();

        $videos = Video::where('id_playlist', $playlist->id_playlist)
            ->orderBy('tanggal', 'desc')
            ->paginate(12);

        return view('guest.playlist.playlistDetail', compact('playlist', 'videos'));
    }
}
