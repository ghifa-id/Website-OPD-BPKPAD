<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\dokperenlitbang;
use Illuminate\Support\Facades\File;

class DokperenlitbangController extends Controller
{
    // Start Dokperenlitbang
    public function dokperenlitbang()
    {
        $dokperenlitbang = dokperenlitbang::orderBy('id_dokperenlitbang', 'desc')->get();
        return view('admin.mod_dokperenlitbang.dokperenlitbang', compact('dokperenlitbang'));
    }

    public function tambah_dokperenlitbang()
    {
        $dokperenlitbang = dokperenlitbang::all();
        return view('admin.mod_dokperenlitbang.dokperenlitbangCreate', compact('dokperenlitbang'));
    }

    public function simpan_dokperenlitbang(Request $request)
    {
        $request->validate([
            'jenis' => 'required|integer',
            'nama_file' => 'required|file|mimes:pdf|max:5120',
            'cover_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tahun_dokumen' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1)
        ]);

        $jenisOptions = $this->getJenisOptions();

        $data = [
            'jenis' => $request->jenis,
            'nama_file' => null, // placeholder
            'file' => null, // placeholder
            'tgl_posting' => now()->format('Y-m-d'),
            'hits' => 0,
            'tahun_dokumen' => $request->tahun_dokumen
        ];

        $uploadPath = public_path('asset/files/');
        $coverPath = public_path('asset/img_dokumen/');

        // Handle dokumen utama
        if ($request->hasFile('nama_file')) {
            $file = $request->file('nama_file');
            $originalName = $file->getClientOriginalName();
            $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('asset/files/'), $filename);

            $data['file'] = $filename;
            $data['nama_file'] = $filename;
        }


        // Handle cover (opsional)
        if ($request->hasFile('cover_file')) {
            $cover = $request->file('cover_file');
            $coverName = time() . '_cover_' . Str::slug(pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $cover->getClientOriginalExtension();

            $cover->move($coverPath, $coverName);
            $data['cover_file'] = $coverName;
        }

        // Simpan semua data ke database
        Dokperenlitbang::create($data);

        return redirect()->route('dokperenlitbang')->with('success', 'Dokumen berhasil ditambahkan');
    }



    public function edit_dokperenlitbang($id_dokperenlitbang)
    {
        $dokumen = dokperenlitbang::findOrFail($id_dokperenlitbang);
        $jenisOptions = $this->getJenisOptions();
        return view('admin.mod_dokperenlitbang.dokperenlitbangEdit', compact('dokumen', 'jenisOptions'));
    }

    public function update_dokperenlitbang(Request $request, $id_dokperenlitbang)
    {
        $request->validate([
            'jenis' => 'required|integer',
            'nama_file' => 'nullable|file|mimes:pdf|max:5120',
            'cover_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tahun_dokumen' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1)
        ]);

        $dokumen = dokperenlitbang::findOrFail($id_dokperenlitbang);
        $jenisOptions = $this->getJenisOptions();

        $data = [
            'jenis' => $request->jenis,
            'tahun_dokumen' => $request->tahun_dokumen,
        ];

        $uploadPath = public_path('asset/files/');
        $coverPath = public_path('asset/img_dokumen/');

        // Handle file dokumen (PDF)
        if ($request->hasFile('nama_file')) {
            if ($dokumen->file && file_exists(public_path($dokumen->file))) {
                File::delete(public_path($dokumen->file));
            }

            $file = $request->file('nama_file');
            $originalName = $file->getClientOriginalName();
            $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);

            $data['file'] = 'asset/files/' . $filename;
            $data['nama_file'] = $filename;
        }

        // Handle cover dokumen (optional)
        if ($request->hasFile('cover_file')) {
            if ($dokumen->cover_file && file_exists(public_path('asset/img_dokumen/' . $dokumen->cover_file))) {
                File::delete(public_path('asset/img_dokumen/' . $dokumen->cover_file));
            }

            $cover = $request->file('cover_file');
            $coverName = time() . '_cover_' . Str::slug(pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $cover->getClientOriginalExtension();
            $cover->move($coverPath, $coverName);

            $data['cover_file'] = $coverName;
        }


        $dokumen->update($data);

        return redirect()->route('dokperenlitbang')->with('success', 'Dokumen berhasil diperbarui');
    }


    public function delete_dokperenlitbang($id_dokperenlitbang)
    {
        $dokumen = dokperenlitbang::findOrFail($id_dokperenlitbang);

        if ($dokumen->file && file_exists(public_path($dokumen->file))) {
            File::delete(public_path($dokumen->file));
        }

        if ($dokumen->cover_file && file_exists(public_path($dokumen->cover_file))) {
            File::delete(public_path($dokumen->cover_file));
        }

        $dokumen->delete();

        return redirect()->route('dokperenlitbang')
            ->with('success', 'Dokumen berhasil dihapus');
    }

    private function getJenisOptions()
    {
        return [
            1 => 'Rencana Pembangunan Jangka Panjang Daerah',
            2 => 'Rencana Tata Ruang Wilayah',
            3 => 'Rencana Pembangunan Jangka Menengah Daerah',
            4 => 'Rencana Penanggulangan Kemiskinan Daerah',
            5 => 'Roadmap Pembangunan Ekonomi',
            6 => 'Rencana Strategis',
            7 => 'Rencana Kerja Pemerintah Daerah',
            8 => 'Musyawarah Perencanaan Pembangunan',
            9 => 'Rencana Kerja',
            10 => 'Perjanjian Kinerja',
            11 => 'Rencana Kerja Tahunan',
            12 => 'KUA dan PPAS',
            13 => 'Rencana Kebijakan Anggaran',
            14 => 'Evaluasi RPJMD',
            15 => 'Evaluasi RKPD',
            16 => 'Evaluasi Renja',
            17 => 'Evaluasi Pelaksanaan DAK',
            18 => 'Serapan Anggaran',
            19 => 'Penelitian',
            20 => 'Inovasi',
            21 => 'Monev',
            22 => 'Indeks Daya Saing Daerah (IDSD)',
            23 => 'Kajian - Peraturan Daerah',
            24 => 'Kajian - Peraturan Bupati',
            25 => 'Kajian - Peraturan Kepala Badan',
            26 => 'Rencana Kerja Pemerintah Daerah Perubahan'
        ];
    }

    private function uploadFile($file)
    {
        $originalName = $file->getClientOriginalName();
        $filename = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $path = 'asset/files/';

        if (!file_exists(public_path($path))) {
            mkdir(public_path($path), 0777, true);
        }

        $file->move(public_path($path), $filename);
        return $path . $filename;
    }
}
