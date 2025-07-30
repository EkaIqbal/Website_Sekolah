@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto py-10">
    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-.75-4.75a.75.75 0 011.5 0v.5a.75.75 0 01-1.5 0v-.5zM10 7a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0v-3.5A.75.75 0 0010 7z" clip-rule="evenodd"/>
        </svg>
        Edit Gambar Slideshow
    </h1>

    @if(session('success'))
        <div class="mb-4">
            <div class="flex items-center p-4 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg class="flex-shrink-0 w-5 h-5 me-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-.75-4.75a.75.75 0 011.5 0v.5a.75.75 0 01-1.5 0v-.5zM10 7a.75.75 0 00-.75.75v3.5a.75.75 0 001.5 0v-3.5A.75.75 0 0010 7z" clip-rule="evenodd"/></svg>
                <span class="font-medium">Sukses!</span> {{ session('success') }}
            </div>
        </div>
    @endif

    <form action="{{ route('admin.slideshow.update', $slideshow->id) }}" method="POST" class="bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg border dark:border-gray-700 space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-2">
            <label for="image_path" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                📂 Ganti Gambar dari Folder <code class="text-blue-600">public/storage/background</code>
            </label>

            <div class="relative">
                <select id="image_path" name="image_path" required
                        class="form-select block w-full px-4 py-2 pr-10 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg shadow-sm focus:ring-blue-600 focus:border-blue-600 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled selected>Pilih Gambar</option>
                    @foreach($backgroundImages as $file)
                        <option value="{{ 'storage/background/' . $file->getFilename() }}" {{ $slideshow->image_path == 'storage/background/' . $file->getFilename() ? 'selected' : '' }}>
                            {{ $file->getFilename() }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.slideshow.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg shadow-sm dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition">
                ❌ Batal
            </a>
            <button type="submit" class="inline-flex items-center px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 shadow-md transition">
                💾 Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
