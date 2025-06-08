{{-- File: resources/views/pomotime/partials/_task-list.blade.php --}}

@forelse ($tasks as $task)
    @include('pomotime.partials._task-item', ['task' => $task, 'activeTaskId' => $activeTaskId ?? null])
@empty
    <p class="text-center text-yellow-100/50">Belum ada tugas. Tambahkan satu!</p>
@endforelse