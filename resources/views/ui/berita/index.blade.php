<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Berita</h2>
    </x-slot>

    <div class="py-8 px-4 max-w-7xl mx-auto">
        @if($beritas->count())
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($beritas as $berita)
                    <div class="bg-white rounded-lg border border-yellow-400 shadow hover:shadow-xl transition">
                        @if($berita->image_url && file_exists(public_path('storage/' . $berita->image_url)))
                            <img src="{{ asset('storage/' . $berita->image_url) }}" class="w-full h-48 object-cover rounded-t-lg"
                                alt="{{ $berita->title }}" />
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                Tidak ada gambar
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-blue-700 hover:text-yellow-500">
                                <a href="{{ route('berita.show', $berita->id) }}">
                                    {{ $berita->title ?? 'Tanpa Judul' }}
                                </a>
                            </h3>

                            <p class="text-sm text-gray-600 mt-2">
                                {{ \Illuminate\Support\Str::limit($berita->content, 100, '...') }}
                            </p>

                            <p class="text-xs text-gray-400 mt-2">
                                {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $beritas->links() }}
            </div>
        @else
            <p class="text-center text-gray-500">Belum ada berita yang tersedia.</p>
        @endif
    </div>
</x-app-layout>
