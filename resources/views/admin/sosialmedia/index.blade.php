{{-- @extends('layouts.admin')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Sosial Media</h2>

    <a href="{{ route('admin.sosialmedia.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mb-4 inline-block">+ Tambah Sosial Media</a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($sosials as $sosial)
        <div class="bg-white p-4 rounded shadow flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $sosial->icon) }}" alt="{{ $sosial->nama }}" class="w-10 h-10 object-contain">
                <div>
                    <p class="font-semibold">{{ $sosial->nama }}</p>
                    <a href="{{ $sosial->url }}" target="_blank" class="text-blue-500 text-sm break-all">{{ $sosial->url }}</a>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.sosialmedia.edit', $sosial->id) }}" class="text-blue-600 hover:underline">Edit</a>
                <form action="{{ route('admin.sosialmedia.destroy', $sosial->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:underline">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection --}}
