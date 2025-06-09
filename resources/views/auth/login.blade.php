<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - PomoCat</title>

    {{-- Aset dan Font --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/pomotime.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <section class="min-h-screen flex items-center justify-center p-4"
        style="background: radial-gradient(circle, #F2A51A 0%, #EA6227 70%, #d35400 100%);">
        {{-- Kontainer utama yang akan menampung dua kolom --}}
        <div class="w-full max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-24 ">

                {{-- KOLOM KIRI: FORM LOGIN --}}
                <div class="w-full bg-yellow-100/80 backdrop-blur-sm rounded-2xl shadow-2xl sm:max-w-xl">

                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">

                        <a href="{{ url('/') }}"
                            class="flex items-center mb-4 text-2xl font-semibold text-indigo-950">

                            <img class="w-auto h-14" src="{{ asset('storage/images/logo.png') }}" alt="logo">

                        </a>
                        <div>
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-indigo-950 md:text-3xl">
                                Welcome back!
                            </h1>
                            <p class="text-sm font-small text-gray-600 mt-2">
                                Start your website in seconds. Don’t have an account? <a href="{{ route('register') }}"
                                    class="font-medium text-indigo-800 hover:underline">Sign Up</a>
                            </p>
                        </div>
                        



                        <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('login') }}">

                            @csrf



                            {{-- ======================================================== --}}

                            {{-- == PERUBAHAN: Input dibungkus dalam Grid Responsif == --}}

                            {{-- ======================================================== --}}

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                                <div>

                                    <label for="email"
                                        class="block mb-2 text-md font-medium text-indigo-900">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5"
                                        placeholder="nama@email.com" value="{{ old('email') }}" required>
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-md font-medium text-indigo-900">Password</label>
                                    <input type="password" name="password" id="password" placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5"
                                        required>
                                </div>
                            </div>

                            @if ($errors->has('email') || $errors->has('password'))
                                <p class="text-sm text-red-600">
                                    {{ $errors->first('email') ?: $errors->first('password') }}
                                </p>
                            @endif





                            <div class="flex items-center justify-between">

                                <div class="flex items-start">

                                    <div class="flex items-center h-5">

                                        <input id="remember" name="remember" aria-describedby="remember"
                                            type="checkbox"
                                            class="w-5 h-5 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-amber-400"
                                            {{ old('remember') ? 'checked' : '' }}>

                                    </div>

                                    <div class="ml-3 text-base">

                                        <label for="remember" class="text-gray-600">Remember me</label>

                                    </div>

                                </div>

                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-base font-medium text-indigo-800 hover:underline">Forgot password?</a>
                                @endif

                            </div>



                            <button type="submit"
                                class="w-full text-white bg-indigo-800 hover:bg-indigo-900 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-base px-5 py-2.5 text-center transition-colors">Log in to your account</button>
                            <div class="inline-flex items-center justify-center w-full">
                                <hr class="w-full h-px my-2 bg-gray-300 border-0">

                                <span
                                    class="absolute px-3 font-medium text-gray-500 -translate-x-1/2 bg-yellow-100/0 left-1/2">or</span>


                            </div>



                            <div>

                                <button type="button"
                                    class="w-full text-indigo-900 bg-white hover:bg-gray-100 border border-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200 font-medium rounded-lg text-base px-5 py-2.5 text-center inline-flex items-center justify-center">

                                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 18 19">


                                        <path fill-rule="evenodd"
                                            d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z"
                                            clip-rule="evenodd" />


                                    </svg>

                                    Log in with Google

                                </button>

                            </div>





                        </form>

                    </div>

                </div>
                <div class="hidden md:flex items-center justify-center p-6 ">
                    {{-- Ganti src dengan path ilustrasi Anda nanti --}}
                    {{-- <img src="{{ asset('storage/images/login-illustration.png') }}" class="w-full h-auto max-w-sm" alt="Login Illustration"> --}}
                    <p class="text-white/50 text-center">Area Ilustrasi</p>
                </div>
            </div>

            {{-- KOLOM KANAN: ILUSTRASI --}}

        </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>
