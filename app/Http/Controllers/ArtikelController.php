<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class ArtikelController extends Controller
{
    public function Artikel()
    {
        $artikel = Berita::orderBy('tanggal', 'desc')->take(5)->paginate(15);
        return view('guest.artikel.artikel', compact('artikel'));
    }
}
