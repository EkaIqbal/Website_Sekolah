@extends('layouts.admin')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-gradient-to-br from-gray-100 to-blue-50 p-6">
    <div class="w-full max-w-2xl bg-white rounded-xl shadow-lg p-8 border border-gray-200">
        <h1 class="text-2xl font-extrabold text-center text-blue-800 mb-8">
            {{ isset($data) ? 'Edit' : 'Tambah' }} Struktur Organisasi
        </h1>

        <form method="POST"
              action="{{ isset($data) ? route('admin.struktur.update', $data->id) : route('admin.struktur.store') }}"
              enctype="multipart/form-data" class="space-y-6">
            @csrf
            @if(isset($data)) @method('PUT') @endif

            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Gambar Struktur</label>
                <input type="file" name="image"
                       class="block w-full text-sm text-gray-800 file:mr-4 file:py-2 file:px-4
                       file:rounded-full file:border-0
                       file:text-sm file:font-semibold
                       file:bg-blue-100 file:text-blue-700
                       hover:file:bg-blue-200 transition">
                @if(isset($data) && $data->image)
                    <img src="{{ asset('storage/' . $data->image) }}"
                         alt="Pratinjau Struktur"
                         class="mt-4 w-full max-h-[500px] object-contain rounded-lg shadow">
                @endif
            </div>

            <div class="flex justify-between gap-4">
                <button type="submit"
                        class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition duration-300">
                    Simpan
                </button>
                                <a href="{{ route('admin.struktur.index') }}"
                   class="w-1/2 bg-gray-400 hover:bg-red-300 text-white py-2 rounded-lg text-center font-medium transition duration-300">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
