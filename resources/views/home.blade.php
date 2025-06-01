@extends('layouts.app')

@section('content')
    {{-- Container utama untuk konten ini, pastikan body atau parent-nya sudah memiliki background radial --}}
    <div
        class="flex flex-col items-center justify-start min-h-[calc(100vh-theme(spacing.20))] text-white -z-100 pt-20 sm:pt-16 md:pt-4 px-4 relative">

        {{-- Teks Besar POMOCAT --}}
            <h1 class=" text-8xl sm:text-9xl md:text-[150px] lg:text-[290px] font-bold tracking-wider mt-5 mb-0 sm:mb-0 md:mb-0 text-center"
            style="font-family: 'Baloo Bhaijaan 2', cursive; font-weight: 800; letter-spacing: -0.04em; ">
            POMOCAT
        </h1>
        {{-- Konten di bawah POMOCAT (dua kolom di layar besar) --}}
        <div
            class="w-full max-w-[68rem] mx-auto grid md:grid-cols-2 gap-8 md:gap-x-8 lg:gap-x-12 items-start mb-16 sm:mb-20 md:mb-24">
            {{-- Kolom Kiri --}}
            <div class="text-center md:text-left">
                <p class="text-lg sm:text-base mb-6"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                    Klik tombol berikut untuk memulai PomoCat!
                </p>
                <a href="#"
                    class="inline-block bg-indigo-900 hover:bg-indigo-950 text-white font-semibold py-3 px-6 rounded-lg text-base transition duration-150"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                    Mulai Sekarang &gt;
                </a>
            </div>

            {{-- Kolom Kanan --}}
            <div class="text-center md:text-right pr-5 rounded-lg">
                <p
                    class="text-lg sm:text-base font-semibold mb-2"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                    Hai, aku PomoCat!
                </p>
                <p class="text-base sm:text-base"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                    Siap bantu kamu fokus, istirahat, dan ulangi lagi.
                </p>
                <p class="text-base sm:text-base"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                    Yuk mulai waktumu!
                </p>
            </div>
        </div>
        <div class="absolute bottom-[-100px] -z-100 text-center w-full ">
        </div>
        {{-- Scroll Indikator --}}
        <div class="absolute bottom-0 sm:bottom-5 text-center w-full animate-bounce mb-8">
            <p
                class="text-indigo-950 text-sm sm:text-base mb-0"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                Scroll untuk melihat lebih lanjut</p>
            <svg class="w-6 h-6 sm:w-8 sm:h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke="#091057" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                </path>
            </svg>
        </div>
    </div>

    {{-- SECTION SERVICES --}}
    <div class="w-full py-16 sm:py-24 px-4"
        style="background: radial-gradient(circle at top, #F2A51A 0%, #EA6227 70%, #d35400 100%);">
        <div class="max-w-6xl mx-auto text-center">
            <h2
                class="text-4xl sm:text-7xl font-bold text-white mb-4 relative inline-block pb-2"style="font-family: 'Baloo Bhaijaan 2', cursive; font-weight: 200; letter-spacing: -0.04em;">
                Services.
                {{-- <span class="absolute bottom-0 left-0 w-2/3 h-1 bg-white"></span> --}}
            </h2>
            <p class="text-lg sm:text-sm text-white max-w-2xl mx-auto mb-12 sm:mb-16"
                style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                Akses sesi fokusmu di mana saja, baik melalui web maupun aplikasi mobile. PomoCat siap membantumu tetap
                produktif kapan pun dan di mana pun.
            </p>

            <div class="grid md:grid-cols-3 gap-8 lg:gap-12"> {{-- Disesuaikan gapnya agar tidak terlalu rapat --}}
                {{-- Service Card 1: Timer --}}
                <div
                    class="group p-8 pb-4 rounded-3xl text-white transform hover:scale-105 transition-transform duration-300">
                    <div class="rounded-[35px] h-[250px] md:h-[200px] lg:h-[250px] flex items-center justify-center p-1 transition-all duration-300 group-hover:shadow-[0_0_25px_8px_#091057]"
                        style="background: radial-gradient(circle , #1423BD 0%, #091057 100%);">
                        <img src="{{ asset('storage/images/clock.png') }}" alt="Timer Icon" class="max-h-[60%] w-auto">
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-semibold mb-3 mt-6" style="font-family: 'Poppins', cursive;">Timer
                    </h3>
                    <p class="text-base sm:text-sm" style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Gunakan timer Pomodoro untuk membagi waktu menjadi sesi fokus dan istirahat secara teratur, agar
                        tetap produktif tanpa merasa kewalahan.
                    </p>
                </div>

                {{-- Service Card 2: Manage Task --}}
                <div
                    class="group p-8 pb-4 rounded-3xl text-white transform hover:scale-105 transition-transform duration-300">
                    <div class="rounded-[35px] h-[250px] md:h-[200px] lg:h-[250px] flex items-center justify-center p-1 transition-all duration-300 group-hover:shadow-[0_0_25px_8px_#1423BD]"
                        style="background: radial-gradient(circle , #091057 0%, #1423BD 100% );">
                        <img src="{{ asset('storage/images/task.png') }}" alt="Manage Task Icon" class="max-h-[60%] w-auto">
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-semibold mb-3 mt-6" style="font-family: 'Poppins', cursive;">
                        Manage Task</h3>
                    <p class="text-base sm:text-sm" style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Atur dan pantau daftar tugasmu dengan mudah buat, edit, dan tandai tugas selesai agar pekerjaanmu
                        lebih terorganisir.
                    </p>
                </div>

                {{-- Service Card 3: Rank --}}
                <div
                    class="group p-8 pb-4 rounded-3xl text-white transform hover:scale-105 transition-transform duration-300">
                    <div class="rounded-[35px] h-[250px] md:h-[200px] lg:h-[250px] flex items-center justify-center p-1 transition-all duration-300 group-hover:shadow-[0_0_25px_8px_#091057]"
                        style="background: radial-gradient(circle , #1423BD 0%, #091057 100%);">
                        <img src="{{ asset('storage/images/rank.png') }}" alt="Rank Icon" class="max-h-[60%] w-auto">
                    </div>
                    <h3 class="text-2xl sm:text-3xl font-semibold mb-3 mt-6" style="font-family: 'Poppins', cursive;">Rank
                    </h3>
                    <p class="text-base sm:text-sm" style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Dapatkan peringkat berdasarkan jumlah sesi fokus yang kamu selesaikan. Semakin fokus, semakin tinggi
                        posisimu di papan peringkat!
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- SECTION OUR TEAMS BARU --}}
    <div class="w-full py-16 sm:py-24 px-4" style="background-color: #091057;"> {{-- Latar belakang biru tua solid --}}
        <div class="max-w-6xl mx-auto text-left"> {{-- Diubah menjadi text-left untuk judul --}}
            <h2 class="text-4xl sm:text-7xl font-bold text-white mb-4 relative inline-block pb-2"
                style="font-family: 'Baloo Bhaijaan 2', cursive; font-weight: 200; letter-spacing: -0.04em;">
                Our Teams.
            </h2>
            <p class="text-lg sm:text-sm text-white max-w-3xl mb-12 sm:mb-16"
                style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                Kami fokus pada setiap detail dari apa yang kami kerjakan semua itu untuk membantu orang-orang di seluruh
                dunia agar dapat fokus pada hal yang paling penting bagi mereka.
            </p>

            {{-- Kontainer untuk kartu tim, menggunakan flexbox untuk penempatan yang lebih bebas --}}
            <div
                class="relative flex flex-wrap justify-center items-center gap-8 lg:gap-12 min-h-[400px] sm:min-h-[500px] md:min-h-[600px]">

                {{-- Team Card 1: Fawwaz (Paling Atas dan Sedikit ke Kiri) --}}
                <div
                    class="relative z-20 transform md:translate-y-[-40px] lg:translate-y-[40px] lg:translate-x-[-100px] group">
                    <div class="w-[280px] sm:w-[280px] rounded-[40px] text-center text-white shadow-2xl overflow-hidden transform group-hover:scale-105 transition-transform duration-300"
                        style="box-shadow: 0px 15px 35px -5px rgba(242, 165, 26, 0.5), 0px 8px 15px rgba(0,0,0,0.1);">

                        {{-- Bagian Atas Kartu (Oranye Terang) --}}
                        <div class="relative h-[120px] sm:h-[100px] flex justify-center items-end pb-2"
                            style="background-color: #EA6227;">
                            {{-- Foto Profil --}}
                            <img src="{{ asset('storage/images/profile_fawwaz.jpg') }}" alt="Fawwaz Aufa A. R."
                                class="w-28 h-28 sm:w-32 sm:h-32 rounded-full absolute bottom-[-60px] sm:bottom-[-64px] left-1/2 -translate-x-1/2 border-4 sm:border-[6px] border-white object-cover shadow-lg">
                        </div>

                        {{-- Bagian Bawah Kartu (Oranye Gelap) --}}
                        <div class="pt-[70px] sm:pt-[78px] pb-6 px-6" style="background-color: #F2A51A;">
                            <h3 class="text-xl sm:text-lg font-semibold mt-2 mb-1" style="font-family: 'Poppins', cursive;">
                                Fawwaz Aufa A. R.
                            </h3>
                            <p class="text-sm text-gray-100 mb-4" style="font-family: 'Poppins', cursive;">CEO</p>
                            <div class="flex justify-start space-x-3 pt-2">
                                <a href="https://www.instagram.com/fawwzrf._?igsh=ZTRicHZqYzlnOGw2"
                                    class="text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor"
                                        width="24" height="24" viewBox="0 0 50 50">
                                        <path
                                            d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="https://www.github.com/Fawwzrf" class="text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                        viewBox="0,0,256,256">
                                        <g fill="#fffdfd" fill-rule="nonzero" stroke="none" stroke-width="1"
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
                                </a>
                                <a href="https://www.linkedin.com/in/fawwazrf" class="text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                        viewBox="0,0,256,256">
                                        <g fill="#fffdfd" fill-rule="nonzero" stroke="none" stroke-width="1"
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
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Team Card 2: Revalina (Tengah dan sedikit ke bawah dari Fawwaz) --}}
                <div class="relative z-10 transform md:translate-y-[20px] lg:translate-y-[-120px] group">
                    <div class="w-[280px] sm:w-[280px] rounded-[40px] text-center text-white shadow-2xl overflow-hidden transform group-hover:scale-105 transition-transform duration-300"
                        style="box-shadow: 0px 15px 35px -5px rgba(242, 165, 26, 0.5), 0px 8px 15px rgba(0,0,0,0.1);">

                        <div class="relative h-[120px] sm:h-[100px] flex justify-center items-end pb-2"
                            style="background-color: #EA6227;">
                            <img src="{{ asset('storage/images/profile_fani.png') }}" alt="Revalina Fidiya A."
                                class="w-28 h-28 sm:w-32 sm:h-32 rounded-full absolute bottom-[-60px] sm:bottom-[-64px] left-1/2 -translate-x-1/2 border-4 sm:border-[6px] border-white object-cover shadow-lg">
                        </div>

                        <div class="pt-[70px] sm:pt-[78px] pb-6 px-6" style="background-color: #F2A51A;">
                            <h3 class="text-xl sm:text-lg font-semibold mt-2 mb-1"
                                style="font-family: 'Poppins', cursive;">
                                Revalina Fidiya Anugrah
                            </h3>
                            <p class="text-sm text-gray-100 mb-4" style="font-family: 'Poppins', cursive;">Founder</p>
                            <div class="flex justify-start space-x-3 pt-2">
                                <a href="https://www.instagram.com/rvalinafa_?igsh=MWZsMHpkOXF0cWRlcg=="
                                    class="text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor"
                                        width="24" height="24" viewBox="0 0 50 50">
                                        <path
                                            d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="https://github.com/revalinafa" class="text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                        viewBox="0,0,256,256">
                                        <g fill="#fffdfd" fill-rule="nonzero" stroke="none" stroke-width="1"
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
                                </a>
                                <a href="https://www.linkedin.com/in/revalina-fidiya-anugrah05?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app"
                                    class="text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                        viewBox="0,0,256,256">
                                        <g fill="#fffdfd" fill-rule="nonzero" stroke="none" stroke-width="1"
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
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Team Card 3: Isma (Paling Bawah dan Sedikit ke Kanan) --}}
                <div
                    class="relative z-0 transform md:translate-y-[80px] lg:translate-y-[40px] lg:translate-x-[100px] group">
                    <div class="w-[280px] sm:w-[280px] rounded-[40px] text-center text-white shadow-2xl overflow-hidden transform group-hover:scale-105 transition-transform duration-300"
                        style="box-shadow: 0px 15px 35px -5px rgba(242, 165, 26, 0.5), 0px 8px 15px rgba(0,0,0,0.1);">

                        <div class="relative h-[120px] sm:h-[100px] flex justify-center items-end pb-2"
                            style="background-color: #EA6227;">
                            <img src="{{ asset('storage/images/profile_isma.png') }}" alt="Isma Fadhilatizzahra"
                                class="w-28 h-28 sm:w-32 sm:h-32 rounded-full absolute bottom-[-60px] sm:bottom-[-64px] left-1/2 -translate-x-1/2 border-4 sm:border-[6px] border-white object-cover shadow-lg">
                        </div>

                        <div class="pt-[70px] sm:pt-[78px] pb-6 px-6" style="background-color: #F2A51A;">
                            <h3 class="text-xl sm:text-lg font-semibold mt-2 mb-1"
                                style="font-family: 'Poppins', cursive;">
                                Isma Fadhilatizzahra
                            </h3>
                            <p class="text-sm text-gray-100 mb-4" style="font-family: 'Poppins', cursive;">CTO</p>
                            <div class="flex justify-start space-x-3 pt-2">
                                <a href="http://instagram.com/needmadhira" class="text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor"
                                        width="24" height="24" viewBox="0 0 50 50">
                                        <path
                                            d="M 16 3 C 8.83 3 3 8.83 3 16 L 3 34 C 3 41.17 8.83 47 16 47 L 34 47 C 41.17 47 47 41.17 47 34 L 47 16 C 47 8.83 41.17 3 34 3 L 16 3 z M 37 11 C 38.1 11 39 11.9 39 13 C 39 14.1 38.1 15 37 15 C 35.9 15 35 14.1 35 13 C 35 11.9 35.9 11 37 11 z M 25 14 C 31.07 14 36 18.93 36 25 C 36 31.07 31.07 36 25 36 C 18.93 36 14 31.07 14 25 C 14 18.93 18.93 14 25 14 z M 25 16 C 20.04 16 16 20.04 16 25 C 16 29.96 20.04 34 25 34 C 29.96 34 34 29.96 34 25 C 34 20.04 29.96 16 25 16 z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="http://github.com/IsmaFdz" class="text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                        viewBox="0,0,256,256">
                                        <g fill="#fffdfd" fill-rule="nonzero" stroke="none" stroke-width="1"
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
                                </a>
                                <a href="#" class="text-gray-200 hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                        viewBox="0,0,256,256">
                                        <g fill="#fffdfd" fill-rule="nonzero" stroke="none" stroke-width="1"
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
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- SECTION CLIENT TESTIMONIALS DENGAN FLOWBITE CAROUSEL --}}
    <div class="w-full py-16 sm:py-24 px-4 overflow-hidden" style="background-color: #091057;">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-4xl sm:text-7xl font-bold text-white mb-2 relative inline-flex items-center"
                style="font-family: 'Baloo Bhaijaan 2', cursive; font-weight: 200; letter-spacing: -0.02em;">
                <span class="text-5xl sm:text-7xl mr-4 text-orange-400">&lt;</span>
                Client Testimonials
                <span class="text-5xl sm:text-7xl ml-4 text-orange-400">&gt;</span>
            </h2>

            <div id="testimonialClientCarouselFlowbite" class="relative w-full mt-12 sm:mt-10" data-carousel="slide">
                <div class="relative h-[600px] sm:h-[650px] md:h-[700px] overflow-hidden rounded-lg">

                    {{-- Item Carousel 1: ALFAN di Tengah --}}
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                        <div
                            class="flex justify-center items-center h-full gap-x-1 sm:gap-x-2 md:gap-x-3 lg:gap-x-4 py-8 px-1">
                            {{-- Kartu Kiri (Defit - Kecil, Redup) --}}
                            <div class="testimonial-card-flowbite-side transform scale-90 sm:scale-85 opacity-75 w-[220px] xs:w-[240px] sm:w-[260px] md:w-[280px] p-4 sm:p-6 text-left text-white transition-all duration-300"
                                style="background: linear-gradient(145deg, #F2A51A, #D65A1F); box-shadow: 0px 8px 25px rgba(242, 165, 26, 0.2); border-radius: 30px 80px 40px 60px / 60px 30px 80px 40px; overflow: hidden;">
                                <div
                                    class="relative h-[70px] sm:h-[80px] flex justify-center items-end mb-[-20px] sm:mb-[-25px]">
                                    <img src="{{ asset('storage/images/profile_defit.jpg') }}" alt="Defit Bagus"
                                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full absolute top-8 left-1/2 -translate-x-1/2 -translate-y-1/2 border-2 sm:border-4 border-[#D65A1F] object-cover shadow-md z-10">
                                </div>
                                <div class="pt-[40px] sm:pt-[20px]">
                                    <h3 class="text-md sm:text-lg font-semibold mt-1 mb-1 text-center"
                                        style="font-family: 'Poppins', cursive;">Defit Bagus</h3>
                                    <p class="text-xs text-gray-300 mb-2 text-center"
                                        style="font-family: 'Poppins', cursive;">Pak Lurah</p>
                                    <div class="relative mt-1">
                                        <p class="text-[10px] sm:text-xs italic"
                                            style="font-family: 'Poppins', cursive; line-height: 1.5;">
                                            "Fokus eksekusi jadi meningkat..."
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kartu Tengah (Alfan - Besar, Glow) --}}
                            <div class="testimonial-card-flowbite-center transform scale-100 opacity-100 w-[280px] xs:w-[300px] sm:w-[340px] md:w-[380px] p-8 text-left text-white transition-all duration-300"
                                style="background: linear-gradient(145deg, #EEB04C, #E05A15); border-radius: 80px 40px 60px 30px / 30px 60px 40px 80px; overflow: hidden; box-shadow: 0px 0px 35px 10px rgba(242, 165, 26, 0.7);">
                                <div
                                    class="relative h-[100px] sm:h-[120px] flex justify-center items-end mb-[-30px] sm:mb-[-35px]">
                                    <img src="{{ asset('storage/images/profile_alfan.jpg') }}" alt="Alfan Fauzan"
                                        class="w-28 h-28 sm:w-32 sm:h-32 rounded-full absolute top-12 left-1/2 -translate-x-1/2 -translate-y-1/2 border-4 border-[#E05A15] object-cover shadow-lg
                     profile-glow">
                                </div>
                                <div class="pt-[60px] sm:pt-[30px]">
                                    <h3 class="text-xl sm:text-2xl font-semibold mt-2 mb-1 text-center"
                                        style="font-family: 'Poppins', cursive;">Alfan Fauzan</h3>
                                    <p class="text-sm text-gray-200 mb-3 text-center"
                                        style="font-family: 'Poppins', cursive;">Mahasiswa</p>
                                    <div class="relative mt-1">
                                        <p class="text-sm sm:text-base italic"
                                            style="font-family: 'Poppins', cursive; line-height: 1.6;">
                                            "PomoCat sangat membantu aku dalam membagi waktu antara belajar dan istirahat.
                                            Fitur timernya bikin aku jadi lebih fokus..."
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kartu Kanan (Bina - Kecil, Redup) --}}
                            <div class="testimonial-card-flowbite-side transform scale-90 sm:scale-85 opacity-75 w-[220px] xs:w-[240px] sm:w-[260px] md:w-[280px] p-4 sm:p-6 text-left text-white transition-all duration-300"
                                style="background: linear-gradient(145deg, #F2A51A, #D65A1F); box-shadow: 0px 8px 25px rgba(242, 165, 26, 0.2); border-radius: 60px 30px 80px 40px / 40px 80px 30px 60px; overflow: hidden;">
                                <div
                                    class="relative h-[70px] sm:h-[80px] flex justify-center items-end mb-[-20px] sm:mb-[-25px]">
                                    <img src="{{ asset('storage/images/profile_bina.jpg') }}" alt="Bina Jenner"
                                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full absolute top-8 left-1/2 -translate-x-1/2 -translate-y-1/2 border-2 sm:border-4 border-[#D65A1F] object-cover shadow-md z-10">
                                </div>
                                <div class="pt-[40px] sm:pt-[20px]">
                                    <h3 class="text-md sm:text-lg font-semibold mt-1 mb-1 text-center"
                                        style="font-family: 'Poppins', cursive;">Bina Jenner</h3>
                                    <p class="text-xs text-gray-300 mb-2 text-center"
                                        style="font-family: 'Poppins', cursive;">Mahasiswi</p>
                                    <div class="relative mt-1">
                                        <p class="text-[10px] sm:text-xs italic"
                                            style="font-family: 'Poppins', cursive; line-height: 1.5;">
                                            "Sejak pakai PomoCat, manajemen waktu jadi..."
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Item Carousel 2: BINA di Tengah --}}
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div
                            class="flex justify-center items-center h-full gap-x-1 sm:gap-x-2 md:gap-x-3 lg:gap-x-4 py-8 px-1">
                            {{-- Kartu Kiri (Alfan - Kecil, Redup) --}}
                            <div class="testimonial-card-flowbite-side transform scale-90 sm:scale-85 opacity-75 w-[220px] xs:w-[240px] sm:w-[260px] md:w-[280px] p-4 sm:p-6 text-left text-white transition-all duration-300"
                                style="background: linear-gradient(145deg, #EEB04C, #E05A15); box-shadow: 0px 8px 25px rgba(242, 165, 26, 0.2); border-radius: 80px 40px 60px 30px / 30px 60px 40px 80px; overflow: hidden;">
                                <div
                                    class="relative h-[70px] sm:h-[80px] flex justify-center items-end mb-[-20px] sm:mb-[-25px]">
                                    <img src="{{ asset('storage/images/profile_alfan.jpg') }}" alt="Alfan Fauzan"
                                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full absolute top-8 left-1/2 -translate-x-1/2 -translate-y-1/2 border-2 sm:border-4 border-[#E05A15] object-cover shadow-md z-10">
                                </div>
                                <div class="pt-[40px] sm:pt-[20px]">
                                    <h3 class="text-md sm:text-lg font-semibold mt-1 mb-1 text-center"
                                        style="font-family: 'Poppins', cursive;">Alfan Fauzan</h3>
                                    <p class="text-xs text-gray-300 mb-2 text-center"
                                        style="font-family: 'Poppins', cursive;">Mahasiswa</p>
                                    <div class="relative mt-1">
                                        <p class="text-[10px] sm:text-xs italic"
                                            style="font-family: 'Poppins', cursive; line-height: 1.5;">
                                            "PomoCat sangat membantu aku..."
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Kartu Tengah (Bina - Besar, Glow) --}}
                            <div class="testimonial-card-flowbite-center transform scale-100 opacity-100 w-[280px] xs:w-[300px] sm:w-[340px] md:w-[380px] p-8 text-left text-white transition-all duration-300"
                                style="background: linear-gradient(145deg, #F2A51A, #D65A1F); border-radius: 60px 30px 80px 40px / 40px 80px 30px 60px; overflow: hidden; box-shadow: 0px 0px 35px 10px rgba(242, 165, 26, 0.7);">
                                <div
                                    class="relative h-[100px] sm:h-[120px] flex justify-center items-end mb-[-30px] sm:mb-[-35px]">
                                    <img src="{{ asset('storage/images/profile_bina.jpg') }}" alt="Bina Jenner"
                                        class="w-28 h-28 sm:w-32 sm:h-32 rounded-full absolute top-12 left-1/2 -translate-x-1/2 -translate-y-1/2 border-4 border-[#D65A1F] object-cover shadow-lg
                     profile-glow">
                                </div>
                                <div class="pt-[60px] sm:pt-[30px]">
                                    <h3 class="text-xl sm:text-2xl font-semibold mt-2 mb-1 text-center"
                                        style="font-family: 'Poppins', cursive;">Bina Jenner</h3>
                                    <p class="text-sm text-gray-200 mb-3 text-center"
                                        style="font-family: 'Poppins', cursive;">Mahasiswi</p>
                                    <div class="relative mt-1">
                                        <p class="text-sm sm:text-base italic"
                                            style="font-family: 'Poppins', cursive; line-height: 1.6;">
                                            "Sejak pakai PomoCat, manajemen waktu jadi jauh lebih teratur. Aku bisa
                                            menyelesaikan tugas satu per satu tanpa stres..."
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- Kartu Kanan (Defit - Kecil, Redup) --}}
                            <div class="testimonial-card-flowbite-side transform scale-90 sm:scale-85 opacity-75 w-[220px] xs:w-[240px] sm:w-[260px] md:w-[280px] p-4 sm:p-6 text-left text-white transition-all duration-300"
                                style="background: linear-gradient(145deg, #F2A51A, #D65A1F); box-shadow: 0px 8px 25px rgba(242, 165, 26, 0.2); border-radius: 30px 80px 40px 60px / 60px 30px 80px 40px; overflow: hidden;">
                                <div
                                    class="relative h-[70px] sm:h-[80px] flex justify-center items-end mb-[-20px] sm:mb-[-25px]">
                                    <img src="{{ asset('storage/images/profile_defit.jpg') }}" alt="Defit Bagus"
                                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full absolute top-8 left-1/2 -translate-x-1/2 -translate-y-1/2 border-2 sm:border-4 border-[#D65A1F] object-cover shadow-md z-10">
                                </div>
                                <div class="pt-[40px] sm:pt-[20px]">
                                    <h3 class="text-md sm:text-lg font-semibold mt-1 mb-1 text-center"
                                        style="font-family: 'Poppins', cursive;">Defit Bagus</h3>
                                    <p class="text-xs text-gray-300 mb-2 text-center"
                                        style="font-family: 'Poppins', cursive;">Pak Lurah</p>
                                    <div class="relative mt-1">
                                        <p class="text-[10px] sm:text-xs italic"
                                            style="font-family: 'Poppins', cursive; line-height: 1.5;">
                                            "Fokus eksekusi jadi meningkat..."
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Item Carousel 3: DEFIT di Tengah --}}
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <div
                            class="flex justify-center items-center h-full gap-x-1 sm:gap-x-2 md:gap-x-3 lg:gap-x-4 py-8 px-1">
                            {{-- Kartu Kiri (Bina - Kecil, Redup) --}}
                            <div class="testimonial-card-flowbite-side transform scale-90 sm:scale-85 opacity-75 w-[220px] xs:w-[240px] sm:w-[260px] md:w-[280px] p-4 sm:p-6 text-left text-white transition-all duration-300"
                                style="background: linear-gradient(145deg, #F2A51A, #D65A1F); box-shadow: 0px 8px 25px rgba(242, 165, 26, 0.2); border-radius: 60px 30px 80px 40px / 40px 80px 30px 60px; overflow: hidden;">
                                <div
                                    class="relative h-[70px] sm:h-[80px] flex justify-center items-end mb-[-20px] sm:mb-[-25px]">
                                    <img src="{{ asset('storage/images/profile_bina.jpg') }}" alt="Bina Jenner"
                                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full absolute top-8 left-1/2 -translate-x-1/2 -translate-y-1/2 border-2 sm:border-4 border-[#D65A1F] object-cover shadow-md z-10">
                                </div>
                                <div class="pt-[40px] sm:pt-[20px]">
                                    <h3 class="text-md sm:text-lg font-semibold mt-1 mb-1 text-center"
                                        style="font-family: 'Poppins', cursive;">Bina Jenner</h3>
                                    <p class="text-xs text-gray-300 mb-2 text-center"
                                        style="font-family: 'Poppins', cursive;">Mahasiswi</p>
                                    <div class="relative mt-1">
                                        <p class="text-[10px] sm:text-xs italic"
                                            style="font-family: 'Poppins', cursive; line-height: 1.5;">
                                            "Sejak pakai PomoCat, manajemen waktu jadi..."
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- Kartu Tengah (Defit - Besar, Glow) --}}
                            <div class="testimonial-card-flowbite-center transform scale-100 opacity-100 w-[280px] xs:w-[300px] sm:w-[340px] md:w-[380px] p-8 text-left text-white transition-all duration-300"
                                style="background: linear-gradient(145deg, #F2A51A, #D65A1F); border-radius: 30px 80px 40px 60px / 60px 30px 80px 40px; overflow: hidden; box-shadow: 0px 0px 35px 10px rgba(242, 165, 26, 0.7);">
                                <div
                                    class="relative h-[100px] sm:h-[120px] flex justify-center items-end mb-[-30px] sm:mb-[-35px]">
                                    <img src="{{ asset('storage/images/profile_defit.jpg') }}" alt="Defit Bagus"
                                        class="w-28 h-28 sm:w-32 sm:h-32 rounded-full absolute top-12 left-1/2 -translate-x-1/2 -translate-y-1/2 border-4 border-[#D65A1F] object-cover shadow-lg
                     profile-glow">
                                </div>
                                <div class="pt-[60px] sm:pt-[30px]">
                                    <h3 class="text-xl sm:text-2xl font-semibold mt-2 mb-1 text-center"
                                        style="font-family: 'Poppins', cursive;">Defit Bagus</h3>
                                    <p class="text-sm text-gray-200 mb-3 text-center"
                                        style="font-family: 'Poppins', cursive;">Pak Lurah</p>
                                    <div class="relative mt-1">
                                        <p class="text-sm sm:text-base italic"
                                            style="font-family: 'Poppins', cursive; line-height: 1.6;">
                                            "Fokus eksekusi jadi meningkat sejak kenal PomoCat. Ada rasa senang tiap kali
                                            sesi selesai karena rewardnya yang lucu banget."
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- Kartu Kanan (Alfan - Kecil, Redup) --}}
                            <div class="testimonial-card-flowbite-side transform scale-90 sm:scale-85 opacity-75 w-[220px] xs:w-[240px] sm:w-[260px] md:w-[280px] p-4 sm:p-6 text-left text-white transition-all duration-300"
                                style="background: linear-gradient(145deg, #EEB04C, #E05A15); box-shadow: 0px 8px 25px rgba(242, 165, 26, 0.2); border-radius: 80px 40px 60px 30px / 30px 60px 40px 80px; overflow: hidden;">
                                <div
                                    class="relative h-[70px] sm:h-[80px] flex justify-center items-end mb-[-20px] sm:mb-[-25px]">
                                    <img src="{{ asset('storage/images/profile_alfan.jpg') }}" alt="Alfan Fauzan"
                                        class="w-16 h-16 sm:w-20 sm:h-20 rounded-full absolute top-8 left-1/2 -translate-x-1/2 -translate-y-1/2 border-2 sm:border-4 border-[#E05A15] object-cover shadow-md z-10">
                                </div>
                                <div class="pt-[40px] sm:pt-[20px]">
                                    <h3 class="text-md sm:text-lg font-semibold mt-1 mb-1 text-center"
                                        style="font-family: 'Poppins', cursive;">Alfan Fauzan</h3>
                                    <p class="text-xs text-gray-300 mb-2 text-center"
                                        style="font-family: 'Poppins', cursive;">Mahasiswa</p>
                                    <div class="relative mt-1">
                                        <p class="text-[10px] sm:text-xs italic"
                                            style="font-family: 'Poppins', cursive; line-height: 1.5;">
                                            "PomoCat sangat membantu aku..."
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button"
                        class="absolute top-1/2 -translate-y-1/2 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-orange-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-1/2 -translate-y-1/2 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-orange-400 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        {{-- SECTION FAQ BARU --}}
        <div class="w-full py-16 sm:py-24 px-4" style="background-color: #091057;">
            <div class="max-w-6xl mx-auto"> {{-- Max-width lebih kecil untuk FAQ agar fokus --}}
                <h2 class="text-6xl sm:text-8xl font-bold text-white mb-12 sm:mb-16 text-left"
                    style="font-family: 'Baloo Bhaijaan 2', cursive; font-weight: 200; letter-spacing: -0.02em;">
                    FAQs
                </h2>

                <div id="accordion-faq-pomocat" data-accordion="collapse"
                    data-active-classes="bg-orange-500 text-slate-900"
                    data-inactive-classes="text-gray-300 hover:bg-indigo-950/50">

                    {{-- FAQ Item 1 --}}
                    <h2 id="accordion-faq-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 sm:p-6 font-medium rtl:text-right border-b border-indigo-800 transition-colors duration-200 ease-in-out"
                            data-accordion-target="#accordion-faq-body-1" aria-expanded="false" {{-- Defaultnya false, akan diubah JS Flowbite --}}
                            aria-controls="accordion-faq-body-1">
                            <span class="text-lg sm:text-xl" style="font-family: 'Poppins', sans-serif;">Apakah PomoCat
                                bisa diakses di perangkat apa saja?</span>
                            {{-- Ikon default Flowbite, akan berotasi. Untuk +/- kustom butuh JS atau CSS lebih lanjut --}}
                            <svg data-accordion-icon
                                class="w-4 h-4 sm:w-5 sm:h-5 rotate-0 shrink-0 transition-transform duration-200"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-faq-body-1" class="hidden" aria-labelledby="accordion-faq-heading-1">
                        <div class="p-5 sm:p-6 border-b border-indigo-800 bg-orange-500">
                            <p class="mb-2 text-slate-900 text-sm sm:text-base"
                                style="font-family: 'Poppins', sans-serif; line-height: 1.7;">
                                Ya, PomoCat dirancang untuk fleksibel dan dapat diakses melalui browser web di komputer
                                desktop atau laptop Anda, serta melalui aplikasi mobile kami yang tersedia untuk perangkat
                                Android dan iOS. Sinkronisasi data antar perangkat juga didukung agar Anda bisa melanjutkan
                                sesi fokus di mana saja.
                            </p>
                        </div>
                    </div>

                    {{-- FAQ Item 2 --}}
                    <h2 id="accordion-faq-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 sm:p-6 font-medium rtl:text-right border-b border-indigo-800 transition-colors duration-200 ease-in-out"
                            data-accordion-target="#accordion-faq-body-2" aria-expanded="true" {{-- Contoh item yang terbuka default --}}
                            aria-controls="accordion-faq-body-2">
                            <span class="text-lg sm:text-xl" style="font-family: 'Poppins', sans-serif;">Bagaimana cara
                                kerja timer di PomoCat?</span>
                            <svg data-accordion-icon
                                class="w-4 h-4 sm:w-5 sm:h-5 shrink-0 transition-transform duration-200"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-faq-body-2" class="hidden" aria-labelledby="accordion-faq-heading-2">
                        {{-- Defaultnya hidden, akan diubah oleh JS jika aria-expanded="true" --}}
                        <div class="p-5 sm:p-6 border-b border-indigo-800 bg-orange-500">
                            <p class="mb-2 text-slate-900 text-sm sm:text-base"
                                style="font-family: 'Poppins', sans-serif; line-height: 1.7;">
                                Timer PomoCat mengikuti teknik Pomodoro klasik. Anda mengatur sesi fokus (umumnya 25 menit)
                                diikuti oleh istirahat pendek (5 menit). Setelah beberapa sesi fokus, Anda mengambil
                                istirahat panjang (15-30 menit). Aplikasi kami akan memberi notifikasi dan membantu Anda
                                melacak siklus ini secara otomatis.
                            </p>
                            <p class="text-slate-900 text-sm sm:text-base"
                                style="font-family: 'Poppins', sans-serif; line-height: 1.7;">
                                Anda juga bisa menyesuaikan durasi sesi fokus dan istirahat sesuai preferensi Anda.
                            </p>
                        </div>
                    </div>

                    {{-- FAQ Item 3 --}}
                    <h2 id="accordion-faq-heading-3">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 sm:p-6 font-medium rtl:text-right border-b border-indigo-800 transition-colors duration-200 ease-in-out"
                            data-accordion-target="#accordion-faq-body-3" aria-expanded="false"
                            aria-controls="accordion-faq-body-3">
                            <span class="text-lg sm:text-xl" style="font-family: 'Poppins', sans-serif;">Apa itu fitur
                                Rank di PomoCat?</span>
                            <svg data-accordion-icon
                                class="w-4 h-4 sm:w-5 sm:h-5 rotate-0 shrink-0 transition-transform duration-200"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-faq-body-3" class="hidden" aria-labelledby="accordion-faq-heading-3">
                        <div class="p-5 sm:p-6 border-b border-indigo-800 bg-orange-500">
                            <p class="mb-2 text-slate-900 text-sm sm:text-base"
                                style="font-family: 'Poppins', cursive; line-height: 1.7;">
                                Fitur Rank adalah sistem gamifikasi untuk memotivasi Anda. Setiap sesi fokus yang berhasil
                                diselesaikan akan memberikan poin. Semakin banyak poin yang Anda kumpulkan, semakin tinggi
                                peringkat Anda di papan peringkat mingguan atau bulanan. Ini cara yang menyenangkan untuk
                                tetap konsisten dan melihat progres Anda!
                            </p>
                        </div>
                    </div>

                    {{-- FAQ Item 4 --}}
                    <h2 id="accordion-faq-heading-4">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 sm:p-6 font-medium rtl:text-right border-b border-indigo-800 transition-colors duration-200 ease-in-out"
                            data-accordion-target="#accordion-faq-body-4" aria-expanded="false"
                            aria-controls="accordion-faq-body-4">
                            <span class="text-lg sm:text-xl" style="font-family: 'Poppins', sans-serif;">Apa yang dimaksud
                                Manage Task di PomoCat?</span>
                            <svg data-accordion-icon
                                class="w-4 h-4 sm:w-5 sm:h-5 rotate-0 shrink-0 transition-transform duration-200"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-faq-body-4" class="hidden" aria-labelledby="accordion-faq-heading-4">
                        <div class="p-5 sm:p-6 bg-orange-500"> {{-- Item terakhir tidak perlu border-b --}}
                            <p class="mb-2 text-slate-900 text-sm sm:text-base"
                                style="font-family: 'Poppins', cursive; line-height: 1.7;">
                                Manage Task adalah fitur di mana Anda dapat membuat daftar tugas (to-do list) yang ingin
                                Anda kerjakan selama sesi Pomodoro. Anda bisa menambahkan, mengedit, menandai tugas sebagai
                                selesai, dan bahkan mengaitkan tugas tertentu dengan sesi fokus Anda. Ini membantu Anda
                                tetap terorganisir dan memastikan Anda mengerjakan tugas yang tepat.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endsection

    @push('styles')
        <style>
            /* Styling untuk ikon accordion agar berotasi dengan benar saat terbuka */
            [data-accordion-target][aria-expanded="true"] svg[data-accordion-icon] {
                transform: rotate(180deg);
            }

            [data-accordion-target][aria-expanded="false"] svg[data-accordion-icon] {
                transform: rotate(0deg);
            }

            /* Untuk memastikan kelas aktif Flowbite diterapkan dengan benar */
            #accordion-faq-pomocat [data-accordion-target][aria-expanded="true"] {
                /* Kelas yang didefinisikan di data-active-classes akan diterapkan di sini oleh Flowbite JS */
                /* Contoh: background-color: #F97316; color: #1E293B; */
            }

            #accordion-faq-pomocat [data-accordion-target][aria-expanded="false"] {
                /* Kelas yang didefinisikan di data-inactive-classes akan diterapkan di sini oleh Flowbite JS */
                /* Contoh: color: #D1D5DB; */
            }

            .testimonial-card-flowbite-side,
            .testimonial-card-flowbite-center {
                transition: transform 0.5s ease-out, opacity 0.5s ease-out, box-shadow 0.5s ease-out;
                will-change: transform, opacity, box-shadow;
            }

            .profile-glow {
                box-shadow: 0 0 15px 5px rgba(242, 165, 26, 0.6);
                /* Efek glow pada foto profil */
                transition: box-shadow 0.3s ease-in-out;
            }

            .testimonial-card-flowbite-center:hover .profile-glow {
                box-shadow: 0 0 25px 8px rgba(242, 165, 26, 0.8);
                /* Efek glow lebih kuat saat hover (opsional) */
            }
        </style>
    @endpush
