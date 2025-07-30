<?php

namespace App\Http\Controllers\Admin;

use App\Models\AlurPembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlurPembayaranController extends Controller
{
    public function index()
    {
        $items = AlurPembayaran::latest()->get();
        return view('admin.alur-pembayaran.index', compact('items'));
    }

    public function create()
    {
        return view('admin.alur-pembayaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
        ]);

        AlurPembayaran::create($request->all());
        return redirect()->route('alur-pembayaran.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit(AlurPembayaran $alur_pembayaran)
    {
        return view('admin.alur-pembayaran.edit', compact('alur_pembayaran'));
    }

    public function update(Request $request, AlurPembayaran $alur_pembayaran)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
        ]);

        $alur_pembayaran->update($request->all());
        return redirect()->route('alur-pembayaran.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(AlurPembayaran $alur_pembayaran)
    {
        $alur_pembayaran->delete();
        return redirect()->route('alur-pembayaran.index')->with('success', 'Data berhasil dihapus');
    }
}
