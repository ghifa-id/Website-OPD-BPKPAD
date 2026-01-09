<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\produk_hukum;


class ProdukHukumController extends Controller
{
    // Start produk Hukum
    public function produkHukum()
    {
        $proHukum = produk_hukum::orderBy('id_produk_hukum', 'desc')->get();
        return view('admin.mod_produHukum.produkHukum', compact('proHukum'));
    }

    public function tambah_produkHukum()
    {
        $proHukum = produk_hukum::all();
        return view('admin.mod_produHukum.produkHukumCreate', compact('proHukum'));
    }

    public function simpan_produkHukum(Request $request)
    {

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ket' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120'
        ], [
            'ket.required' => 'Kolom keterangan wajib diisi',
            'file.required' => 'File wajib diupload'
        ]);

        try {
            $filename = null;
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('asset/files'), $filename);
            }


            produk_hukum::create([
                'judul' => $validated['judul'],
                'ket' => $validated['ket'],
                'nama_file' => $filename,
                'tgl_posting' => now(),
                'hits' => 0,
            ]);

            return redirect()->route('produkhukum')->with('success', 'File Produk Hukum Berhasil Ditambahkan');
        } catch (\Exception $e) {
            if (!empty($filename) && file_exists(public_path('asset/files/' . $filename))) {
                @unlink(public_path('asset/files/' . $filename));
            }

            return back()->withInput()->withErrors([
                'error' => 'Gagal menyimpan. Error: ' . $e->getMessage()
            ]);
        }
    }

    public function edit_produkHukum($id_produk_hukum)
    {
        $proHukum = produk_hukum::findOrFail($id_produk_hukum);
        return view('admin.mod_produHukum.produkHukumEdit', compact('proHukum'));
    }

    public function update_produkHukum(Request $request, $id_produk_hukum)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'ket' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120'
        ], [
            'ket.required' => 'Kolom keterangan wajib diisi'
        ]);

        try {
            $proHukum = produk_hukum::findOrFail($id_produk_hukum);
            $filename = $proHukum->nama_file;

            // Proses upload file baru jika ada
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                if ($filename && file_exists(public_path('asset/files/' . $filename))) {
                    unlink(public_path('asset/files/' . $filename));
                }

                $file = $request->file('file');
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('asset/files'), $filename);
            }

            // Update data
            $proHukum->update([
                'judul' => $validated['judul'],
                'ket' => $validated['ket'],
                'nama_file' => $filename,
            ]);

            return redirect()->route('produkhukum')->with('success', 'Produk hukum berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors([
                'error' => 'Gagal memperbarui. Error: ' . $e->getMessage()
            ]);
        }
    }

    public function delete_produkHukum($id_produk_hukum)
    {
        try {
            $proHukum = produk_hukum::findOrFail($id_produk_hukum);

            // Hapus file fisik
            if ($proHukum->nama_file && file_exists(public_path('asset/files/' . $proHukum->nama_file))) {
                unlink(public_path('asset/files/' . $proHukum->nama_file));
            }

            $proHukum->delete();

            return redirect()->route('produkhukum')->with('success', 'File download berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Gagal menghapus file download. Error: ' . $e->getMessage()
            ]);
        }
    }
    // End Produk Hukum
}
