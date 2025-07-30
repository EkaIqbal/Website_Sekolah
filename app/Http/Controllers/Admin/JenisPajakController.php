<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisPajak;
use Illuminate\Http\Request;

class JenisPajakController extends Controller
{
    public function index()
    {
        $items = JenisPajak::latest()->get();
        return view('admin.jenis-pajak.index', compact('items'));
    }

    public function create()
    {
        return view('admin.jenis-pajak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
        ]);

        JenisPajak::create($request->all());
        return redirect()->route('jenis-pajak.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(JenisPajak $jenis_pajak)
    {
        return view('admin.jenis-pajak.edit', compact('jenis_pajak'));
    }

    public function update(Request $request, JenisPajak $jenis_pajak)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $jenis_pajak->update($request->all());
        return redirect()->route('jenis-pajak.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(JenisPajak $jenis_pajak)
    {
        $jenis_pajak->delete();
        return redirect()->route('jenis-pajak.index')->with('success', 'Data berhasil dihapus');
    }
}
