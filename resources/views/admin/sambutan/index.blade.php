@extends('layouts.admin')

@section('content')
    <div class="p-6 max-w-4xl mx-auto">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-blue-800">Sambutan & Profil Kepala Sekolah</h1>
            <a href="{{ route('admin.sambutan.edit') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg transition-all duration-200 shadow-md">
                ✏️ Edit
            </a>
        </div>

        {{-- Konten Sambutan --}}
        @if($sambutan)
            <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300 border border-blue-100">
                <h2 class="text-xl font-bold text-gray-900">{{ $sambutan->judul }}</h2>
                <h3 class="text-md text-blue-600 font-semibold mb-2">{{ $sambutan->subjudul }}</h3>

                <div class="mt-4 text-gray-800 leading-relaxed space-y-4">
                    {!! nl2br(e($sambutan->isi)) !!}
                </div>

                @if($sambutan->foto)
                    <div class="mt-6">
                        <img src="{{ asset('storage/' . $sambutan->foto) }}"
                             alt="Foto Kepala Sekolah"
                             class="rounded-lg shadow w-full max-w-sm mx-auto border border-gray-300">
                    </div>
                @endif
            </div>
        @else
            <div class="text-gray-500 bg-yellow-100 p-4 rounded border border-yellow-300">
                Belum ada data sambutan.
            </div>
        @endif

    </div>
@endsection
