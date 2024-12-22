@extends('welcome')
@section('content')
    <div id="contact" class="section relative pb-20 bg-white dark:bg-gray-800">
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

                    {{-- Alternatif --}}
                    <div class="bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp mb-8" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <div class="mb-3 " style="display: flex; justify-content:right; gap:8px">
                            <a href="#"
                                onclick="event.preventDefault(); if (confirm('Apakah Anda Yakin Ingin Menghapus Semua Data Alternatif ?')) { document.getElementById('delete-form').submit(); }"
                                class="font-bold py-2 px-4 bg-red-400 text-white rounded-full">Kosongkan Alternatif</a>
                            <form id="delete-form" action="{{ route('truncate-alternatif') }}" method="POST"
                                style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>


                            <a href="{{ route('tambah-alternatifs') }}"
                                class="font-bold py-2 px-4 bg-blue-400 text-white rounded-full">
                                Tambahkan Alternatif
                            </a>
                        </div>
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Data</span> Alternatif</h2>
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
                                    @forelse ($alternatif as $alt)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-10 py-2">{{ $alt->motor->nama_sepeda_motor }}</td>
                                            <td class="border px-10 py-2">Rp {{ number_format($alt->motor->harga) }}</td>
                                            <td class="border px-10 py-2">{{ $alt->motor->jarak }}</td>
                                            <td class="border px-10 py-2">{{ $alt->motor->kondisi }}</td>
                                            <td class="border px-10 py-2">{{ $alt->motor->tahun }}</td>
                                            <td class="border px-10 py-2">
                                                <img width="100px" height="100px" class="rounded"
                                                    src="{{ asset('storage/gambar_motor') }}/{{ $alt->motor->gambar }}">
                                            </td>
                                            <td class="border px-10 py-2">
                                                <a href="#"
                                                    onclick="event.preventDefault(); if (confirm('Apakah Anda Yakin Ingin Menghapus Data Alternatif ?')) { document.getElementById('delete-form-{{ $alt->id }}').submit(); }"
                                                    class="text-red-600">Delete</a>
                                                <form id="delete-form-{{ $alt->id }}"
                                                    action="{{ route('delete-alternatif', $alt->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td class="border px-4 py-2 text-center" colspan="8">Data Alternatif Belum
                                                Ada
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Penilaian --}}
                    <div class="bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp mb-8" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Data</span> Penilaian</h2>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60"
                                style="margin: 0 auto;height: 35px;" xml:space="preserve">
                                <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                                    style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                                <line x1="55.1" y1="30.4" x2="100" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                                <line x1="45.1" y1="30.4" x2="0" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                            </svg>
                        </header>
                        <div class="overflow-x-auto flex justify-center">
                            <table class="min-w-full table-auto" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-10 py-2">Nama Alternatif</th>
                                        @foreach ($kriteria as $krt)
                                            <th class="px-10 py-2">{{ $krt->kode_kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($alternatif as $alt)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-10 py-2">{{ $alt->motor->nama_sepeda_motor }}</td>
                                            @foreach ($kriteria as $krt)
                                                @php
                                                    $nilai = $alt->penilaian->firstWhere('id_kriteria', $krt->id);
                                                @endphp
                                                <td class="border px-10 py-2">{{ $nilai ? $nilai->nilai : 'N/A' }}</td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td class="border px-10 py-2" colspan="6">Data Penilaian Belum Ada</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                    {{-- Normalisasi --}}
                    <div class="mb-8 bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Normalisasi</span> Data</h2>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60"
                                style="margin: 0 auto;height: 35px;" xml:space="preserve">
                                <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                                    style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                                <line x1="55.1" y1="30.4" x2="100" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                                <line x1="45.1" y1="30.4" x2="0" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                            </svg>
                        </header>
                        <div class="overflow-x-auto  flex justify-center">
                            <table class="min-w-full table-auto" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-10 py-2">Nama Sepeda Motor</th>
                                        <th class="px-10 py-2">C1</th>
                                        <th class="px-10 py-2">C2</th>
                                        <th class="px-10 py-2">C3</th>
                                        <th class="px-10 py-2">C4</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($alternatif as $alt)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-10 py-2">{{ $alt->motor->nama_sepeda_motor }}</td>
                                            @foreach ($kriteria as $k)
                                                <td class="border px-10 py-2">
                                                    {{ number_format($normalisasi[$alt->id][$k->id], 4) ?? 'N/A' }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @empty
                                        <td class="border px-2 py-1 text-center" colspan="6">Belum Ada Normalisasi</td>
                                    @endforelse
                                </tbody>


                            </table>
                        </div>
                    </div>

                    {{-- Nilai S --}}
                    <div class="mb-8 bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Nilai</span> S</h2>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60"
                                style="margin: 0 auto;height: 35px;" xml:space="preserve">
                                <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                                    style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                                <line x1="55.1" y1="30.4" x2="100" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                                <line x1="45.1" y1="30.4" x2="0" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                            </svg>
                        </header>

                        <div class="overflow-x-auto  flex justify-center">
                            <table class="min-w-full table-auto" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">No</th>
                                        <th class="px-4 py-2">Nama Alternatif</th>
                                        <th class="px-4 py-2">C1</th>
                                        <th class="px-4 py-2">C2</th>
                                        <th class="px-4 py-2">C3</th>
                                        <th class="px-4 py-2">C4</th>
                                        <th class="px-4 py-2">Nilai S</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($nilaiS as $index => $alt)
                                        <tr class="text-center ">
                                            <td class="border px-4 py-2">{{ $loop->iteration }}</td>
                                            <td class="border px-4 py-2">{{ $alt['alternatif'] }}</td>
                                            @foreach ($alt['detail'] as $detail)
                                                <td class="border px-4 py-2">
                                                    {{ number_format($detail['nilai_kriteria'], 4) }}
                                                </td>
                                            @endforeach
                                            <td class="border px-4 py-2 font-bold">
                                                {{ number_format($alt['total_s'], 4) }}
                                            </td>
                                        </tr>

                                    @empty
                                        <td class="border px-2 py-1 text-center" colspan="7">Belum Ada Nilai S</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                    {{-- Nilai R --}}
                    <div class="mb-8 bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Nilai</span> R</h2>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60"
                                style="margin: 0 auto;height: 35px;" xml:space="preserve">
                                <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                                    style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                                <line x1="55.1" y1="30.4" x2="100" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                                <line x1="45.1" y1="30.4" x2="0" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                            </svg>
                        </header>
                        <div class="overflow-x-auto flex justify-center">
                            <table class="min-w-full table-auto" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-10 py-2">Nama Sepeda Motor</th>
                                        <th class="px-10 py-2">Nilai R</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($nilaiR as $index => $s)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $index + 1 }}</td>
                                            <td class="border px-10 py-2">{{ $s['alternatif'] }}</td>
                                            <td class="border px-10 py-2">{{ number_format($s['nilai_r'], 4) }}</td>
                                        </tr>
                                    @empty
                                        <td class="border px-2 py-1 text-center" colspan="3">Belum Ada Nilai R</td>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Nilai S dan R --}}
                    <div class="mb-8 bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100"><span
                                    class="font-light">Nilai</span> S & R</h2>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60"
                                style="margin: 0 auto;height: 35px;" xml:space="preserve">
                                <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                                    style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                                <line x1="55.1" y1="30.4" x2="100" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                                <line x1="45.1" y1="30.4" x2="0" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                            </svg>
                        </header>
                        <div class="overflow-x-auto flex justify-center">
                            <table class="min-w-full table-auto" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="px-10 py-2">S+</th>
                                        <th class="px-10 py-2">S-</th>
                                        <th class="px-10 py-2">R+</th>
                                        <th class="px-10 py-2">R-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        @if (
                                            $minMaxValues['sMax'] !== null &&
                                                $minMaxValues['sMin'] !== null &&
                                                $minMaxValues['rMax'] !== null &&
                                                $minMaxValues['rMin'] !== null)
                                            <td class="border px-10 py-2">
                                                {{ number_format($minMaxValues['sMax'], 4) }}
                                            </td>
                                            <td class="border px-10 py-2">
                                                {{ number_format($minMaxValues['sMin'], 4) }}
                                            </td>
                                            <td class="border px-10 py-2">
                                                {{ number_format($minMaxValues['rMax'], 4) }}
                                            </td>
                                            <td class="border px-10 py-2">
                                                {{ number_format($minMaxValues['rMin'], 4) }}
                                            </td>
                                        @else
                                            <td class="border px-2 py-1 text-center" colspan="4">Belum Ada Nilai S dan
                                                R MIN/MAX</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                    {{-- Perankingan --}}
                    <div class="mb-8 bg-gray-50 border-b border-gray-100 w-full p-12 wow fadeInUp" data-wow-duration="1s"
                        data-wow-delay=".5s">
                        <div class="mb-3 " style="display: flex; justify-content:right;">
                            @if (!empty($nilaiQ))
                                <a href="{{ route('cetak-pdf') }}"
                                    class="font-bold py-2 px-4 bg-blue-400 text-white rounded-full">
                                    Cetak Hasil
                                </a>
                            @endif
                        </div>
                        <header class="text-center mx-auto mb-2 lg:px-20">
                            <h2 class="text-2xl leading-normal mb-2 font-bold text-gray-800 dark:text-gray-100">
                                <span class="font-light">Hasil</span> Perhitungan
                            </h2>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 60"
                                style="margin: 0 auto;height: 35px;" xml:space="preserve">
                                <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                                    style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                                <line x1="55.1" y1="30.4" x2="100" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                                <line x1="45.1" y1="30.4" x2="0" y2="30.4"
                                    class="stroke-primary" style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                            </svg>
                        </header>

                        <div class="overflow-x-auto flex justify-center">
                            <table class="min-w-full table-auto" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-10 py-2">Nama Sepeda Motor</th>
                                        <th class="px-10 py-2">Nilai S</th>
                                        <th class="px-10 py-2">Nilai R</th>
                                        <th class="px-10 py-2">Nilai Q</th>
                                        <th class="px-10 py-2">Peringkat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($nilaiQ as $hasil)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-10 py-2">{{ $hasil['alternatif'] }}</td>
                                            <td class="border px-10 py-2">
                                                {{ number_format($nilaiS[array_search($hasil['alternatif'], array_column($nilaiS, 'alternatif'))]['total_s'], 4) }}
                                            </td>
                                            <td class="border px-10 py-2">
                                                {{ number_format($nilaiR[array_search($hasil['alternatif'], array_column($nilaiR, 'alternatif'))]['nilai_r'], 4) }}
                                            </td>
                                            <td class="border px-10 py-2">{{ number_format($hasil['nilai_q'], 4) }}</td>
                                            <td class="border px-10 py-2"><strong>{{ $hasil['rank'] }}</strong></td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td class="border px-2 py-1 text-center" colspan="6">Belum Ada Hasil
                                                Perhitungan</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Rekomendasi Terbaik -->
                    @if (!empty($nilaiQ))
                        <div role="alert" class="mt-5 mb-5">
                            <div
                                class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
                                <p class="font-bold">Rekomendasi Terbaik:</p>
                                <p>Berdasarkan analisis menggunakan metode VIKOR,
                                    <strong>{{ $nilaiQ[0]['alternatif'] }}</strong> menjadi pilihan terbaik dengan nilai
                                    indeks {{ number_format($nilaiQ[0]['nilai_q'], 4) }}. Sepeda motor ini merupakan
                                    rekomendasi utama untuk pembelian, mempertimbangkan berbagai kriteria yang telah
                                    ditetapkan.
                                </p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
