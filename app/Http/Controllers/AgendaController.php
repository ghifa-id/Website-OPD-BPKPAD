<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\HalamanStatis;
use App\models\Menu;
use App\Models\Agenda;

use Illuminate\Http\Request;

class AgendaController extends Controller
{

    public function agenda()
    {
        $agenda = Agenda::orderBy('tgl_posting', 'desc')->paginate(5);

        $beritaTerpopuler = Berita::orderBy('dibaca', 'desc')
            ->take(6)
            ->get();

        $beritaTerbaru = Berita::orderBy('tanggal', 'desc')
            ->orderBy('jam', 'desc')
            ->take(6)
            ->get();

        return view('guest.agenda.agenda', compact('agenda', 'beritaTerbaru', 'beritaTerpopuler'));
    }
}
