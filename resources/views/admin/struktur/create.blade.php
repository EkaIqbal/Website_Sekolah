@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto">
    <h1 class="text-xl font-bold mb-4">{{ isset($data) ? 'Edit' : 'Tambah' }} Struktur Organisasi</h1>

    <form method="POST" action="{{ isset($data) ? route('admin.struktur.update', $data->id) : route('admin.struktur.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($data)) @method('PUT') @endif

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Gambar Struktur</label>
            <input type="file" name="image" class="border p-2 w-full">
            @if(isset($data) && $data->image)
                <img src="{{ asset('storage/' . $data->image) }}" class="mt-2 w-full max-w-md">
            @endif
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
