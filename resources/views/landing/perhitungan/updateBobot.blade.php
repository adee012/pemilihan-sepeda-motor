@extends('welcome')
@section('content')
    <div id="contact" class="section relative pb-20 bg-white dark:bg-gray-800">
        <div class="container xl:max-w-6xl mx-auto px-4 border border-transparent">
            <div class="flex flex-wrap flex-row -mx-4 justify-center " style="margin-top: 1rem">

                <div class="max-w-ful px-4 w-full lg:w-8/12">
                    <div class="bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Ubah</span> Bobot</h2>
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
                        <form method="POST" action="{{ route('update-bobot') }}" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $kriteria->id }}">
                            <div style="margin-bottom: 1rem">
                                <x-input-label style="margin-bottom: 4px; font-size: 16px" for="kode_kriteria"
                                    :value="__('Kode Kriteria')" />
                                <x-text-input id="kode_kriteria" class="block mt-1 w-full border bg-white rounded-full"
                                    type="text" name="kode_kriteria" value="{{ $kriteria->kode_kriteria }}" disabled
                                    required autofocus autocomplete="kode_kriteria" style="padding: 8px" />
                                <x-input-error :messages="$errors->get('kode_kriteria')" class="mt-2" />
                            </div>

                            <div style="margin-bottom: 1rem">
                                <x-input-label style="margin-bottom: 4px; font-size: 16px" for="nama_kriteria"
                                    :value="__('Nama Kriteria')" />
                                <x-text-input id="nama_kriteria" class="block mt-1 w-full border bg-white rounded-full"
                                    type="text" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" disabled
                                    required autofocus autocomplete="nama_kriteria" style="padding: 8px" />
                                <x-input-error :messages="$errors->get('nama_kriteria')" class="mt-2" />
                            </div>

                            <div style="margin-bottom: 1rem">
                                <x-input-label style="margin-bottom: 4px; font-size: 16px" for="bobot"
                                    :value="__('Bobot')" />
                                <x-text-input id="bobot" class="block mt-1 w-full border bg-white rounded-full"
                                    type="number" name="bobot" value="{{ $kriteria->bobot }}" required autofocus
                                    autocomplete="bobot" style="padding: 8px" />
                                <x-input-error :messages="$errors->get('bobot')" class="mt-2" />
                            </div>



                            <div class="flex items-center justify-end mt-4">

                                <button type="submit" class="font-bold py-2 px-4 bg-blue-400 text-white rounded-full">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
