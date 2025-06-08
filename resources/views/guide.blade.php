@extends('layouts.app')

@section('title', 'Panduan Pengguna - Pomo Cat')

@section('content')
<div class="w-full pt-28 pb-12" style="background: radial-gradient(circle, #F2A51A 0%, #EA6227 70%, #d35400 100%);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:gap-x-16">
            
            {{-- KOLOM KIRI: SIDEBAR NAVIGASI --}}
            <aside class="hidden lg:block w-64 flex-shrink-0">
                <div class="sticky top-10">
                    <h3 class="text-lg font-bold text-yellow-100 uppercase tracking-wider">Panduan Pengguna</h3>
                    <nav id="guide-nav" class="mt-6">
                        <ul class="space-y-3 text-base" data-spy="scroll" data-target="#main-content-guide" data-offset="120">
                            <li><a href="#apa-itu-pomodoro" class="block pl-4 py-1 border-l-2 border-transparent text-yellow-200/80 hover:text-white hover:border-amber-400">Apa Itu Pomodoro?</a></li>
                            <li><a href="#istilah-penting" class="block pl-4 py-1 border-l-2 border-transparent text-yellow-200/80 hover:text-white hover:border-amber-400">Istilah Penting</a></li>
                            <li><a href="#cara-penggunaan" class="block pl-4 py-1 border-l-2 border-transparent text-yellow-200/80 hover:text-white hover:border-amber-400">Cara Menggunakan</a></li>
                            <li><a href="#tips-pro" class="block pl-4 py-1 border-l-2 border-transparent text-yellow-200/80 hover:text-white hover:border-amber-400">Tips untuk Sukses</a></li>
                        </ul>
                    </nav>
                </div>
            </aside>

            {{-- KOLOM KANAN: KONTEN UTAMA & FOOTER --}}
            <div class="min-w-0 flex-1 flex flex-col p-6 bg-yellow-100 rounded-lg shadow-lg lg:shadow-none lg:bg-[#EA6227] lg:border lg:border-yellow-300/30">
                
                {{-- KONTEN UTAMA --}}
                <main id="main-content-guide" class="flex-grow">
                    <div class="space-y-12 text-yellow-100/90 leading-relaxed">

                        <section id="apa-itu-pomodoro" class="scroll-mt-24">
                            <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6">😹 Selamat Datang di Pomo Cat!</h1>
                            <p class="text-lg mb-4">Pernah merasa sulit untuk memulai pekerjaan? Atau mungkin perhatian Anda gampang teralihkan oleh notifikasi dan media sosial? Jangan khawatir, Anda tidak sendirian.</p>
                            <p class="text-lg mb-6">Pomo Cat hadir untuk membantu Anda mengatasi masalah tersebut dengan sebuah metode sederhana namun sangat kuat: <strong class="text-white font-semibold">Teknik Pomodoro</strong>.</p>
                            <blockquote class="border-l-4 border-amber-400 pl-6 italic text-yellow-100 my-6">Filosofi Inti: Bekerja dalam sprint pendek dan terfokus jauh lebih efektif daripada bekerja berjam-jam tanpa henti. Istirahat yang terencana bukanlah kemalasan, melainkan bagian penting dari produktivitas.</blockquote>
                        </section>

                        <section id="istilah-penting" class="scroll-mt-24">
                            <h2 class="text-3xl font-bold text-yellow-200 mt-12 mb-6 border-b border-yellow-400/30 pb-3">Istilah Penting di Pomo Cat</h2>
                            <h3 class="text-xl font-semibold text-amber-300 mt-6 mb-2">⭐ Sesi (Session)</h3>
                            <p class="mb-4">Secara umum, "Sesi" adalah satu blok waktu yang Anda alokasikan untuk sebuah aktivitas. Di Pomo Cat, ada dua jenis sesi utama: <strong class="text-white font-semibold">Sesi Fokus (Pomodoro)</strong> dan <strong class="text-white font-semibold">Sesi Istirahat (Break)</strong>. Saat Anda menambahkan tugas, Anda akan diminta untuk mengestimasi berapa banyak Sesi Fokus yang dibutuhkan. Setiap kali Anda menyelesaikan satu timer Pomodoro, angka sesi pada tugas Anda akan bertambah.</p>
                            <h3 class="text-xl font-semibold text-amber-300 mt-6 mb-2">Pomodoro (Sesi Fokus)</h3>
                            <p class="mb-4">Ini adalah satu blok waktu kerja tanpa gangguan (default 25 menit). Selama waktu ini, fokus Anda 100% hanya pada satu tugas.</p>
                            <h3 class="text-xl font-semibold text-amber-300 mt-6 mb-2">Istirahat Pendek & Panjang</h3>
                            <p class="mb-4">Setelah menyelesaikan satu Sesi Fokus, Anda berhak mendapatkan istirahat pendek (default 5 menit). Setelah 4 sesi, Anda mendapatkan istirahat panjang yang lebih lama (default 15 menit) untuk memulihkan energi sepenuhnya.</p>
                        </section>
                        
                        <section id="cara-penggunaan" class="scroll-mt-24">
                            <h2 class="text-3xl font-bold text-yellow-200 mt-12 mb-6 border-b border-yellow-400/30 pb-3">Cara Menggunakan Pomo Cat: 4 Langkah Mudah</h2>
                            <ol class="list-decimal list-inside space-y-3">
                                <li><strong class="text-white font-semibold">Tulis Tugas & Estimasi Sesi:</strong> Klik `+ Add Task`, tulis pekerjaan Anda, dan perkirakan berapa banyak "Sesi Pomodoro" yang dibutuhkan. Memecah tugas besar menjadi beberapa sesi kecil adalah kunci keberhasilan.</li>
                                <li><strong class="text-white font-semibold">Pilih Satu Tugas & Mulai Timer:</strong> Klik pada salah satu tugas untuk menjadikannya aktif, lalu tekan "Start".</li>
                                <li><strong class="text-white font-semibold">Bekerja dengan Fokus Penuh:</strong> Singkirkan semua gangguan hingga alarm berbunyi.</li>
                                <li><strong class="text-white font-semibold">Istirahat & Ulangi:</strong> Saat alarm berbunyi, selamat! Klik tombol "Short Break". Setelah istirahat, mulai lagi sesi berikutnya.</li>
                            </ol>
                        </section>

                        <section id="tips-pro" class="scroll-mt-24 ">
                            <h2 class="text-3xl font-bold text-yellow-200 mt-12 mb-6 border-b border-yellow-400/30 pb-3">Tips Pro untuk Sukses 🚀</h2>
                            <ul class="list-disc list-inside space-y-3">
                                <li><strong class="text-white font-semibold">Satu Pomodoro, Satu Tujuan:</strong> Jangan mengerjakan banyak hal dalam satu sesi.</li>
                                <li><strong class="text-white font-semibold">Lindungi Sesi Anda:</strong> Jika ada gangguan, catat dan segera kembali bekerja.</li>
                                <li><strong class="text-white font-semibold">Gunakan Istirahat dengan Bijak:</strong> Jangan membuka media sosial. Berdiri atau lakukan peregangan.</li>
                                <li><strong class="text-white font-semibold">Sesuaikan Waktu:</strong> Jika 25 menit tidak cocok, ubah durasi di halaman Profil Anda.</li>
                            </ul>
                            <p class="mt-6 text-lg mb-6">Siap untuk lebih produktif? Pilih tugas pertamamu dan <strong class="text-white font-semibold">mulai sesi Pomodoro sekarang!</strong></p>
                        </section>
                    </div>
                </main>
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        /* Kelas CSS untuk menandai link navigasi yang aktif pada Scrollspy */
        #guide-nav .scrollspy-active {
            color: white;
            border-left-color: #FBBF24;
            /* Warna kuning amber-400 */
            font-weight: 600;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 0 8px 8px 0;
        }

    </style>
@endpush
