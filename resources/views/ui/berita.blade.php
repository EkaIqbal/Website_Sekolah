<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Semua Berita</h2>
    </x-slot>

    <div class="py-10 px-4 max-w-7xl mx-auto">
        @if($beritas->count())
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($beritas as $berita)
                    <a href="https://data.sekolah-kita.net/sekolah/UNIT%20PELAKSANA%20TEKNIS%20DAERAH%20(UPTD)%20SATUAN%20PENDIDIKAN%20SDN%20CURAHNONGKO%2002_100445"
                       target="_blank"
                       class="bg-white rounded-lg border border-gray-300 shadow hover:shadow-lg transition transform hover:scale-[1.02] block"
                       data-aos="zoom-in"
                       data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                        
                        @if($berita->image_url && file_exists(public_path('storage/' . $berita->image_url)))
                            <img src="{{ asset('storage/' . $berita->image_url) }}"
                                 class="w-full h-48 object-cover rounded-t-lg"
                                 alt="{{ $berita->title }}">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                Tidak ada gambar
                            </div>
                        @endif
                        
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-blue-700">{{ $berita->title }}</h3>
                            <p class="text-sm text-gray-600 mt-2">{{ $berita->excerpt }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $berita->created_at->format('d M Y') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $beritas->links() }}
            </div>
        @else
            <p class="text-center text-gray-500" data-aos="fade-in">Belum ada berita yang tersedia.</p>
        @endif
    </div>
</x-app-layout>
