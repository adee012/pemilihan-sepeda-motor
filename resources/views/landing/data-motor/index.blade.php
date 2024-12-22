@extends('welcome')
@section('content')
    <div id="datas-motor" class="section relative z-0 py-12 md:py-16 bg-white">
        <div class="container xl:max-w-6xl mx-auto px-4">

            <header class="text-center mx-auto mb-12 lg:px-20">
                <h2 class="text-2xl leading-normal mb-2 font-bold text-black">Data Motor</h2>
                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                    y="0px" viewBox="0 0 100 60" style="margin: 0 auto;height: 35px;" xml:space="preserve">
                    <circle cx="50.1" cy="30.4" r="5" class="stroke-primary"
                        style="fill: transparent;stroke-width: 2;stroke-miterlimit: 10;"></circle>
                    <line x1="55.1" y1="30.4" x2="100" y2="30.4" class="stroke-primary"
                        style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                    <line x1="45.1" y1="30.4" x2="0" y2="30.4" class="stroke-primary"
                        style="stroke-width: 2;stroke-miterlimit: 10;"></line>
                </svg>
                <p class="text-gray-500 leading-relaxed font-light text-xl mx-auto pb-2">Cash atau kredit siap kami bantu.
                </p>
            </header>
        </div>

        <div class="flex justify-start " style="margin: 0 28px">
            <form method="GET" action="{{ url()->current() }}" class="mb-6 text-center">
                <select name="filter" class="border border-grey-700 rounded px-4 py-2 text-black " style="width: 340px">
                    <Option value="" disabled selected>Pilih Merk Motor</Option>
                    <option value="All" {{ request('filter') == 'All' ? 'selected' : '' }}>Semua Motor</option>
                    @foreach ($namaMotors as $namaMotor)
                        <option value="{{ $namaMotor }}" {{ request('filter') == $namaMotor ? 'selected' : '' }}>
                            {{ $namaMotor }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded">Filter</button>
            </form>
        </div>

        <div class="flex flex-wrap flex-row px-4">
            @forelse ($motors as $motor)
                <figure class="flex-shrink max-w-full px-3 w-full sm:w-1/2 lg:w-1/3 group wow fadeInUp"
                    data-wow-duration="1s">
                    <div class="relative overflow-hidden cursor-pointer mb-6">
                        <a href="{{ asset('storage/gambar_motor') }}/{{ $motor->gambar }}" data-gallery="gallery1"
                            data-glightbox="title: {{ $motor->nama_sepeda_motor }}; description:  <b>Kondisi</b> : {{ $motor->kondisi }}, <b>Jarak Tempuh</b> : {{ $motor->jarak }} Km, <b>Tahun Keluaran</b> : {{ $motor->tahun }} <br> <br> <b>Spesifikasi</b> : {{ $motor->spesifikasi }}"
                            class="glightbox3">
                            <img class="block w-full h-auto transform duration-500 grayscale hover:scale-125"
                                src="{{ asset('storage/gambar_motor') }}/{{ $motor->gambar }}" alt="Image Description">
                            <div
                                class="absolute inset-x-0 bottom-0 h-20 transition-opacity duration-500 ease-in opacity-0 group-hover:opacity-100 overflow-hidden px-4 py-2 text-gray-100 bg-black text-center">
                                <h3 class="text-base leading-normal font-semibold my-1 text-white">
                                    {{ $motor->nama_sepeda_motor }}</h3>
                                <small class="d-block">Rp {{ number_format($motor->harga) }}</small>
                            </div>
                        </a>
                    </div>
                </figure>
            @empty
                <h1 class="text-center">Data Motor Tidak Ditemukan</h1>
            @endforelse

        </div>
    </div>
@endsection
