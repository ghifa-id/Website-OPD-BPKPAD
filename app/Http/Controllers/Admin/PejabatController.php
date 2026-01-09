<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jabatan;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class PejabatController extends Controller
{
    public function Jabatan()
    {
        $jabatan = Jabatan::all();
        return view('admin.mod_jabatan.jabatan', compact('jabatan'));
    }

    public function tambah_Jabatan()
    {
        $jabatan = Jabatan::all();
        return view('admin.mod_jabatan.jabatanCreate', compact('jabatan'));
    }

    public function simpan_Jabatan(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required',
            'tipe_jabatan' => 'required',
        ]);

        $jabatan = new Jabatan();
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->tipe_jabatan = $request->tipe_jabatan;
        $jabatan->save();

        return redirect()->route('tambah_jabatan')->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit_Jabatan($jabatan_id)
    {
        $jabatan = Jabatan::findOrFail($jabatan_id);
        return view('admin.mod_jabatan.jabatanEdit', compact('jabatan'));
    }

    public function update_Jabatan(Request $request, $jabatan_id)
    {
        $request->validate([
            'nama_jabatan' => 'required',
            'tipe_jabatan' => 'required',
        ]);

        $jabatan = Jabatan::findOrFail($jabatan_id);
        $jabatan->nama_jabatan = $request->nama_jabatan;
        $jabatan->tipe_jabatan = $request->tipe_jabatan;
        $jabatan->save();

        return redirect()->route('jabatan')->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function delete_Jabatan($jabatan_id)
    {
        $jabatan = Jabatan::findOrFail($jabatan_id);
        $jabatan->delete();

        return redirect()->route('jabatan')->with('success', 'Jabatan berhasil dihapus.');
    }

    public function Pejabat()
    {
        $pejabat = Pejabat::orderBy('pejabat_id', 'ASC')->get();
        return view('admin.mod_pejabat.pejabat', compact('pejabat'));
    }

    public function tambah_Pejabat()
    {
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        return view('admin.mod_pejabat.pejabatCreate', compact('jabatans'));
    }

    public function simpan_Pejabat(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required|numeric',
            'nama_pejabat' => 'required|string|max:255',
            'riwayat' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ], [
            'jabatan_id.required' => 'Jabatan harus dipilih',
            'jabatan_id.numeric' => 'Jabatan harus berupa angka',
            'nama_pejabat.required' => 'Nama pejabat harus diisi',
            'riwayat.required' => 'Riwayat harus diisi',
            'foto.required' => 'Foto pejabat harus diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'Ukuran foto maksimal 5MB',
        ]);

        try {
            $slug = \Str::slug($request->nama_pejabat);

            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('asset/foto_pejabat'), $imageName);

            $pejabat = new Pejabat();
            $pejabat->jabatan_id = $request->jabatan_id;
            $pejabat->nama_pejabat = $request->nama_pejabat;
            $pejabat->slug = $slug;
            $pejabat->riwayat = $request->riwayat;
            $pejabat->foto = $imageName;
            $pejabat->save();

            return redirect()->route('pejabat')->with('success', 'Pejabat berhasil ditambahkan.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit_Pejabat($pejabat_id)
    {
        $pejabat = Pejabat::findOrFail($pejabat_id);
        $jabatans = Jabatan::orderBy('nama_jabatan')->get();
        return view('admin.mod_pejabat.pejabatEdit', compact('pejabat', 'jabatans'));
    }

    public function update_Pejabat(Request $request, $pejabat_id)
    {
        $request->validate([
            'jabatan_id' => 'required',
            'nama_pejabat' => 'required',
            'riwayat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $pejabat = Pejabat::findOrFail($pejabat_id);

            if ($pejabat->nama_pejabat != $request->nama_pejabat) {
                $slug = str_replace(' ', '-', strtolower($request->nama_pejabat));
                $pejabat->slug = $slug;
            }

            $pejabat->jabatan_id = $request->jabatan_id;
            $pejabat->nama_pejabat = $request->nama_pejabat;
            $pejabat->riwayat = $request->riwayat;

            if ($request->hasFile('foto')) {
                if ($pejabat->foto && file_exists(public_path('asset/foto_pejabat/' . $pejabat->foto))) {
                    unlink(public_path('asset/foto_pejabat/' . $pejabat->foto));
                }

                $imageName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('asset/foto_pejabat'), $imageName);
                $pejabat->foto = $imageName;
            }

            $pejabat->save();

            return redirect()->route('pejabat')->with('success', 'Pejabat berhasil diperbarui.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete_Pejabat($pejabat_id)
    {
        try {
            $pejabat = Pejabat::findOrFail($pejabat_id);

            if ($pejabat->foto && file_exists(public_path('asset/foto_pejabat/' . $pejabat->foto))) {
                unlink(public_path('asset/foto_pejabat/' . $pejabat->foto));
            }

            $pejabat->delete();

            return redirect()->route('pejabat')->with('success', 'Pejabat berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}