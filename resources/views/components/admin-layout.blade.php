<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title></title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js') {{-- Untuk memuat komponen Flowbite --}}
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen font-sans">

    {{-- Navbar Admin --}}
    <nav class="bg-blue-700 shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-white text-2xl font-bold"></div>
            <div class="flex items-center space-x-6">

                {{-- Beranda --}}
                <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-blue-200 transition">Beranda</a>

                {{-- Dropdown Profil --}}
                <div class="relative">
                    <button id="profilDropdown" data-dropdown-toggle="profilMenu"
                        class="text-white hover:text-blue-200 transition inline-flex items-center gap-1">
                        Profil
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                        </svg>
                    </button>
                    <div id="profilMenu"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-52 absolute mt-2">
                        <ul class="py-2 text-sm text-gray-700">
                            <li><a href="{{ route('admin.sambutan.index') }}"
                                   class="block px-4 py-2 hover:bg-gray-100">Sambutan Kepala Sekolah</a></li>
                            <li><a href="{{ route('admin.visi-misi.index') }}"
                                   class="block px-4 py-2 hover:bg-gray-100">Visi & Misi</a></li>
                            <li><a href="{{ route('admin.struktur.index') }}"
                                   class="block px-4 py-2 hover:bg-gray-100">Struktur Kantor</a></li>
                            <li><a href="{{ route('admin.galeri.index') }}"
                                   class="block px-4 py-2 hover:bg-gray-100">Galeri</a></li>
                        </ul>
                    </div>
                </div>

                {{-- Berita --}}
                <a href="{{ route('admin.berita.index') }}" class="text-white hover:text-blue-200 transition">Berita</a>


                {{-- Kontak --}}
                <a href="{{ route('admin.kontak.index') }}" class="text-white hover:text-blue-200 transition">Kontak</a>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Script Flowbite --}}
    <script src="https://unpkg.com/flowbite@2.3.0/dist/flowbite.min.js"></script>
</body>

</html>
