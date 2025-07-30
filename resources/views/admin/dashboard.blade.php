@extends('layouts.admin')

@section('header')
    <h2 class="text-3xl font-extrabold text-gray-900 leading-tight tracking-tight">
        Dashboard Admin
    </h2>
@endsection

@section('content')
<div class="py-12 px-6 max-w-7xl mx-auto bg-white">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

        @foreach([
            ['title' => 'Slideshow', 'desc' => "$totalSlideshow gambar ditampilkan", 'route' => 'admin.slideshow.index', 'color' => 'from-fuchsia-500 to-purple-600'],
            ['title' => 'Berita', 'desc' => "$totalBerita berita telah diposting", 'route' => 'admin.berita.index', 'color' => 'from-rose-500 to-red-500'],
            ['title' => 'Sambutan', 'desc' => "$totalSambutan sambutan tersedia", 'route' => 'admin.sambutan.index', 'color' => 'from-sky-500 to-cyan-600'],
        ] as $card)
        <article class="bg-white rounded-none shadow-xl
                        transform transition duration-500 hover:scale-[1.03] hover:shadow-2xl
                        border border-gray-200
                        flex flex-col justify-between">

            <div class="p-8 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-2xl font-extrabold text-gray-900 tracking-wide">
                        {{ $card['title'] }}
                    </h3>
                    <span class="inline-block bg-gradient-to-r {{ $card['color'] }} text-white text-xs font-semibold px-3 py-1 shadow-lg select-none">
                        {{ explode(' ', $card['desc'])[0] }}
                    </span>
                </div>
                <p class="text-gray-700 leading-relaxed font-medium">
                    {{ $card['desc'] }}
                </p>
            </div>

            <a href="{{ route($card['route']) }}"
               class="group relative inline-block bg-gradient-to-r {{ $card['color'] }} hover:from-opacity-90 hover:to-opacity-90
                      text-white text-center font-semibold py-4 rounded-none tracking-wide
                      focus:outline-none focus:ring-4 focus:ring-offset-1 focus:ring-opacity-75
                      focus:ring-indigo-400 transition shadow-md"
               aria-label="Kelola {{ $card['title'] }}">

                <span class="absolute inset-0 rounded-none bg-gradient-to-r {{ $card['color'] }} opacity-20 group-hover:opacity-30 transition duration-300"></span>

                <span class="relative flex justify-center items-center gap-3">
                    Kelola {{ $card['title'] }}

                    <svg class="w-5 h-5 transform transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </a>
        </article>
        @endforeach

    </div>
</div>
@endsection
