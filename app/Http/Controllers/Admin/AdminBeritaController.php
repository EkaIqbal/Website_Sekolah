<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;

class AdminBeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
{
    $imageFiles = collect(Storage::disk('public')->files('berita'))
        ->filter(function ($file) {
            return preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file);
        })
        ->values();

    return view('admin.berita.create', compact('imageFiles'));
}


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'link' => 'nullable|url',
            'image_url' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'excerpt', 'content', 'link']);

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('berita', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        $imageFiles = collect(Storage::disk('public')->files('berita'))
            ->filter(function ($file) {
                return preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file);
            })
            ->values();

        return view('admin.berita.edit', compact('berita', 'imageFiles'));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'link' => 'nullable|url',
            'image_url' => 'nullable|image|max:2048',
            'selected_image' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'excerpt', 'content', 'link']);

        // Hapus gambar lama jika admin memilih upload baru
        if ($request->hasFile('image_url')) {
            if ($berita->image_url) {
                Storage::disk('public')->delete($berita->image_url);
            }
            $data['image_url'] = $request->file('image_url')->store('berita', 'public');
        }
        // Jika admin memilih dari gambar yang sudah ada
        elseif ($request->filled('selected_image')) {
            $data['image_url'] = $request->input('selected_image');
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->image_url) {
            Storage::disk('public')->delete($berita->image_url);
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
