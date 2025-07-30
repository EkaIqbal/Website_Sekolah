@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
    <div class="max-w-3xl mx-auto py-10 px-4">
        {{-- Title --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">✏️ Edit Berita</h1>

        {{-- Kotak Form --}}
        <div
            class="bg-gradient-to-br from-white via-gray-50 to-white border border-gray-200 rounded-xl shadow-xl p-8 transition-all duration-300 hover:shadow-2xl">

            <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div class="mb-4">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $berita->title) }}"
                        class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Masukkan judul berita" required>
                    @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Excerpt --}}
                <div class="mb-4">
                    <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-700">Excerpt (Ringkasan)</label>
                    <textarea name="excerpt" id="excerpt" rows="3"
                        class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tulis ringkasan singkat" required>{{ old('excerpt', $berita->excerpt) }}</textarea>
                    @error('excerpt') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Konten --}}
                <div class="mb-4">
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-700">Konten Lengkap</label>
                    <textarea name="content" id="content" rows="6"
                        class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Tulis isi berita secara lengkap"
                        required>{{ old('content', $berita->content) }}</textarea>
                    @error('content') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Link --}}
                <div class="mb-4">
                    <label for="link" class="block mb-2 text-sm font-medium text-gray-700">Tautan (opsional)</label>
                    <input type="url" name="link" id="link" value="{{ old('link', $berita->link) }}"
                        class="block w-full p-2.5 text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="https://contoh.com">
                    @error('link') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Pilih Gambar --}}
                <div class="mb-4">
                    <label for="selected_image" class="block mb-2 text-sm font-medium text-gray-700">Pilih Gambar dari
                        Galeri</label>
                    <select name="selected_image" id="selected_image"
                        class="block w-full p-2.5 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Pilih Gambar --</option>
                        @foreach($imageFiles as $image)
                            <option value="{{ $image }}" {{ old('selected_image', $berita->image_url) === $image ? 'selected' : '' }}>
                                {{ basename($image) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Upload Gambar --}}
                <div class="mb-4">
                    <label for="image_url" class="block mb-2 text-sm font-medium text-gray-700">Upload Gambar Baru</label>
                    <input type="file" name="image_url" id="image_url"
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                        accept="image/*">
                    @error('image_url') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Gambar Aktif --}}
                @if ($berita->image_url)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                        <img src="{{ asset('storage/' . $berita->image_url) }}" alt="Gambar Berita"
                            class="w-40 rounded-lg shadow-md">
                    </div>
                @endif

                {{-- Tombol --}}
                <div class="flex items-center justify-end gap-3 pt-4">
                    <button type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 shadow">
                        💾 Update Berita
                    </button>
                    <a href="{{ route('admin.berita.index') }}"
                        class="text-white bg-gray-400 border border-gray-300 hover:bg-red-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
@endsection