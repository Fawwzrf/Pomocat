@extends('layouts.admin')

@section('title', 'Ringkasan Pengguna')
@section('page-title', 'Ringkasan Aktivitas Pengguna')

@php
function sortable_link($title, $column, $currentSortBy, $currentSortDirection) {
    $direction = ($currentSortBy == $column && $currentSortDirection == 'asc') ? 'desc' : 'asc';
    $icon = '';
    if ($currentSortBy == $column) {
        $icon = $currentSortDirection == 'asc' ? '&#9650;' : '&#9660;';
    }
    $url = request()->fullUrlWithQuery(['sort_by' => $column, 'sort_direction' => $direction]);
    return '<a href="' . $url . '" class="inline-flex items-center gap-1">' . $title . '<span>' . $icon . '</span></a>';
}
@endphp

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <div class="flex items-center justify-end pb-4">
        <form method="GET" action="{{ route('admin.summary.index') }}">
            <div class="relative"><div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"><svg class="w-4 h-4 text-gray-500" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg></div>
                <input type="text" name="search" class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Cari nama pengguna..." value="{{ request('search') }}">
            </div>
        </form>
    </div>

    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                <tr>
                    <th scope="col" class="px-6 py-3">Pengguna</th>
                    <th scope="col" class="px-6 py-3 text-center">{!! sortable_link('Total Sesi', 'total_sessions', $currentSortBy, $currentSortDirection) !!}</th>
                    <th scope="col" class="px-6 py-3 text-center">{!! sortable_link('Total Jam Fokus', 'total_hours', $currentSortBy, $currentSortDirection) !!}</th>
                    <th scope="col" class="px-6 py-3 text-center">{!! sortable_link('Hari Diakses', 'days_accessed', $currentSortBy, $currentSortDirection) !!}</th>
                    <th scope="col" class="px-6 py-3 text-center">Rentetan Hari</th>
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
                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-center font-semibold">{{ $user->total_sessions }}</td>
                    <td class="px-6 py-4 text-center font-semibold">{{ $user->total_hours }} Jam</td>
                    <td class="px-6 py-4 text-center font-semibold">{{ $user->days_accessed }}</td>
                    <td class="px-6 py-4 text-center text-gray-400 italic">
                        (N/A)
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Tidak ada data untuk ditampilkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
     <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection