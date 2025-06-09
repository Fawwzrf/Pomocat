{{-- File: resources/views/pomotime/partials/_report-detail-table.blade.php --}}

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="p-4 bg-yellow-50">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="detail-table-search" class="block pt-2 ps-10 text-sm text-indigo-900 border border-yellow-300 rounded-lg w-80 bg-white focus:ring-amber-500 focus:border-amber-500" placeholder="Cari tugas..." value="{{ request('search') }}">
        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-700">
        <thead class="text-xs text-amber-800 uppercase bg-yellow-200/50">
            <tr>
                <th scope="col" class="px-6 py-3">Tanggal Selesai</th>
                <th scope="col" class="px-6 py-3">Nama Tugas & Catatan</th>
                <th scope="col" class="px-6 py-3">Total Menit</th>
                <th scope="col" class="px-6 py-3"><span class="sr-only">Aksi</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($completedTasks as $task)
            <tr class="bg-white border-b hover:bg-yellow-50">
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $task->updated_at->format('d M Y, H:i') }}
                </td>
                <td class="px-6 py-4">
                    <div class="font-semibold text-indigo-950">{{ $task->title }}</div>
                    @if($task->notes)
                        <div class="text-xs text-gray-500">{{ $task->notes }}</div>
                    @endif
                </td>
                <td class="px-6 py-4">
                    {{ $task->sessions_completed * $pomodoroDuration }}
                </td>
                <td class="px-6 py-4 text-right">
                    {{-- Tombol hapus dapat ditambahkan di sini jika diperlukan --}}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada data yang cocok dengan pencarian Anda.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Render Link Paginasi --}}
<div class="mt-4 px-4">
    {{ $completedTasks->links() }}
</div>