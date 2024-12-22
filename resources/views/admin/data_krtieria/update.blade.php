<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Data Kriteria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">{{ session('error') }}</strong>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <title>Close</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            @endif
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('update-data-kriteria') }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $kriteria->id }}">
                    <div class="mt-4">
                        <x-input-label for="kode_kriteria" :value="__('Kode Kriteria')" />
                        <x-text-input id="kode_kriteria" class="block mt-1 w-full" type="text" name="kode_kriteria"
                            value="{{ $kriteria->kode_kriteria }}" disabled required autofocus
                            autocomplete="kode_kriteria" />
                        <x-input-error :messages="$errors->get('kode_kriteria')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="nama_kriteria" :value="__('Nama Kriteria')" />
                        <x-text-input id="nama_kriteria" class="block mt-1 w-full" type="text" name="nama_kriteria"
                            value="{{ $kriteria->nama_kriteria }}" disabled required autofocus
                            autocomplete="nama_kriteria" />
                        <x-input-error :messages="$errors->get('nama_kriteria')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="bobot" :value="__('bobot')" />
                        <x-text-input id="bobot" class="block mt-1 w-full" type="number" name="bobot"
                            value="{{ $kriteria->bobot }}" required autofocus autocomplete="bobot" />
                        <x-input-error :messages="$errors->get('bobot')" class="mt-2" />
                    </div>



                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Submit
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
