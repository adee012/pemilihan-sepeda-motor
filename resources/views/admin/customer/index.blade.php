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
                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-2 py-1">#</th>
                                    <th class="px-4 py-2">Nama</th>
                                    <th class="px-4 py-2">Username</th>
                                    <th class="px-4 py-2">Email</th>
                                    <th class="px-4 py-2">No Hp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customer as $cust)
                                    <tr class="text-center">
                                        <td class="border px-2 py-1">{{ $loop->iteration }}</td>
                                        <td class="border px-4 py-2">{{ $cust->name }}</td>
                                        <td class="border px-4 py-2">{{ $cust->username }}</td>
                                        <td class="border px-4 py-2">{{ $cust->email }}</td>
                                        <td class="border px-4 py-2">{{ $cust->no_tlp }}</td>
                                    </tr>

                                @empty
                                    <tr>
                                        <td colspan="8" class="border px-4 py-2 text-center">Data Customer Belum Ada
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
