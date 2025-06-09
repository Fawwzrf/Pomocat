@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('page-title', 'Daftar Pengguna')

@section('content')
<div class="relative bg-white p-4 sm:p-6 rounded-lg shadow-md overflow-x-auto">
    <div class="flex items-center justify-between pb-4">
        <div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 text-sm font-medium rounded-lg hover:bg-indigo-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah User
            </a>
        </div>
        {{-- Form Pencarian --}}
        <form method="GET" action="{{ route('admin.users.index') }}">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg>
                </div>
                <input type="text" name="search" id="table-search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari berdasarkan nama atau email..." value="{{ request('search') }}">
            </div>
        </form>
    </div>
    
    @if(session('success')) <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4 text-sm">{{ session('success') }}</div> @endif
    @if(session('error')) <div class="bg-red-100 text-red-800 p-3 rounded-lg mb-4 text-sm">{{ session('error') }}</div> @endif

    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3">Pengguna</th>
                <th scope="col" class="px-6 py-3 text-center">Jumlah Tugas</th>
                <th scope="col" class="px-6 py-3 text-center">Total Jam Fokus</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Tanggal Bergabung</th>
                <th scope="col" class="px-6 py-3 text-right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr class="bg-white border-b hover:bg-gray-50">
                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    <div class="flex items-center gap-x-3">
                        <img class="w-10 h-10 rounded-full object-cover" src="{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : 'https://img.icons8.com/fluency/96/user-male-circle.png' }}" alt="{{ $user->name }}">
                        <div>
                            <div class="font-bold">{{ $user->name }}</div>
                            <div class="text-xs text-gray-500">{{ $user->email }} (ID: {{ $user->id }})</div>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-center">{{ $user->tasks_count }}</td>
                <td class="px-6 py-4 text-center font-semibold">
                    @php
                        $totalMinutes = ($user->tasks_sum_sessions_completed ?? 0) * ($user->setting_pomodoro ?? 25);
                        $totalHours = round($totalMinutes / 60, 1);
                    @endphp
                    {{ $totalHours }} Jam
                </td>
                <td class="px-6 py-4">
                    @if($user->is_admin)
                        <span class="px-2 py-1 text-xs font-semibold text-white bg-indigo-600 rounded-full">Admin</span>
                    @else
                        <span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-200 rounded-full">User</span>
                    @endif
                </td>
                <td class="px-6 py-4">{{ $user->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-x-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                        @if (Auth::id() !== $user->id) {{-- Tombol hapus tidak muncul untuk diri sendiri --}}
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('PERINGATAN: Menghapus pengguna akan menghapus SEMUA tugas mereka secara permanen. Apakah Anda yakin?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada pengguna ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection