@extends('layouts.app') {{-- Asumsikan Anda memiliki layout utama --}}

@section('title', 'PomoTime - Focus Timer')

@section('content')
    {{-- Kontainer utama halaman dengan background gradien --}}
    <div class="min-h-screen flex justify-center items-start m-0">

        {{-- Kontainer untuk PomoTime dan Tasks, mengatur lebar dan posisi --}}
        <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-7xl flex flex-col lg:flex-row lg:gap-x-20 px-4">

            {{-- Kolom Utama untuk PomoTime dan Tasks --}}
            <div class="w-full lg:w-[500px] shrink-0">

                {{-- Kontainer Timer --}}
                <div
                    class="bg-yellow-400/80 drop-shadow-yellow-400 backdrop-blur-sm p-6 sm:p-8 rounded-[40px] shadow-2xl mb-8">
                    {{-- Tombol Mode Timer --}}
                    <div class="flex justify-center space-x-2 sm:space-x-3 mb-6">
                        <button
                            class="pomotime-mode-btn active-mode text-sm sm:text-lg font-semibold py-1 px-4 rounded-full border-2 border-indigo-950 text-indigo-950 bg-yellow-100/70 hover:bg-yellow-100 transition-all">Pomodoro</button>
                        <button
                            class="pomotime-mode-btn text-sm sm:text-lg font-semibold py-1 px-4 rounded-full border-2 border-indigo-950 text-indigo-950 hover:bg-yellow-100 transition-all">Short
                            Break</button>
                        <button
                            class="pomotime-mode-btn text-sm sm:text-lg font-semibold py-1 px-4 rounded-full border-2 border-indigo-950 text-indigo-950 hover:bg-yellow-100 transition-all">Long
                            Break</button>
                    </div>

                    {{-- Timer Visual --}}
                    <div class="relative w-48 h-48 sm:w-80 sm:h-80 mx-auto mb-6">
                        <svg class="w-full h-full" viewBox="0 0 100 100">
                            <circle class="text-black/10" stroke-width="5" stroke="currentColor" fill="transparent" r="45"
                                cx="50" cy="50" />
                            <circle class="text-yellow-100/20" stroke-width="5" stroke="currentColor" fill="transparent"
                                r="45" cx="50" cy="50" transform="translate(0.5, 0.5)" />

                            <circle id="progress-circle" class="progress-shadow transition-all duration-500"
                                {{-- <-- Kelas baru untuk efek 3D --}} stroke-width="4" stroke-linecap="round" stroke="currentColor"
                                fill="transparent" r="45" cx="50" cy="50"
                                style="stroke-dasharray: 282.743; stroke-dashoffset: 0; transform: rotate(-90deg); transform-origin: 50% 50%;" />
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-800">
                            <div class="w-6 h-6 sm:w-20 sm:h-20 mt-[-40px] ">
                                <img id="timer-logo" width="96" height="96"
                                    src="https://img.icons8.com/emoji/96/glasses-emoji.png" alt="timer-logo" />
                            </div>
                            <div class="text-yellow-100 drop-shadow-[0_4px_4px_rgba(9,16,87,1)] text-4xl sm:text-8xl font-bold"
                                style="font-family: 'Baloo Bhaijaan 2', cursive; font-weight: 800;" id="time-display">25:00
                            </div>
                            <div class="text-xs sm:text-xl font-bold tracking-wider mt-1 transition-colors duration-500"
                                id="mode-label">
                                FOCUS</div>
                        </div>
                    </div>

                    {{-- Tombol Kontrol Timer --}}
                    <div class="flex justify-center gap-6 items-center">
                        <button id="reset-btn" class="text-indigo-900 hover:text-indigo-950 transition-colors">
                            <svg class="w-7 h-7 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.158-2m15.158 2H15">
                                </path>
                            </svg>
                        </button>
                        <button id="start-pause-btn"
                            class="border-2 border-indigo-950 text-indigo-950 bg-yellow-100/70 hover:bg-yellow-100 transition-all font-semibold py-1 px-8 sm:px-10 rounded-full text-lg shadow-md hover:shadow-lg transform hover:scale-105"
                            style="font-family: 'Poppins', sans-serif;">
                            Start
                        </button>
                        <button id="settings-btn" class="text-indigo-900 hover:text-indigo-950 transition-colors">
                            <svg class="w-7 h-7 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Bagian Tasks --}}
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
            </div>

            {{-- Kolom Kanan Kosong (hanya muncul di layar besar untuk memberi ruang) --}}
            <div class="hidden lg:block lg:flex-grow">
                {{-- Kolom ini akan mengambil sisa ruang di kanan pada layar lg ke atas --}}
            </div>
        </div>
    </div>

    <div id="add-task-modal" class="hidden fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">

        {{-- Modal Panel --}}
        <div class="bg-yellow-100 w-full max-w-md p-6 rounded-2xl shadow-xl">
            <form id="add-task-form">

                <div class="relative mb-6">
                    <input type="text" id="task-title-input"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-lg text-gray-900 bg-transparent rounded-lg border-2 border-yellow-500 appearance-none focus:outline-none focus:ring-0 focus:border-yellow-600 peer"
                        placeholder=" " required />
                    <label for="task-title-input"
                        class="absolute text-lg text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-yellow-100 px-2 peer-focus:px-2 peer-focus:text-yellow-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">Judul
                        Task</label>
                </div>

                <div class="mb-6">
                    <label for="quantity-input" class="block mb-2 text-sm font-bold text-amber-700">Jumlah Sesi
                        PomoCat</label>
                    <div class="relative flex items-center max-w-[10rem]">
                        <button type="button" data-input-counter-decrement="quantity-input"
                            class="bg-yellow-300 hover:bg-yellow-400 border border-yellow-400 rounded-s-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 2">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 1h16" />
                            </svg>
                        </button>
                        <input type="text" id="quantity-input" data-input-counter data-input-counter-min="1"
                            data-input-counter-max="20" value="1"
                            class="bg-white border-x-0 border-yellow-400 h-11 text-center text-gray-900 text-sm focus:ring-yellow-500 focus:border-yellow-500 block w-full py-2.5"
                            required />
                        <button type="button" data-input-counter-increment="quantity-input"
                            class="bg-yellow-300 hover:bg-yellow-400 border border-yellow-400 rounded-e-lg p-3 h-11 focus:ring-gray-100 focus:ring-2 focus:outline-none">
                            <svg class="w-3 h-3 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="relative">
                    <textarea id="task-notes" rows="3"
                        class="block rounded-lg px-2.5 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-white/50 border-0 border-b-2 border-yellow-400 appearance-none focus:outline-none focus:ring-0 focus:border-yellow-600 peer"
                        placeholder=" "></textarea>
                    <label for="task-notes"
                        class="absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-4 z-10 origin-[0] start-2.5 peer-focus:text-yellow-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Catatan
                        (opsional)</label>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-end gap-x-3 mt-6">
                    <button type="button" id="modal-cancel-btn"
                        class="bg-yellow-500 hover:bg-yellow-600 text-indigo-950 font-bold py-2 px-5 rounded-lg transition-colors">Batal</button>
                    <button type="submit"
                        class="bg-indigo-900 hover:bg-indigo-950 text-white font-bold py-2 px-5 rounded-lg transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- LETAKKAN KODE MODAL INI TEPAT DI BAWAH MODAL SEBELUMNYA --}}

    <div id="settings-modal" class="hidden fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
        <div class="bg-yellow-100 w-full max-w-lg p-6 rounded-2xl shadow-xl max-h-[90vh] overflow-y-auto">
            <form id="settings-form">
                <h2 class="text-2xl font-bold text-indigo-900 mb-6" style="font-family: 'Poppins', sans-serif;">PomoCat
                    Setting</h2>

                {{-- Durasi Timer --}}
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-amber-700 mb-3">DURASI TIMER (MENIT)</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="setting-pomodoro"
                                class="block mb-1 text-sm font-medium text-gray-700">Pomodoro</label>
                            <input type="number" id="setting-pomodoro" value="25"
                                class="bg-white border border-yellow-400 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                        </div>
                        <div>
                            <label for="setting-short-break" class="block mb-1 text-sm font-medium text-gray-700">Short
                                Break</label>
                            <input type="number" id="setting-short-break" value="5"
                                class="bg-white border border-yellow-400 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                        </div>
                        <div>
                            <label for="setting-long-break" class="block mb-1 text-sm font-medium text-gray-700">Long
                                Break</label>
                            <input type="number" id="setting-long-break" value="15"
                                class="bg-white border border-yellow-400 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                        </div>
                    </div>
                </div>

                <hr class="border-yellow-300 my-6">

                {{-- Pengaturan Otomatisasi --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                    {{-- Toggle Auto Start Breaks --}}
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="setting-auto-start-breaks" class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-yellow-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500">
                        </div>
                        <span class="ms-3 text-sm font-medium text-indigo-900">Auto Start Breaks</span>
                    </label>
                    {{-- Toggle Auto Start Pomodoros --}}
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="setting-auto-start-pomodoros" class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-yellow-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500">
                        </div>
                        <span class="ms-3 text-sm font-medium text-indigo-900">Auto Start Pomodoros</span>
                    </label>
                    {{-- Long Break Interval --}}
                    <div>
                        <label for="setting-long-break-interval"
                            class="block mb-1 text-sm font-medium text-indigo-900">Long Break Interval</label>
                        <input type="number" id="setting-long-break-interval" value="4"
                            class="bg-white border border-yellow-400 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                    </div>
                </div>

                <hr class="border-yellow-300 my-6">

                {{-- Pengaturan Tugas (Toggles) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="setting-auto-check-tasks" class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-yellow-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500">
                        </div>
                        <span class="ms-3 text-sm font-medium text-indigo-900">Auto Check Tasks</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="setting-auto-switch-tasks" class="sr-only peer">
                        <div
                            class="relative w-11 h-6 bg-slate-300 rounded-full peer peer-focus:ring-4 peer-focus:ring-yellow-300 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-yellow-500">
                        </div>
                        <span class="ms-3 text-sm font-medium text-indigo-900">Auto Switch Tasks</span>
                    </label>
                </div>


                {{-- Tombol Aksi --}}
                <div class="flex justify-end gap-x-3 mt-8">
                    <button type="button" id="settings-cancel-btn"
                        class="bg-yellow-500 hover:bg-yellow-600 text-indigo-900 font-bold py-2 px-5 rounded-lg transition-colors">Tutup</button>
                    <button type="submit"
                        class="bg-indigo-900 hover:bg-indigo-950 text-white font-bold py-2 px-5 rounded-lg transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    {{-- Elemen Audio untuk Notifikasi --}}
    <audio id="alarm-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
@endsection

@push('styles')
    <style>
        .pomotime-mode-btn.active-mode {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            color: #1e293b;
            /* slate-800 */
        }

        .task-item .delete-task-btn {
            opacity: 0;
            transition: opacity 0.2s ease-in-out;
            font-size: 1.5rem;
            line-height: 1;
        }

        .task-item:hover .delete-task-btn {
            opacity: 1;
        }

        .progress-shadow {

            filter:
                drop-shadow(2px 3px 2px rgba(0, 0, 0, 0.25))
                /* Bayangan gelap */
                drop-shadow(0 0 1px currentColor);
            /* Kilau/Glow */
        }

        .task-item.task-active {
            box-shadow: 0 0 0 2px #facc15;
            /* Kuning (yellow-400) */
            background-color: #fef3c7;
            /* yellow-100 */
        }

        .task-item.task-active span {
            color: #1e293b;
            /* slate-800 */
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // === Inisialisasi Elemen DOM (Tidak Berubah) ===
            const timeDisplay = document.getElementById('time-display');
            const modeLabel = document.getElementById('mode-label');
            const progressCircle = document.getElementById('progress-circle');
            const modeButtons = document.querySelectorAll('.pomotime-mode-btn');
            const startPauseBtn = document.getElementById('start-pause-btn');
            const resetBtn = document.getElementById('reset-btn');
            const settingsBtn = document.getElementById('settings-btn');
            const alarmSound = document.getElementById('alarm-sound');

            const addTaskBtn = document.getElementById('add-task-btn');
            const taskListContainer = document.getElementById('task-list');
            const clearFinishedTasksBtn = document.getElementById('clear-finished-tasks-btn');
            const clearAllTasksBtn = document.getElementById('clear-all-tasks-btn');

            const addTaskModal = document.getElementById('add-task-modal');
            const addTaskForm = document.getElementById('add-task-form');
            const addTaskCancelBtn = document.getElementById('modal-cancel-btn');
            const taskTitleInput = document.getElementById('task-title-input');
            const quantityInput = document.getElementById('quantity-input');
            const notesTextarea = document.getElementById('task-notes');

            const settingsModal = document.getElementById('settings-modal');
            const settingsForm = document.getElementById('settings-form');
            const settingsCancelBtn = document.getElementById('settings-cancel-btn');
            const inputPomodoro = document.getElementById('setting-pomodoro');
            const inputShortBreak = document.getElementById('setting-short-break');
            const inputLongBreak = document.getElementById('setting-long-break');
            const toggleAutoStartBreaks = document.getElementById('setting-auto-start-breaks');
            const toggleAutoStartPomodoros = document.getElementById('setting-auto-start-pomodoros');
            const inputLongBreakInterval = document.getElementById('setting-long-break-interval');
            const toggleAutoCheckTasks = document.getElementById('setting-auto-check-tasks');
            const toggleAutoSwitchTasks = document.getElementById('setting-auto-switch-tasks');

            // === Variabel State Aplikasi (Tidak Berubah) ===
            const defaultSettings = {
                pomodoro: 25,
                shortBreak: 5,
                longBreak: 15,
                autoStartBreaks: true,
                autoStartPomodoros: false,
                longBreakInterval: 4,
                autoCheckTasks: false,
                autoSwitchTasks: false
            };
            let settings = JSON.parse(localStorage.getItem('settings')) || defaultSettings;


            let modes = {};
            let currentMode = 'pomodoro';
            let timeLeft, totalTime;
            let timerInterval = null;
            let isPaused = true;
            let pomodoroCycle = 0;

            let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            let activeTaskId = JSON.parse(localStorage.getItem('activeTaskId')) || null;


            // === Logika Pengaturan (Tidak Berubah) ===
            function applySettings() {
                modes = {
                    pomodoro: {
                        time: settings.pomodoro * 60,
                        label: 'FOCUS'
                    },
                    shortbreak: {
                        time: settings.shortBreak * 60,
                        label: 'SHORT BREAK'
                    },
                    longbreak: {
                        time: settings.longBreak * 60,
                        label: 'LONG BREAK'
                    },
                };
                setMode(currentMode);
            }

            function loadSettingsIntoModal() {
                inputPomodoro.value = settings.pomodoro;
                inputShortBreak.value = settings.shortBreak;
                inputLongBreak.value = settings.longBreak;
                toggleAutoStartBreaks.checked = settings.autoStartBreaks;
                toggleAutoStartPomodoros.checked = settings.autoStartPomodoros;
                inputLongBreakInterval.value = settings.longBreakInterval;
                toggleAutoCheckTasks.checked = settings.autoCheckTasks;
                toggleAutoSwitchTasks.checked = settings.autoSwitchTasks;
            }

            function openSettingsModal() {
                loadSettingsIntoModal();
                settingsModal.classList.remove('hidden');
            }

            function closeSettingsModal() {
                settingsModal.classList.add('hidden');
            }

            // BARU: Fungsi untuk menyimpan dan mengatur task yang aktif
            function saveActiveTask() {
                localStorage.setItem('activeTaskId', JSON.stringify(activeTaskId));
            }

            function setActiveTask(taskId) {
                activeTaskId = taskId;
                saveActiveTask();
                renderTasks(); // Render ulang untuk menampilkan perubahan visual
            }

            // === Logika Notifikasi (Tidak Berubah) ===
            function requestNotificationPermission() {
                if ('Notification' in window && Notification.permission !== 'granted' && Notification.permission !==
                    'denied') {
                    Notification.requestPermission();
                }
            }
            requestNotificationPermission();

            function showNotification(message) {
                if ('Notification' in window && Notification.permission === 'granted') {
                    new Notification('PomoTime', {
                        body: message,
                        icon: 'https://img.icons8.com/emoji/96/glasses-emoji.png'
                    });
                }
            }

            // === Logika Timer (DIPERBARUI) ===
            const CIRCLE_CIRCUMFERENCE = 282.743;

            function updateDisplay() {
                const minutes = Math.floor(timeLeft / 60);
                const seconds = timeLeft % 60;
                const displayString =
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
                timeDisplay.textContent = displayString;
                document.title = `${displayString} - ${modes[currentMode].label}`;
                const progress = totalTime > 0 ? (timeLeft / totalTime) : 0;
                const dashOffset = CIRCLE_CIRCUMFERENCE * (1 - progress);
                progressCircle.style.strokeDashoffset = dashOffset;
            }

            // DIPERBARUI: Logika startTimer sekarang menggunakan 'settings'
            function startTimer() {
                if (timerInterval) return;
                isPaused = false;
                startPauseBtn.textContent = 'Pause';
                timerInterval = setInterval(() => {
                    timeLeft--;
                    updateDisplay();
                    // Di dalam fungsi startTimer(), ganti blok if (timeLeft <= 0) { ... } dengan ini:
                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        timerInterval = null;
                        alarmSound.play();

                        // BARU: Logika Auto Check & Auto Switch
                        if (currentMode === 'pomodoro') {
                            pomodoroCycle++;

                            // Cek apakah ada task aktif dan settingnya aktif
                            if (settings.autoCheckTasks && activeTaskId) {
                                const activeTask = tasks.find(t => t.id == activeTaskId);
                                if (activeTask && !activeTask.completed) {
                                    activeTask.sessionsCompleted++;
                                    // Cek jika task selesai
                                    if (activeTask.sessionsCompleted >= activeTask.sessionsNeeded) {
                                        activeTask.completed = true;
                                        showNotification(`Task "${activeTask.text}" completed!`);

                                        // Logika Auto Switch Task
                                        if (settings.autoSwitchTasks) {
                                            const currentIndex = tasks.findIndex(t => t.id == activeTaskId);
                                            // Cari task berikutnya yang belum selesai
                                            const nextTask = tasks.find((t, index) => index >
                                                currentIndex && !t.completed);
                                            setActiveTask(nextTask ? nextTask.id : null);
                                        }
                                    }
                                    saveTasks();
                                    renderTasks();
                                }
                            }

                            showNotification("Focus session complete! Time for a break.");
                            const nextMode = pomodoroCycle % settings.longBreakInterval === 0 ?
                                'longbreak' : 'shortbreak';
                            setMode(nextMode);
                            if (settings.autoStartBreaks) {
                                setTimeout(() => startTimer(), 1000);
                            }
                        } else {
                            showNotification("Break's over! Time to get back to focus.");
                            setMode('pomodoro');
                            if (settings.autoStartPomodoros) {
                                setTimeout(() => startTimer(), 1000);
                            }
                        }
                    }
                }, 1000);
            }

            function pauseTimer() {
                isPaused = true;
                startPauseBtn.textContent = 'Resume';
                clearInterval(timerInterval);
                timerInterval = null;
            }

            function resetTimer() {
                clearInterval(timerInterval);
                timerInterval = null;
                isPaused = true;
                startPauseBtn.textContent = 'Start';
                if (modes[currentMode]) {
                    timeLeft = modes[currentMode].time;
                }
                updateDisplay();
            }

            // Fungsi setMode (DIPERBARUI) - logika tombol diperbaiki & disederhanakan
            function setMode(modeKey) {
                currentMode = modeKey;
                if (modes[modeKey]) {
                    totalTime = modes[modeKey].time;
                }
                const logoImage = document.getElementById('timer-logo');
                progressCircle.classList.remove('text-indigo-950', 'text-blue-600', 'text-red-800');
                modeLabel.classList.remove('text-indigo-950', 'text-blue-600', 'text-red-800');

                switch (modeKey) {
                    case 'shortbreak':
                        progressCircle.classList.add('text-blue-600');
                        modeLabel.textContent = modes[modeKey].label;
                        modeLabel.classList.add('text-blue-600');
                        logoImage.src = 'https://img.icons8.com/color/96/clew.png';
                        logoImage.alt = 'yarn-logo';
                        break;
                    case 'longbreak':
                        progressCircle.classList.add('text-red-800');
                        modeLabel.textContent = modes[modeKey].label;
                        modeLabel.classList.add('text-red-800');
                        logoImage.src = 'https://img.icons8.com/emoji/48/cup-with-straw-emoji.png';
                        logoImage.alt = 'drink-logo';
                        break;
                    default: // 'pomodoro'
                        progressCircle.classList.add('text-indigo-950');
                        if (modes.pomodoro) modeLabel.textContent = modes.pomodoro.label;
                        modeLabel.classList.add('text-indigo-950');
                        logoImage.src = 'https://img.icons8.com/emoji/96/glasses-emoji.png';
                        logoImage.alt = 'glasses-logo';
                        break;
                }

                modeButtons.forEach(btn => {
                    const buttonText = btn.textContent.toLowerCase().replace(/\s/g, '');
                    if (buttonText === modeKey) {
                        btn.classList.add('active-mode', 'bg-yellow-100/70');
                    } else {
                        btn.classList.remove('active-mode', 'bg-yellow-100/70');
                    }
                });
                resetTimer();
            }

            // === Logika Modal & Tasks (Tidak Berubah) ===
            function openAddTaskModal() {
                addTaskForm.reset();
                quantityInput.value = 1;
                addTaskModal.classList.remove('hidden');
                taskTitleInput.focus();
            }

            function closeAddTaskModal() {
                addTaskModal.classList.add('hidden');
            }

            function saveTasks() {
                localStorage.setItem('tasks', JSON.stringify(tasks));
            }

            // Ganti fungsi renderTasks() Anda dengan yang ini:
            // Ganti fungsi renderTasks() Anda dengan yang ini
            function renderTasks() {
                // BARU: Urutkan task agar yang sudah selesai (completed: true) berada di bawah
                tasks.sort((a, b) => a.completed - b.completed);

                taskListContainer.innerHTML = '';
                if (tasks.length === 0) {
                    taskListContainer.innerHTML =
                        `<p class="text-center text-yellow-100/50">No tasks yet. Add one!</p>`;
                    return;
                }
                tasks.forEach(task => {
                    const taskEl = document.createElement('div');
                    taskEl.className =
                        `task-item cursor-pointer flex items-center justify-between p-3 rounded-lg transition-all ${task.completed ? 'bg-yellow-500/30 text-yellow-100/60' : 'bg-yellow-400/50'}`;
                    taskEl.dataset.id = task.id;

                    if (task.id == activeTaskId) {
                        taskEl.classList.add('task-active');
                    }

                    taskEl.innerHTML = `
            <div class="flex items-center gap-x-3">
                <input type="checkbox" class="task-checkbox h-5 w-5 rounded-full bg-transparent border-2 border-indigo-950 text-indigo-950 focus:ring-0 cursor-pointer" ${task.completed ? 'checked' : ''}>
                <div>
                    <span class="font-medium ${task.completed ? 'line-through' : ''}">${task.text}</span>
                    <div class="text-xs text-indigo-900/80 font-semibold">${task.sessionsCompleted} / ${task.sessionsNeeded} Sesi</div>
                </div>
            </div>
            <button class="delete-task-btn text-indigo-950/60 hover:text-indigo-950 text-2xl leading-none">&times;</button>
        `;
                    taskListContainer.appendChild(taskEl);
                });
            }

            // Ganti fungsi addTask() Anda dengan yang ini:
            function addTask(taskData) {
                if (!taskData || !taskData.text.trim()) return;
                const newTask = {
                    id: Date.now(),
                    text: taskData.text.trim(),
                    notes: taskData.notes.trim(),
                    sessionsNeeded: taskData.sessions,
                    sessionsCompleted: 0,
                    completed: false
                };
                tasks.push(newTask);
                saveTasks();
                renderTasks();

                // BARU: Jika ini adalah satu-satunya task, jadikan aktif
                if (tasks.filter(t => !t.completed).length === 1) {
                    setActiveTask(newTask.id);
                }
            }

            function toggleTask(id) {
                const task = tasks.find(t => t.id == id);
                if (task) {
                    task.completed = !task.completed;
                    saveTasks();
                    renderTasks();
                }
            }

            // Ganti fungsi deleteTask() Anda dengan yang ini:
            function deleteTask(id) {
                // BARU: Cek jika task yang dihapus adalah task aktif
                if (id == activeTaskId) {
                    // Cari task berikutnya yang belum selesai untuk dijadikan aktif
                    const currentIndex = tasks.findIndex(t => t.id == id);
                    const nextTask = tasks.find((t, index) => index > currentIndex && !t.completed);

                    if (nextTask) {
                        setActiveTask(nextTask.id);
                    } else {
                        // Jika tidak ada, cari dari awal
                        const anyNextTask = tasks.find(t => t.id != id && !t.completed);
                        setActiveTask(anyNextTask ? anyNextTask.id : null);
                    }
                }

                tasks = tasks.filter(t => t.id != id);
                saveTasks();
                renderTasks();
            }

            // === Event Listeners (DIORGANISIR ULANG) ===
            startPauseBtn.addEventListener('click', () => {
                isPaused ? startTimer() : pauseTimer();
            });
            resetBtn.addEventListener('click', resetTimer);
            settingsBtn.addEventListener('click', openSettingsModal);
            modeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    setMode(this.textContent.toLowerCase().replace(/\s/g, ''));
                });
            });

            // Listener untuk Add Task Modal
            addTaskBtn.addEventListener('click', openAddTaskModal);
            addTaskCancelBtn.addEventListener('click', closeAddTaskModal);
            addTaskModal.addEventListener('click', (e) => {
                if (e.target === addTaskModal) closeAddTaskModal();
            });
            addTaskForm.addEventListener('submit', e => {
                e.preventDefault();
                addTask({
                    text: taskTitleInput.value,
                    sessions: parseInt(quantityInput.value, 10),
                    notes: notesTextarea.value
                });
                closeAddTaskModal();
            });

            // Listener untuk Settings Modal
            settingsCancelBtn.addEventListener('click', closeSettingsModal);
            settingsModal.addEventListener('click', (e) => {
                if (e.target === settingsModal) closeSettingsModal();
            });
            settingsForm.addEventListener('submit', e => {
                e.preventDefault();
                settings.pomodoro = parseInt(inputPomodoro.value, 10);
                settings.shortBreak = parseInt(inputShortBreak.value, 10);
                settings.longBreak = parseInt(inputLongBreak.value, 10);
                settings.autoStartBreaks = toggleAutoStartBreaks.checked;
                settings.autoStartPomodoros = toggleAutoStartPomodoros.checked;
                settings.longBreakInterval = parseInt(inputLongBreakInterval.value, 10);
                settings.autoCheckTasks = toggleAutoCheckTasks.checked;
                settings.autoSwitchTasks = toggleAutoSwitchTasks.checked;
                localStorage.setItem('settings', JSON.stringify(settings));
                applySettings();
                closeSettingsModal();
            });

            // Listener untuk Tombol Escape (DIGABUNGKAN JADI SATU)
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    if (!addTaskModal.classList.contains('hidden')) {
                        closeAddTaskModal();
                    }
                    if (!settingsModal.classList.contains('hidden')) {
                        closeSettingsModal();
                    }
                }
            });

            // Listener untuk list task dan clear buttons
            // Ganti event listener untuk taskListContainer dengan yang ini:
            taskListContainer.addEventListener('click', e => {
                const taskItem = e.target.closest('.task-item');
                if (!taskItem) return;

                const id = taskItem.dataset.id;

                // Jika checkbox di-klik
                if (e.target.matches('.task-checkbox')) {
                    toggleTask(id);
                    return; // Hentikan eksekusi lebih lanjut
                }
                // Jika tombol delete di-klik
                if (e.target.matches('.delete-task-btn')) {
                    if (confirm('Are you sure you want to delete this task?')) {
                        deleteTask(id);
                    }
                    return; // Hentikan eksekusi lebih lanjut
                }

                // BARU: Jika area lain dari task di-klik, jadikan aktif
                setActiveTask(id);
            });
            clearFinishedTasksBtn.addEventListener('click', e => {
                e.preventDefault();
                tasks = tasks.filter(t => !t.completed);
                saveTasks();
                renderTasks();
            });
            clearAllTasksBtn.addEventListener('click', e => {
                e.preventDefault();
                if (confirm('Delete ALL tasks?')) {
                    tasks = [];
                    saveTasks();
                    renderTasks();
                }
            });

            // === Inisialisasi Aplikasi ===
            applySettings();
            renderTasks();
        });
    </script>
@endpush
