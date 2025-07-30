<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use App\Models\SosialMedia;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Tampilkan halaman index kontak beserta sosial media.
     */
    public function index()
    {
        $kontak = Kontak::first(); // hanya satu data kontak
        $sosials = SosialMedia::latest()->get(); // semua sosial media

        return view('admin.kontak.index', compact('kontak', 'sosials'));
    }

    /**
     * Tampilkan form untuk membuat data kontak.
     */
    public function create()
    {
        if (Kontak::exists()) {
            return redirect()->route('admin.kontak.index')->with('error', 'Data kontak sudah ada. Silakan edit data yang ada.');
        }

        return view('admin.kontak.create');
    }

    /**
     * Simpan data kontak ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'map_url' => 'required|url',
        ]);

        if (Kontak::exists()) {
            return redirect()->route('admin.kontak.index')->with('error', 'Data kontak hanya boleh satu. Edit data yang ada.');
        }

        $iframe = '<iframe src="' . $request->map_url . '" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';

        Kontak::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'map_embed' => $iframe,
        ]);

        return redirect()->route('admin.kontak.index')->with('success', 'Data kontak berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit kontak dan sosial media.
     */
    public function edit(string $id)
    {
        $kontak = Kontak::findOrFail($id);
        $sosialMedias = SosialMedia::all()->keyBy('platform'); // ['facebook' => ..., 'instagram' => ...]

        return view('admin.kontak.edit', compact('kontak', 'sosialMedias'));
    }

    /**
     * Simpan hasil update data kontak dan sosial media.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'map_url' => 'required|url',
            'sosial' => 'nullable|array',
            'sosial.*' => 'nullable|url',
        ]);

        $kontak = Kontak::findOrFail($id);

        $iframe = '<iframe src="' . $request->map_url . '" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>';

        $kontak->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'map_embed' => $iframe,
        ]);

        // Update sosial media (gunakan updateOrCreate untuk masing-masing platform)
        if ($request->has('sosial')) {
            foreach ($request->sosial as $platform => $url) {
                if ($url) {
                    SosialMedia::updateOrCreate(
                        ['platform' => $platform],
                        ['url' => $url]
                    );
                }
            }
        }

        return redirect()->route('admin.kontak.index')->with('success', 'Data kontak berhasil diperbarui.');
    }

    /**
     * Tidak tersedia fitur hapus kontak.
     */
    public function destroy(string $id)
    {
        return redirect()->route('admin.kontak.index')->with('error', 'Fitur hapus kontak tidak tersedia.');
    }

    /**
     * Tidak tersedia fitur show kontak.
     */
    public function show(string $id)
    {
        return redirect()->route('admin.kontak.index');
    }
}
