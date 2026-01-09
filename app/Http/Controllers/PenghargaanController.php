<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HalamanStatis;
use App\models\Menu;
use App\models\penghargaan;

class PenghargaanController extends Controller
{
    public function penghargaan()
    {
        $menus = Menu::where('aktif', 'Ya')->orderBy('urutan', 'asc')->get();
        $penghargaan = Penghargaan::orderBy('tahun', 'desc')->paginate(5);
        $offset = $penghargaan->currentPage() * 5;
        $secPenghargaan = Penghargaan::orderBy('tahun', 'desc')
            ->skip($offset)
            ->take(5)
            ->get();

        return view('guest.penghargaan.penghargaan', compact('menus', 'penghargaan', 'secPenghargaan'));
    }
}
