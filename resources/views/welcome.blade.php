<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title  -->
    <title>Jogya Motor</title>
    <meta name="description">

    <!-- Development css -->
    <link rel="stylesheet" href="{{ asset('assets/src/css/style.css') }}">

    <!-- Production css -->
    <!-- <link rel="stylesheet" href="dist/css/style.css"> -->

    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;500;700&amp;display=swap"
        rel="stylesheet">

    <!-- Favicon  -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/src/img/icon.png') }}">
</head>

<body class="text-gray-700">
    <!-- preloader -->
    <div class="preloader loaded-success fixed inset-0 z-50 bg-gray-50">
        <div class="absolute left-1/2 top-1/2 transform -translate-y-1/2">
            <div class="relative mx-auto my-12">
                <div class="inline-block">
                    <svg class="animate-spin h-8 w-8 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== { HEADER }==========  -->
    <header class="fixed top-0 left-0 right-0 z-40">
        <nav class="main-nav">
            <div class="container xl:max-w-6xl mx-auto px-4">
                <div class="lg:flex lg:justify-between">
                    <div class="flex justify-between">
                        <div class="mx-w-10 text-3xl font-bold capitalize text-gray-900 flex items-center">Jogya Motor
                        </div>
                        <!-- mobile nav -->
                        <div class="flex flex-row items-center py-4 lg:py-0">
                            <div class="relative text-gray-900 hover:text-black block lg:hidden">
                                <button type="button"
                                    class="menu-mobile block py-3 px-6 border-b-2 border-transparent">
                                    <span class="sr-only">Mobile menu</span>
                                    <svg class="open h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="close bi bi-x-lg h-8 w-8" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                                        <path fill-rule="evenodd"
                                            d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-row">
                        <!-- nav menu -->
                        <ul
                            class="navbar bg-white lg:bg-transparent w-full hidden text-center lg:text-left lg:flex lg:flex-row text-gray-900 text-sm items-center font-bold">
                            <li class="relative hover:text-black">
                                <a class="block py-3 lg:py-7 px-6 border-b-2 border-transparent {{ request()->is('/') ? 'active' : '' }}"
                                    href="{{ url('/') }}">Home</a>
                            </li>

                            @if (Route::has('login'))
                                @auth
                                    <li class="relative hover:text-black">
                                        <a class="block py-3 lg:py-7 px-6 border-b-2 border-transparent {{ request()->routeIs('datas-motor') ? 'active' : '' }}"
                                            href="{{ route('datas-motor') }}">Spesifikasi Motor</a>
                                    </li>
                                    <li class="relative hover:text-black">
                                        <a class="block py-3 lg:py-7 px-6 border-b-2 border-transparent {{ request()->routeIs('perhitungan') ? 'active' : '' }}"
                                            href="{{ route('perhitungan') }}">Rekomendasi Motor</a>
                                    </li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li class="relative">
                                            <button class="bg-blue-400 text-white px-4 py-2 rounded">Logout
                                            </button>
                                        </li>
                                    </form>
                                @else
                                    <li class="relative">
                                        <button class="bg-blue-400 text-white px-4 py-2 rounded">
                                            <a href="{{ route('login') }}"
                                                class="block border-b-2 border-transparent">Login</a>
                                        </button>
                                    </li>
                                @endauth
                            @endif
                        </ul>

                    </div>
                </div>
            </div>
        </nav>
    </header><!-- end header -->

    <!-- =========={ MAIN }==========  -->
    <main id="content" style="margin-top: 5rem">
        @yield('content')
    </main><!-- end main -->


    <!-- =========={ SCROLL TO TOP }==========  -->
    <a href="#"
        class="back-top fixed p-4 rounded bg-gray-100 border border-gray-100 text-gray-500 dark:bg-gray-900 dark:border-gray-800 right-4 bottom-4 hidden"
        aria-label="Scroll To Top">
        <svg width="1rem" height="1rem" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M8 3.5a.5.5 0 01.5.5v9a.5.5 0 01-1 0V4a.5.5 0 01.5-.5z" clip-rule="evenodd">
            </path>
            <path fill-rule="evenodd"
                d="M7.646 2.646a.5.5 0 01.708 0l3 3a.5.5 0 01-.708.708L8 3.707 5.354 6.354a.5.5 0 11-.708-.708l3-3z"
                clip-rule="evenodd"></path>
        </svg>
    </a>

    <!--Vendor js-->
    <script src="{{ asset('assets/src/vendors/glightbox/dist/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/src/vendors/@splidejs/splide/dist/js/splide.min.js') }}"></script>
    <script src="{{ asset('assets/src/vendors/typed.js/lib/typed.min.js') }}"></script>
    <script src="{{ asset('assets/src/vendors/wow.js/dist/wow.min.js') }}"></script>
    <script src="{{ asset('assets/src/vendors/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>

    <!-- Start development js -->
    <script src="{{ asset('assets/src/js/theme.js') }}"></script>
    <!-- End development js -->

    <!-- Production js -->
    <!-- <script src="dist/js/scripts.js"></script> -->

    <script>
        function closeFlashMessage() {
            document.getElementById('flash-message').style.display = 'none';
        }
    </script>
</body>

</html>
