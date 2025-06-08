<div class="bg-yellow-400/80 drop-shadow-yellow-400 backdrop-blur-sm p-6 sm:p-8 rounded-[40px] shadow-2xl mb-0">
    {{-- Tombol Mode Timer --}}
    <div class="flex justify-center space-x-2 sm:space-x-3 mb-6">
        <button
            class="pomotime-mode-btn active-mode text-sm sm:text-lg font-semibold py-1 px-3 rounded-full border-2 border-indigo-950 text-indigo-950 bg-yellow-100/70 hover:bg-yellow-100 transition-all">Pomodoro</button>
        <button
            class="pomotime-mode-btn text-sm sm:text-lg font-semibold py-1 px-3 rounded-full border-2 border-indigo-950 text-indigo-950 hover:bg-yellow-100 transition-all">Short
            Break</button>
        <button
            class="pomotime-mode-btn text-sm sm:text-lg font-semibold py-1 px-3 rounded-full border-2 border-indigo-950 text-indigo-950 hover:bg-yellow-100 transition-all">Long
            Break</button>
    </div>

    {{-- Timer Visual --}}
    <div class="relative w-48 h-48 sm:w-80 sm:h-80 mx-auto mb-6">
        <svg class="w-full h-full" viewBox="0 0 100 100">
            <circle class="text-black/10" stroke-width="5" stroke="currentColor" fill="transparent" r="45" cx="50"
                cy="50" />
            <circle class="text-yellow-100/20" stroke-width="5" stroke="currentColor" fill="transparent" r="45"
                cx="50" cy="50" transform="translate(0.5, 0.5)" />

            <circle id="progress-circle" class="progress-shadow transition-all duration-500" {{-- <-- Kelas baru untuk efek 3D --}}
                stroke-width="4" stroke-linecap="round" stroke="currentColor" fill="transparent" r="45" cx="50"
                cy="50"
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
