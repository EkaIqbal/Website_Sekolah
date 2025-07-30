<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sambutan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SambutanController extends Controller
{
    public function index()
    {
        $sambutan = Sambutan::first();
        return view('admin.sambutan.index', compact('sambutan'));
    }

    public function edit()
    {
        $sambutan = Sambutan::first();
        return view('admin.sambutan.edit', compact('sambutan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'subjudul' => 'required',
            'isi' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $sambutan = Sambutan::first() ?? new Sambutan();

        $sambutan->judul = $request->judul;
        $sambutan->subjudul = $request->subjudul;
        $sambutan->isi = $request->isi;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($sambutan->foto && Storage::disk('public')->exists($sambutan->foto)) {
                Storage::disk('public')->delete($sambutan->foto);
            }

            // Simpan ke storage/app/public/sambutan
            $sambutan->foto = $request->file('foto')->store('sambutan', 'public');
        }

        $sambutan->save();

        return redirect()->route('admin.sambutan.index')->with('success', 'Sambutan berhasil disimpan.');
    }
}
