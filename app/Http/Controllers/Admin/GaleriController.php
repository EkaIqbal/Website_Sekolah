<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Galeri;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        // Ambil nama file yang ada di folder galeri (tanpa 'public/')
        $existingImages = Storage::files('public/galeri');
        return view('admin.galeri.create', compact('existingImages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keterangan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'foto_pilih' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            // Upload baru
            $path = $request->file('foto')->store('galeri', 'public'); // hasil: galeri/namafile.jpg
        } elseif ($request->foto_pilih) {
            // Pilih file lama
            $path = 'galeri/' . basename($request->foto_pilih);
        } else {
            return back()->withErrors(['foto' => 'Harap upload atau pilih gambar dari galeri'])->withInput();
        }

        Galeri::create([
            'keterangan' => $request->keterangan,
            'foto' => $path,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        $existingImages = Storage::files('public/galeri');
        return view('admin.galeri.edit', compact('galeri', 'existingImages'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

        $request->validate([
            'keterangan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'foto_pilih' => 'nullable|string',
        ]);

        if ($request->hasFile('foto')) {
            // Upload baru
            $path = $request->file('foto')->store('galeri', 'public');

            // Hapus file lama jika file lama adalah hasil upload
            if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
                Storage::disk('public')->delete($galeri->foto);
            }

        } elseif ($request->foto_pilih) {
            // Pilih file lama
            $path = 'galeri/' . basename($request->foto_pilih);
        } else {
            $path = $galeri->foto; // tetap pakai foto lama
        }

        $galeri->update([
            'keterangan' => $request->keterangan,
            'foto' => $path,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        // Hapus file di storage jika ada
        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus!');
    }
}
