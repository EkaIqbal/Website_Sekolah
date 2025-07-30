<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SosialMedia;
use App\Models\Kontak;
use Illuminate\Http\Request;

class SosialMediaController extends Controller
{
    public function index()
    {
        $sosials = SosialMedia::all();
        $kontak = Kontak::first(); // Ambil kontak pertama

        return view('admin.kontak.index', compact('sosials', 'kontak'));
    }

    public function create()
    {
        return view('admin.sosialmedia.create');
    }

    public function store(Request $request)
    {
        // Validasi bahwa icon adalah string class Font Awesome, bukan gambar
        $request->validate([
            'nama' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
        ]);

        SosialMedia::create($request->only('nama', 'url', 'icon'));

        return redirect()->route('admin.sosialmedia.index')->with('success', 'Media sosial berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sosials = SosialMedia::findOrFail($id);
        return view('admin.sosialmedia.edit', compact('sosials'));
    }

    public function update(Request $request, $id)
    {
        $item = SosialMedia::findOrFail($id);

        // Validasi string Font Awesome, bukan file image
        $request->validate([
            'nama' => 'required|string|max:255',
            'url' => 'required|url',
            'icon' => 'required|string|max:255',
        ]);

        $item->update($request->only('nama', 'url', 'icon'));

        return redirect()->route('admin.sosialmedia.index')->with('success', 'Media sosial berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = SosialMedia::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Media sosial berhasil dihapus.');
    }
}
