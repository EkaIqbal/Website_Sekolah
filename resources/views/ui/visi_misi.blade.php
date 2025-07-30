<x-app-layout>
    <!-- Section Visi dan Misi -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8 border border-gray-200">
                <!-- Judul -->
                <h3 class="text-4xl font-bold text-gray-800 mb-8 text-center text-shadow-lg">
                    Visi dan Misi
                </h3>

                @if ($data)
                <!-- Kontainer Visi & Misi Bersebelahan -->
                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Visi -->
                    <div class="w-full md:w-1/2 bg-blue-50 border border-blue-200 rounded-lg shadow-md p-6">
                        <h4 class="text-xl font-bold text-gray-800 mb-4">Visi</h4>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $data->visi }}
                        </p>
                    </div>

                    <!-- Misi -->
                    <div class="w-full md:w-1/2 bg-blue-50 border border-blue-200 rounded-lg shadow-md p-6">
                        <h4 class="text-xl font-bold text-gray-800 mb-4">Misi</h4>
                        <ul class="list-disc ml-5 space-y-2 text-gray-700">
                            @foreach ($data->misi as $m)
                                <li>{{ $m }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @else
                    <div class="text-center text-gray-500 italic">Data Visi & Misi belum tersedia.</div>
                @endif
            </div>
        </div>
    </div>

    <style>
        @keyframes scroll-x {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .animate-scroll-x {
            animation: scroll-x 40s linear infinite;
        }

        .text-shadow-lg {
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.15);
        }
    </style>
</x-app-layout>
