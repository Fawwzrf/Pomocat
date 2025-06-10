<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - PomoCat</title>

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

        <div class="flex items-center justify-center w-full">
            <div class="w-full max-w-xl bg-yellow-100/80 backdrop-blur-sm rounded-2xl shadow-2xl">


                {{-- KOLOM KIRI: FORM REGISTRASI --}}
                <div class="w-full bg-yellow-100/80 backdrop-blur-sm rounded-2xl shadow-2xl sm:max-w-xl">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <a href="{{ url('/') }}"
                            class="flex items-center mb-4 text-2xl font-semibold text-indigo-950">
                            <img class="w-auto h-14" src="{{ asset('storage/images/logo.png') }}" alt="logo">
                        </a>
                        <div>
                            <h1 class="text-xl font-bold leading-tight tracking-tight text-indigo-950 md:text-3xl">
                                Create your account
                            </h1>
                            <p class="text-sm font-small text-gray-600 mt-2">
                                Start your website in seconds. Already have an account? <a href="{{ route('login') }}"
                                    class="font-medium text-indigo-800 hover:underline">Log in</a>
                            </p>
                        </div>

                        <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="name"
                                        class="block mb-2 text-md font-medium text-indigo-900">Username</label>
                                    <input type="text" name="name" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5"
                                        placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block mb-2 text-md font-medium text-indigo-900">Your
                                        Email</label>
                                    <input type="email" name="email" id="email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5"
                                        placeholder="nama@email.com" value="{{ old('email') }}" required>
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-md font-medium text-indigo-900">Password</label>
                                    <input type="password" name="password" id="password" placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5"
                                        required>
                                </div>
                                <div>
                                    <label for="password-confirm"
                                        class="block mb-2 text-md font-medium text-indigo-900">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password-confirm"
                                        placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-md rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5"
                                        required>
                                </div>
                            </div>
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <button type="submit"
                                class="w-full text-white bg-indigo-800 hover:bg-indigo-900 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-base px-5 py-2.5 text-center transition-colors">
                                Create an account
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>
