{{-- File: resources/views/pomotime/partials/_task-item.blade.php --}}

<div class="task-item group p-3 rounded-lg border-b-2 border-yellow-400/30 flex items-start gap-x-4 transition-colors {{ $task->completed ? 'opacity-60' : '' }} {{ ($activeTaskId ?? null) == $task->id ? 'bg-yellow-400/20' : '' }}"
    data-id="{{ $task->id }}">

    <div class="flex-none pt-1">
        <input type="checkbox" class="task-checkbox h-5 w-5 rounded-full bg-transparent border-2 border-indigo-950 text-indigo-950 focus:ring-0 cursor-pointer"
            data-id="{{ $task->id }}"
            {{ $task->completed ? 'checked' : '' }}>
    </div>

    <div class="flex-grow cursor-pointer" data-action="set-active">
        <span class="font-medium text-yellow-50 {{ $task->completed ? 'line-through' : '' }}">{{ $task->title }}</span>
        @if($task->notes)
            <p class="text-xs text-yellow-200/80 mt-1 font-light">{{ $task->notes }}</p>
        @endif
    </div>

    <div class="flex-none flex items-center gap-x-3 pl-2">
        <span class="font-semibold text-yellow-50">{{ $task->sessions_completed }}</span>
        <span class="text-yellow-200/80">/</span>
        <span class="text-yellow-200/80">{{ $task->sessions_needed }}</span>
        <button data-dropdown-toggle="task-options-{{ $task->id }}" class="p-1 rounded-md opacity-0 group-hover:opacity-100 transition-opacity hover:bg-yellow-400/50">
            <svg class="w-5 h-5 text-yellow-200" fill="currentColor" viewBox="0 0 16 16"><path d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/></svg>
        </button>
        <div id="task-options-{{ $task->id }}" class="z-50 hidden bg-yellow-100 divide-y divide-gray-100 rounded-lg shadow w-32">
            <ul class="py-1 text-sm text-indigo-900">
                <li><a href="#" class="task-edit-btn block px-4 py-2 hover:bg-yellow-200" data-id="{{ $task->id }}">Edit</a></li>
            </ul>
        </div>
    </div>
</div>