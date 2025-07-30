<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    // Tampilkan semua berita di halaman ui/berita.blade.php
    public function index()
    {
        $beritas = Berita::latest()->paginate(6);
        return view('ui.berita', compact('beritas'));
    }

    // Simpan berita baru dari form admin
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $berita = new Berita();
        $berita->title = $request->title;
        $berita->excerpt = $request->excerpt;
        $berita->content = $request->content;
        $berita->link = $request->link;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('berita', 'public');
            $berita->image_url = $path;
        }

        $berita->save();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }
}
