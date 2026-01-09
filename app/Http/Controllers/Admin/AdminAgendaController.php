<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Agenda;


class AdminAgendaController extends Controller
{
    // Start Agenda Admin
    public function agendaAdmin()
    {
        $agendaAdmin = Agenda::orderBy('id_agenda', 'desc')->get();
        return view('admin.mod_agenda.agenda', compact('agendaAdmin'));    
    }

    public function tambah_agendaAdmin()
    {
        $agendaAdmin = Agenda::all();
        return view('admin.mod_agenda.agendaCreate');
    }

    public function simpan_agendaAdmin(Request $request)
    {
        $request->validate([
            'tema' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tempat' => 'required|string|max:255',
            'jam' => 'required|string|max:255',
            'tanggal' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
        ]);

        // Process date range
        $dateRange = explode(' - ', $request->tanggal);
        $tgl_mulai = \Carbon\Carbon::createFromFormat('d F Y', trim($dateRange[0]))->format('Y-m-d');
        $tgl_selesai = \Carbon\Carbon::createFromFormat('d F Y', trim($dateRange[1]))->format('Y-m-d');

        $data = [
            'tema' => $request->tema,
            'tema_seo' => Str::slug($request->tema),
            'isi_agenda' => $request->isi,
            'tempat' => $request->tempat,
            'pengirim' => $request->pengirim,
            'jam' => $request->jam,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
            'tgl_posting' => now()->format('Y-m-d'),
            'dibaca' => 0,
            'username' => Session::get('username')
        ];

        // Handle file upload using move()
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Buat direktori jika belum ada
            if (!file_exists(public_path('asset/files'))) {
                mkdir(public_path('asset/files'), 0777, true);
            }

            $file->move(public_path('asset/files'), $filename);
            $data['gambar'] = 'asset/files/' . $filename;
        }

        Agenda::create($data);

        return redirect()->route('administrator.agenda')
            ->with('success', 'Agenda berhasil ditambahkan');
    }

    public function edit_agendaAdmin($id_agenda)
    {
        $agenda = Agenda::findOrFail($id_agenda);

        $tgl_mulai = \Carbon\Carbon::parse($agenda->tgl_mulai)->format('d F Y');
        $tgl_selesai = \Carbon\Carbon::parse($agenda->tgl_selesai)->format('d F Y');
        $agenda->tanggal = $tgl_mulai . ' - ' . $tgl_selesai;

        return view('admin.mod_agenda.agendaEdit', compact('agenda'));
    }

    public function update_agendaAdmin(Request $request, $id_agenda)
    {
        $request->validate([
            'tema' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tempat' => 'required|string|max:255',
            'jam' => 'required|string|max:255',
            'tanggal' => 'required|string|max:255',
            'pengirim' => 'required|string|max:255',
        ]);

        $agenda = Agenda::findOrFail($id_agenda);

        // Process date range
        $dateRange = explode(' - ', $request->tanggal);
        $tgl_mulai = \Carbon\Carbon::createFromFormat('d F Y', trim($dateRange[0]))->format('Y-m-d');
        $tgl_selesai = \Carbon\Carbon::createFromFormat('d F Y', trim($dateRange[1]))->format('Y-m-d');

        $data = [
            'tema' => $request->tema,
            'tema_seo' => Str::slug($request->tema),
            'isi_agenda' => $request->isi,
            'tempat' => $request->tempat,
            'pengirim' => $request->pengirim,
            'jam' => $request->jam,
            'tgl_mulai' => $tgl_mulai,
            'tgl_selesai' => $tgl_selesai,
        ];

        // Handle file upload using move()
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Buat direktori jika belum ada
            if (!file_exists(public_path('asset/files'))) {
                mkdir(public_path('asset/files'), 0777, true);
            }

            // Hapus gambar lama jika ada
            if ($agenda->gambar && file_exists(public_path($agenda->gambar))) {
                unlink(public_path($agenda->gambar));
            }

            $file->move(public_path('asset/files'), $filename);
            $data['gambar'] = 'asset/files/' . $filename;
        }

        $agenda->update($data);

        return redirect()->route('administrator.agenda')
            ->with('success', 'Agenda berhasil diperbarui');
    }

    public function delete_agendaAdmin($id_agenda)
    {
        $agenda = Agenda::findOrFail($id_agenda);

        if ($agenda->gambar) {
            Storage::disk('public')->delete($agenda->gambar);
        }

        $agenda->delete();

        return redirect()->route('administrator.agenda')
            ->with('success', 'Agenda berhasil dihapus');
    }
}
