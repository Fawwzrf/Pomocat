@extends('layouts.app')

@section('title', 'Akun Saya')

@section('content')
<section class="min-h-screen py-8 md:py-8" style="background: radial-gradient(circle, #F2A51A 0%, #EA6227 70%, #d35400 100%);">
  <div class="mx-auto max-w-screen-lg px-4 2xl:px-0">
    <h2 class="mb-4 text-3xl font-bold text-yellow-100 dark:text-white md:mb-6">Profil & Laporan</h2>
    
    {{-- General Overview --}}
    <div class="grid grid-cols-2 gap-6 border-b-2 border-t-2 border-orange-400/50 py-6 md:py-8 lg:grid-cols-4 xl:gap-12">
        {{-- Card Peringkat --}}
        <div>
            <svg class="mb-2 h-8 w-8 text-yellow-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.083 5.104c.35-.8 1.485-.8 1.834 0l1.752 4.022a1 1 0 0 0 .84.597l4.463.342c.9.069 1.255 1.2.556 1.771l-3.33 2.723a1 1 0 0 0-.337 1.016l1.03 4.119c.214.858-.71 1.552-1.474 1.106l-3.913-2.281a1 1 0 0 0-1.008 0L7.583 20.8c-.764.446-1.688-.248-1.474-1.106l1.03-4.119A1 1 0 0 0 6.8 14.56l-3.33-2.723c-.698-.571-.342-1.702.557-1.771l4.462-.342a1 1 0 0 0 .84-.597l1.753-4.022Z"/></svg>
            <h3 class="mb-2 text-yellow-100 font-semibold">Peringkat Anda</h3>
            <span class="flex items-center text-3xl font-bold text-white">#{{ $reportData['rank'] ?? 'N/A' }}</span>
        </div>
        {{-- Card Total Sesi --}}
        <div>
            <svg class="mb-2 h-8 w-8 text-yellow-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6h6m6 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            <h3 class="mb-2 text-yellow-100 font-semibold">Total Sesi Fokus</h3>
            <span class="flex items-center text-3xl font-bold text-white">{{ $reportData['total_focus_sessions'] }}</span>
        </div>
        {{-- Card Total Jam --}}
        <div>
            <svg class="mb-2 h-8 w-8 text-yellow-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            <h3 class="mb-2 text-yellow-100 font-semibold">Total Jam Fokus</h3>
            <span class="flex items-center text-3xl font-bold text-white">{{ $reportData['total_focus_hours'] }}</span>
        </div>
        {{-- Card Tugas Selesai --}}
        <div>
            <svg class="mb-2 h-8 w-8 text-yellow-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5"/></svg>
            <h3 class="mb-2 text-yellow-100 font-semibold">Tugas Selesai</h3>
            <span class="flex items-center text-3xl font-bold text-white">{{ $reportData['tasks_completed'] }}</span>
        </div>
    </div>
    
    {{-- Konten Utama (Profil & Tabel) --}}
    <div class="py-4 md:py-8">
      <div class="grid gap-4 sm:grid-cols-2 sm:gap-8 lg:gap-16">
        
        {{-- Kolom Kiri: Detail Akun & Edit --}}
        <div class="space-y-6">
            {{-- Bagian Informasi Akun --}}
            <div class="p-6 bg-yellow-100/80 backdrop-blur-sm rounded-lg shadow-lg">
                <div class="flex items-center space-x-4">
                    <img id="photo-preview-main" class="h-20 w-20 rounded-full object-cover border-4 border-white" src="{{ Auth::user()->profile_photo_path ? asset('storage/'.Auth::user()->profile_photo_path) : 'https://img.icons8.com/fluency/96/user-male-circle.png' }}" alt="{{ $user->name }}" />
                    <div>
                      <h2 class="text-2xl font-bold text-indigo-950">{{ $user->name }}</h2>
                      <p class="text-sm text-slate-700">{{ $user->email }}</p>
                    </div>
                </div>
                <button type="button" data-modal-target="edit-profile-modal" data-modal-toggle="edit-profile-modal" class="mt-4 inline-flex w-full items-center justify-center rounded-lg bg-indigo-800 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-900 focus:outline-none focus:ring-4 focus:ring-indigo-300 sm:w-auto">
                    <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path></svg>
                    Edit Akun Anda
                </button>
            </div>
        </div>

        {{-- Kolom Kanan: Tabel Tugas Terbaru --}}
        <div class="p-4 bg-yellow-100/80 backdrop-blur-sm rounded-lg shadow-lg">
          <h3 class="mb-4 text-xl font-semibold text-indigo-950">Aktivitas Tugas Terakhir</h3>
          <div class="flow-root">
              <ul role="list" class="divide-y divide-yellow-300">
                  @forelse($latestTasks as $task)
                  <li class="py-3 sm:py-4">
                      <div class="flex items-center">
                          <div class="flex-1 min-w-0 ms-4">
                              <p class="text-sm font-medium text-indigo-900 truncate">{{ $task->title }}</p>
                              <p class="text-sm text-gray-600 truncate">
                                Selesai pada: {{ $task->updated_at->format('d M Y') }}
                              </p>
                          </div>
                          <div class="inline-flex items-center text-base font-semibold text-indigo-900">
                            {{ $task->sessions_completed * $pomodoroDuration }} menit
                          </div>
                      </div>
                  </li>
                  @empty
                  <li class="py-3 sm:py-4 text-center text-gray-500">Belum ada aktivitas.</li>
                  @endforelse
              </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="edit-profile-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <div class="relative bg-yellow-50 rounded-lg shadow">
            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="edit-profile-modal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="p-4 sm:p-8 space-y-6">
                {{-- Form untuk upload foto --}}
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-indigo-950">Foto Profil</h2>
                        <p class="mt-1 text-sm text-slate-700">Perbarui foto profil Anda.</p>
                    </header>
                    <form method="post" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="mt-6 flex items-center gap-6">
                        @csrf @method('post')
                        <img id="photo-preview" class="h-24 w-24 rounded-full object-cover" src="{{ Auth::user()->profile_photo_path ? asset('storage/'.Auth::user()->profile_photo_path) : 'https://img.icons8.com/fluency/96/user-male-circle.png' }}" alt="{{ Auth::user()->name }}">
                        <div>
                            <label for="photo" class="cursor-pointer bg-white text-indigo-800 font-semibold py-2 px-4 rounded-lg border border-indigo-300 hover:bg-indigo-50">Pilih Foto Baru</label>
                            <input id="photo" name="photo" type="file" class="hidden">
                            @error('photo')<p class="text-sm text-red-600 mt-2">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit" class="bg-indigo-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-900">Simpan Foto</button>
                        @if (session('status') === 'photo-updated')<p class="text-sm text-gray-600">Tersimpan.</p>@endif
                    </form>
                </section>
                <hr class="border-yellow-300">
                {{-- Form untuk info profil --}}
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-indigo-950">Informasi Profil</h2>
                        <p class="mt-1 text-sm text-slate-700">Perbarui nama dan alamat email akun Anda.</p>
                    </header>
                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                        @csrf @method('patch')
                        <div><label for="name" class="block font-medium text-sm text-indigo-800">Nama</label><input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" value="{{ old('name', $user->name) }}" required>@error('name')<span class="text-sm text-red-600">{{ $message }}</span>@enderror</div>
                        <div><label for="email" class="block font-medium text-sm text-indigo-800">Email</label><input id="email" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" value="{{ old('email', $user->email) }}" required>@error('email')<span class="text-sm text-red-600">{{ $message }}</span>@enderror</div>
                        <div class="flex items-center gap-4"><button type="submit" class="bg-indigo-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-900">Simpan Info</button>@if (session('status') === 'profile-updated')<p class="text-sm text-gray-600">Tersimpan.</p>@endif</div>
                    </form>
                </section>
                <hr class="border-yellow-300">
                {{-- Form untuk ubah password --}}
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-indigo-950">Ubah Password</h2>
                        <p class="mt-1 text-sm text-slate-700">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
                    </header>
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf @method('put')
                        <div><label for="update_password_current_password" class="block font-medium text-sm text-indigo-800">Password Saat Ini</label><input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" required>@error('current_password', 'updatePassword')<span class="text-sm text-red-600">{{ $message }}</span>@enderror</div>
                        <div><label for="update_password_password" class="block font-medium text-sm text-indigo-800">Password Baru</label><input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" required>@error('password', 'updatePassword')<span class="text-sm text-red-600">{{ $message }}</span>@enderror</div>
                        <div><label for="update_password_password_confirmation" class="block font-medium text-sm text-indigo-800">Konfirmasi Password</label><input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500" required></div>
                        <div class="flex items-center gap-4"><button type="submit" class="bg-indigo-800 text-white font-bold py-2 px-4 rounded-lg hover:bg-indigo-900">Simpan Password</button>@if (session('status') === 'password-updated')<p class="text-sm text-gray-600">Tersimpan.</p>@endif</div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Skrip untuk preview gambar profil
    document.addEventListener('DOMContentLoaded', () => {
        const photoInput = document.getElementById('photo');
        const photoPreview = document.getElementById('photo-preview-main');
        const modalPhotoPreview = document.getElementById('photo-preview');

        if (photoInput) {
            photoInput.addEventListener('change', () => {
                const file = photoInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        if(photoPreview) photoPreview.src = e.target.result;
                        if(modalPhotoPreview) modalPhotoPreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush