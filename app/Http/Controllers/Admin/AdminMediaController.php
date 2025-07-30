<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaBapenda;
use Illuminate\Http\Request;

class AdminMediaController extends Controller
{
    public function index()
    {
        $media_utama = MediaBapenda::where('type', 'utama')->first();
        $media_kecil = MediaBapenda::where('type', 'kecil')->get();

        return view('admin.media.index', compact( 'media_utama', 'media_kecil'));
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'youtube_url' => 'required|url',
            'type' => 'required|in:utama,kecil',
        ]);

        MediaBapenda::create([
            'title' => $request->title,
            'description' => $request->description,
            'youtube_url' => $request->youtube_url,
            'type' => $request->type,
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(MediaBapenda $media)
    {
        return view('admin.media.edit', compact('media'));
    }

    public function update(Request $request, MediaBapenda $media)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'youtube_url' => 'required|url',
            'type' => 'required|in:utama,kecil',
        ]);

        if ($request->type === 'utama') {
            MediaBapenda::where('type', 'utama')->delete();
        }

        $media->update([
            'title' => $request->title,
            'description' => $request->description,
            'youtube_url' => $request->youtube_url,
            'type' => $request->type,
        ]);

        return redirect()->route('admin.media.index')->with('success', 'Video berhasil diubah.');
    }

    public function destroy(MediaBapenda $media)
    {
        $media->delete();
        return redirect()->route('admin.media.index')->with('success', 'Video berhasil dihapus.');
    }
}
