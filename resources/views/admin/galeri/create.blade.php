@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-100 to-blue-50 py-10 px-4">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8 border">

        {{-- Judul --}}
        <h2 class="text-3xl font-bold text-blue-800 mb-6 text-center">Tambah Galeri</h2>

        {{-- Pesan error global --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Keterangan --}}
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Keterangan</label>
                <input type="text" name="keterangan" value="{{ old('keterangan') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    required>
                @error('keterangan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Upload Gambar Baru --}}
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Upload Gambar Baru</label>
                <input type="file" name="foto" accept="image/*"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700">
                @error('foto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pilih dari Galeri --}}
            <div>
                <label class="block mb-1 font-semibold text-gray-700">Atau Pilih Gambar dari Galeri</label>
                <select name="foto_pilih" id="foto_pilih"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="">-- Pilih Gambar --</option>
                    @foreach ($existingImages as $img)
                        @php $filename = basename($img); @endphp
                        <option value="{{ $filename }}" {{ old('foto_pilih') == $filename ? 'selected' : '' }}>
                            {{ $filename }}
                        </option>
                    @endforeach
                </select>
                @error('foto_pilih')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Preview dari Pilihan Galeri --}}
            <div id="previewContainer" class="hidden mt-2">
                <label class="block mb-1 font-semibold text-gray-700">Preview Gambar</label>
                <img id="imagePreview" src="#" alt="Preview" class="w-40 h-40 object-cover rounded shadow border">
            </div>

            {{-- Tombol --}}
            <div class="flex justify-between mt-6">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg font-semibold transition">
                    Simpan
                </button>
                <a href="{{ route('admin.galeri.index') }}"
                    class="inline-block bg-gray-400 hover:bg-red-400 text-white px-5 py-2.5 rounded-lg font-semibold transition">
                    Batal
                </a>
            </div>
        </form>

    </div>
</div>

{{-- Script Preview --}}
<script>
    const select = document.getElementById('foto_pilih');
    const preview = document.getElementById('imagePreview');
    const container = document.getElementById('previewContainer');

    select.addEventListener('change', function () {
        const filename = this.value;
        if (filename) {
            preview.src = `{{ asset('storage/galeri') }}/` + filename;
            container.classList.remove('hidden');
        } else {
            container.classList.add('hidden');
            preview.src = '#';
        }
    });
</script>
@endsection
