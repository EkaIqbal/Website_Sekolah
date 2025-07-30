<div class="flex overflow-x-auto gap-4 py-4">
    @for ($i = 0; $i < count($iklans); $i++)
        <a href="{{ $iklans[$i]->link ?? '#' }}" target="_blank"
           class="block w-52 flex-shrink-0 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition">
            <img src="{{ asset('storage/' . $iklans[$i]->gambar) }}" class="w-full h-[150px] object-cover">
        </a>
    @endfor
</div>
