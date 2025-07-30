<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-12 tracking-wide" data-aos="fade-down">
            📸 Galeri Kegiatan sekolah
        </h1>

        <div class="space-y-12">
            @forelse ($galeris as $galeri)
                <div class="flex flex-col md:flex-row {{ $loop->index % 2 !== 0 ? 'md:flex-row-reverse' : '' }} items-center gap-6 md:gap-12"
                    data-aos="{{ $loop->index % 2 === 0 ? 'fade-right' : 'fade-left' }}"
                    data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                    <div class="md:w-1/2 w-full overflow-hidden rounded-xl shadow-lg border border-gray-200 hover:shadow-blue-200 transition duration-300"
                        data-aos="zoom-in" data-aos-delay="{{ 100 * ($loop->index + 1) + 100 }}">
                        <img src="{{ asset('storage/' . $galeri->foto) }}" alt="Foto Kegiatan"
                            class="w-full h-64 object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="md:w-1/2 w-full text-center md:text-left">
                        <p class="text-lg text-gray-700 font-medium bg-blue-50 p-4 rounded-xl shadow-sm border border-blue-100"
                            data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index + 1) + 200 }}">
                            {{ $galeri->keterangan }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500" data-aos="fade-in">Belum ada foto kegiatan.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>

<style>
    @keyframes scroll-x {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-50%);
        }
    }

    .animate-scroll-x {
        animation: scroll-x 40s linear infinite;
    }