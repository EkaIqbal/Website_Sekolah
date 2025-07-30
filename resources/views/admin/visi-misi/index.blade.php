@extends('layouts.admin')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-extrabold text-blue-800 border-b-4 border-blue-300 pb-2">Visi & Misi</h1>
        <a href="{{ route('admin.dashboard') }}"
           class="bg-gray-200 hover:bg-red-300 text-gray-800 text-sm px-4 py-2 rounded shadow inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" /></svg>
            Kembali
        </a>
    </div>

    @if ($data)
        @php
            $misiList = is_array($data->misi) ? $data->misi : json_decode($data->misi, true);
        @endphp

        <div class="bg-white border border-blue-100 p-6 rounded-lg shadow-md transition duration-300">
            {{-- Visi --}}
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-blue-700 mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path d="M13 16h-1v-4h-1m4 0h1a2 2 0 1 1-2 2v0a2 2 0 0 1 2-2z" /></svg>
                    Visi:
                </h2>
                <p class="text-gray-700 text-base leading-relaxed italic border-l-4 border-blue-400 pl-4">
                    {{ $data->visi }}
                </p>
            </div>

            {{-- Misi --}}
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-blue-700 mb-2 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path d="M9 12h6m-6 4h6m-6-8h6m-7 4H5m0 0v8m0-8L3 10m2 2l2-2" /></svg>
                    Misi:
                </h2>
                <ol class="list-decimal list-inside space-y-2 text-gray-700 text-base ml-2">
                    @foreach ($misiList as $m)
                        <li class="hover:translate-x-1 transition-all duration-200">{{ $m }}</li>
                    @endforeach
                </ol>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-6 flex gap-4">
                <a href="{{ route('admin.visi-misi.edit', $data->id) }}"
                   class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-full shadow transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                         viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" /></svg>
                    Edit
                </a>

                <form action="{{ route('admin.visi-misi.destroy', $data->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline-block">
                    @csrf
                </form>
            </div>
        </div>
    @else
        {{-- Jika belum ada data --}}
        <div class="text-center mt-10 space-y-4">
            <p class="text-gray-600 text-lg">Belum ada data Visi & Misi.</p>
            <a href="{{ route('admin.visi-misi.create') }}"
               class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full shadow transition inline-flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24"><path d="M12 4v16m8-8H4" /></svg>
                Tambah Visi Misi
            </a>
            <div>
                <a href="{{ route('admin.dashboard') }}"
                   class="inline-block mt-4 text-sm text-blue-600 hover:underline">← Kembali ke Dashboard</a>
            </div>
        </div>
    @endif
</div>
@endsection
