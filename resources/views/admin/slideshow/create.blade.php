@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <h1 class="text-3xl font-extrabold text-gray-800 mb-6 flex items-center gap-2">
        🖼️ <span>Pilih atau Upload Gambar Slideshow</span>
    </h1>

    {{-- Tombol Kembali --}}
    <div class="mb-6">
        <a href="{{ route('admin.slideshow.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-blue-700 bg-blue-100 border border-blue-300 rounded-lg hover:bg-blue-200 hover:text-blue-900 transition">
            ⬅️ Kembali
        </a>
    </div>

    {{-- Alert Sukses --}}
    @if(session('success'))
        <div class="mb-4">
            <div class="flex items-center gap-3 p-4 text-green-700 border border-green-300 rounded-lg bg-green-50" role="alert">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-.75-4.75a.75.75 0 011.5 0v.5a.75.75 0 01-1.5 0v-.5zM10 7a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0v-3.5A.75.75 0 0010 7z" clip-rule="evenodd"/>
                </svg>
                <div><span class="font-bold">Sukses!</span> {{ session('success') }}</div>
            </div>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('admin.slideshow.store') }}" method="POST" enctype="multipart/form-data"
          class="bg-white p-6 rounded-xl shadow-md border space-y-6">
        @csrf

        {{-- Upload Gambar Baru --}}
        <div>
            <label for="image_upload" class="block text-sm font-medium text-gray-700 mb-2">
                ⬆️ Upload Gambar Baru (opsional)
            </label>
            <input type="file" name="image_upload" id="image_upload"
                accept="image/*"
                onchange="previewUpload(this)"
                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <p class="text-xs text-gray-500 mt-1">Jika Anda ingin mengunggah gambar baru, pilih file di sini.</p>
        </div>

        {{-- Pilih dari Folder --}}
        <div>
            <label for="image_path" class="block text-sm font-medium text-gray-700 mb-2">
                📂 Atau Pilih Gambar dari Folder <code class="text-blue-500">public/storage/background</code>
            </label>
            <select name="image_path" id="image_path"
                class="form-select w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 transition"
                onchange="previewImage(this)">
                <option value="" disabled selected>-- Pilih Gambar --</option>
                @foreach($backgroundImages as $file)
                    @php $path = 'storage/background/' . $file->getFilename(); @endphp
                    <option value="{{ $path }}">{{ $file->getFilename() }}</option>
                @endforeach
            </select>
            <small class="text-gray-500 block mt-1">Abaikan jika Anda menggunakan gambar baru dari atas.</small>
        </div>

        {{-- Preview Gambar --}}
        <div id="previewContainer" class="hidden mt-4">
            <label class="block text-sm text-gray-700 font-medium mb-1">🔍 Pratinjau Gambar:</label>
            <img id="imagePreview" src="#" alt="Preview"
                 class="w-full max-h-72 object-cover rounded-lg border shadow">
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
            💾 Simpan Gambar
        </button>
    </form>
</div>

{{-- Script Preview --}}
@push('scripts')
<script>
    function previewImage(selectElement) {
        const selectedValue = selectElement.value;
        const imagePreview = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('previewContainer');

        if (selectedValue) {
            imagePreview.src = selectedValue;
            previewContainer.classList.remove('hidden');
        }
    }

    function previewUpload(input) {
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const file = input.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush
@endsection
