@extends('layouts.admin')

@section('title', 'Daftar Berita')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">📢 Daftar Berita</h1>
        <div class="flex gap-3">
            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg border border-gray-300 hover:bg-red-300 focus:ring-4 focus:ring-gray-300">
                ← Kembali
            </a>
            <a href="{{ route('admin.berita.create') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                ➕ Tambah Berita
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-100 border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Card Grid --}}
    @if($beritas->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($beritas as $berita)
                <div class="bg-white border border-gray-200 rounded-lg shadow hover:shadow-md transition-shadow duration-300">
                    @if ($berita->image_url)
                        <img src="{{ asset('storage/' . $berita->image_url) }}" alt="Gambar" class="w-full h-48 object-cover rounded-t-lg">
                    @endif
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $berita->title }}</h3>
                        <p class="text-sm text-gray-700 mb-4">{{ Str::limit(strip_tags($berita->excerpt), 80, '...') }}</p>
                        
                        <div class="flex flex-col gap-2 text-sm text-gray-500 mb-3">
                            <div>🕒 Dibuat: {{ $berita->created_at->format('d M Y H:i') }}</div>
                            <div>🔁 Diupdate: {{ $berita->updated_at->format('d M Y H:i') }}</div>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('admin.berita.edit', $berita->id) }}" class="w-full inline-flex justify-center items-center px-3 py-2 text-xs font-medium text-yellow-800 bg-yellow-100 hover:bg-yellow-200 rounded-md transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST" class="w-full" onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 text-xs font-medium text-red-800 bg-red-100 hover:bg-red-200 rounded-md transition">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $beritas->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <div class="text-center text-gray-500 italic mt-6">Belum ada data berita.</div>
    @endif
</div>
@endsection
