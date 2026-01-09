<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\menu;

class MenuController extends Controller
{
    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_parent' => 'required|integer',
            'nama_menu' => 'required|string',
            'link' => 'required|string',
            'aktif' => 'required|string',
            'position' => 'required|string',
            'urutan' => 'required|integer',
        ]);

        Menu::create($request->all());

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'id_parent' => 'required|integer',
            'nama_menu' => 'required|string',
            'link' => 'required|string',
            'aktif' => 'required|string',
            'position' => 'required|string',
            'urutan' => 'required|integer',
        ]);

        $menu->update($request->all());

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diupdate.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
