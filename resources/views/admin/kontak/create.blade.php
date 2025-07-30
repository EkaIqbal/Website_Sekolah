@extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Tambah Kontak</h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kontak.store') }}" method="POST">
        @csrf

        {{-- Judul --}}
        <div class="mb-4">
            <label class="block font-semibold">Judul:</label>
            <input type="text" name="judul" value="{{ old('judul') }}"
                   class="w-full p-2 border rounded" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label class="block font-semibold">Deskripsi:</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full p-2 border rounded" required>{{ old('deskripsi') }}</textarea>
        </div>

        {{-- Google Maps URL --}}
        <div class="mb-4">
            <label class="block font-semibold">Link Embed Google Maps (hanya URL):</label>
            <input type="url" name="map_url" value="{{ old('map_url') }}"
                   class="w-full p-2 border rounded" required>
            <p class="text-sm text-gray-500 mt-1">
                Contoh: https://www.google.com/maps/embed?pb=...
            </p>
        </div>

        {{-- Media Sosial (Opsional) --}}
        {{-- <h3 class="text-xl font-semibold mt-8 mb-2">Link Media Sosial (Opsional)</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold">Facebook:</label>
                <input type="url" name="sosial[facebook]" value="{{ old('sosial.facebook') }}"
                       class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold">Instagram:</label>
                <input type="url" name="sosial[instagram]" value="{{ old('sosial.instagram') }}"
                       class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold">YouTube:</label>
                <input type="url" name="sosial[youtube]" value="{{ old('sosial.youtube') }}"
                       class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block font-semibold">TikTok:</label>
                <input type="url" name="sosial[tiktok]" value="{{ old('sosial.tiktok') }}"
                       class="w-full p-2 border rounded">
            </div>
        </div> --}}

        {{-- Tombol --}}
        <div class="mt-6">
            <button type="submit"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Simpan</button>
            <a href="{{ route('admin.kontak.index') }}"
               class="ml-2 text-blue-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
