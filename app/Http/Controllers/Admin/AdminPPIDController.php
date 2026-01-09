<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ppidkonten;
use App\Models\transparasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class AdminPPIDController extends Controller
{
    // Start PPID Admin
    public function ppidAdmin()
    {
        $datadb2 = DB::connection('ppid')->table('tb_skpd')->get();

        $ppid = DB::connection('ppid')
            ->table('tb_daftarinfo')
            ->where('id_skpd', 4)
            ->orderBy('id', 'DESC')
            ->limit(1000)
            ->get();

        $transparasi = Transparasi::orderBy('id_transparasi', 'desc')->get();

        return view('admin.mod_transparasi.transparasi', compact('datadb2', 'ppid', 'transparasi'));
    }

    public function tambah_ppidAdmin()
    {
        $skpd = DB::connection('ppid')->table('tb_skpd')->get();
        return view('admin.mod_transparasi.transparasiCreate', compact('skpd'));
    }

    public function simpan_ppidAdmin(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'skpd' => 'required',
            'tahun' => 'required',
            'jenis' => 'required',
            'kat' => 'required',
            'file' => 'required|file|mimes:pdf|max:15360'
        ]);

        try {
            DB::beginTransaction();

            $fileName = null;

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $nama = 'PDF';
                $acak = Str::random(10);
                $angka = rand(10000, 99999);
                $extension = $file->getClientOriginalExtension();
                $fileName = "{$nama}_{$acak}_{$angka}.{$extension}";

                $file->move(public_path('asset/files'), $fileName);
            }

            $localPath = public_path('asset/files/' . $fileName);
            $subdomain = explode('.', request()->getHost())[0]; // misal: bapedalitbang
            $remoteFolder = '/asset/files/' . $subdomain;
            $remotePath = $remoteFolder . '/' . $fileName;

            // === Upload manual ke FTP ===
            $ftp_server = '103.18.117.184';
            $ftp_user = 'ftppessel';
            $ftp_pass = '@Painan123';
            $ftp_conn = ftp_connect($ftp_server);
            $login = ftp_login($ftp_conn, $ftp_user, $ftp_pass);
            ftp_pasv($ftp_conn, true);

            if ($ftp_conn && $login) {
                if (!@ftp_chdir($ftp_conn, $remoteFolder)) {
                    ftp_mkdir($ftp_conn, $remoteFolder);
                }

                // Upload file ke FTP
                $upload = ftp_put($ftp_conn, $remotePath, $localPath, FTP_BINARY);

                if (!$upload) {
                    throw new \Exception('Upload ke FTP gagal untuk file: ' . $fileName);
                }


                ftp_close($ftp_conn);
            } else {
                throw new \Exception('Gagal koneksi ke FTP server.');
            }

            // === Simpan ke DB utama ===
            $transparasiData = [
                'judul'       => $this->cleanInput($validated['judul']),
                'opd'         => $validated['skpd'],
                'tahun'       => $validated['tahun'],
                'jenis'       => $validated['jenis'],
                'id_kat'      => $validated['kat'],
                'tgl_posting' => now()->format('Y-m-d'),
                'hits'        => 0,
                'nama_file'   => $fileName
            ];
            DB::table('transparasi')->insert($transparasiData);

            // === Simpan ke DB PPID ===
            $ppidData = [
                'judul'   => $this->cleanInput($validated['judul']),
                'id_skpd' => $validated['skpd'],
                'id_kat'  => $validated['kat'],
                'tgl'     => now()->format('Y-m-d'),
                'tahun'   => $validated['tahun'],
                'file'    => $fileName,
                'url'     => url('asset/files/' . $fileName)
            ];
            DB::connection('ppid')->table('tb_daftarinfo')->insert($ppidData);

            DB::commit();
            return redirect()->route('ppid')->with('success', '? Dokumen berhasil disimpan dan diunggah ke FTP.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Hapus file lokal jika masih ada
            if (isset($fileName)) {
                $localPath = public_path('asset/files/' . $fileName);
                if (file_exists($localPath)) {
                    @unlink($localPath);
                }
            }

            return back()->withInput()->withErrors([
                'error' => 'Gagal menyimpan: ' . $e->getMessage()
            ]);
        }
    }

    public function edit_ppidAdmin($id_transparasi)
    {
        $dokumen = Transparasi::findOrFail($id_transparasi);
        $skpd = DB::connection('ppid')->table('tb_skpd')->get();

        return view('admin.mod_transparasi.transparasiEdit', compact('dokumen', 'skpd'));
    }

    public function update_ppidAdmin(Request $request, $id_transparasi)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'skpd' => 'required',
            'tahun' => 'required',
            'jenis' => 'required',
            'kat' => 'required',
            'file' => 'required|file|mimes:pdf|max:15360'
        ]);

        $dokumen = Transparasi::findOrFail($id_transparasi);
        $fileName = $dokumen->nama_file;

        try {
            DB::beginTransaction();

            if ($request->hasFile('file')) {
                // Hapus file lama jika ada (jika ingin tetap disimpan, hapus blok ini juga)
                if ($fileName && file_exists(public_path('asset/files/' . $fileName))) {
                    unlink(public_path('asset/files/' . $fileName));
                }

                // Simpan file baru
                $file = $request->file('file');
                $nama = 'PDF';
                $acak = Str::random(10);
                $angka = rand(10000, 99999);
                $extension = $file->getClientOriginalExtension();
                $fileName = "{$nama}_{$acak}_{$angka}.{$extension}";

                $file->move(public_path('asset/files'), $fileName);

                // Upload ke FTP
                $localPath = public_path('asset/files/' . $fileName);
                $subdomain = explode('.', request()->getHost())[0];
                $remoteFolder = '/asset/files/' . $subdomain;
                $remotePath = $remoteFolder . '/' . $fileName;

                $ftp_server = '103.18.117.184';
                $ftp_user = 'ftppessel';
                $ftp_pass = '@Painan123';
                $ftp_conn = ftp_connect($ftp_server);
                $login = ftp_login($ftp_conn, $ftp_user, $ftp_pass);
                ftp_pasv($ftp_conn, true);

                if ($ftp_conn && $login) {
                    if (!@ftp_chdir($ftp_conn, $remoteFolder)) {
                        ftp_mkdir($ftp_conn, $remoteFolder);
                    }

                    if (!ftp_put($ftp_conn, $remotePath, $localPath, FTP_BINARY)) {
                        throw new \Exception('Upload FTP gagal.');
                    }

                    ftp_close($ftp_conn);
                } else {
                    throw new \Exception('Gagal koneksi ke FTP.');
                }
            }

            // Update di DB utama
            DB::table('transparasi')->where('id_transparasi', $id_transparasi)->update([
                'judul' => $this->cleanInput($validated['judul']),
                'opd' => $validated['skpd'],
                'tahun' => $validated['tahun'],
                'jenis' => $validated['jenis'],
                'id_kat' => $validated['kat'],
                'nama_file' => $fileName,
            ]);

            // Update di DB PPID
            DB::connection('ppid')->table('tb_daftarinfo')
                ->where('file', $dokumen->nama_file)
                ->update([
                    'judul' => $this->cleanInput($validated['judul']),
                    'id_skpd' => $validated['skpd'],
                    'id_kat' => $validated['kat'],
                    'tahun' => $validated['tahun'],
                    'file' => $fileName,
                    'url' => url('asset/files/' . $fileName)
                ]);

            DB::commit();

            return redirect()->route('ppid')->with('success', '✅ Dokumen berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal memperbarui: ' . $e->getMessage()]);
        }
    }



    public function delete_ppidAdmin($id_transparasi)
    {
        DB::beginTransaction();

        try {
            $transparasi = Transparasi::findOrFail($id_transparasi);
            $fileName = $transparasi->nama_file;

            $transparasi->delete();

            DB::connection('ppid')
                ->table('tb_daftarinfo')
                ->where('file', $fileName)
                ->delete();

            if (!empty($fileName)) {
                $filePath = public_path('asset/files/' . $fileName);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            DB::commit();

            return redirect()->route('ppid')->with('success', 'Dokumen berhasil dihapus');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'error' => 'Gagal menghapus dokumen: ' . $e->getMessage()
            ]);
        }
    }

    private function cleanInput($value)
    {
        return preg_replace("/[\'\"\,\;\<\>\)\(\/]/", " ", $value);
    }

    // End PPID Admin

    // Start PPID Konten Admin
    public function ppidKonten()
    {
        $ppidkonten = ppidkonten::orderBy('id_ppidkonten', 'desc')->get();
        return view('admin.mod_ppidKonten.ppidKonten', compact('ppidkonten'));
    }

    public function tambah_ppidKontenAdmin()
    {
        return view('admin.mod_ppidKonten.ppidKontenCreate');
    }

    public function simpan_ppidKontenAdmin(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = [
            'jenis' => $request->jenis,
            'tgl_posting' => now(),
            'hits' => 0,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('asset/files'), $filename);
            $data['nama_file'] = $filename;
        }


        ppidkonten::create($data);
        return redirect()->route('ppidkonten')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit_ppidKontenAdmin($id_ppidkonten)
    {
        $data = ppidkonten::findOrFail($id_ppidkonten);
        return view('admin.mod_ppidKonten.ppidKontenEdit', compact('data'));
    }

    public function update_ppidKontenAdmin(Request $request, $id_ppidkonten)
    {
        $request->validate([
            'jenis' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = ppidkonten::findOrFail($id_ppidkonten);

        $data->jenis = $request->jenis;

        if ($request->hasFile('file')) {
            // Hapus file lama
            $oldPath = public_path('asset/files/' . $data->nama_file);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            // Upload file baru
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('asset/files'), $filename);

            $data->nama_file = $filename;
        }

        $data->save();

        return redirect()->route('ppidkonten')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete_ppidKontenAdmin($id_ppidkonten)
    {
        $konten = ppidkonten::findOrFail($id_ppidkonten);
        if ($konten->nama_file && file_exists(public_path('asset/files/' . $konten->nama_file))) {
            unlink(public_path('asset/files/' . $konten->nama_file));
        }
        $konten->delete();
        return redirect()->route('ppidkonten')->with('success', 'Data berhasil dihapus.');
    }
    // End PPID Konten Admin
}
