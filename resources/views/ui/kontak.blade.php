<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800" data-aos="fade-down" data-aos-duration="800">
            Kontak
        </h2>
    </x-slot>

    {{-- AOS Stylesheet --}}
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <section class="bg-white py-10">
        <div class="max-w-7xl mx-auto px-4 space-y-12">

            <!-- Kotak Informasi -->
            <div class="border rounded-2xl overflow-hidden shadow-lg flex flex-col" data-aos="zoom-in"
                data-aos-duration="1000">
                <div class="bg-blue-500 py-4 px-6 text-center">
                    <h3 class="text-white text-2xl font-bold uppercase" data-aos="fade-down" data-aos-delay="100">
                        {{ $kontak->judul ?? '' }}
                    </h3>
                </div>

                <div class="bg-white p-6 text-center space-y-4">
                    <p class="text-lg text-gray-700" data-aos="fade-up" data-aos-delay="200">
                        {{ $kontak->deskripsi ?? '' }}
                    </p>

                    <div class="w-full" data-aos="fade-up" data-aos-delay="300">
                        {!! $kontak->map_embed ?? '<p class="text-red-500"></p>' !!}
                    </div>
                </div>

                <!-- Media Sosial -->
                <div class="mt-4 bg-blue-500 rounded-b-2xl py-6 px-6 flex justify-center space-x-8 text-white text-3xl"
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