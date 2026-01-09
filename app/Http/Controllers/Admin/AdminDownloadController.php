<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Download;


class AdminDownloadController extends Controller
{
    // Start Download
    public function download()
    {
        $download = Download::orderBy('id_download', 'desc')->get();
        return view('admin.mod_download.download', compact('download'));
    }

    public function tambah_downloadAdmin()
    {
        $download = Download::all();
        return view('admin.mod_download.dowloadCreate', compact('download'));
    }

    public function simpan_downloadAdmin(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
        ]);

        try {
            $file = $request->file('file');
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                . '-' . time() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke public/asset/files
            $file->move(public_path('asset/files'), $filename);

            Download::create([
                'judul' => $request->judul,
                'nama_file' => $filename,
                'hits' => 0,
                'tgl_posting' => now(),
            ]);

            return redirect()->route('download')->with('success', 'File download berhasil ditambahkan');
        } catch (\Exception $e) {
            // Hapus file jika sudah terupload tapi error saat menyimpan data
            if (!empty($filename) && file_exists(public_path('asset/files/' . $filename))) {
                unlink(public_path('asset/files/' . $filename));
            }

            return back()->withInput()->withErrors([
                'error' => 'Gagal menyimpan file. Error: ' . $e->getMessage()
            ]);
        }
    }

    public function edit_downloadAdmin($id_download)
    {
        $download = Download::findOrFail($id_download);
        return view('admin.mod_download.downloadEdit', compact('download'));
    }

    public function update_downloadAdmin(Request $request, $id_download)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120',
        ]);

        try {
            $download = Download::findOrFail($id_download);
            $filename = $download->nama_file;

            // Handle file upload jika ada file baru
            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                if ($filename && file_exists(public_path('asset/files/' . $filename))) {
                    unlink(public_path('asset/files/' . $filename));
                }

                $file = $request->file('file');
                $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
                    . '-' . time() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke public/asset/files
                $file->move(public_path('asset/files'), $filename);
            }

            // Update data
            $download->update([
                'judul' => $request->judul,
                'nama_file' => $filename,
                'tgl_posting' => now(),
            ]);

            return redirect()->route('download')->with('success', 'File download berhasil diperbarui');
        } catch (\Exception $e) {
            // Hapus file jika sudah terupload tapi error saat menyimpan data
            if (!empty($filename) && file_exists(public_path('asset/files/' . $filename))) {
                unlink(public_path('asset/files/' . $filename));
            }

            return back()->withInput()->withErrors([
                'error' => 'Gagal memperbarui file download. Error: ' . $e->getMessage()
            ]);
        }
    }

    public function delete_downloadAdmin($id_download)
    {
        try {
            $download = Download::findOrFail($id_download);

            // Hapus file fisik
            if ($download->nama_file && file_exists(public_path('asset/files/' . $download->nama_file))) {
                unlink(public_path('asset/files/' . $download->nama_file));
            }

            $download->delete();

            return redirect()->route('download')->with('success', 'File download berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Gagal menghapus file download. Error: ' . $e->getMessage()
            ]);
        }
    }
    // End Download
}
