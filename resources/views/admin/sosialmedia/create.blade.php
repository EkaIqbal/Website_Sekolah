@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-xl mt-4">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
        ➕ <span class="ml-2">Tambah Sosial Media</span>
    </h2>

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 border border-red-300">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.sosialmedia.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Nama Platform --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Nama Platform:</label>
            <input type="text" name="nama" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        </div>

        {{-- URL --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">URL:</label>
            <input type="url" name="url" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required>
        </div>

        {{-- Font Awesome Class --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-1">Icon Font Awesome:</label>
            <input type="text" name="icon" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" required placeholder="Contoh: fab fa-facebook">
            <p class="text-sm text-gray-500 mt-1">
                Gunakan nama class Font Awesome, contoh: <code>fab fa-facebook</code>, <code>fab fa-instagram</code>, dll.
                <a href="https://fontawesome.com/icons" class="text-blue-600 underline" target="_blank">Lihat daftar ikon</a>
            </p>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center justify-start space-x-4">
            <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all shadow-md hover:shadow-lg">
                💾 Simpan
            </button>
            <a href="{{ route('admin.sosialmedia.index') }}"
                class="bg-gray-400 text-white px-5 py-2 rounded-lg font-semibold hover:bg-red-400 transition-all shadow hover:shadow-md">
                ❌ Batal
            </a>
        </div>
    </form>
</div>
@endsection
