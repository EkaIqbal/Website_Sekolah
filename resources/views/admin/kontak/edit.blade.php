@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-center text-blue-800 mb-6">Edit Informasi Kontak</h2>

        {{-- Tampilkan pesan error validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Tampilkan pesan sukses --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-xl rounded-xl p-8 max-w-2xl mx-auto">
            <form action="{{ route('admin.kontak.update', $kontak->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $kontak->judul) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        required>{{ old('deskripsi', $kontak->deskripsi) }}</textarea>
                </div>

                {{-- Google Maps URL --}}
                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2">Link Embed Google Maps</label>
                    <input type="url" name="map_url" value="{{ old('map_url', '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        required>
                    <p class="text-sm text-gray-500 mt-1">
                        Contoh: https://www.google.com/maps/embed?pb=...
                    </p>
                </div>

                {{-- Tombol --}}
                <div class="mt-8 flex justify-end space-x-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                        Simpan
                    </button>
                    <a href="{{ route('admin.kontak.index') }}"
                        class="bg-gray-400 hover:bg-red-400 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection