@extends('layouts.admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">
        {{ isset($data) ? 'Edit' : 'Tambah' }} Visi & Misi
    </h1>

    <form method="POST" action="{{ isset($data) ? route('admin.visi-misi.update', $data->id) : route('admin.visi-misi.store') }}">
        @csrf
        @if(isset($data)) @method('PUT') @endif

        {{-- Input Visi --}}
        <div class="mb-6">
            <label class="block font-semibold mb-2">Visi:</label>
            <textarea name="visi" rows="3"
                class="w-full border border-gray-300 rounded-md p-3 focus:outline-blue-500 focus:ring"
                required>{{ old('visi', $data->visi ?? '') }}</textarea>
        </div>

        {{-- Input Misi Dinamis --}}
        <div x-data="{ missions: [] }"
             x-init="missions = {{ json_encode(old('misi', isset($data) && is_array($data->misi) ? $data->misi : [''])) }}"
             class="mb-6">
            <label class="block font-semibold mb-2">Misi:</label>

            <template x-for="(mission, index) in missions" :key="index">
                <div class="flex gap-2 mb-3">
                    <textarea
                        class="w-full border border-gray-300 rounded-md p-3 focus:outline-blue-500"
                        :name="`misi[]`"
                        x-model="missions[index]"
                        rows="2"
                        required
                    ></textarea>
                    <button type="button"
                        @click="missions.splice(index, 1)"
                        x-show="missions.length > 1"
                        class="text-red-600 font-bold px-3 py-1 hover:text-red-800"
                        title="Hapus">
                        &times;
                    </button>
                </div>
            </template>

            <button type="button"
                @click="missions.push('')"
                class="mt-2 text-sm text-blue-700 hover:text-blue-900 font-medium">
                + Tambah Misi
            </button>
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md shadow">
            Simpan
        </button>
    </form>
</div>
@endsection
