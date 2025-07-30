<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use Illuminate\Http\Request;

class AplikasiController extends Controller
{
    // Tampilkan semua aplikasi
    public function index()
    {
        $data = Aplikasi::all();
        return view('admin.aplikasi.index', compact('data'));
    }

    // Form tambah aplikasi
    public function create()
    {
        return view('admin.aplikasi.create');
    }

    // Simpan aplikasi baru
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon_class' => 'nullable|string|max:100',
        ]);

        Aplikasi::create([
            'judul' => $request->judul,
            'url' => $request->url,
            'icon_class' => $request->icon_class,
        ]);

        return redirect()->route('admin.aplikasi.index')->with('success', 'Aplikasi berhasil ditambahkan');
    }

    // Form edit aplikasi
    public function edit(Aplikasi $aplikasi)
    {
        return view('admin.aplikasi.edit', compact('aplikasi'));
    }

    // Update aplikasi
    public function update(Request $request, Aplikasi $aplikasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon_class' => 'nullable|string|max:100',
        ]);

        $aplikasi->update([
            'judul' => $request->judul,
            'url' => $request->url,
            'icon_class' => $request->icon_class,
        ]);

        return redirect()->route('admin.aplikasi.index')->with('success', 'Aplikasi berhasil diperbarui');
    }

    // Hapus aplikasi
    public function destroy(Aplikasi $aplikasi)
    {
        $aplikasi->delete();
        return redirect()->route('admin.aplikasi.index')->with('success', 'Aplikasi berhasil dihapus');
    }
}
