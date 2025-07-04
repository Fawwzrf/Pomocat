<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - PomoCat</title>
    {{-- Aset dan Font --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap"
        rel="stylesheet">
    @vite(['resources/css/pomotime.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <section class="min-h-screen flex items-center justify-center p-4"
        style="background: radial-gradient(circle, #F2A51A 0%, #EA6227 70%, #d35400 100%);">
        <div class="w-full bg-yellow-100/90 backdrop-blur-sm rounded-2xl shadow-2xl sm:max-w-md">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <a href="{{ url('/') }}" class="flex items-center mb-4 text-2xl font-semibold text-indigo-950">
                    <img class="w-auto h-14" src="{{ asset('storage/images/logo.png') }}" alt="logo">
                </a>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-indigo-950 md:text-2xl">
                    Reset Password Anda
                </h1>
                <p class="text-sm text-slate-600">Masukkan email Anda, dan kami akan mengirimkan link untuk mereset
                    password.</p>

                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="space-y-4 md:space-y-6" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-indigo-900">Alamat
                            Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-amber-600 focus:border-amber-600 block w-full p-2.5"
                            placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="w-full text-white bg-indigo-800 hover:bg-indigo-900 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors">Kirim
                        Link Reset Password</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>
