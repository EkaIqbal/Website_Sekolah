@extends('layouts.admin')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-gray-100 to-blue-50 p-6">
        <div class="w-full max-w-6xl">
            <h1 class="text-3xl font-extrabold text-center text-blue-800 mb-10 border-b-4 border-blue-300 pb-3">
                Struktur Organisasi
            </h1>

            <div class="mt-10 flex justify-center">
                <a href="{{ route('admin.dashboard') }}"
                    class="bg-gray-200 hover:bg-red-300 text-gray-800 px-6 py-3 rounded-full shadow-md transition-all duration-300 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>

            <div class="flex justify-center mb-8">
                <a href="{{ route('admin.struktur.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full shadow-md transition-all duration-300 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Struktur
                </a>
            </div>

            @if($data->count())
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 justify-items-center">
                    @foreach ($data as $item)
                        <div
                            class="bg-white rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 overflow-hidden border border-gray-200 w-full max-w-md">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="Struktur Organisasi"
                                class="w-full h-[450px] object-contain bg-gray-50">

                            <div class="p-5 flex justify-between items-center">
                                <a href="{{ route('admin.struktur.edit', $item->id) }}"
                                    class="text-blue-600 hover:text-blue-800 font-medium transition-all flex items-center gap-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M15.232 5.232l3.536 3.536M9 11l6-6 3 3-6 6H9v-3z" />
                                    </svg>
                                    Edit
                                </a>

                                <form action="{{ route('admin.struktur.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-800 font-medium transition-all flex items-center gap-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path
                                                d="M19 7l-.867 12.142A2 2 0 0 1 16.138 21H7.862a2 2 0 0 1-1.995-1.858L5 7m5-4h4a1 1 0 0 1 1 1v2H9V4a1 1 0 0 1 1-1z" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 text-lg mt-10">Belum ada data struktur organisasi.</p>
            @endif
        </div>
    </div>
@endsection