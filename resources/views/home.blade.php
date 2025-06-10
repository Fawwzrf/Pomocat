@extends('layouts.app')

@section('title', 'PomoCat - Focus Timer & To-Do List')

@section('content')
    <div class="relative overflow-x-hidden">

        {{-- ======================================================= --}}
        {{-- == SECTION HERO (DENGAN 3D BACKGROUND & Z-INDEX BARU) == --}}
        {{-- ======================================================= --}}
        <section class="relative isolate flex flex-col items-center justify-start min-h-screen text-yellow-100 pt-20 px-4">

            {{-- Teks Besar POMOCAT (diberi z-index negatif agar di belakang) --}}
            <h1 class="absolute top-36 left-1/2 -translate-x-1/2 text-6xl sm:text-8xl md:text-[120px] lg:text-[200px] xl:text-[290px] font-bold tracking-wider -z-20"
                style="font-family: 'Baloo Bhaijaan 2', cursive; font-weight: 800; letter-spacing: -0.04em;">
                POMOCAT
            </h1>

            {{-- Wadah untuk Spline Viewer (di tengah) --}}
            <div class="absolute inset-0 w-full h-full -z-10">
                <script type="module" src="https://unpkg.com/@splinetool/viewer@1.10.2/build/spline-viewer.js"></script>
                <spline-viewer loading-anim-type="spinner-small-light" url="https://prod.spline.design/g9fY1TzK6xQEu6Hl/scene.splinecode"></spline-viewer>
            </div>

            {{-- Konten Teks (tetap di depan dengan z-10) --}}
            <div class="relative z-10 w-full max-w-[68rem] mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 lg:gap-x-12 items-start mt-80 mb-12 sm:mb-16 md:mb-20 lg:mb-24">
                {{-- Kolom Kiri --}}
                <div class="text-left">
                    <p class="text-base sm:text-md lg:text-lg mb-4 sm:mb-6" style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Klik tombol berikut untuk memulai PomoCat!
                    </p>
                    <a href="{{ route('pomotime') }}" class="inline-block bg-indigo-900 hover:bg-indigo-950 text-yellow-100 font-semibold py-2 px-4 sm:py-3 sm:px-6 rounded-lg text-sm sm:text-base transition duration-150"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Mulai Sekarang &gt;
                    </a>
                </div>
                {{-- Kolom Kanan --}}
                <div class="text-right pr-0 md:pr-5 rounded-lg">
                    <p class="text-base sm:text-md lg:text-lg font-semibold mb-1 sm:mb-2"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Hai, aku PomoCat!
                    </p>
                    <p class="text-sm sm:text-base"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Siap bantu kamu fokus, istirahat, dan ulangi lagi.
                    </p>
                    <p class="text-sm sm:text-base"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Yuk mulai waktumu!
                    </p>
                </div>
            </div>

            {{-- Scroll Indikator (tetap di depan dengan z-10) --}}
            <div class="relative -bottom-10 text-center w-full animate-bounce z-10">
                <p class="text-indigo-950 text-xs sm:text-sm md:text-base mb-0"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                    Scroll untuk melihat lebih lanjut</p>
                <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke="#091057" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </section>

    {{-- ======================================================= --}}
    {{-- == SECTION SERVICES == --}}
    {{-- ======================================================= --}}
    <section class="relative z-20 w-full py-12 sm:py-16 md:py-20 lg:py-24 px-4" style="background: radial-gradient(circle, #F2A51A 0%, #EA6227 70%, #d35400 100%);">
        <div class="max-w-6xl mx-auto text-center">
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-semibold text-yellow-100 mb-3 sm:mb-4 relative inline-block pb-1 sm:pb-2" style="font-family: 'Baloo Bhaijaan 2', cursive;">
                Services
            </h2>
            <p class="text-sm sm:text-base lg:text-lg text-yellow-100 max-w-xs sm:max-w-md md:max-w-lg lg:max-w-2xl mx-auto mb-8 sm:mb-12 md:mb-16" style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                Akses sesi fokusmu di mana saja, baik melalui web maupun aplikasi mobile. PomoCat siap membantumu tetap produktif kapan pun dan di mana pun.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 lg:gap-12">
                {{-- Service Card 1: Timer --}}
                <div class="group p-6 sm:p-8 pb-4 rounded-3xl text-yellow-100 transform hover:scale-105 transition-transform duration-300">
                    <div class="rounded-[35px] h-[200px] sm:h-[220px] md:h-[200px] lg:h-[250px] flex items-center justify-center p-1 transition-all duration-300 group-hover:shadow-[0_0_25px_8px_#091057]" style="background: radial-gradient(circle , #1423BD 0%, #091057 100%);">
                        <img src="{{ asset('storage/images/clock.png') }}" alt="Timer Icon" class="max-h-[50%] sm:max-h-[60%] w-auto">
                    </div>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-semibold mb-2 sm:mb-3 mt-4 sm:mt-6" style="font-family: 'Poppins', cursive;">Timer</h3>
                    <p class="text-xs sm:text-sm lg:text-base" style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">Gunakan timer Pomodoro untuk membagi waktu menjadi sesi fokus dan istirahat secara teratur, agar tetap produktif tanpa merasa kewalahan.</p>
                </div>
                {{-- Service Card 2: Manage Task --}}
                <div class="group p-6 sm:p-8 pb-4 rounded-3xl text-yellow-100 transform hover:scale-105 transition-transform duration-300">
                    <div class="rounded-[35px] h-[200px] sm:h-[220px] md:h-[200px] lg:h-[250px] flex items-center justify-center p-1 transition-all duration-300 group-hover:shadow-[0_0_25px_8px_#1423BD]" style="background: radial-gradient(circle , #091057 0%, #1423BD 100% );">
                        <img src="{{ asset('storage/images/task.png') }}" alt="Manage Task Icon" class="max-h-[50%] sm:max-h-[60%] w-auto">
                    </div>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-semibold mb-2 sm:mb-3 mt-4 sm:mt-6" style="font-family: 'Poppins', cursive;">Manage Task</h3>
                    <p class="text-xs sm:text-sm lg:text-base" style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">Atur dan pantau daftar tugasmu dengan mudah buat, edit, dan tandai tugas selesai agar pekerjaanmu lebih terorganisir.</p>
                </div>
                {{-- Service Card 3: Rank --}}
                <div class="group p-6 sm:p-8 pb-4 rounded-3xl text-yellow-100 transform hover:scale-105 transition-transform duration-300">
                    <div class="rounded-[35px] h-[200px] sm:h-[220px] md:h-[200px] lg:h-[250px] flex items-center justify-center p-1 transition-all duration-300 group-hover:shadow-[0_0_25px_8px_#091057]" style="background: radial-gradient(circle , #1423BD 0%, #091057 100%);">
                        <img src="{{ asset('storage/images/rank.png') }}" alt="Rank Icon" class="max-h-[50%] sm:max-h-[60%] w-auto">
                    </div>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-semibold mb-2 sm:mb-3 mt-4 sm:mt-6" style="font-family: 'Poppins', cursive;">Rank</h3>
                    <p class="text-xs sm:text-sm lg:text-base" style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">Dapatkan peringkat berdasarkan jumlah sesi fokus yang kamu selesaikan. Semakin fokus, semakin tinggi posisimu di papan peringkat!</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ======================================================= --}}
    {{-- == SECTION OUR TEAMS (DESAIN BARU) == --}}
    {{-- ======================================================= --}}
    <section class="relative z-20 py-12 sm:py-16 md:py-20 lg:py-24" style="background-color: #091057;">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="grid gap-8 lg:gap-16 lg:grid-cols-2">
                {{-- Kolom Kiri: Teks Deskripsi --}}
                <div class="font-light text-gray-300 sm:text-lg">
                    <h2 class="mb-4 text-4xl lg:text-7xl tracking-tight font-semibold text-white" style="font-family: 'Baloo Bhaijaan 2', cursive;">Our Teams</h2>
                    <p class="mb-4" style="font-family: 'Poppins', sans-serif;">Kami fokus pada setiap detail dari apa yang kami kerjakan. Semua itu untuk membantu orang-orang di seluruh dunia agar dapat fokus pada hal yang paling penting bagi mereka.</p>
                    <p style="font-family: 'Poppins', sans-serif;">Bekerja bersama kami berarti Anda akan berinteraksi dengan para profesional berbakat, ditantang untuk memecahkan masalah sulit, dan berpikir dengan cara baru yang kreatif.</p>
                </div>
                {{-- Kolom Kanan: Daftar Anggota Tim --}}
                <div class="space-y-8">
                    {{-- Anggota Tim 1: Fawwaz --}}
                    <div class="flex items-center gap-6">
                        <img class="w-32 h-32 rounded-full object-cover flex-shrink-0" src="{{ asset('storage/images/profile_fawwaz.jpg') }}" alt="Fawwaz Avatar">
                        <div>
                            <h3 class="text-xl font-bold tracking-tight text-white"><a href="#">Fawwaz Aufa A. R.</a></h3>
                            <p class="text-amber-400">CEO/Co-founder</p>
                            <p class="mt-2 text-sm text-gray-300">Fawwaz memimpin arah strategis dan visi produk PomoCat, memastikan setiap fitur memberikan nilai maksimal untuk fokus dan produktivitas pengguna.</p>
                        </div>
                    </div>
                    {{-- Anggota Tim 2: Revalina --}}
                    <div class="flex items-center gap-6">
                        <img class="w-32 h-32 rounded-full object-cover flex-shrink-0" src="{{ asset('storage/images/profile_fani.png') }}" alt="Revalina Avatar">
                        <div>
                            <h3 class="text-xl font-bold tracking-tight text-white"><a href="#">Revalina Fidiya A.</a></h3>
                            <p class="text-amber-400">Founder</p>
                            <p class="mt-2 text-sm text-gray-300">Sebagai penggagas awal, Revalina mengubah ide-ide kreatif menjadi pengalaman pengguna yang intuitif dan memotivasi di seluruh platform PomoCat.</p>
                        </div>
                    </div>
                    {{-- Anggota Tim 3: Isma --}}
                    <div class="flex items-center gap-6">
                        <img class="w-32 h-32 rounded-full object-cover flex-shrink-0" src="{{ asset('storage/images/profile_isma.png') }}" alt="Isma Avatar">
                        <div>
                            <h3 class="text-xl font-bold tracking-tight text-white"><a href="#">Isma Fadhilatizzahra</a></h3>
                            <p class="text-amber-400">CTO</p>
                            <p class="mt-2 text-sm text-gray-300">Isma memimpin eksekusi teknis dan inovasi, memastikan platform PomoCat berjalan dengan cepat, andal, dan aman di semua perangkat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ======================================================= --}}
    {{-- == SECTION TESTIMONIALS (DESAIN BARU) == --}}
    {{-- ======================================================= --}}
    <section class="relative z-20 py-12 sm:py-16 md:py-20 lg:py-24" style="background-color: #091057;">
        <div class="max-w-screen-xl px-4 py-8 mx-auto text-center lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm">
                <h2 class="mb-4 text-7xl tracking-tight font-semibold text-white" style="font-family: 'Baloo Bhaijaan 2', cursive;">Testimonials.</h2>
                <p class="mb-8 font-light text-gray-300 lg:mb-16 sm:text-xl">Lihat apa kata pengguna kami tentang PomoCat dalam membantu mereka menjadi lebih fokus dan produktif.</p>
            </div>
            <div id="testimonial-carousel" class="relative w-full" data-carousel="slide">
                <div class="relative h-80 overflow-hidden rounded-lg md:h-96">
                    {{-- Item 1: Testimoni Alfan --}}
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <figure class="max-w-screen-md mx-auto h-full flex flex-col justify-center">
                            <svg class="h-10 mx-auto mb-3 text-amber-400" viewBox="0 0 24 27" fill="currentColor"><path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" /></svg> 
                            <blockquote><p class="text-xl sm:text-2xl font-medium text-white">"PomoCat sangat membantu aku dalam membagi waktu antara belajar dan istirahat. Fitur timernya bikin aku jadi lebih fokus dan tidak gampang teralihkan."</p></blockquote>
                            <figcaption class="flex items-center justify-center mt-6 space-x-3"><img class="w-8 h-8 rounded-full" src="{{ asset('storage/images/profile_alfan.jpg') }}" alt="profile picture"><div class="flex items-center divide-x-2 divide-gray-500"><cite class="pr-3 font-medium text-white">Alfan Fauzan</cite><cite class="pl-3 text-sm text-gray-400">Mahasiswa</cite></div></figcaption>
                        </figure>
                    </div>
                    {{-- Item 2: Testimoni Defit --}}
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <figure class="max-w-screen-md mx-auto h-full flex flex-col justify-center"><svg class="h-10 mx-auto mb-3 text-amber-400" viewBox="0 0 24 27" fill="currentColor"><path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" /></svg> 
                        <blockquote><p class="text-xl sm:text-2xl font-medium text-white">"Fokus eksekusi jadi meningkat sejak kenal PomoCat. Ada rasa senang tiap kali sesi selesai karena reward-nya yang lucu banget."</p></blockquote>
                        <figcaption class="flex items-center justify-center mt-6 space-x-3"><img class="w-8 h-8 rounded-full" src="{{ asset('storage/images/profile_defit.jpg') }}" alt="profile picture"><div class="flex items-center divide-x-2 divide-gray-500"><cite class="pr-3 font-medium text-white">Defit Bagus</cite><cite class="pl-3 text-sm text-gray-400">Pak Lurah</cite></div></figcaption>
                        </figure>
                    </div>
                    {{-- Item 3: Testimoni Bina --}}
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <figure class="max-w-screen-md mx-auto h-full flex flex-col justify-center"><svg class="h-10 mx-auto mb-3 text-amber-400" viewBox="0 0 24 27" fill="currentColor"><path d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" /></svg> 
                        <blockquote><p class="text-xl sm:text-2xl font-medium text-white">"Sejak pakai PomoCat, manajemen waktu jadi jauh lebih teratur. Aku bisa menyelesaikan tugas satu per satu tanpa merasa stres."</p></blockquote>
                        <figcaption class="flex items-center justify-center mt-6 space-x-3"><img class="w-8 h-8 rounded-full" src="{{ asset('storage/images/profile_bina.jpg') }}" alt="profile picture"><div class="flex items-center divide-x-2 divide-gray-500"><cite class="pr-3 font-medium text-white">Bina Jenner</cite><cite class="pl-3 text-sm text-gray-400">Mahasiswi</cite></div></figcaption>
                        </figure>
                    </div>
                </div>
                <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev><span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 group-focus:ring-4 group-focus:ring-white/70"><svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/></svg><span class="sr-only">Previous</span></span></button>
                <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next><span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 group-focus:ring-4 group-focus:ring-white/70"><svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/></svg><span class="sr-only">Next</span></span></button>
            </div>
        </div>
    </section>
</div>
@endsection