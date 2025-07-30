<x-app-layout>
    {{-- === HERO SECTION === --}}
    <section 
        x-data="{
            active: 0,
            images: [
                @foreach(App\Models\Slideshow::all() as $slide)
                    '{{ asset($slide->image_path) }}'@if(!$loop->last),@endif
                @endforeach
            ],
            next() { this.active = (this.active + 1) % this.images.length; },
            prev() { this.active = (this.active - 1 + this.images.length) % this.images.length; },
            start() { this.interval = setInterval(() => this.next(), 7000); },
            interval: null
        }"
        x-init="start()"
        class="relative w-full h-[750px] md:h-[850px] overflow-hidden"
    >
        <!-- Gambar Slideshow -->
        <template x-for="(image, index) in images" :key="index">
            <div x-show="active === index"
                x-transition:enter="transition duration-1000 ease-out transform"
                x-transition:enter-start="opacity-0 scale-105"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition duration-1000 ease-in transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="absolute inset-0"
            >
                <div :style="`background-image: url('${image}')`"
                    class="w-full h-full bg-cover bg-center bg-no-repeat brightness-[0.6]">
                </div>
            </div>
        </template>

 <!-- Overlay Teks dan Logo -->
<div class="absolute inset-0 z-20 flex flex-col items-center justify-center text-center px-4">
    <img src="{{ asset('assets/images/sd1.png') }}" alt="Logo SDN"
        class="w-24 h-24 md:w-32 md:h-32 mb-4 drop-shadow-lg animate-pulse">
    <h1 class="text-white text-3xl md:text-5xl font-bold drop-shadow-lg animate-fade-in">
        SDN CURAHNONGKO 02
    </h1>
    <p class="text-white mt-2 text-lg md:text-xl drop-shadow-md font-medium animate-fade-in">
        Mewujudkan Generasi Cerdas, Santun, dan Berbudaya
    </p>
</div>


<!-- Overlay Gradient Transparan -->
<div class="absolute inset-0 bg-gradient-to-b from-black/30 via-black/20 to-black/30 z-10"></div>

        <!-- Navigasi Panah -->
        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 z-30">
            <button @click="prev()" class="bg-white/30 hover:bg-white/50 rounded-full p-2">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
        </div>
        <div class="absolute right-4 top-1/2 transform -translate-y-1/2 z-30">
            <button @click="next()" class="bg-white/30 hover:bg-white/50 rounded-full p-2">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </section>

    {{-- === SAMBUTAN & PROFIL === --}}
    @php $sambutan = \App\Models\Sambutan::first(); @endphp
    @if ($sambutan)
    <section class="w-full bg-white py-16 border border-blue-900 rounded-2xl shadow-sm mx-4 my-10" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-10">
                <div class="w-full lg:w-1/2 space-y-6" data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-gray-900">{{ $sambutan->judul }}</h2>
                    <h3 class="text-3xl font-bold text-gray-900">{{ $sambutan->subjudul }}</h3>
                    <p class="text-gray-700 text-base leading-relaxed">{{ $sambutan->isi }}</p>
                </div>
                <div class="w-full lg:w-[300px] flex justify-center" data-aos="fade-left">
                    <div class="bg-white p-2 rounded-2xl shadow-xl">
                        <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="Foto Kepala Sekolah"
                             class="rounded-xl w-[260px] h-[360px] object-cover">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

 {{-- === GALERI SEKOLAH === --}}
 <section class="bg-gradient-to-b from-white to-blue-50 py-16 px-6 rounded-2xl shadow-inner mx-4 my-10" data-aos="fade-up">
    <h2 class="text-3xl font-bold text-center text-gray-900 mb-2" data-aos="fade-down">Galeri Sekolah</h2>
    <p class="text-center text-gray-600 mb-8" data-aos="fade-up" data-aos-delay="150">
        Momen-momen berharga di lingkungan SDN Curahnongko 02.
    </p>
    @if ($galeris->isNotEmpty())
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
        @foreach ($galeris as $galeri)
            <a href="{{ asset('storage/' . $galeri->foto) }}" target="_blank"
               class="block overflow-hidden rounded-xl shadow-md hover:shadow-xl transform hover:scale-105 transition duration-300">
                <img src="{{ asset('storage/' . $galeri->foto) }}" alt="Galeri {{ $loop->iteration }}" class="w-full h-64 object-cover">
            </a>
        @endforeach
    </div>
    @else
        <p class="text-center text-gray-500 mt-4">Belum ada foto galeri yang ditampilkan.</p>
    @endif
</section>

    {{-- === BERITA UTAMA === --}}
@if($beritas->count())
    <div class="py-16 px-4 bg-white border border-blue-900 rounded-2xl shadow-sm mx-4 my-10" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-2" data-aos="fade-down">Berita Utama</h2>
        <p class="text-center text-gray-600 mb-8" data-aos="fade-up" data-aos-delay="150">
            Kumpulan informasi dan kabar terbaru seputar kegiatan dan prestasi SDN Curahnongko 02.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($beritas->take(3) as $berita)
                <a href="{{ $berita->link ?? '#' }}" target="_blank"
                   class="block bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md hover:border-blue-500 hover:ring-1 hover:ring-blue-300 transition-all duration-300 overflow-hidden group"
                   data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    
                    @if($berita->image_url && file_exists(public_path('storage/' . $berita->image_url)))
                        <img src="{{ asset('storage/' . $berita->image_url) }}"
                             class="w-full h-40 object-cover rounded-t-2xl group-hover:scale-105 transition-transform duration-300"
                             alt="{{ $berita->title }}">
                    @else
                        <div class="w-full h-40 bg-gray-200 flex items-center justify-center text-gray-500 rounded-t-2xl">
                            Tidak ada gambar
                        </div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-base font-semibold text-blue-700 group-hover:text-blue-900">{{ $berita->title }}</h3>
                        <p class="text-sm text-gray-600 mt-2 line-clamp-3">{{ $berita->excerpt }}</p>
                        <p class="text-xs text-gray-400 mt-2">{{ $berita->updated_at->format('d M Y') }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Tombol ke semua berita --}}
        <div class="mt-8 text-center">
            <a href="{{ route('berita.index') }}"
               class="inline-block px-6 py-2 rounded-full border border-blue-600 text-blue-700 font-medium
                      hover:bg-white/20 hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-300">
                Lihat Semua Berita
            </a>
        </div>
    </div>
@endif

    {{-- === PARALLAX  === --}}
    <section class="relative w-full h-[500px] flex items-center justify-center text-white parallax border border-gray-300 rounded-2xl shadow-sm mx-4 my-10"
             style="background-image: url('{{ asset('assets/images/guru 3.jpeg') }}');">
        
        <div class="absolute inset-0 bg-black/50 z-0"></div>

        <div class="relative z-10 max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-6 text-center">
            <div class="flex flex-col items-center justify-center space-y-3 px-4">
                <div class="text-xl">★★★★★</div>
                <p class="text-lg leading-relaxed">
                    Sekolah ini memberikan pendidikan yang berkualitas dan lingkungan belajar yang mendukung perkembangan siswa.
                </p>
            </div>
            <div class="flex flex-col items-center justify-center space-y-3 px-4">
                <div class="text-xl">★★★★★</div>
                <p class="text-lg leading-relaxed">
                    Pengalaman belajar di sini sangat menyenangkan, guru-gurunya ramah dan selalu siap membantu siswa.
                </p>
            </div>
        </div>
    </section>

       {{-- CSS Animasi Floating --}}
    <style>
        @keyframes floating {
            0%   { transform: translateY(0); }
            50%  { transform: translateY(-10px); }
            100% { transform: translateY(0); }
        }
        .animate-floating {
            animation: floating 6s ease-in-out infinite;
        }

        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    {{-- JS Modal --}}
    <script>
        function showModal(id) {
            document.getElementById(`modal-${id}`).classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
        function closeModal(id) {
            document.getElementById(`modal-${id}`).classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    </script>
</x-app-layout>
