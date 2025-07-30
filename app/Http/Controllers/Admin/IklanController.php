<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Iklan;
use Illuminate\Support\Facades\Storage;

class IklanController extends Controller
{
    public function index()
    {
        $iklans = Iklan::all();
        return view('admin.iklan.index', compact('iklans'));
    }

    public function create()
    {
        $gambarTersedia = $this->getGambarTersedia();
        return view('admin.iklan.create', compact('gambarTersedia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar_upload' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_pilih' => 'nullable|string',
            'iklan' => 'nullable|string|max:255',
        ]);

        $gambarPath = $this->prosesGambar($request);
        if (!$gambarPath) {
            return back()->withErrors(['gambar_upload' => 'Pilih gambar atau upload gambar baru.'])->withInput();
        }

        Iklan::create([
            'gambar' => $gambarPath,
            'iklan' => $request->iklan,
        ]);

        return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $iklan = Iklan::findOrFail($id);
        $gambarTersedia = $this->getGambarTersedia();
        return view('admin.iklan.edit', compact('iklan', 'gambarTersedia'));
    }

    public function update(Request $request, $id)
    {
        $iklan = Iklan::findOrFail($id);

        $request->validate([
            'gambar_upload' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'gambar_pilih' => 'nullable|string',
            'link' => 'nullable|url|max:255',
        ]);

        $gambarPath = $this->prosesGambar($request);
        if ($gambarPath) {
            $iklan->gambar = $gambarPath;
        }

        $iklan->link = $request->link;
        $iklan->save();

        return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $iklan = Iklan::findOrFail($id);

        $digunakanLain = Iklan::where('gambar', $iklan->gambar)->where('id', '!=', $id)->exists();
        if (!$digunakanLain && Storage::disk('public')->exists($iklan->gambar)) {
            Storage::disk('public')->delete($iklan->gambar);
        }

        $iklan->delete();
        return redirect()->route('admin.iklan.index')->with('success', 'Iklan berhasil dihapus.');
    }

    private function getGambarTersedia()
    {
        return collect(Storage::disk('public')->files('iklan'))
            ->filter(fn($path) => in_array(strtolower(pathinfo($path, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png']))
            ->map(fn($path) => basename($path));
    }

    private function prosesGambar(Request $request)
    {
        if ($request->hasFile('gambar_upload')) {
            return $request->file('gambar_upload')->store('iklan', 'public');
        }

        if ($request->filled('gambar_pilih')) {
            $fileDipilih = 'iklan/' . $request->gambar_pilih;
            $gambarTersedia = Storage::disk('public')->files('iklan');

            if (in_array($fileDipilih, $gambarTersedia)) {
                return $fileDipilih;
            }

            return null;
        }

        return null;
    }
}
