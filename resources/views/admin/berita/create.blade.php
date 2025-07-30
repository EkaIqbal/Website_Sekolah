@extends('layouts.admin')

@section('content')
    <div class="flex justify-center py-10 px-4">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">📝 Tambah Berita Baru</h1>

            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Judul --}}
                <div>
                    <label for="title" class="block mb-1 text-sm font-semibold text-gray-700">Judul Berita</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ringkasan --}}
                <div>
                    <label for="excerpt" class="block mb-1 text-sm font-semibold text-gray-700">Excerpt (Ringkasan)</label>
                    <textarea name="excerpt" id="excerpt" rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konten --}}
                <div>
                    <label for="content" class="block mb-1 text-sm font-semibold text-gray-700">Konten Lengkap</label>
                    <textarea name="content" id="content" rows="6"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Link --}}
                <div>
                    <label for="link" class="block mb-1 text-sm font-semibold text-gray-700">Tautan (Opsional)</label>
                    <input type="url" name="link" id="link" value="{{ old('link') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Pilih Gambar dari Galeri --}}
                <div>
                    <label for="selected_image" class="block mb-1 text-sm font-semibold text-gray-700">Pilih Gambar dari
                        Folder</label>
                    <select name="selected_image" id="selected_image"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Gambar --</option>
                        @foreach($imageFiles as $image)
                            <option value="{{ $image }}" {{ old('selected_image') === $image ? 'selected' : '' }}>
                                {{ basename($image) }}
                            </option>
                        @endforeach
                    </select>
                    @error('selected_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Gambar Baru --}}
                <div>
                    <label for="image_url" class="block mb-1 text-sm font-semibold text-gray-700">Atau Upload Gambar
                        Baru</label>
                    <input type="file" name="image_url" id="image_url" accept="image/*"
                        class="w-full rounded-md border border-gray-300 text-gray-900 bg-white shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    @error('image_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Submit --}}
                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 shadow">
                        Simpan Berita
                    </button>
                    <a href="{{ route('admin.berita.index') }}"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gray-400 border border-gray-300 rounded-md hover:bg-red-400 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection