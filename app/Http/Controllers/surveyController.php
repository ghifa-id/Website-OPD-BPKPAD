<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KepuasanPublik;

class surveyController extends Controller
{
    public function kepuasanPublik()
    {
        return view('guest.kepuasanPublik.kepuasanPublik');
    }

    public function kepuasanPublikStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'nullable|email',
            'skor' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:1000',
            'informasi' => 'required|in:Ya,Tidak',
            'fitur' => 'required|string|max:1000',
        ]);

        KepuasanPublik::create($request->all());

        return redirect()->route('kepuasanPublik')->with('success', 'Terima kasih atas penilaian Anda!');
    }
}
