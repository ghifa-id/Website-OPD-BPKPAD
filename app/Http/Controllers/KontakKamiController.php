<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\PesanKontak;

class KontakKamiController extends Controller
{
    public function kontakKami(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validasi dan simpan hasil ke variabel
            $validated = $request->validate([
                'name'    => 'required|string|max:150',
                'email'   => 'required|email',
                'phone'   => 'nullable|string|max:20',
                'subject' => 'required|string|max:200',
                'message' => 'required|string',
            ]);

            // Simpan ke database
            PesanKontak::create($validated);

            // Return JSON untuk AJAX
            return response()->json(['message' => 'Pesan berhasil dikirim!']);
        }

        // Jika GET, tampilkan halaman
        return view('guest.kontakKami.kontakKami');
    }
}
