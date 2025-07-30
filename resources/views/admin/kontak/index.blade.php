@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6">

        {{-- Judul --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-6">📍 Informasi Kontak</h2>

        {{-- Tombol Kembali --}}
        <div class="mb-4">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center bg-gray-400 text-white px-4 py-2 rounded hover:bg-red-400 transition">
                ← Kembali
            </a>
        </div>

        {{-- Pesan sukses --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 border border-green-300 rounded p-3 mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Data Kontak --}}
        @if ($kontak)
            <div class="bg-white shadow-md rounded-xl p-6 space-y-4 border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800">{{ $kontak->judul }}</h3>
                <p class="text-gray-700">{{ $kontak->deskripsi }}</p>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">Google Maps</label>
                    <div class="w-full rounded overflow-hidden border border-gray-300">
                        {!! $kontak->map_embed !!}
                    </div>
                </div>

                <div class="pt-4">
                    <a href="{{ route('admin.kontak.edit', $kontak->id) }}"
                        class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        ✏️ Edit Kontak
                    </a>
                </div>
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded">
                <p>Data kontak belum tersedia. Silakan
                    <a href="{{ route('admin.kontak.create') }}" class="text-blue-600 underline hover:text-blue-800">tambah
                        kontak baru</a>.
                </p>
            </div>
        @endif

        {{-- Sosial Media --}}
        <hr class="my-10 border-gray-300">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            🔗 <span class="ml-2">Sosial Media</span>
        </h2>

        <div class="mb-6">
            <a href="{{ route('admin.sosialmedia.create') }}"
                class="inline-flex items-center bg-green-600 text-white font-semibold px-4 py-2 rounded-lg hover:bg-green-700 shadow hover:shadow-lg transition">
                ➕ Tambah Sosial Media
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($sosials as $sosial)
                <div
                    class="bg-white border border-gray-200 rounded-xl shadow-md hover:shadow-xl p-6 transition-all duration-300 flex flex-col justify-between">
                    <div class="flex items-start space-x-4">
                        {{-- Icon --}}
                        @if ($sosial->icon)
                            <i class="{{ $sosial->icon }} text-4xl text-blue-600 flex-shrink-0"></i>
                        @else
                            <i class="fas fa-globe text-4xl text-gray-400 flex-shrink-0"></i>
                        @endif

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-lg font-bold text-gray-800">{{ $sosial->nama }}</p>
                            <a href="{{ $sosial->url }}" target="_blank"
                                class="text-blue-500 text-sm inline-block truncate w-full max-w-full hover:underline"
                                title="{{ $sosial->url }}">
                                {{ $sosial->url }}
                            </a>
                        </div>
                    </div>

                    {{-- Aksi --}}
                    <div class="mt-6 flex justify-between">
                        <a href="{{ route('admin.sosialmedia.edit', $sosial->id) }}"
                            class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded hover:bg-blue-200 font-medium transition">
                            ✏️ Edit
                        </a>

                        <form action="{{ route('admin.sosialmedia.destroy', $sosial->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-sm bg-red-100 text-red-700 px-3 py-1 rounded hover:bg-red-200 font-medium transition">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 col-span-full">
                    Belum ada sosial media ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
@endsection