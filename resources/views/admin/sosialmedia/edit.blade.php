@extends('layouts.admin')

@section('content')
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold text-center text-blue-800 mb-6">Edit Sosial Media</h2>

        {{-- Error Validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Kotak Form --}}
        <div class="bg-white shadow-xl rounded-xl p-8 max-w-2xl mx-auto">
            <form action="{{ route('admin.sosialmedia.update', $sosials->id) }}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')

                {{-- Nama Platform --}}
                <div class="mb-5">
                    <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Platform</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $sosials->nama) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        required>
                </div>

                {{-- URL --}}
                <div class="mb-5">
                    <label for="url" class="block text-gray-700 font-semibold mb-2">URL</label>
                    <input type="url" id="url" name="url" value="{{ old('url', $sosials->url) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        required>
                </div>

                {{-- Font Awesome Icon --}}
                <div class="mb-5">
                    <label for="icon" class="block text-gray-700 font-semibold mb-2">Icon Font Awesome</label>
                    <input type="text" id="icon" name="icon" value="{{ old('icon', $sosials->icon) }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition"
                        placeholder="Contoh: fab fa-facebook" required>
                    <p class="text-sm text-gray-500 mt-1">
                        Gunakan nama class Font Awesome, contoh:
                        <code>fab fa-facebook</code>, <code>fab fa-instagram</code>, dll.
                        <a href="https://fontawesome.com/icons" class="text-blue-600 underline" target="_blank">Lihat
                            ikon</a>
                    </p>
                    <p class="text-sm mt-3 font-semibold text-gray-600">Icon Saat Ini:</p>
                    <i class="{{ trim($sosials->icon) }} text-3xl mt-1 text-blue-600"></i>
                </div>

                {{-- Tombol --}}
                <div class="mt-8 flex justify-end space-x-4">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                        💾 Simpan
                    </button>
                    <a href="{{ route('admin.sosialmedia.index') }}"
                        class="bg-gray-400 hover:bg-red-400 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection