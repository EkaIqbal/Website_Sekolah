@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">🖼️ Manajemen Slideshow</h1>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div id="alert-success" class="flex items-center p-4 mb-6 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
            <svg class="flex-shrink-0 w-4 h-4 me-2" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10c0 4.418-3.582 8-8 8s-8-3.582-8-8 3.582-8 8-8 8 3.582 8 8zM9 13h2v-2H9v2zm0-4h2V7H9v2z"/></svg>
            <div>{{ session('success') }}</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-100 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-success" aria-label="Close">
                <svg class="w-3 h-3" viewBox="0 0 14 14"><path fill="currentColor" d="M7 6l3.646-3.646a.5.5 0 0 1 .708.708L7.707 6.707l3.647 3.646a.5.5 0 0 1-.708.708L7 7.707l-3.646 3.647a.5.5 0 0 1-.708-.708L6.293 6.707 2.646 3.061a.5.5 0 1 1 .708-.708L7 5.293z"/></svg>
            </button>
        </div>
    @endif

    {{-- Tombol Aksi --}}
    <div class="flex flex-wrap gap-4 items-center mb-6">
        {{-- Tombol Tambah --}}
        <a href="{{ route('admin.slideshow.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Tambah Gambar
        </a>

        {{-- Tombol Kembali ke Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-red-300 text-gray-800 text-sm font-medium rounded-lg shadow transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Kembali
        </a>
    </div>

    {{-- Grid Gambar --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse($slides as $slide)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden relative group">
                <img src="{{ asset($slide->image_path) }}" alt="Slideshow Image" class="w-full h-64 object-cover">
                {{-- Tombol Hapus --}}
                <form action="{{ route('admin.slideshow.destroy', $slide) }}" method="POST" class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus gambar ini?')" class="bg-red-600 hover:bg-red-700 text-white rounded-full p-2 shadow-lg focus:outline-none">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </form>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Belum ada gambar slideshow yang ditambahkan.</p>
        @endforelse
    </div>
</div>
@endsection
