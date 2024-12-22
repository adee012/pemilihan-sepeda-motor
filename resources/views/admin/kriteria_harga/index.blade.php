<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kriteria') }}
            </h2>

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                @if (session('success'))
                    <div id="flash-message"
                        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-3"
                        role="alert">
                        <strong class="font-bold">{{ session('success') }}</strong>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="closeFlashMessage()">
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

                {{-- Bobot Kriteria --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 ">
                        <div class="mb-3 flex items-center justify-between">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Data Kriteria') }}
                            </h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-4 py-2">Kode Kriteria</th>
                                        <th class="px-4 py-2">Nama Kriteria</th>
                                        <th class="px-4 py-2">Bobot</th>
                                        <th class="px-4 py-2">Normalisasi</th>
                                        <th class="px-4 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kriteria as $krt)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-4 py-2">{{ $krt->kode_kriteria }}</td>
                                            <td class="border px-4 py-2">{{ $krt->nama_kriteria }}</td>
                                            <td class="border px-4 py-2">{{ $krt->bobot }}</td>
                                            <td class="border px-4 py-2">{{ (float) $krt->bobot / $totalBobot }}</td>
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('update-data-kriteria') }}/{{ $krt->id }}"
                                                    class="text-indigo-600">Edit</a>
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

                {{-- Kriteria Harga --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 ">
                        <div class="mb-3 flex items-center justify-between">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Kriteria Harga') }}
                            </h2>
                            <a href="{{ route('kriteria-harga') }}"
                                class=" font-bold py-2 px-4 bg-indigo-700 text-white rounded-full ">
                                Tambahkan Kriteria Harga
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-4 py-2">Harga</th>
                                        <th class="px-4 py-2">Keterangan</th>
                                        <th class="px-4 py-2">Nilai</th>
                                        <th class="px-4 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($harga as $h)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-4 py-2">{{ $h->harga }}</td>
                                            <td class="border px-4 py-2">{{ $h->keterangan }}</td>
                                            <td class="border px-4 py-2">{{ $h->nilai }}</td>
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('update-kriteria-harga') }}/{{ $h->id }}"
                                                    class="text-indigo-600">Edit</a> |
                                                <a href="#"
                                                    onclick="event.preventDefault(); if (confirm('Apakah Anda Yakin Ingin Menghapus Kriteria Harga ?')) { document.getElementById('delete-form-{{ $h->id }}').submit(); }"
                                                    class="text-red-600">Delete</a>
                                                <form id="delete-form-{{ $h->id }}"
                                                    action="{{ route('delete-kriteria-harga', $h->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
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

                {{-- Kriteria Kondisi --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 ">
                        <div class="mb-3 flex items-center justify-between">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Kriteria Kondisi') }}
                            </h2>
                            <a href="{{ route('kriteria-kondisi') }}"
                                class=" font-bold py-2 px-4 bg-indigo-700 text-white rounded-full ">
                                Tambahkan Kriteria Kondisi
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-4 py-2">Kondisi</th>
                                        <th class="px-4 py-2">Keterangan</th>
                                        <th class="px-4 py-2">Nilai</th>
                                        <th class="px-4 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kondisi as $k)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-4 py-2">{{ $k->kondisi }}</td>
                                            <td class="border px-4 py-2">{{ $k->keterangan }}</td>
                                            <td class="border px-4 py-2">{{ $k->nilai }}</td>
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('update-kriteria-kondisi') }}/{{ $k->id }}"
                                                    class="text-indigo-600">Edit</a> |
                                                <a href="#"
                                                    onclick="event.preventDefault(); if (confirm('Apakah Anda Yakin Ingin Menghapus Kriteria Kondisi ?')) { document.getElementById('delete-form-{{ $k->id }}').submit(); }"
                                                    class="text-red-600">Delete</a>
                                                <form id="delete-form-{{ $k->id }}"
                                                    action="{{ route('delete-kriteria-kondisi', $k->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td class="border px-4 py-2 text-center" colspan="5">Kriteria Kondisi
                                                Belum
                                                Ada
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Kriteria Jarak --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 ">
                        <div class="mb-3 flex items-center justify-between">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Kriteria Jarak') }}
                            </h2>
                            <a href="{{ route('kriteria-jarak') }}"
                                class=" font-bold py-2 px-4 bg-indigo-700 text-white rounded-full ">
                                Tambahkan Kriteria Jarak
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-4 py-2">Jarak</th>
                                        <th class="px-4 py-2">Keterangan</th>
                                        <th class="px-4 py-2">Nilai</th>
                                        <th class="px-4 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jarak as $j)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-4 py-2"> {{ $j->jarak }}</td>
                                            <td class="border px-4 py-2">{{ $j->keterangan }}</td>
                                            <td class="border px-4 py-2">{{ $j->nilai }}</td>
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('update-kriteria-jarak') }}/{{ $j->id }}"
                                                    class="text-indigo-600">Edit</a> |
                                                <a href="#"
                                                    onclick="event.preventDefault(); if (confirm('Apakah Anda Yakin Ingin Menghapus Kriteria Jarak ?')) { document.getElementById('delete-form-{{ $j->id }}').submit(); }"
                                                    class="text-red-600">Delete</a>
                                                <form id="delete-form-{{ $j->id }}"
                                                    action="{{ route('delete-kriteria-jarak', $j->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td class="border px-4 py-2 text-center" colspan="5">Kriteria Jarak
                                                Belum
                                                Ada
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Kriteria Tahun --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                    <div class="p-6 text-gray-900 ">
                        <div class="mb-3 flex items-center justify-between">
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ __('Kriteria Tahun') }}
                            </h2>
                            <a href="{{ route('kriteria-tahun') }}"
                                class=" font-bold py-2 px-4 bg-indigo-700 text-white rounded-full ">
                                Tambahkan Kriteria Tahun
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto">
                                <thead>
                                    <tr>
                                        <th class="px-2 py-1">#</th>
                                        <th class="px-4 py-2">Tahun</th>
                                        <th class="px-4 py-2">Keterangan</th>
                                        <th class="px-4 py-2">Nilai</th>
                                        <th class="px-4 py-2">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tahun as $t)
                                        <tr class="text-center">
                                            <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                            <td class="border px-4 py-2"> {{ $t->tahun }}</td>
                                            <td class="border px-4 py-2">{{ $t->keterangan }}</td>
                                            <td class="border px-4 py-2">{{ $t->nilai }}</td>
                                            <td class="border px-4 py-2">
                                                <a href="{{ route('update-kriteria-tahun') }}/{{ $t->id }}"
                                                    class="text-indigo-600">Edit</a> |
                                                <a href="#"
                                                    onclick="event.preventDefault(); if (confirm('Apakah Anda Yakin Ingin Menghapus Kriteria Tahun ?')) { document.getElementById('delete-form-{{ $t->id }}').submit(); }"
                                                    class="text-red-600">Delete</a>
                                                <form id="delete-form-{{ $t->id }}"
                                                    action="{{ route('delete-kriteria-tahun', $t->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td class="border px-4 py-2 text-center" colspan="5">Kriteria Tahun
                                                Belum
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
</x-app-layout>
