# Pomocat

Pomocat adalah aplikasi web manajemen waktu berbasis metode Pomodoro yang mengintegrasikan pencatatan tugas, pelaporan performa, dan leaderboard interaktif menggunakan Laravel 12, Tailwind CSS 4, dan Flowbite.

---

## Fitur Utama

- **Interactive Pomodoro Timer**: Pengatur waktu fokus, istirahat pendek, dan istirahat panjang dengan integrasi model Spline 3D yang dinamis.
- **Task Management**: Manajemen daftar tugas (to-do list) dengan penyimpanan lokal untuk tamu (local storage) dan penyimpanan database untuk pengguna terautentikasi.
- **Productivity Report**: Dasbor statistik fokus yang mencakup total menit fokus, grafik ApexCharts harian, dan ekspor laporan ke format CSV.
- **Leaderboard / Ranking**: Peringkat pengguna real-time dengan visualisasi podium untuk 3 besar dan pencarian dinamis.
- **Personalized Settings**: Kustomisasi durasi sesi fokus, waktu istirahat, interval istirahat panjang, serta fitur otomatisasi pergantian tugas.
- **Admin Panel**: Dasbor khusus admin untuk mengelola pengguna, memantau data tugas, dan melihat ringkasan statistik sistem.

## Teknologi Utama

- **Backend**: PHP 8.2+, Laravel 12.x
- **Frontend**: Blade Templating, Tailwind CSS v4, Flowbite v3, GSAP (animasi), ApexCharts
- **Interaktivitas 3D**: Spline 3D Viewer
- **Database**: SQLite / MySQL

## Cara Instalasi & Menjalankan Proyek

1. **Clone repositori ini**:
   ```bash
   git clone https://github.com/Fawwzrf/pomocat.git
   cd pomocat
   ```

2. **Instal Dependensi PHP & Node.js**:
   ```bash
   composer install
   npm install
   ```

3. **Salin berkas konfigurasi lingkungan**:
   ```bash
   cp .env.example .env
   ```
   *Sesuaikan pengaturan database di berkas `.env` jika diperlukan.*

4. **Buat Application Key & Jalankan Migrasi**:
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```

5. **Jalankan Aplikasi secara Lokal**:
   ```bash
   # Menjalankan server lokal dan Vite secara bersamaan (kombinasi dev command bawaan pomocat)
   composer dev
   ```

6. **Build Aset Frontend**:
   ```bash
   npm run build
   ```

## Lisensi

Proyek ini dilisensikan di bawah [MIT license](LICENSE).
