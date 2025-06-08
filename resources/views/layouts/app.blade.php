<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="z-60 w-full" style="background: radial-gradient(circle, #F2A51A 0%, #EA6227 70%, #d35400 100%);">
        <div id="app">
            <header class="w-full z-100 text-sm ">
                <nav
                    class="relative max-w-8xl w-full flex flex-wrap items-center justify-between mx-auto z-100 py-4 px-12">
                    {{-- Logo Anda --}}
                    <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="{{ asset('storage/images/logo.png') }}" class="h-16 w-auto" alt="Logo" />
                        {{-- <span class="self-center text-2xl font-semibold whitespace-nowrap">Preline</span> --}}
                    </a>

                    {{-- Tombol Auth dan Menu Mobile (md:order-2) --}}
                    <div class="flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse z-100">
                        @guest
                            @if (Route::has('login'))
                                <div class="hidden sm:flex items-center">
                                    <div class="border-l border-orange-400 h-6 mx-2"></div>
                                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-yellow-400 hover:bg-yellow-500 text-slate-900"
                                        href="{{ route('login') }}">
                                        <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd">
                                            </path>
                                        </svg>
                                        {{ __('Log in') }}
                                    </a>
                                </div>
                            @endif
                            @if (Route::has('register'))
                                <div class="hidden sm:flex items-center ml-2">
                                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-indigo-900 hover:bg-indigo-950 text-white"
                                        href="{{ route('register') }}">
                                        {{ __('Sign up') }}
                                    </a>
                                </div>
                            @endif
                        @else
                            {{-- Dropdown Pengguna Menggunakan Struktur Flowbite --}}
                            {{-- Pastikan font Poppins sudah di-load melalui <head> atau tailwind.config.js --}}
                            <div class="relative" style="font-family: 'Poppins', sans-serif;">
                                {{-- 1. Tombol Pemicu (Trigger) --}}
                                <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                                    class="flex items-center text-lg pe-2 font-medium text-yellow-100 rounded-full hover:text-white md:me-0 focus:ring-2 focus:ring-yellow-300"
                                    type="button">
                                    <span class="sr-only">Open user menu</span>

                                    <img class="w-9 h-9 me-3 rounded-full"
                                        src="{{ Auth::user()->profile_photo_url ?? asset('storage/images/profile_fawwaz.jpg') }}"
                                        alt="user photo">

                                    <span class="text-lg">{{ Auth::user()->name }}</span>

                                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 4 4 4-4" />
                                    </svg>
                                </button>

                                {{-- 2. Panel Dropdown --}}
                                <div id="dropdownAvatarName"
                                    class="z-50 hidden bg-yellow-100 divide-y divide-yellow-200 rounded-lg shadow-lg w-56 border border-yellow-300">

                                    {{-- 3. Header Dropdown (Info Pengguna) --}}
                                    <div class="px-4 py-3 text-sm text-indigo-900">
                                        <div class="font-medium">{{ Auth::user()->name }}</div>
                                        <div class="truncate text-slate-500">{{ Auth::user()->email }}</div>
                                    </div>

                                    {{-- 4. Item Menu --}}
                                    <ul class="py-2 text-sm text-indigo-900" aria-labelledby="dropdownAvatarNameButton">
                                        <li>
                                            <a href="#"
                                                class="flex items-center gap-x-2 px-4 py-2 hover:bg-yellow-200 transition-colors">
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                                    <circle cx="12" cy="7" r="4" />
                                                </svg>
                                                Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="flex items-center gap-x-2 px-4 py-2 hover:bg-yellow-200 transition-colors">
                                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                                    <circle cx="12" cy="12" r="3" />
                                                </svg>
                                                Settings
                                            </a>
                                        </li>
                                    </ul>

                                    {{-- 5. Link Logout --}}
                                    <div class="py-1">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="flex items-center gap-x-2 px-4 py-2 text-sm text-red-700 hover:bg-red-100 hover:text-red-800 transition-colors">
                                            <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                                <polyline points="16,17 21,12 16,7" />
                                                <line x1="21" x2="9" y1="12" y2="12" />
                                            </svg>
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="hidden">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endguest

                        {{-- Tombol Hamburger untuk Mobile (Menggunakan atribut Flowbite) --}}
                        <button data-collapse-toggle="navbar-default-menu" type="button"
                            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-orange-200 hover:bg-orange-500 focus:ring-orange-400"
                            aria-controls="navbar-default-menu" aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 17 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                            </svg>
                        </button>
                    </div>

                    {{-- Menu Utama (md:order-1) Menggunakan atribut Flowbite untuk collapse --}}
                    <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 z-100"
                        id="navbar-default-menu">
                        <div
                            class="flex flex-col gap-y-4 p-4 md:p-0 mt-4 md:flex-row md:items-center md:justify-center md:gap-y-0 md:gap-x-4 md:mt-0 w-full md:border-0">
                            <div>
                                <a class="font-semibold text-slate-950 bg-amber-400 py-2 px-4 rounded-lg inline-flex items-center gap-x-2 relative before:absolute before:bottom-0.5 before:start-0 before:-z-1 before:w-full before:h-1"
                                    href="/" aria-current="page">
                                    <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                        </path>
                                    </svg>
                                    Home
                                </a>
                            </div>
                            <div>
                                <a class="font-semibold text-stone-200 bg-amber-400 hover:bg-amber-500 py-2 px-4 rounded-lg inline-flex items-center gap-x-2"
                                    href="{{ url('/pomotime') }}">
                                    <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    PomoTime
                                </a>
                            </div>
                            <div>
                                <a class="font-semibold text-stone-200 bg-amber-400 hover:bg-amber-500 py-2 px-4 rounded-lg inline-flex items-center gap-x-2"
                                    href="#">
                                    <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" class="bi bi-book-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                                    </svg>
                                    Guide
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <main class="pt-4">
                @yield('content')
            </main>
            {{-- FOOTER BARU DISESUAIKAN UNTUK POMOCAT --}}
            <footer class="w-full text-white mb-[-100px]">
                {{-- Bagian Utama Footer - Warna Oranye --}}
                <div style="background-color: #D65A1F;"> {{-- Atau #F2A51A, atau gradien jika diinginkan --}}
                    <div class="mx-auto w-full max-w-screen-5xl p-10 px-12 pt-6 lg:pt-8">
                        <div class="md:flex md:justify-between">
                            <div class="mb-0 md:mb-0">
                                <a href="{{ url('/') }}" class="flex items-center">
                                    <img src="{{ asset('storage/images/logo_white.png') }}" class="h-16 me-3"
                                        alt="PomoCat Logo" />
                                    <span class="self-center text-3xl whitespace-nowrap"
                                        style="font-family: 'Baloo Bhaijaan 2', cursive; font-weight: 800;">PomoCat</span>
                                </a>
                            </div>
                            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                                <div>
                                    <h2 class="mb-6 text-sm font-semibold text-gray-100 uppercase"
                                        style="font-family: 'Poppins', sans-serif;">Sumber Daya</h2>
                                    <ul class="text-gray-300 font-medium"> {{-- Warna teks link sedikit lebih terang --}}
                                        <li class="mb-4">
                                            <a href="#" class="hover:underline hover:text-orange-300"
                                                style="font-family: 'Poppins', sans-serif;">Blog</a>
                                        </li>
                                        <li>
                                            <a href="#faq-section" class="hover:underline hover:text-orange-300"
                                                style="font-family: 'Poppins', sans-serif;">FAQs</a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h2 class="mb-6 text-sm font-semibold text-gray-100 uppercase"
                                        style="font-family: 'Poppins', sans-serif;">Ikuti Kami</h2>
                                    <ul class="text-gray-300 font-medium">
                                        <li class="mb-4">
                                            <a href="https://www.github.com/Fawwzrf"
                                                class="hover:underline hover:text-orange-300"
                                                style="font-family: 'Poppins', sans-serif;">Github</a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/fawwzrf._?igsh=ZTRicHZqYzlnOGw2"
                                                class="hover:underline hover:text-orange-300"
                                                style="font-family: 'Poppins', sans-serif;">Instagram</a>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <h2 class="mb-6 text-sm font-semibold text-gray-100 uppercase"
                                        style="font-family: 'Poppins', sans-serif;">Legal</h2>
                                    <ul class="text-gray-300 font-medium">
                                        <li class="mb-4">
                                            <a href="#" class="hover:underline hover:text-orange-300"
                                                style="font-family: 'Poppins', sans-serif;">Kebijakan Privasi</a>
                                        </li>
                                        <li>
                                            <a href="#" class="hover:underline hover:text-orange-300"
                                                style="font-family: 'Poppins', sans-serif;">Syarat & Ketentuan</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <hr class="my-6 border-orange-400/50 sm:mx-auto lg:my-8" /> {{-- Warna border disesuaikan --}}
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <span class="text-sm text-gray-300 sm:text-center"
                                style="font-family: 'Poppins', sans-serif;">© {{ date('Y') }} <a
                                    href="{{ url('/') }}"
                                    class="hover:underline hover:text-orange-300">PomoCat™</a>. Hak Cipta Dilindungi.
                            </span>
                            <div class="flex mt-4 sm:justify-center sm:mt-0 space-x-5 rtl:space-x-reverse">
                                {{-- Ikon media sosial disesuaikan warnanya --}}
                                <a href="https://www.instagram.com/fawwzrf._?igsh=ZTRicHZqYzlnOGw2"
                                    class="text-gray-300 hover:text-orange-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor"
                                        width="20" height="20" viewBox="0 0 50 50">
                                        <path
                                            d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z">
                                        </path>
                                    </svg>
                                    <span class="sr-only">Instagram page</span>
                                </a>
                                <a href="https://www.github.com/Fawwzrf" class="text-gray-300 hover:text-orange-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                        height="20" viewBox="0,0,256,256">
                                        <g fill="currentColor" fill-rule="nonzero" stroke="none" stroke-width="1"
                                            stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                            stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                            font-weight="none" font-size="none" text-anchor="none"
                                            style="mix-blend-mode: normal">
                                            <g transform="scale(5.12,5.12)">
                                                <path
                                                    d="M17.791,46.836c0.711,-0.306 1.209,-1.013 1.209,-1.836v-5.4c0,-0.197 0.016,-0.402 0.041,-0.61c-0.014,0.004 -0.027,0.007 -0.041,0.01c0,0 -3,0 -3.6,0c-1.5,0 -2.8,-0.6 -3.4,-1.8c-0.7,-1.3 -1,-3.5 -2.8,-4.7c-0.3,-0.2 -0.1,-0.5 0.5,-0.5c0.6,0.1 1.9,0.9 2.7,2c0.9,1.1 1.8,2 3.4,2c2.487,0 3.82,-0.125 4.622,-0.555c0.934,-1.389 2.227,-2.445 3.578,-2.445v-0.025c-5.668,-0.182 -9.289,-2.066 -10.975,-4.975c-3.665,0.042 -6.856,0.405 -8.677,0.707c-0.058,-0.327 -0.108,-0.656 -0.151,-0.987c1.797,-0.296 4.843,-0.647 8.345,-0.714c-0.112,-0.276 -0.209,-0.559 -0.291,-0.849c-3.511,-0.178 -6.541,-0.039 -8.187,0.097c-0.02,-0.332 -0.047,-0.663 -0.051,-0.999c1.649,-0.135 4.597,-0.27 8.018,-0.111c-0.079,-0.5 -0.13,-1.011 -0.13,-1.543c0,-1.7 0.6,-3.5 1.7,-5c-0.5,-1.7 -1.2,-5.3 0.2,-6.6c2.7,0 4.6,1.3 5.5,2.1c1.699,-0.701 3.599,-1.101 5.699,-1.101c2.1,0 4,0.4 5.6,1.1c0.9,-0.8 2.8,-2.1 5.5,-2.1c1.5,1.4 0.7,5 0.2,6.6c1.1,1.5 1.7,3.2 1.6,5c0,0.484 -0.045,0.951 -0.11,1.409c3.499,-0.172 6.527,-0.034 8.204,0.102c-0.002,0.337 -0.033,0.666 -0.051,0.999c-1.671,-0.138 -4.775,-0.28 -8.359,-0.089c-0.089,0.336 -0.197,0.663 -0.325,0.98c3.546,0.046 6.665,0.389 8.548,0.689c-0.043,0.332 -0.093,0.661 -0.151,0.987c-1.912,-0.306 -5.171,-0.664 -8.879,-0.682c-1.665,2.878 -5.22,4.755 -10.777,4.974v0.031c2.6,0 5,3.9 5,6.6v5.4c0,0.823 0.498,1.53 1.209,1.836c9.161,-3.032 15.791,-11.672 15.791,-21.836c0,-12.682 -10.317,-23 -23,-23c-12.683,0 -23,10.318 -23,23c0,10.164 6.63,18.804 15.791,21.836z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="sr-only">GitHub account</span>
                                </a>
                                <a href="https://www.linkedin.com/in/fawwazrf"
                                    class="text-gray-300 hover:text-orange-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20"
                                        height="20" viewBox="0,0,256,256">
                                        <g fill="currentColor" fill-rule="nonzero" stroke="none" stroke-width="1"
                                            stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10"
                                            stroke-dasharray="" stroke-dashoffset="0" font-family="none"
                                            font-weight="none" font-size="none" text-anchor="none"
                                            style="mix-blend-mode: normal">
                                            <g transform="scale(5.12,5.12)">
                                                <path
                                                    d="M41,4h-32c-2.76,0 -5,2.24 -5,5v32c0,2.76 2.24,5 5,5h32c2.76,0 5,-2.24 5,-5v-32c0,-2.76 -2.24,-5 -5,-5zM17,20v19h-6v-19zM11,14.47c0,-1.4 1.2,-2.47 3,-2.47c1.8,0 2.93,1.07 3,2.47c0,1.4 -1.12,2.53 -3,2.53c-1.8,0 -3,-1.13 -3,-2.53zM39,39h-6c0,0 0,-9.26 0,-10c0,-2 -1,-4 -3.5,-4.04h-0.08c-2.42,0 -3.42,2.06 -3.42,4.04c0,0.91 0,10 0,10h-6v-19h6v2.56c0,0 1.93,-2.56 5.81,-2.56c3.97,0 7.19,2.73 7.19,8.26z">
                                                </path>
                                            </g>
                                        </g>
                                    </svg>
                                    <span class="sr-only">LinkedIn account</span>
                                </a>
                            </div>
                        </div>
                    </div>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
        @stack('scripts')
</body>

</html>
