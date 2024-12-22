@extends('welcome')
@section('content')
    <div id="" class="section relative pb-20 bg-white dark:bg-gray-800">
        <div class="container xl:max-w-6xl mx-auto px-4 border border-transparent">
            <div class="flex flex-wrap flex-row -mx-4 justify-center " style="margin-top: 1rem">

                <div class="max-w-ful px-4 w-full lg:w-10/12">
                    @if (session('success'))
                        <div id="flash-message" onclick="closeFlashMessage()"
                            class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-5"
                            role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6
                        text-green-500" role="button"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path
                                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                </svg>
                            </span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div id="flash-message" onclick="closeFlashMessage()"
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5"
                            role="alert">
                            <strong class="font-bold">{{ session('error') }}</strong>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6
                        text-red-500" role="button"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path
                                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                </svg>
                            </span>
                        </div>
                    @endif
                    <div class="bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp mb-8" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Tambah</span> Alternatif</h2>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60"
                                style="margin: 0 auto;height: 35px;" xml:space="preserve">
                                <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                                    style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                                <line x1="55.1" y1="30.4" x2="100" y2="30.4" class="stroke-primary"
                                    style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                                <line x1="45.1" y1="30.4" x2="0" y2="30.4" class="stroke-primary"
                                    style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                            </svg>
                        </header>
                        <div class="overflow-x-auto  flex justify-center">
                            <form action="{{ route('tambah-alternatiff') }}" method="POST" id="alternatif-form">
                                @csrf
                                <table class="min-w-full table-auto mb-3">
                                    <thead>
                                        <tr>
                                            <th class="px-2 py-1">#</th>
                                            <th class="px-10 py-2">Nama Sepeda Motor</th>
                                            <th class="px-10 py-2">Harga</th>
                                            <th class="px-10 py-2">Jarak</th>
                                            <th class="px-10 py-2">Kondisi</th>
                                            <th class="px-10 py-2">Tahun</th>
                                            <th class="px-10 py-2">Gambar</th>
                                            <th class="px-10 py-2">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($motors as $motor)
                                            <tr class="text-center">
                                                <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                                <td class="border px-4 py-2">{{ $motor->nama_sepeda_motor }}</td>
                                                <td class="border px-4 py-2">Rp {{ number_format($motor->harga) }}</td>
                                                <td class="border px-4 py-2">{{ $motor->kondisi }}</td>
                                                <td class="border px-4 py-2">{{ $motor->jarak }}</td>
                                                <td class="border px-4 py-2">{{ $motor->tahun }}</td>
                                                <td class="border px-4 py-2">
                                                    <img width="100px" height="100px" class="rounded"
                                                        src="{{ asset('storage/gambar_motor') }}/{{ $motor->gambar }}">
                                                </td>
                                                <td class="border px-10 py-2">
                                                    <input type="checkbox" name="motor_ids[]" value="{{ $motor->id }}"
                                                        style="width: 20px; height: 20px; cursor:pointer">

                                                    {{-- <a href="#"
                                                    onclick="event.preventDefault(); { document.getElementById('delete-form-{{ $motor->id }}').submit(); }"
                                                    class="text-white bg-blue-400 px-2 py-1 rounded-full">Tambah</a>
                                                <form id="delete-form-{{ $motor->id }}"
                                                    action="{{ route('tambah-alternatif', $motor->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form> --}}
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td class="border px-4 py-2 text-center" colspan="7">Data Motor Belum
                                                    Ada
                                                </td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                                <div style="display: flex; justify-content: right">
                                    <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded-full">Pilih
                                        Motor</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div id="contact" class="section relative pb-20 bg-white dark:bg-gray-800">
        <div class="container xl:max-w-6xl mx-auto px-4 border border-transparent">
            <div class="flex flex-wrap flex-row -mx-4 justify-center " style="margin-top: 1rem">

                <div class="max-w-ful px-4 w-full lg:w-8/12">
                    @if (session('error'))
                        <div id="flash-message" onclick="closeFlashMessage()"
                            class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5"
                            role="alert">
                            <strong class="font-bold">{{ session('error') }}</strong>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6
                            text-red-500" role="button"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path
                                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                </svg>
                            </span>
                        </div>
                    @endif
                    <div class="bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Cari</span> Alternatif</h2>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60"
                                style="margin: 0 auto;height: 35px;" xml:space="preserve">
                                <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                                    style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                                <line x1="55.1" y1="30.4" x2="100" y2="30.4" class="stroke-primary"
                                    style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                                <line x1="45.1" y1="30.4" x2="0" y2="30.4" class="stroke-primary"
                                    style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                            </svg>
                        </header>
                        <form method="POST" action="{{ route('tambah-alternatif') }}" enctype="multipart/form-data">
                            @csrf
                            <div style="margin-bottom: 1rem">
                                <x-input-label style="margin-bottom: 4px; font-size: 16px" for="kondisi"
                                    :value="__('Kondisi')" />

                                <select name="kondisi" id="kondisi"
                                    class="py-3 rounded-lg pl-3 w-full border border-slate-300 rounded-full"
                                    style="padding: 8px">
                                    <option value="" disabled selected>Kondisi Motor</option>
                                    @foreach ($kondisi as $knd)
                                        <option value="{{ $knd->kondisi }}">{{ $knd->kondisi }}</option>
                                    @endforeach

                                </select>

                                <x-input-error :messages="$errors->get('kondisi')" class="mt-2" />
                            </div>

                            <div style="margin-bottom: 1rem">
                                <x-input-label style="margin-bottom: 4px; font-size: 16px" for="harga"
                                    :value="__('Harga')" />
                                <x-text-input id="harga" class="block mt-1 w-full border bg-white rounded-full"
                                    type="text" name="harga" :value="old('harga')" required autofocus autocomplete="harga"
                                    style="padding: 8px" />
                                <x-input-error :messages="$errors->get('harga')" class="mt-2" />
                            </div>

                            <div style="margin-bottom: 1rem">
                                <x-input-label style="margin-bottom: 4px; font-size: 16px" for="jarak"
                                    :value="__('Jarak')" />
                                <x-text-input id="jarak" class="block mt-1 w-full border bg-white rounded-full"
                                    type="number" name="jarak" :value="old('jarak')" required autofocus autocomplete="jarak"
                                    style="padding: 8px" />
                                <x-input-error :messages="$errors->get('jarak')" class="mt-2" />
                            </div>

                            <div style="margin-bottom: 1rem">
                                <x-input-label style="margin-bottom: 4px; font-size: 16px" for="tahun"
                                    :value="__('Tahun')" />
                                <x-text-input id="tahun" class="block mt-1 w-full border bg-white rounded-full"
                                    type="number" name="tahun" :value="old('tahun')" required autofocus autocomplete="tahun"
                                    style="padding: 8px" />
                                <x-input-error :messages="$errors->get('tahun')" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-4">

                                <button type="submit" class="font-bold py-2 px-4 bg-blue-400 text-white rounded-full">
                                    Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div> --}}
@endsection
