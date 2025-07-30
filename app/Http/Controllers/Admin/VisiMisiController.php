<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisiMisi;

class VisiMisiController extends Controller
{
    public function index()
    {
        $data = VisiMisi::first(); // Asumsi hanya 1 data
        return view('admin.visi-misi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.visi-misi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string',
        ]);

        VisiMisi::create([
            'visi' => $request->visi,
            'misi' => json_encode($request->misi),
        ]);

        return redirect()->route('admin.visi-misi.index')->with('success', 'Visi & Misi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = VisiMisi::findOrFail($id);

        // Penting: ubah string JSON jadi array
        $data->misi = json_decode($data->misi, true);

        return view('admin.visi-misi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'visi' => 'required|string',
            'misi' => 'required|array|min:1',
            'misi.*' => 'required|string',
        ]);

        $data = VisiMisi::findOrFail($id);
        $data->update([
            'visi' => $request->visi,
            'misi' => json_encode($request->misi),
        ]);

        return redirect()->route('admin.visi-misi.index')->with('success', 'Visi & Misi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        VisiMisi::destroy($id);
        return redirect()->back()->with('success', 'Data dihapus.');
    }
}
