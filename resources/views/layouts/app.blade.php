<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'preline') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <header class="w-full text-sm py-3">
            <nav class="max-w-[85rem] w-full mx-auto px-4 flex flex-wrap basis-full items-center justify-between">
                <div class="flex-none sm:order-1 h-20 items-center">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" class="w-auto h-20 mr-2">
                </div>

                <div id="hs-navbar-alignment"
                    class="hidden hs-collapse overflow-hidden transition-all duration-300 basis-full grow
                            sm:order-2 sm:basis-auto sm:grow
                            sm:flex sm:justify-center sm:items-center"
                    aria-labelledby="hs-navbar-alignment-collapse">
                    <div class="flex flex-col gap-y-4 gap-x-4 mt-5 sm:flex-row sm:items-center sm:mt-0">
                        <a class="font-semibold text-slate-950 bg-amber-500 py-2 px-4 rounded-lg inline-flex items-center gap-x-2"
                            href="#" aria-current="page">
                            <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                                </path>
                            </svg>
                            Home
                        </a>
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
                        <a class="font-semibold text-stone-200  bg-amber-400 hover:bg-amber-500 py-2 px-4 rounded-lg inline-flex items-center gap-x-2"
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

                <div class="flex items-center gap-x-2 sm:order-3">
                    <button type="button"
                        class="sm:hidden hs-collapse-toggle relative size-9 flex justify-center items-center gap-x-2 rounded-lg border border-orange-500 bg-orange-400 text-white shadow-2xs hover:bg-orange-300 focus:outline-none focus:bg-orange-300 disabled:opacity-50 disabled:pointer-events-none"
                        id="hs-navbar-alignment-collapse" aria-expanded="false" aria-controls="hs-navbar-alignment"
                        aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-alignment">
                        <svg class="hs-collapse-open:hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="3" x2="21" y1="6" y2="6" />
                            <line x1="3" x2="21" y1="12" y2="12" />
                            <line x1="3" x2="21" y1="18" y2="18" />
                        </svg>
                        <svg class="hs-collapse-open:block hidden shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                        <span class="sr-only">Toggle</span>
                    </button>

                    <div class="hidden sm:flex items-center gap-x-2">
                        @guest
                            @if (Route::has('login'))
                                <div class="border-l border-orange-400 h-6"></div>
                                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-yellow-400 hover:bg-yellow-500 text-slate-900"
                                    href="{{ route('login') }}">
                                    <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ __('Log in') }}
                                </a>
                            @endif

                            @if (Route::has('register'))
                                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white"
                                    href="{{ route('register') }}">
                                    {{ __('Sign up') }}
                                </a>
                            @endif
                        @else
                            <div class="hs-dropdown relative inline-flex">
                                <button id="hs-dropdown-user" type="button"
                                    class="hs-dropdown-toggle py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-indigo-700 hover:bg-indigo-800 text-neutral-50 focus:outline-none"
                                    aria-haspopup="menu" aria-expanded="false" aria-label="User menu">
                                    {{ Auth::user()->name }}
                                    <svg class="hs-dropdown-open:rotate-180 size-4 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="m6 9 6 6 6-6" />
                                    </svg>
                                </button>

                                <div class="hs-dropdown-menu transition-[opacity,margin] duration-300 hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg p-2 mt-2 z-10 border border-gray-200"
                                    role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-user">
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition-colors duration-150"
                                        href="#">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                            <circle cx="12" cy="7" r="4"/>
                                        </svg>
                                        Profile
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition-colors duration-150"
                                        href="#">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                        Settings
                                    </a>
                                    <div class="border-t border-gray-200 my-2"></div>
                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-red-600 hover:bg-red-50 focus:outline-none focus:bg-red-50 transition-colors duration-150"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                            <polyline points="16,17 21,12 16,7"/>
                                            <line x1="21" x2="9" y1="12" y2="12"/>
                                        </svg>
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @endguest
                    </div>
                </div>
            </nav>
        </header>
        
        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/preline@2.0.3/dist/preline.min.js"></script>
</body>

</html>