<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\User;



class ManajemenUserController extends Controller
{
    public function manajemenUser()
    {
        $users = User::all();
        return view('admin.mod_user.user', compact('users'));
    }

    public function tambah_manajemenuser()
    {
        return view('admin.mod_user.userCreate');
    }

    public function simpan_manajemenuser(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6',
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100', 
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'level' => 'required|string|max:20',
            'blokir' => 'required|in:Y,N',
        ]);

        $user = new User();

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoName = time() . '_' . $request->username . '.' . $request->foto->extension();

            // Simpan ke folder public/asset/foto_user
            $request->foto->move(public_path('asset/foto_user'), $fotoName);

            // Simpan nama file ke database
            $user->foto = $fotoName;
        }

        // Set data user
        $user->id_username = $request->username;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->level = $request->level;
        $user->blokir = $request->blokir;
        $user->id_session = session()->getId();

        $user->save();

        return redirect()->route('manajemenuser')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit_manajemenuser($id_username)
    {
        $user = User::findOrFail($id_username);
        return view('admin.mod_user.userEdit', compact('user'));
    }

    public function update_manajemenuser(Request $request, $id_username)
    {
        $user = User::findOrFail($id_username);

        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id_username . ',id_username',
            'password' => 'nullable|string|min:6',
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|',
            'no_telp' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'level' => 'required|string|max:20',
            'blokir' => 'required|in:Y,N',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $fotoName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('asset/foto_user'), $fotoName);

            // Hapus foto lama jika ada
          $oldFotoPath = public_path('asset/foto_user/' . $user->foto);
if ($user->foto && file_exists($oldFotoPath)) {
    unlink($oldFotoPath);
}

            $user->foto = $fotoName;
        }

        // Update data
        $user->username = $request->username;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->level = $request->level;
        $user->blokir = $request->blokir;

        $user->save();

        return redirect()->route('manajemenuser')->with('success', 'User berhasil diperbarui.');
    }

    public function delete_manajemenuser($id_username)
    {
        $user = User::findOrFail($id_username);
        $user->delete();

        return redirect()->route('manajemenuser')->with('success', 'User berhasil dihapus!');
    }

    // Start Edit Profil

public function EditProfil()
{
    $username = Session::get('username');
    $user = User::where('username', $username)->firstOrFail();

    return view('admin.mod_profile.profileEdit', compact('user'));
}

public function updateProfil(Request $request)
{
    $username = Session::get('username');
    $user = User::where('username', $username)->firstOrFail();

    $validated = $request->validate([
        'nama_lengkap' => 'required|string|max:100',
        'email' => 'required|email|max:100',
        'no_telp' => 'nullable|string|max:20',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    // Handle upload foto
    if ($request->hasFile('foto')) {
        if ($user->foto && file_exists(public_path('storage/profiles/' . $user->foto))) {
            unlink(public_path('storage/profiles/' . $user->foto));
        }

        $filename = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('storage/profiles'), $filename);
        $validated['foto'] = $filename;
    }

    // Handle password jika diisi
    if ($request->filled('password')) {
        $validated['password'] = Hash::make($request->password);
    } else {
        unset($validated['password']);
    }

    $user->update($validated);

   return redirect()->route('edit.profil')->with('success', 'Profil berhasil diperbarui');
}

}
