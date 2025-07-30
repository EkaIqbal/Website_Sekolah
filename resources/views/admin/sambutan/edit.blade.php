@extends('layouts.admin')

@section('content')
    <div class="p-6 max-w-3xl mx-auto">

        <h1 class="text-2xl font-bold text-blue-800 mb-6">✏️ Edit Sambutan Kepala Sekolah</h1>

        <form method="POST" action="{{ route('admin.sambutan.update') }}" enctype="multipart/form-data"
              class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-blue-100">

            @csrf
            @method('PUT')

            {{-- Judul --}}
            <div class="mb-4">
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-1">Judul</label>
                <input type="text" id="judul" name="judul"
                       value="{{ old('judul', $sambutan->judul ?? '') }}"
                       class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
            </div>

            {{-- Subjudul --}}
            <div class="mb-4">
                <label for="subjudul" class="block text-sm font-semibold text-gray-700 mb-1">Subjudul</label>
                <input type="text" id="subjudul" name="subjudul"
                       value="{{ old('subjudul', $sambutan->subjudul ?? '') }}"
                       class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
            </div>

            {{-- Isi Sambutan --}}
            <div class="mb-4">
                <label for="isi" class="block text-sm font-semibold text-gray-700 mb-1">Isi Sambutan</label>
                <textarea id="isi" name="isi" rows="6"
                          class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm resize-none">{{ old('isi', $sambutan->isi ?? '') }}</textarea>
            </div>

            {{-- Upload Foto --}}
            <div class="mb-4">
                <label for="foto" class="block text-sm font-semibold text-gray-700 mb-1">Foto Kepala Sekolah</label>
                <input type="file" id="foto" name="foto"
                       class="w-full border rounded px-4 py-2 text-sm bg-white file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                
                @if($sambutan && $sambutan->foto)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $sambutan->foto) }}"
                             alt="Foto Kepala Sekolah"
                             class="w-32 rounded-lg shadow border border-gray-200">
                    </div>
                @endif
            </div>

            {{-- Tombol Simpan --}}
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-2 rounded shadow transition-all duration-200">
                💾 Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
