<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StrukturOrganisasi;
use Illuminate\Support\Facades\Storage;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $data = StrukturOrganisasi::all();
        return view('admin.struktur.index', compact('data'));
    }

    public function create()
    {
        return view('admin.struktur.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048'
        ]);

        $path = $request->file('image')->store('struktur', 'public');

        StrukturOrganisasi::create([
            'image' => $path
        ]);

        return redirect()->route('admin.struktur.index')->with('success', 'Struktur berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = StrukturOrganisasi::findOrFail($id);
        return view('admin.struktur.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = StrukturOrganisasi::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // hapus gambar lama
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $path = $request->file('image')->store('struktur', 'public');
            $data->image = $path;
        }

        $data->save();

        return redirect()->route('admin.struktur.index')->with('success', 'Struktur berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = StrukturOrganisasi::findOrFail($id);
        if ($data->image && Storage::disk('public')->exists($data->image)) {
            Storage::disk('public')->delete($data->image);
        }

        $data->delete();

        return redirect()->back()->with('success', 'Struktur berhasil dihapus.');
    }
}

