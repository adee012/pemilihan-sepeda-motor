<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Data Motor') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-3 flex items-center justify-end">
                        <a href="{{ route('tambah-motor') }}"
                            class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                            Tambahkan Data Motor
                        </a>
                    </div>


                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-2 py-1">#</th>
                                    <th class="px-4 py-2">Motor</th>
                                    <th class="px-4 py-2">Harga</th>
                                    <th class="px-4 py-2">Kondisi</th>
                                    <th class="px-4 py-2">Jarak</th>
                                    <th class="px-4 py-2">Tahun</th>
                                    <th class="px-4 py-2">Spesifikasi</th>
                                    <th class="px-4 py-2">Gambar</th>
                                    <th class="px-4 py-2">Aksi</th>
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
                                        <td class="border px-4 py-2">{{ $motor->spesifikasi }}</td>
                                        <td class="border px-4 py-2">
                                            <img width="100px" height="100px" class="rounded"
                                                src="{{ asset('storage/gambar_motor') }}/{{ $motor->gambar }}">
                                        </td>
                                        <td class="border px-4 py-2">
                                            <a href="{{ route('update-data-motor') }}/{{ $motor->id }}"
                                                class="text-indigo-600">Edit</a> |
                                            <a href="#"
                                                onclick="event.preventDefault(); if (confirm('Apakah Anda Yakin Ingin Menghapus Data Motor ?')) { document.getElementById('delete-form-{{ $motor->id }}').submit(); }"
                                                class="text-red-600">Delete</a>
                                            <form id="delete-form-{{ $motor->id }}"
                                                action="{{ route('delete-motor', $motor->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="8" class="border px-4 py-2 text-center">Data Motor Belum Ada
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
