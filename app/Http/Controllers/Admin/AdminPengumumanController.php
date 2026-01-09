<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Models\announcement;


class AdminPengumumanController extends Controller
{
    // Start Pengumuman Admin
    public function pengumumanAdmin()
    {
        $pengumuman = announcement::orderBy('id_announcement', 'desc')->get();
        return view('admin.mod_pengumuman.pengumuman', compact('pengumuman'));
    }

    public function tambah_pengumumanAdmin()
    {
        $pengumuman = announcement::all();
        return view('admin.mod_pengumuman.pengumumanCreate', compact('pengumuman'));
    }

    public function simpan_pengumumanAdmin(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_posting' => 'required|date',
            'perihal' => 'required|string|max:255',
            'deskripsi_pengumuman' => 'required|string',
            'file_pendukung' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120', // 5MB
            'keterangan' => 'nullable|string'
        ]);

        try {
            // Handle file upload jika ada
            $filename = null;
            if ($request->hasFile('file_pendukung')) {
                $file = $request->file('file_pendukung');
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '-' . time() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke public/asset/files
                $file->move(public_path('asset/files'), $filename);
            }

            // Simpan data ke database
            $pengumuman = announcement::create([
                'judul' => $validated['judul'],
                'judul_seo' => Str::slug($validated['judul']),
                'tanggal_posting' => $validated['tanggal_posting'],
                'deadline' => $validated['tanggal_posting'],
                'perihal' => $validated['perihal'],
                'deskripsi_pengumuman' => $validated['deskripsi_pengumuman'],
                'file_pendukung' => $filename ? $filename : null,
                'keterangan' => $validated['keterangan'] ?? null,
                'username' => Session::get('username')
            ]);

            return redirect()->route('admin.pengumuman')->with([
                'success' => 'Pengumuman berhasil ditambahkan',
                'pengumuman_id' => $pengumuman->id
            ]);
        } catch (\Exception $e) {
            // Hapus file jika sudah terupload tapi error saat menyimpan data
            if (!empty($filename) && file_exists(public_path('asset/files/' . $filename))) {
                unlink(public_path('asset/files/' . $filename));
            }

            return back()->withInput()->withErrors([
                'error' => 'Gagal menyimpan pengumuman. Error: ' . $e->getMessage()
            ]);
        }
    }

    public function edit_pengumumanAdmin($id_announcement)
    {
        $pengumuman = announcement::findOrFail($id_announcement);
        return view('admin.mod_pengumuman.pengumumanEdit', compact('pengumuman'));
    }

    public function update_pengumumanAdmin(Request $request, $id_announcement)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal_posting' => 'required|date',
            'perihal' => 'required|string|max:255',
            'deskripsi_pengumuman' => 'required|string',
            'file_pendukung' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:5120', // 5MB
            'keterangan' => 'nullable|string'
        ]);

        try {
            $pengumuman = announcement::findOrFail($id_announcement);
            $filename = $pengumuman->file_pendukung;

            // Handle file upload jika ada file baru
            if ($request->hasFile('file_pendukung')) {
                // Hapus file lama jika ada
                if ($filename && file_exists(public_path('asset/files/' . $filename))) {
                    unlink(public_path('asset/files/' . $filename));
                }

                $file = $request->file('file_pendukung');
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '-' . time() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke public/asset/files
                $file->move(public_path('asset/files'), $filename);
            }

            // Update data
            $pengumuman->update([
                'judul' => $validated['judul'],
                'judul_seo' => Str::slug($validated['judul']),
                'tanggal_posting' => $validated['tanggal_posting'],
                'deadline' => $validated['tanggal_posting'],
                'perihal' => $validated['perihal'],
                'deskripsi_pengumuman' => $validated['deskripsi_pengumuman'],
                'file_pendukung' => $filename,
                'keterangan' => $validated['keterangan'] ?? null,
                'username' => Session::get('username')
            ]);

            return redirect()->route('admin.pengumuman')->with([
                'success' => 'Pengumuman berhasil diperbarui'
            ]);
        } catch (\Exception $e) {
            // Hapus file jika sudah terupload tapi error saat menyimpan data
            if (!empty($filename) && file_exists(public_path('asset/files/' . $filename))) {
                unlink(public_path('asset/files/' . $filename));
            }

            return back()->withInput()->withErrors([
                'error' => 'Gagal memperbarui pengumuman. Error: ' . $e->getMessage()
            ]);
        }
    }

    public function delete_pengumumanAdmin($id_announcement)
    {
        $pengumuman = announcement::findOrFail($id_announcement);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman')->with('success', 'Pengumuman berhasil dihapus!');
    }
    // End Pengumuman Admin

}
