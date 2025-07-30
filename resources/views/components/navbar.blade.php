<nav class="bg-white shadow sticky top-0 z-50 border-b border-gray-200">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto ">
{{-- 
        <!-- Logo -->
        <a href="/" class="flex items-center space-x-3">
            <img src="{{ asset('assets/images/sd.jpg') }}" class="h-8" alt="sd Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-900">SDN Curahnongko 02</span>
        </a> --}}

        <!-- Toggle Menu Mobile -->
        <button data-collapse-toggle="navbar-menu" type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5" aria-hidden="true" fill="none" viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>

        <!-- Menu Navigasi -->
        <div class="hidden w-full md:flex md:items-center md:justify-between md:w-auto" id="navbar-menu">
            <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-white 
                       md:flex-row md:space-x-8 md:mt-0 md:border-0">

                <li><a href="{{ route('beranda') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Beranda</a></li>

                <!-- Dropdown Profil -->
                <li x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center py-2 px-3 text-gray-900 hover:bg-gray-100 rounded md:inline-flex">
                        Profil
                        <svg class="ml-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.23 8.27a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul x-show="open" @click.away="open = false" x-transition
                        class="absolute bg-white shadow-lg rounded mt-1 z-50 min-w-[180px]">
                        <li><a href="{{ route('profil.visi_misi') }}" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Visi & Misi</a></li>
                        <li><a href="{{ route('profil.struktur') }}" class="block px-4 py-2 hover:bg-gray-100 text-gray-700">Struktur Organisasi</a></li>
                    </ul>
                </li>

                <li><a href="{{ route('profil.galeri') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Galeri</a></li>
                <li><a href="{{ route('berita.index') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Berita</a></li>
                <li><a href="{{ route('kontak') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100">Kontak</a></li>
            </ul>
        </div>

          <!-- Media Sosial -->
                <div class="py-6 px-6 flex justify-center space-x-8 text-gray-900 text-2xl"
                    data-aos="fade-up" data-aos-delay="400">
                    @foreach ($sosials as $item)
                        <a href="{{ $item->url }}" target="_blank"
                            class="hover:text-gray-200 transform hover:scale-125 transition duration-300 ease-in-out"
                            data-aos="zoom-in" data-aos-delay="{{ 500 + ($loop->index * 100) }}">
                            <i class="{{ $item->icon }}"></i>
                        </a>
                    @endforeach
                </div>
    </div>
</nav>
