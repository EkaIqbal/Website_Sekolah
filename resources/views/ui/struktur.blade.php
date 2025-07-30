<x-app-layout>
    @if($struktur && $struktur->image)
        <div class="bg-white shadow rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $struktur->image) }}"
                     alt="Struktur Organisasi"
                     class="w-full h-auto object-contain">
         </div>
     @else
            <div class="text-center text-gray-500 text-lg py-10">
                Gambar struktur organisasi belum tersedia.
            </div>
    @endif
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