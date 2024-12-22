@extends('welcome')
@section('content')
    <div id="contact" class="section relative pb-20 bg-white dark:bg-gray-800">
        <div class="container xl:max-w-6xl mx-auto px-4 border border-transparent">
            <div class="flex flex-wrap flex-row -mx-4 justify-center " style="margin-top: 1rem">

                <div class="max-w-ful px-4 w-full lg:w-10/12">
                    <div role="alert" class="mb-5">
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>Data Kriteria merupakan tabel yang berisi tentang kepentingan suatu nilai pada bobot.
                                Contoh: Kriteria kondisi nilainya adalah 30 nilai tersebut paling besar karena kriteria
                                kondisi lebih penting dibandingkan dengan kriteria lainnya</p>
                        </div>
                    </div>
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
                    <div class="bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Data</span> Kriteria</h2>
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
                            <table class="min-w-full table-auto" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-10 py-2">Kode Kriteria</th>
                                        <th class="px-10 py-2">Nama Kriteria</th>
                                        <th class="px-10 py-2">Bobot</th>
                                        <th class="px-10 py-2">Normalisasi</th>
                                        <th class="px-10 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kriteria as $krt)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-10 py-2">{{ $krt->kode_kriteria }}</td>
                                            <td class="border px-10 py-2">{{ $krt->nama_kriteria }}</td>
                                            <td class="border px-10 py-2">{{ $krt->bobot }}</td>
                                            <td class="border px-10 py-2">{{ (float) $krt->bobot / $totalBobot }}</td>
                                            <td class="border px-10 py-2">
                                                <a href="{{ route('update-bobot') }}/{{ $krt->id }}"
                                                    class="text-white bg-blue-400 rounded-full px-2 py-1">Edit</a>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td class="border px-4 py-2 text-center" colspan="5">Kriteria Harga Belum
                                                Ada
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
