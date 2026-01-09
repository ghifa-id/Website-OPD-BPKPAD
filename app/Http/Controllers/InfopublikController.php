<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use App\Models\Transparasi;

class InfopublikController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Halaman Informasi Publik';
        $description = 'Deskripsi halaman informasi publik'; // Ganti jika ada helper
        $keywords = 'kata kunci'; // Ganti jika ada helper

        $jumlah = Transparasi::count();
        $perPage = $jumlah;

        $data = Transparasi::orderByDesc('id_transparasi')->paginate($perPage);

        return view('infopublik.index', [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'infopublik' => $data,
        ]);
    }

    public function file($filename)
    {
        $filePath = public_path("asset/files/" . $filename);

        if (!File::exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        Transparasi::where('nama_file', $filename)->increment('hits');

        return Response::download($filePath, $filename);
    }

    public function berkala()
    {
        return view('infopublik.berkala', [
            'title' => 'Informasi Berkala',
            'description' => 'Deskripsi Informasi Berkala',
            'keywords' => 'informasi berkala'
        ]);
    }

    public function sertamerta()
    {
        return view('infopublik.sertamerta', [
            'title' => 'Informasi Serta Merta',
            'description' => 'Deskripsi Informasi Serta Merta',
            'keywords' => 'informasi serta merta'
        ]);
    }

    public function setiapsaat()
    {
        return view('infopublik.setiapsaat', [
            'title' => 'Informasi Setiap Saat',
            'description' => 'Deskripsi Informasi Setiap Saat',
            'keywords' => 'informasi setiap saat'
        ]);
    }
}
