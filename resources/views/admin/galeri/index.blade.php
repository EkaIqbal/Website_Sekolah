@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 to-blue-50 py-8 px-4">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-extrabold text-blue-800">Kelola Galeri</h2>
            <div class="flex gap-4">
                <a href="{{ route('admin.galeri.create') }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path d="M12 4v16m8-8H4"/></svg>
                    Tambah
                </a>
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-flex items-center gap-2 bg-gray-400 hover:bg-red-400 text-white px-5 py-2.5 rounded-lg font-semibold transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" /></svg>
                    Kembali
                </a>
            </div>
        </div>

        {{-- Galeri List --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($galeris as $galeri)
                <div class="bg-white rounded-xl shadow-md overflow-hidden border hover:shadow-lg transition">
                    <img src="{{ asset('storage/' . $galeri->foto) }}" alt="Foto"
                         class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                    <div class="p-4">
                        <p class="text-gray-800 font-medium">{{ $galeri->keterangan }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <a href="{{ route('admin.galeri.edit', $galeri->id) }}"
                               class="text-blue-600 hover:underline font-semibold">Edit</a>
                            <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-600 hover:underline font-semibold">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Jika kosong --}}
        @if ($galeris->isEmpty())
            <div class="mt-10 text-center text-gray-500 italic">
                Belum ada data galeri yang ditambahkan.
            </div>
        @endif

    </div>
</div>
@endsection
