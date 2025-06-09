@extends('layouts.admin')

@section('title', 'Manajemen Tugas')
@section('page-title', 'Daftar Semua Tugas')

@section('content')
<div class="relative bg-white p-4 sm:p-6 rounded-lg shadow-md overflow-x-auto">
    <div class="flex items-center justify-between pb-4">
        <a href="{{ route('admin.tasks.create') }}" class="inline-flex items-center bg-indigo-600 text-white px-4 py-2 text-sm font-medium rounded-lg hover:bg-indigo-700">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah Tugas
        </a>
        <form method="GET" action="{{ route('admin.tasks.index') }}">
            <div class="relative"><div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"><svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg></div><input type="text" name="search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari judul tugas atau nama..." value="{{ request('search') }}"></div>
        </form>
    </div>

    @if(session('success')) <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4 text-sm">{{ session('success') }}</div> @endif
    
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <th scope="col" class="px-6 py-3">Judul Tugas</th>
                <th scope="col" class="px-6 py-3">Pemilik</th>
                <th scope="col" class="px-6 py-3 text-center">Sesi</th>
                <th scope="col" class="px-6 py-3 text-center">Status</th>
                <th scope="col" class="px-6 py-3">Terakhir Diupdate</th>
                <th scope="col" class="px-6 py-3"><span class="sr-only">Aksi</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $task->title }}</th>
                <td class="px-6 py-4">{{ $task->user->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-center">{{ $task->sessions_completed }} / {{ $task->sessions_needed }}</td>
                <td class="px-6 py-4 text-center">
                    @if($task->deleted_at)<span class="px-2 py-1 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Dihapus</span>
                    @elseif($task->completed)<span class="px-2 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Selesai</span>
                    @else<span class="px-2 py-1 text-xs font-semibold text-gray-800 bg-gray-100 rounded-full">Aktif</span>@endif
                </td>
                <td class="px-6 py-4">{{ $task->updated_at->diffForHumans() }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-x-2">
                        <a href="{{ route('admin.tasks.edit', $task) }}" class="font-medium text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tugas ini?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="font-medium text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data tugas.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $tasks->links() }}</div>
</div>
@endsection