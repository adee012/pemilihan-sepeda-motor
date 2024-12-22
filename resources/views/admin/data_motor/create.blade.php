<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambahkan Data Motor') }}
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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('tambah-motor') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-input-label for="nama_sepeda_motor" :value="__('Nama Motor')" />
                        <x-text-input id="nama_sepeda_motor" class="block mt-1 w-full" type="text"
                            name="nama_sepeda_motor" :value="old('nama_sepeda_motor')" required autofocus
                            autocomplete="nama_sepeda_motor" />
                        <x-input-error :messages="$errors->get('nama_sepeda_motor')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="harga" :value="__('Harga Motor')" />
                        <x-text-input id="harga" class="block mt-1 w-full" type="number" name="harga"
                            :value="old('harga')" required autofocus autocomplete="harga" />
                        <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="kondisi" :value="__('Kondisi Motor')" />

                        <select name="kondisi" id="kondisi"
                            class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="" disabled selected>Kondisi Motor</option>
                            <option value="Sangat Baik">Sangat Baik</option>
                            <option value="Baik">Baik</option>
                            <option value="Cukup">Cukup</option>
                            <option value="Buruk">Buruk</option>
                        </select>

                        <x-input-error :messages="$errors->get('kondisi')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="jarak" :value="__('Jarak Tempuh Motor')" />
                        <x-text-input id="jarak" class="block mt-1 w-full" type="number" name="jarak"
                            :value="old('jarak')" required autofocus autocomplete="jarak" />
                        <x-input-error :messages="$errors->get('jarak')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="tahun" :value="__('Tahun Keluaran')" />
                        <x-text-input id="tahun" class="block mt-1 w-full" type="number" name="tahun"
                            :value="old('tahun')" required autofocus autocomplete="tahun" />
                        <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
                    </div>

                    {{-- <div class="mt-4">
                        <x-input-label for="spesifikasi" :value="__('Spesifikasi')" />
                        <x-text-input id="spesifikasi" class="block mt-1 w-full" type="text" name="spesifikasi"
                            :value="old('spesifikasi')" required autofocus autocomplete="spesifikasi" />
                        <x-input-error :messages="$errors->get('spesifikasi')" class="mt-2" />
                    </div> --}}

                    <div class="mt-4">
                        <x-input-label for="spesifikasi" :value="__('Spesifikasi')" />
                        <textarea id="spesifikasi" name="spesifikasi" rows="4"
                            class="block mt-1 w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            required autofocus autocomplete="spesifikasi">{{ old('spesifikasi') }}</textarea>
                        <x-input-error :messages="$errors->get('spesifikasi')" class="mt-2" />
                    </div>


                    <hr class="my-5">

                    <div class="mt-4">
                        <x-input-label for="gambar" :value="__('Gambar')" />
                        <x-text-input id="gambar" class="block mt-1 w-full" type="file" name="gambar" required
                            autofocus autocomplete="gambar" />
                        <x-input-error :messages="$errors->get('gambar')" class="mt-2" />
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
