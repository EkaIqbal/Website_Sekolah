<x-layouts.app>
    <div class="max-w-5xl mx-auto py-12 px-6">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden transition-transform hover:scale-[1.01] duration-300">
            @if ($berita->thumbnail)
                <img 
                    src="{{ asset('storage/' . $berita->thumbnail) }}" 
                    alt="Thumbnail Berita" 
                    class="w-full h-96 object-cover rounded-t-2xl"
                >
            @endif

            <div class="p-6 md:p-10">
                <h1 class="text-3xl font-bold text-blue-800 mb-4 border-b pb-2">
                    {{ $berita->judul }}
                </h1>

                <p class="text-sm text-gray-500 mb-6">
                    Dipublikasikan pada: {{ \Carbon\Carbon::parse($berita->tanggal)->translatedFormat('d F Y') }}
                </p>

                <div class="prose max-w-none text-gray-800 leading-relaxed text-justify">
                    {!! nl2br(e($berita->isi)) !!}
                </div>
            </div>
        </div>

        <div class="mt-8">
            <a 
                href="{{ route('berita.index') }}" 
                class="inline-block px-6 py-3 bg-blue-700 hover:bg-blue-800 text-white rounded-lg shadow-md transition-all"
            >
                ← Kembali ke Daftar Berita
            </a>
        </div>
    </div>
</x-layouts.app>
<!-- Carousel Iklan -->
  <div class="overflow-hidden relative w-full">
    <div class="animate-scroll-x whitespace-nowrap text-center text-4xl font-extrabold flex">
        <div class="flex-shrink-0 flex space-x-16 px-6">
            @for($i = 0; $i < 2; $i++) {{-- Gandakan isi agar animasi tidak terputus --}}
                @for($j = 0; $j < 8; $j++)
                    <span class="flex items-center">
                        <!-- Logo sebelum tulisan BAPENDA -->
                        <img src="{{ asset('assets/images/logo_situbondo.png') }}" alt="Logo" class="w-10 h-10 mr-2">
                        <span>
                            <span class="text-blue-800">BAPENDA</span>
                            <span class="text-yellow-500"> Kab. Situbondo</span>
                        </span>
                    </span>
                @endfor
            @endfor
        </div>
    </div>
</div>

<style>
    {{-- @keyframes scroll-x {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    } --}}

    {{-- .animate-scroll-x { --}}
        animation: scroll-x 40s linear infinite;
    {{-- }