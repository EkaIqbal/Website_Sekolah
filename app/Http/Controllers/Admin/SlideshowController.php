<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slideshow;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SlideshowController extends Controller
{
    public function index()
    {
        $slides = Slideshow::all();
        return view('admin.slideshow.index', compact('slides'));
    }

    public function create()
    {
        $backgroundImages = File::files(public_path('storage/background'));
        return view('admin.slideshow.create', compact('backgroundImages'));
    }

    public function store(Request $request)
    {
        // Validasi umum
        $request->validate([
            'image_upload' => 'nullable|image|max:5000',
            'image_path' => 'nullable|string',
        ]);

        if (!$request->hasFile('image_upload') && !$request->filled('image_path')) {
            return back()->withErrors(['image_upload' => 'Harap unggah gambar atau pilih salah satu dari folder.'])->withInput();
        }

        $imagePath = null;

        if ($request->hasFile('image_upload')) {
            $file = $request->file('image_upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('background'), $filename);
            $imagePath = 'background/' . $filename;
        } elseif ($request->filled('image_path')) {
            $imagePath = $request->input('image_path');

            // Validasi tambahan: Pastikan file memang ada di folder
            if (!File::exists(public_path($imagePath))) {
                return back()->withErrors(['image_path' => 'Gambar yang dipilih tidak ditemukan.'])->withInput();
            }
        }

        Slideshow::create([
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.slideshow.index')->with('success', 'Slide berhasil ditambahkan.');
    }

    public function destroy(Slideshow $slideshow)
    {
        // Cek jika file lokal dan bisa dihapus
        $filePath = public_path($slideshow->image_path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $slideshow->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}
