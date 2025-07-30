<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ADMIN SDN CURAHNONGKO 02</title>
    <link rel="icon" type="image/png" href="{{ asset('storage/logo/sd1.png') }}">

    {{-- Vite --}}
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    {{-- Flowbite --}}
    <script src="https://unpkg.com/flowbite@2.3.0/dist/flowbite.min.js"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css" />
</head>

<body class="bg-gray-100 text-gray-800 min-h-screen">

    <nav class="bg-blue-700 shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col md:flex-row md:justify-between md:items-center">
            {{-- Logo dan Toggle --}}
            <div class="flex items-center justify-between w-full md:w-auto">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('storage/logo/sd1.png') }}" alt="Logo"
                        class="w-10 h-10 rounded-full border-2 border-white shadow-md" />
                    <span class="text-white text-2xl font-bold"> Dashboard Admin</span>
                </div>
                <div class="md:hidden">
                    <button id="menu-toggle"
                        class="text-white hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-white ml-4">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>

            {{-- Menu --}}
            <div id="menu"
                class="hidden flex-col mt-4 md:mt-0 md:flex md:flex-row md:items-center md:space-x-4 bg-blue-700 md:bg-transparent w-full md:w-auto">
                <a href="{{ route('admin.dashboard') }}"
                    class="text-white hover:text-blue-200 px-3 py-2 block">Beranda</a>

                {{-- Dropdown Profil --}}
                <div class="relative">
                    <button data-dropdown-button="profil"
                        class="text-white hover:text-blue-200 px-3 py-2 inline-flex items-center gap-1">
                        Profil <i class="fas fa-angle-down text-sm"></i>
                    </button>
                    <div data-dropdown-content="profil"
                        class="hidden absolute bg-white rounded-md shadow-md mt-2 w-44 z-50 text-sm text-gray-800 transition duration-200 transform origin-top scale-95">
                        <a href="{{ route('admin.visi-misi.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Visi & Misi</a>
                        <a href="{{ route('admin.struktur.index') }}"
                            class="block px-4 py-2 hover:bg-gray-100">Struktur Organisasi</a>
                    </div>
                </div>

                <a href="{{ route('admin.galeri.index') }}"
                    class="text-white hover:text-blue-200 px-3 py-2 block">Galeri</a>
                <a href="{{ route('admin.berita.index') }}"
                    class="text-white hover:text-blue-200 px-3 py-2 block">Berita</a>   
                <a href="{{ route('admin.kontak.index') }}"
                    class="text-white hover:text-blue-200 px-3 py-2 block">Kontak</a>

                {{-- Tombol Logout --}}
                <form method="POST" action="{{ route('logout') }}" class="mt-2 md:mt-0">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium w-full md:w-auto">
                        <i class="fas fa-right-from-bracket mr-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Konten Utama --}}
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    {{-- Script --}}
    <script>
        // Toggle menu mobile
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });

        // Dropdown toggle
        document.querySelectorAll('[data-dropdown-button]').forEach(button => {
            button.addEventListener('click', function (e) {
                const key = button.getAttribute('data-dropdown-button');
                const dropdown = document.querySelector(`[data-dropdown-content="${key}"]`);

                // Toggle dropdown
                dropdown.classList.toggle('hidden');

                // Tutup dropdown lain
                document.querySelectorAll('[data-dropdown-content]').forEach(el => {
                    if (el !== dropdown) el.classList.add('hidden');
                });

                e.stopPropagation(); // Cegah bubbling klik ke document
            });
        });

        // Klik di luar dropdown, tutup semua
        document.addEventListener('click', function () {
            document.querySelectorAll('[data-dropdown-content]').forEach(el => {
                el.classList.add('hidden');
            });
        });
    </script>

</body>

</html>
