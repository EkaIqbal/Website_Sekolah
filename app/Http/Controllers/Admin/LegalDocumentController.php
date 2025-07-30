<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LegalDocument;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class LegalDocumentController extends Controller
{
    public function index()
    {
        $documents = LegalDocument::all()->groupBy('category');
        return view('admin.landasan-hukum.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.landasan-hukum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'title' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:20480', // 20MB
            'file_url' => 'nullable|url',
        ]);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('landasan_hukum', 'public');
        } elseif ($request->file_url) {
            $filePath = $request->file_url;
        } else {
            return back()->withErrors(['file' => 'Harus mengupload file atau memberikan URL.']);
        }

        LegalDocument::create([
            'category' => $request->category,
            'title' => $request->title,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.landasan-hukum.index')->with('success', 'Dokumen berhasil disimpan.');
    }

    public function edit($id)
    {
        $document = LegalDocument::findOrFail($id);
        return view('admin.landasan-hukum.edit', compact('document'));
    }

    public function update(Request $request, $id)
    {
        $document = LegalDocument::findOrFail($id);

        $request->validate([
            'category' => 'required|string',
            'title' => 'required|string',
            'file' => 'nullable|file|mimes:pdf|max:20480',
            'file_url' => 'nullable|url',
        ]);

        // Jika ada file baru diunggah
        if ($request->hasFile('file')) {
            // Hapus file lama jika lokal
            if (!str_starts_with($document->file_path, 'http')) {
                Storage::disk('public')->delete($document->file_path);
            }

            $filePath = $request->file('file')->store('landasan_hukum', 'public');
        } elseif ($request->file_url) {
            // Hapus file lama jika lokal
            if (!str_starts_with($document->file_path, 'http')) {
                Storage::disk('public')->delete($document->file_path);
            }

            $filePath = $request->file_url;
        } else {
            $filePath = $document->file_path; // Tidak mengubah file
        }

        $document->update([
            'category' => $request->category,
            'title' => $request->title,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.landasan-hukum.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $document = LegalDocument::findOrFail($id);

        // Hapus file dari storage kalau bukan URL
        if (!str_starts_with($document->file_path, 'http')) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('admin.landasan-hukum.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
