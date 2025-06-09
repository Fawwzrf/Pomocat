@extends('layouts.admin')

@section('title', 'Papan Peringkat')
@section('page-title', 'Papan Peringkat Pengguna')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex items-center justify-end pb-4">
        {{-- Form Pencarian --}}
        <form method="GET" action="{{ route('admin.ranking.index') }}">
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"><svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg></div>
                <input type="text" name="search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari nama pengguna..." value="{{ request('search') }}">
            </div>
        </form>
    </div>
    
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">Peringkat</th>
                    <th scope="col" class="px-6 py-3">Pengguna</th>
                    <th scope="col" class="px-6 py-3 text-center">Total Sesi</th>
                    <th scope="col" class="px-6 py-3 text-center">Total Jam Fokus</th>
                    {{-- KOLOM BARU UNTUK AKSI --}}
                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rankedUsers as $rankedUser)
                <tr class="bg-white border-b hover:bg-gray-50 {{ $rankedUser->id === Auth::id() ? 'bg-blue-50' : '' }}">
                    <td class="px-6 py-4 font-bold text-lg text-center text-gray-900">{{ $rankedUser->rank }}</td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                        <div class="flex items-center gap-x-3">
                            <img class="w-10 h-10 rounded-full object-cover" src="{{ $rankedUser->profile_photo_path ? asset('storage/'.$rankedUser->profile_photo_path) : 'https://img.icons8.com/fluency/96/user-male-circle.png' }}" alt="{{ $rankedUser->name }}">
                            <span>{{ $rankedUser->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center font-semibold">{{ $rankedUser->total_sessions }}</td>
                    <td class="px-6 py-4 text-center font-semibold">{{ $rankedUser->total_hours }} Jam</td>
                    {{-- TOMBOL AKSI BARU --}}
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-x-3">
                            <a href="{{ route('admin.users.edit', $rankedUser->id) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                            @if (Auth::id() !== $rankedUser->id) {{-- Tombol hapus tidak muncul untuk diri sendiri --}}
                            <form action="{{ route('admin.users.destroy', $rankedUser->id) }}" method="POST" onsubmit="return confirm('PERINGATAN: Menghapus pengguna akan menghapus SEMUA tugas mereka secara permanen. Apakah Anda yakin?');">
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
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data peringkat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection