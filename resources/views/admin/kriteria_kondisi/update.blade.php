<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Kriteria Kondisi') }}
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
                <form method="POST" action="{{ route('update-kriteria-kondisi') }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $kondisi->id }}">
                    <div class="mt-4">
                        <x-input-label for="kondisi" :value="__('Kondisi Motor')" />
                        <x-text-input id="kondisi" class="block mt-1 w-full" type="text" name="kondisi"
                            value="{{ $kondisi->kondisi }}" required autofocus autocomplete="kondisi" />
                        <x-input-error :messages="$errors->get('kondisi')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="keterangan" :value="__('Keterangan')" />
                        <x-text-input id="keterangan" class="block mt-1 w-full" type="text" name="keterangan"
                            value="{{ $kondisi->keterangan }}" required disabled autofocus autocomplete="keterangan" />
                        <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="nilai" :value="__('Nilai')" />
                        <x-text-input id="nilai" class="block mt-1 w-full" type="number" name="nilai"
                            value="{{ $kondisi->nilai }}" required autofocus autocomplete="nilai" />
                        <x-input-error :messages="$errors->get('nilai')" class="mt-2" />
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
