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
</head>

<body style="background: radial-gradient(circle,#F2A51A, #EA6227);">
    <div id="app">
        <header class="w-full z-100 text-sm py-3 ">
            <nav class="relative max-w-7xl w-full flex flex-wrap items-center justify-between mx-auto z-100 p-4">
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
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd"></path>
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
                        <div class="relative z-100">
                            <button type="button"
                                class="flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-indigo-900 hover:bg-indigo-950 text-neutral-50 focus:outline-none py-2 px-3"
                                id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                                data-dropdown-placement="bottom-end" data-dropdown-offset-distance="8" {{-- Jarak vertikal dari tombol --}}
                                data-dropdown-offset-skidding="-4"> {{-- Menggeser 4px ke kiri dari posisi rata kanan --}}
                                <span class="sr-only">Open user menu</span>
                                {{ Auth::user()->name }}
                                <svg class="w-4 h-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                            <div class="z-[60] hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-md w-56 min-w-[15rem] p-2 border border-gray-200"
                                id="user-dropdown">
                                <div class="px-4 py-3">
                                    <span class="block text-sm text-gray-900">{{ Auth::user()->name }}</span>
                                    <span class="block text-sm text-gray-500 truncate">{{ Auth::user()->email }}</span>
                                </div>
                                <ul class="py-1" aria-labelledby="user-menu-button">
                                    <li>
                                        <a href="#"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
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
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
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
                                    <li>
                                        <div class="border-t border-gray-200 my-1 mx-2"></div>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 focus:outline-none focus:bg-red-50">
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
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endguest

                    {{-- Tombol Hamburger untuk Mobile (Menggunakan atribut Flowbite) --}}
                    <button data-collapse-toggle="navbar-default-menu" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm rounded-lg md:hidden focus:outline-none focus:ring-2 text-orange-200 hover:bg-orange-500 focus:ring-orange-400"
                        aria-controls="navbar-default-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
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
                                href="#" aria-current="page">
                                <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                    </path>
                                </svg>
                                Home
                            </a>
                        </div>
                        <div>
                            <a class="font-semibold text-stone-200 bg-amber-400 hover:bg-amber-500 py-2 px-4 rounded-lg inline-flex items-center gap-x-2"
                                href="#">
                                <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
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
                                <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V8a2 2 0 00-2-2h-5L9 4H4zm4.707 6.707a1 1 0 00-1.414-1.414L6 10.586V8a1 1 0 00-2 0v4a1 1 0 001 1h4a1 1 0 000-2H7.414l1.293-1.293z">
                                    </path>
                                </svg>
                                Report
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>

</html>
