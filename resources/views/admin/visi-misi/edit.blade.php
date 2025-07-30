@extends('layouts.admin')

@section('content')
    <div class="min-h-screen flex justify-center items-center bg-gradient-to-br from-gray-100 to-blue-50 p-6">
        <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8 border border-gray-200">
            <h1 class="text-2xl font-extrabold text-center text-blue-800 mb-8 border-b-2 border-blue-300 pb-3">
                {{ isset($data) ? 'Edit' : 'Tambah' }} Visi & Misi
            </h1>

            <form method="POST"
                action="{{ isset($data) ? route('admin.visi-misi.update', $data->id) : route('admin.visi-misi.store') }}"
                class="space-y-6">
                @csrf
                @if(isset($data)) @method('PUT') @endif

                {{-- Visi --}}
                <div>
                    <label for="visi" class="block text-base font-semibold text-blue-700 mb-2">Visi:</label>
                    <textarea id="visi" name="visi" rows="4"
                        class="w-full p-4 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm resize-y transition"
                        placeholder="Tuliskan visi...">{{ old('visi', $data->visi ?? '') }}</textarea>
                </div>

                {{-- Misi --}}
                <div>
                    <label class="block text-base font-semibold text-blue-700 mb-2">Misi (Satu per baris):</label>
                    @for ($i = 0; $i < 4; $i++)
                        <textarea name="misi[]" rows="3"
                            class="w-full p-3 border border-blue-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300 shadow-sm mt-2 resize-y transition"
                            placeholder="Misi ke-{{ $i + 1 }}">{{ old("misi.$i", $data->misi[$i] ?? '') }}</textarea>
                    @endfor
                </div>

                {{-- Tombol --}}
                <div class="flex justify-between gap-4 pt-6">

                    <button type="submit"
                        class="w-1/2 bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg font-semibold transition duration-300">
                        Simpan
                    </button>
                    <a href="{{ route('admin.visi-misi.index') }}"
                        class="w-1/2 text-center bg-gray-400 hover:bg-red-400 text-white py-2.5 rounded-lg font-semibold transition duration-300">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection