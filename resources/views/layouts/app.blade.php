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

<body style="background: radial-gradient(circle, #F2A51A 0%, #EA6227 70%, #d35400 100%);"
data-spy="scroll" data-target="#guide-nav" data-offset="120">
    <div class="z-60 w-full" style="background: radial-gradient(circle, #F2A51A 0%, #EA6227 70%, #d35400 100%);">
        <div id="app">
            <header class="w-full z-50 text-sm py-2">
                <nav class="relative max-w-7xl w-full flex items-center justify-between mx-auto px-4 sm:px-6 lg:px-8">
                    {{-- Logo --}}
                    <a href="{{ url('/') }}" class="flex-none">
                        <img src="{{ asset('storage/images/logo.png') }}" class="h-14 w-auto" alt="Logo" />
                    </a>

                    {{-- Menu Utama & Tombol Auth (Desktop) --}}
                    <div class="hidden md:flex items-center gap-x-2">
                        {{-- PERUBAHAN: Link 'Profil' dihapus dari sini --}}
                        <a class="font-semibold py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('home') ? 'bg-yellow-400 text-indigo-950' : 'text-yellow-100 hover:bg-yellow-500/20' }}"
                            href="{{ route('home') }}">Home</a>
                        <a class="font-semibold py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('pomotime') ? 'bg-yellow-400 text-indigo-950' : 'text-yellow-100 hover:bg-yellow-500/20' }}"
                            href="{{ route('pomotime') }}">PomoTime</a>
                        <a class="font-semibold py-2 px-3 rounded-lg transition-colors {{ request()->routeIs('guide') ? 'bg-yellow-400 text-indigo-950' : 'text-yellow-100 hover:bg-yellow-500/20' }}"
                            href="{{ route('guide') }}">Guide</a>

                        @guest
                            <div class="border-l border-orange-400 h-6 mx-2"></div>
                            @if (Route::has('login'))
                                <a class="font-semibold text-yellow-100 hover:text-white" href="{{ route('login') }}">Log
                                    in</a>
                            @endif
                            @if (Route::has('register'))
                                <a class="font-semibold text-yellow-100 bg-indigo-900 hover:bg-indigo-950 mx-2 py-2 px-4 rounded-lg"
                                    href="{{ route('register') }}">Sign up</a>
                            @endif
                        @else
                            {{-- Dropdown Pengguna --}}
                            <div class="relative ms-4">
                                <button id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName"
                                    class="flex items-center gap-x-2 font-medium text-yellow-100 hover:text-white"
                                    type="button">
                                    <img class="w-8 h-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : 'https://img.icons8.com/fluency/96/user-male-circle.png' }}"
                                        alt="user photo">
                                </button>
                                <div id="dropdownAvatarName"
                                    class="z-10 hidden bg-yellow-100 divide-y divide-yellow-200 rounded-lg shadow w-52">
                                    <div class="px-4 py-3 text-sm text-indigo-900">
                                        <div class="font-medium truncate">{{ Auth::user()->name }}</div>
                                        <div class="truncate text-slate-500">{{ Auth::user()->email }}</div>
                                    </div>
                                    {{-- PERUBAHAN: Link 'Profil' dikembalikan ke dalam dropdown --}}
                                    <ul class="py-2 text-sm text-indigo-900" aria-labelledby="dropdownAvatarNameButton">
                                        <li><a href="{{ route('profile.edit') }}"
                                                class="flex items-center gap-x-2 px-4 py-2 hover:bg-yellow-200">Profile</a>
                                        </li>
                                    </ul>
                                    <div class="py-1">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="flex items-center gap-x-2 px-4 py-2 text-sm text-red-700 hover:bg-red-100">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="hidden">@csrf</form>
                                    </div>
                                </div>
                            </div>
                        @endguest
                    </div>

                    {{-- Tombol Hamburger untuk Mobile --}}
                    <div class="md:hidden">
                        <button data-collapse-toggle="navbar-collapse-menu" type="button"
                            class="p-2 inline-flex justify-center items-center gap-x-2 rounded-lg border border-transparent text-yellow-100 hover:bg-yellow-500/20">
                            <svg class="hs-collapse-open:hidden flex-shrink-0 size-6" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="3" x2="21" y1="6" y2="6" />
                                <line x1="3" x2="21" y1="12" y2="12" />
                                <line x1="3" x2="21" y1="18" y2="18" />
                            </svg>
                            <svg class="hs-collapse-open:block hidden flex-shrink-0 size-6"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>
                </nav>

                {{-- Menu Mobile (Collapse) --}}
                <div id="navbar-collapse-menu" class="hidden md:hidden">
                    <div class="flex flex-col gap-y-4 pt-4 px-4 pb-4">
                        <a class="font-medium {{ request()->routeIs('home') ? 'text-yellow-300' : 'text-yellow-100' }}"
                            href="{{ route('home') }}">Home</a>
                        <a class="font-medium {{ request()->routeIs('pomotime') ? 'text-yellow-300' : 'text-yellow-100' }}"
                            href="{{ route('pomotime') }}">PomoTime</a>
                        <a class="font-medium text-yellow-100" href="#">Guide</a>

                        @auth
                            <div class="border-t border-orange-400/50 pt-4 mt-2">
                                <div class="flex items-center gap-x-3 mb-3">
                                    <img class="w-10 h-10 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : 'https://img.icons8.com/fluency/96/user-male-circle.png' }}"
                                        alt="user photo">
                                    <div>
                                        <p class="font-semibold text-white">{{ Auth::user()->name }}</p>
                                    </div>
                                </div>
                                {{-- PERUBAHAN: Link 'Profil' juga ditambahkan di sini untuk mobile --}}
                                <a href="{{ route('profile.edit') }}"
                                    class="block text-center py-2 px-3 rounded-lg bg-yellow-400/80 text-indigo-950 font-semibold hover:bg-yellow-400 mb-2">Lihat
                                    Profil</a>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();"
                                    class="block w-full text-center py-2 px-3 rounded-lg bg-red-600/80 text-white font-semibold hover:bg-red-700">
                                    Logout
                                </a>
                                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST"
                                    class="hidden">@csrf</form>
                            </div>
                        @endauth
                    </div>
                </div>
            </header>
        </div>

            <main class="pt-4">
                @yield('content')
            </main>
            {{-- FOOTER BARU DISESUAIKAN UNTUK POMOCAT --}}
            @if (!request()->routeIs('guide'))
                @include('pomotime.partials._footer')
            @endif


        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.46.0/dist/apexcharts.min.js"></script>
        @stack('scripts')
</body>

</html>
