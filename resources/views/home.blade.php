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
            <div id="spline-container" class="absolute inset-0 w-full h-full -z-10">
                <iframe src='https://my.spline.design/landingpage-UhgQQhmrYUp6PzCeeqIiXZGN/' frameborder='0' width='100%'
                    height='100%'></iframe>
            </div>

            {{-- Konten Teks (tetap di depan dengan z-10) --}}
            <div
                class="relative z-10 w-full max-w-[68rem] mx-auto grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 lg:gap-x-12 items-start mt-80 mb-12 sm:mb-16 md:mb-20 lg:mb-24">
                {{-- Kolom Kiri --}}
                <div class="text-left">
                    <p class="text-base sm:text-md lg:text-lg mb-4 sm:mb-6"
                        style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Klik tombol berikut untuk memulai PomoCat!
                    </p>
                    <a href="{{ route('pomotime') }}"
                        class="inline-block bg-indigo-900 hover:bg-indigo-950 text-yellow-100 font-semibold py-2 px-4 sm:py-3 sm:px-6 rounded-lg text-sm sm:text-base transition duration-150"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                        Mulai Sekarang &gt;
                    </a>
                </div>
                {{-- Kolom Kanan --}}
                <div class="text-right pr-0 md:pr-5 rounded-lg">
                    <p
                        class="text-base sm:text-md lg:text-lg font-semibold mb-1 sm:mb-2"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
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
                <p
                    class="text-indigo-950 text-xs sm:text-sm md:text-base mb-0"style="font-family: 'Poppins', cursive; letter-spacing: -0.03em;">
                    Scroll untuk melihat lebih lanjut</p>
                <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-8 md:h-8 mx-auto" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke="#091057" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </section>

        {{-- HAPUS SECTION SERVICES LAMA ANDA --}}


        {{-- ======================================================= --}}
        {{-- == PERUBAHAN: SECTION SERVICES DENGAN DESAIN BARU == --}}
        {{-- ======================================================= --}}
        <section class="relative z-20 py-12 sm:py-16 md:py-20 lg:py-24"
            style="background: radial-gradient(circle, #F2A51A 0%, #EA6227 70%, #d35400 100%);">
            <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
                <div class="max-w-screen-base px-36 text-center mb-8 lg:mb-16">
                    <h2 class="mb-4 text-7xl tracking-tight font-semibold text-white"
                        style="font-family: 'Baloo Bhaijaan 2', cursive;">Services</h2>
                    <p class="text-yellow-100/90 sm:text-xl">
                        Dirancang untuk meningkatkan fokus dan produktivitas Anda, PomoCat menggabungkan teknik teruji
                        dengan fitur-fitur modern.
                    </p>
                </div>
                <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">

                    {{-- Fitur 1: Timer Pomodoro --}}
                    <div>
                        <div
                            class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-indigo-950 lg:h-12 lg:w-12">
                            <svg class="w-5 h-5 text-yellow-300 lg:w-6 lg:h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-white">Timer Pomodoro</h3>
                        <p class="text-yellow-100/90">Bagi pekerjaan Anda menjadi sesi fokus intens (Pomodoro) dan istirahat
                            teratur untuk menjaga stamina mental dan mencegah kelelahan.</p>
                    </div>

                    {{-- Fitur 2: Manajemen Tugas --}}
                    <div>
                        <div
                            class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-indigo-950 lg:h-12 lg:w-12">
                            <svg class="w-5 h-5 text-yellow-300 lg:w-6 lg:h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-white">Manajemen Tugas</h3>
                        <p class="text-yellow-100/90">Buat daftar tugas, estimasi berapa banyak sesi Pomodoro yang
                            dibutuhkan, dan lacak kemajuan Anda secara visual untuk setiap tugas.</p>
                    </div>

                    {{-- Fitur 3: Laporan & Analitik --}}
                    <div>
                        <div
                            class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-indigo-950 lg:h-12 lg:w-12">
                            <svg class="w-5 h-5 text-yellow-300 lg:w-6 lg:h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-white">Laporan Produktivitas</h3>
                        <p class="text-yellow-100/90">Pahami pola kerja Anda melalui ringkasan data, grafik aktivitas, dan
                            papan peringkat untuk terus termotivasi dan berkembang.</p>
                    </div>

                    {{-- Fitur 4: Kustomisasi Pengaturan --}}
                    <div>
                        <div
                            class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-indigo-950 lg:h-12 lg:w-12">
                            <svg class="w-5 h-5 text-yellow-300 lg:w-6 lg:h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-white">Pengaturan Fleksibel</h3>
                        <p class="text-yellow-100/90">Sesuaikan durasi timer, interval istirahat, dan notifikasi otomatis
                            agar sesuai dengan gaya kerja dan preferensi pribadi Anda.</p>
                    </div>

                    {{-- Fitur 5: Mode Tamu --}}
                    <div>
                        <div
                            class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-indigo-950 lg:h-12 lg:w-12">
                            <svg class="w-5 h-5 text-yellow-300 lg:w-6 lg:h-6" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="mb-2 text-xl font-bold text-white">Mode Tamu</h3>
                        <p class="text-yellow-100/90">Coba semua fitur inti PomoCat secara langsung tanpa perlu mendaftar.
                            Data Anda akan disimpan sementara di browser Anda.</p>
                    </div>

                    {{-- Fitur 6: Dashboard Admin --}}

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
                        <h2 class="mb-4 text-4xl lg:text-7xl tracking-tight font-semibold text-white"
                            style="font-family: 'Baloo Bhaijaan 2', cursive;">Our Teams</h2>
                        <p class="mb-4" style="font-family: 'Poppins', sans-serif;">Kami fokus pada setiap detail dari
                            apa
                            yang kami kerjakan. Semua itu untuk membantu orang-orang di seluruh dunia agar dapat fokus pada
                            hal yang paling penting bagi mereka.</p>
                        <p style="font-family: 'Poppins', sans-serif;">Bekerja bersama kami berarti Anda akan berinteraksi
                            dengan para profesional berbakat, ditantang untuk memecahkan masalah sulit, dan berpikir dengan
                            cara baru yang kreatif.</p>
                    </div>
                    {{-- Kolom Kanan: Daftar Anggota Tim --}}
                    <div class="space-y-8">
                        {{-- Anggota Tim 1: Fawwaz --}}
                        <div class="flex items-center gap-6">
                            <img class="w-32 h-32 rounded-full object-cover flex-shrink-0"
                                src="{{ asset('storage/images/profile_fawwaz.jpg') }}" alt="Fawwaz Avatar">
                            <div>
                                <h3 class="text-xl font-bold tracking-tight text-white"><a href="#">Fawwaz Aufa A.
                                        R.</a></h3>
                                <p class="text-amber-400">CEO/Co-founder</p>
                                <p class="mt-2 text-sm text-gray-300">Fawwaz memimpin arah strategis dan visi produk
                                    PomoCat, memastikan setiap fitur memberikan nilai maksimal untuk fokus dan produktivitas
                                    pengguna.</p>
                            </div>
                        </div>
                        {{-- Anggota Tim 2: Revalina --}}
                        <div class="flex items-center gap-6">
                            <img class="w-32 h-32 rounded-full object-cover flex-shrink-0"
                                src="{{ asset('storage/images/profile_fani.png') }}" alt="Revalina Avatar">
                            <div>
                                <h3 class="text-xl font-bold tracking-tight text-white"><a href="#">Revalina Fidiya
                                        A.</a></h3>
                                <p class="text-amber-400">Founder</p>
                                <p class="mt-2 text-sm text-gray-300">Sebagai penggagas awal, Revalina mengubah ide-ide
                                    kreatif menjadi pengalaman pengguna yang intuitif dan memotivasi di seluruh platform
                                    PomoCat.</p>
                            </div>
                        </div>
                        {{-- Anggota Tim 3: Isma --}}
                        <div class="flex items-center gap-6">
                            <img class="w-32 h-32 rounded-full object-cover flex-shrink-0"
                                src="{{ asset('storage/images/profile_isma.png') }}" alt="Isma Avatar">
                            <div>
                                <h3 class="text-xl font-bold tracking-tight text-white"><a href="#">Isma
                                        Fadhilatizzahra</a></h3>
                                <p class="text-amber-400">CTO</p>
                                <p class="mt-2 text-sm text-gray-300">Isma memimpin eksekusi teknis dan inovasi, memastikan
                                    platform PomoCat berjalan dengan cepat, andal, dan aman di semua perangkat.</p>
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
                    <h2 class="mb-4 text-7xl tracking-tight font-semibold text-white"
                        style="font-family: 'Baloo Bhaijaan 2', cursive;">Testimonials.</h2>
                    <p class="mb-8 font-light text-gray-300 lg:mb-16 sm:text-xl">Lihat apa kata pengguna kami tentang
                        PomoCat dalam membantu mereka menjadi lebih fokus dan produktif.</p>
                </div>
                <div id="testimonial-carousel" class="relative w-full" data-carousel="slide">
                    <div class="relative h-80 overflow-hidden rounded-lg md:h-96">
                        {{-- Item 1: Testimoni Alfan --}}
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <figure class="max-w-screen-md mx-auto h-full flex flex-col justify-center">
                                <svg class="h-10 mx-auto mb-3 text-amber-400" viewBox="0 0 24 27" fill="currentColor">
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" />
                                </svg>
                                <blockquote>
                                    <p class="text-xl sm:text-2xl font-medium text-white">"PomoCat sangat membantu aku
                                        dalam membagi waktu antara belajar dan istirahat. Fitur timernya bikin aku jadi
                                        lebih fokus dan tidak gampang teralihkan."</p>
                                </blockquote>
                                <figcaption class="flex items-center justify-center mt-6 space-x-3"><img
                                        class="w-8 h-8 rounded-full" src="{{ asset('storage/images/profile_alfan.jpg') }}"
                                        alt="profile picture">
                                    <div class="flex items-center divide-x-2 divide-gray-500"><cite
                                            class="pr-3 font-medium text-white">Alfan Fauzan</cite><cite
                                            class="pl-3 text-sm text-gray-400">Mahasiswa</cite></div>
                                </figcaption>
                            </figure>
                        </div>
                        {{-- Item 2: Testimoni Defit --}}
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <figure class="max-w-screen-md mx-auto h-full flex flex-col justify-center"><svg
                                    class="h-10 mx-auto mb-3 text-amber-400" viewBox="0 0 24 27" fill="currentColor">
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" />
                                </svg>
                                <blockquote>
                                    <p class="text-xl sm:text-2xl font-medium text-white">"Fokus eksekusi jadi meningkat
                                        sejak kenal PomoCat. Ada rasa senang tiap kali sesi selesai karena reward-nya yang
                                        lucu banget."</p>
                                </blockquote>
                                <figcaption class="flex items-center justify-center mt-6 space-x-3"><img
                                        class="w-8 h-8 rounded-full" src="{{ asset('storage/images/profile_defit.jpg') }}"
                                        alt="profile picture">
                                    <div class="flex items-center divide-x-2 divide-gray-500"><cite
                                            class="pr-3 font-medium text-white">Defit Bagus</cite><cite
                                            class="pl-3 text-sm text-gray-400">Pak Lurah</cite></div>
                                </figcaption>
                            </figure>
                        </div>
                        {{-- Item 3: Testimoni Bina --}}
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <figure class="max-w-screen-md mx-auto h-full flex flex-col justify-center"><svg
                                    class="h-10 mx-auto mb-3 text-amber-400" viewBox="0 0 24 27" fill="currentColor">
                                    <path
                                        d="M14.017 18L14.017 10.609C14.017 4.905 17.748 1.039 23 0L23.995 2.151C21.563 3.068 20 5.789 20 8H24V18H14.017ZM0 18V10.609C0 4.905 3.748 1.038 9 0L9.996 2.151C7.563 3.068 6 5.789 6 8H9.983L9.983 18L0 18Z" />
                                </svg>
                                <blockquote>
                                    <p class="text-xl sm:text-2xl font-medium text-white">"Sejak pakai PomoCat, manajemen
                                        waktu jadi jauh lebih teratur. Aku bisa menyelesaikan tugas satu per satu tanpa
                                        merasa stres."</p>
                                </blockquote>
                                <figcaption class="flex items-center justify-center mt-6 space-x-3"><img
                                        class="w-8 h-8 rounded-full" src="{{ asset('storage/images/profile_bina.jpg') }}"
                                        alt="profile picture">
                                    <div class="flex items-center divide-x-2 divide-gray-500"><cite
                                            class="pr-3 font-medium text-white">Bina Jenner</cite><cite
                                            class="pl-3 text-sm text-gray-400">Mahasiswi</cite></div>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev><span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 group-focus:ring-4 group-focus:ring-white/70"><svg
                                class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg><span class="sr-only">Previous</span></span></button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next><span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/20 hover:bg-white/30 group-focus:ring-4 group-focus:ring-white/70"><svg
                                class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg><span class="sr-only">Next</span></span></button>
                </div>
            </div>
        </section>

        {{-- ======================================================= --}}
        {{-- == SECTION FAQ BARU == --}}
        {{-- ======================================================= --}}
        <section class="relative z-20" style="background-color: #091057;">
            <div class="py-8 px-4 mx-auto max-w-screen-md lg:py-16 lg:px-6">
                <h2 class="mb-8 text-7xl tracking-tight font-semibold text-center text-white"
                    style="font-family: 'Baloo Bhaijaan 2', cursive;">
                    Faq
                </h2>

                {{-- Accordion Container --}}
                <div id="accordion-faq-pomocat" data-accordion="collapse"
                    data-active-classes="bg-orange-500/20 text-white"
                    data-inactive-classes="text-gray-300 hover:bg-indigo-950/50">

                    {{-- FAQ Item 1 --}}
                    <h2 id="accordion-faq-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right border-b border-indigo-800 transition-colors duration-200 ease-in-out"
                            data-accordion-target="#accordion-faq-body-1" aria-expanded="true"
                            aria-controls="accordion-faq-body-1">
                            <span class="text-base sm:text-lg lg:text-xl"
                                style="font-family: 'Poppins', sans-serif;">Apakah PomoCat bisa diakses di perangkat apa
                                saja?</span>
                            <svg data-accordion-icon class="w-4 h-4 rotate-180 shrink-0 transition-transform duration-200"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-faq-body-1" class="hidden" aria-labelledby="accordion-faq-heading-1">
                        <div class="p-5 border-b border-indigo-800 bg-orange-600/10">
                            <p class="mb-2 text-yellow-100/90" style="line-height: 1.7;">
                                Ya, PomoCat dirancang untuk fleksibel dan dapat diakses melalui browser web di komputer
                                desktop atau laptop Anda. Desainnya yang responsif juga memastikan pengalaman yang baik di
                                perangkat mobile.
                            </p>
                        </div>
                    </div>

                    {{-- FAQ Item 2 --}}
                    <h2 id="accordion-faq-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right border-b border-indigo-800 transition-colors duration-200 ease-in-out"
                            data-accordion-target="#accordion-faq-body-2" aria-expanded="false"
                            aria-controls="accordion-faq-body-2">
                            <span class="text-base sm:text-lg lg:text-xl"
                                style="font-family: 'Poppins', sans-serif;">Bagaimana cara kerja timer di PomoCat?</span>
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-faq-body-2" class="hidden" aria-labelledby="accordion-faq-heading-2">
                        <div class="p-5 border-b border-indigo-800 bg-orange-600/10">
                            <p class="mb-2 text-yellow-100/90" style="line-height: 1.7;">
                                Timer PomoCat mengikuti teknik Pomodoro klasik. Anda mengatur sesi fokus (umumnya 25 menit)
                                diikuti oleh istirahat pendek (5 menit). Setelah empat sesi fokus, Anda mengambil istirahat
                                panjang (15-30 menit). Aplikasi kami akan memberi notifikasi dan membantu Anda melacak
                                siklus ini secara otomatis.
                            </p>
                        </div>
                    </div>

                    {{-- FAQ Item 3 --}}
                    <h2 id="accordion-faq-heading-3">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right border-b-0 border-indigo-800 transition-colors duration-200 ease-in-out"
                            data-accordion-target="#accordion-faq-body-3" aria-expanded="false"
                            aria-controls="accordion-faq-body-3">
                            <span class="text-base sm:text-lg lg:text-xl"
                                style="font-family: 'Poppins', sans-serif;">Apakah data saya aman jika menggunakan Mode
                                Tamu?</span>
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform duration-200"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-faq-body-3" class="hidden" aria-labelledby="accordion-faq-heading-3">
                        <div class="p-5 border-b-0 border-indigo-800 bg-orange-600/10">
                            <p class="mb-2 text-yellow-100/90" style="line-height: 1.7;">
                                Tentu saja. Saat Anda menggunakan Mode Tamu, semua data tugas dan pengaturan Anda disimpan
                                secara lokal hanya di browser Anda menggunakan `localStorage`. Data tersebut tidak pernah
                                dikirim atau disimpan di server kami. Jika Anda membersihkan cache browser, data tersebut
                                akan hilang.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        // Pastikan DOM sudah siap
        document.addEventListener('DOMContentLoaded', function() {
            gsap.registerPlugin(ScrollTrigger);

            const splineContainer = document.getElementById('spline-container');
            const splineViewer = splineContainer ? splineContainer.querySelector('spline-viewer') : null;
            const heroSection = document.querySelector('section.min-h-screen'); // Ambil referensi ke section hero

            if (splineContainer && splineViewer && heroSection) {
                // Buat ScrollTrigger
                ScrollTrigger.create({
                    trigger: heroSection, // Trigger saat section hero tidak lagi terlihat
                    start: "bottom top", // Saat bagian bawah hero mencapai bagian atas viewport
                    // end: "bottom top", // Tidak perlu end jika hanya ingin sekali trigger
                    onEnter: () => {
                        // Ketika hero section sudah tidak terlihat (scroll ke bawah)
                        if (splineViewer.parentNode) {
                            splineViewer.parentNode.style.display = 'none'; // Sembunyikan container
                        }
                        if (splineViewer && typeof splineViewer.stop === 'function') {
                            splineViewer.stop(); // Hentikan animasi spline
                            console.log('Spline stopped and hidden');
                        }
                    },
                    onLeaveBack: () => {
                        // Ketika kembali ke hero section (scroll ke atas)
                        if (splineViewer.parentNode) {
                            splineViewer.parentNode.style.display =
                                'block'; // Tampilkan kembali container
                        }
                        if (splineViewer && typeof splineViewer.start === 'function') {
                            splineViewer.start(); // Mulai kembali animasi spline
                            console.log('Spline started and shown');
                        }
                    },
                    // markers: true // Hapus ini di produksi, hanya untuk debugging
                });
            } else {
                console.warn("Spline container, viewer, or hero section not found.");
            }
        });
    </script>
@endpush
