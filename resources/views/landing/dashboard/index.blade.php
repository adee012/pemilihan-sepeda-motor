@extends('welcome')
@section('content')
    <div id="hero" class="section relative z-0 py-16 md:pt-32 md:pb-20 bg-gray-50">
        <div class="container xl:max-w-6xl mx-auto px-4">
            <div class="flex flex-wrap flex-row -mx-4 justify-center">

                <div class="flex-shrink max-w-full px-4 sm:px-12 lg:px-18 w-full sm:w-9/12 lg:w-1/2 self-center">
                    <img src="{{ asset('assets/src/img/dummy/leasing.jpg') }}" class="w-full max-w-full h-auto"
                        alt="creative agency">
                </div>


                <div class="flex-shrink max-w-full px-4 w-full md:w-9/12 lg:w-1/2 self-center lg:pr-12">
                    <div class="text-center lg:text-left mt-6 lg:mt-0">
                        <div class="mb-12">
                            <h1 class="text-4xl leading-normal text-black font-bold mb-4">Mau jual atau beli? bisa!!!
                            </h1>
                            <p class="text-gray-500 leading-relaxed font-light text-xl mx-auto pb-2">Tukar tambah juga
                                bisa!! Motor harga standar kualitas teratas.</p>
                        </div>
                        <a class="py-2.5 px-10 inline-block text-center leading-normal text-gray-900 bg-white border-b border-gray-100 hover:text-black hover:ring-0 focus:outline-none focus:ring-0 mr-4"
                            href="https://www.google.com/maps?q=Jogya+Motor+jual+beli+motor+bekas+berkualitas"
                            target="_blank">
                            <span style="display: inline-block; vertical-align: middle;">
                                <img src="{{ asset('assets/src/img/dummy/icons8-location-100.png') }}"
                                    style="width: 20px; margin-right: 5px;" alt="">
                            </span>
                            <span style="display: inline-block; vertical-align: middle;">
                                Lokasi
                            </span>
                        </a>

                        <a class="py-2.5 px-10 inline-block text-center leading-normal text-gray-100 bg-black border-b border-gray-800 hover:text-white hover:ring-0 focus:outline-none focus:ring-0"
                            target="_blank" href="https://wa.link/g8203p">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5rem" height="1.5rem" class="inline-block mr-1"
                                fill="currentColor" viewBox="0 0 512 512">
                                <rect x="48" y="96" width="416" height="320" rx="40" ry="40"
                                    style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                                <polyline points="112 160 256 272 400 160"
                                    style="fill:none;stroke:currentColor;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" />
                            </svg>
                            Hubungi Admin
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
