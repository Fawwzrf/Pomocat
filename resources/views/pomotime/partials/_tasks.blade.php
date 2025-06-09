<div class=" p-5 sm:p-6 text-yellow-100">
    <div class="flex justify-between items-center mb-3">
        <h2 class="text-xl font-semibold" style="font-family: 'Poppins', sans-serif;">Tasks</h2>
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
            data-dropdown-placement="bottom-end" data-dropdown-offset-distance="10"
            class="text-yellow-100 bg-yellow-400/80 hover:bg-yellow-400 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center"
            type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-three-dots-vertical" viewBox="0 0 16 16">
                <path
                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
            </svg>
        </button>

        <div id="dropdown"
            class="z-10 hidden bg-yellow-100 border border-yellow-300 divide-y divide-yellow-200 rounded-lg shadow-lg w-52">
            <ul class="py-2 text-sm text-indigo-900" aria-labelledby="dropdownDefaultButton">
                <li>
                    <a href="#" id="clear-finished-tasks-btn"
                        class="flex items-center gap-x-2 px-4 py-2 hover:bg-yellow-200 transition-colors">
                        {{-- Ikon Opsional untuk memperjelas aksi --}}
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        Clear finished tasks
                    </a>
                </li>
                <li>
                    <a href="#" id="clear-all-tasks-btn"
                        class="flex items-center gap-x-2 px-4 py-2 text-red-700 hover:bg-red-100 transition-colors">
                        {{-- Ikon Opsional dan warna merah untuk aksi destruktif --}}
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.134-2.09-2.134H8.09a2.09 2.09 0 0 0-2.09 2.134v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Clear all tasks
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <hr class="border-yellow-400 stroke-2 mb-4">
    <div id="task-list" class="space-y-2 mb-4">
        {{-- Daftar task akan ditampilkan di sini oleh JavaScript --}}
    </div>
    <button id="add-task-btn"
        class="w-full border-2 border-dashed bg-yellow-400/50 hover:bg-yellow-400/80 border-indigo-950/50 hover:border-indigo-950 text-yellow-100/70 hover:text-yellow-100 font-medium py-2 px-4 rounded-lg transition-colors duration-150"
        style="font-family: 'Poppins', sans-serif;">
        + Add Task
    </button>
</div>