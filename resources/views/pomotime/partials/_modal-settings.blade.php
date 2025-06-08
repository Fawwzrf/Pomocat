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
                        <input type="number" id="setting-pomodoro" value="25" min="1"
                            class="bg-white border border-yellow-400 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label for="setting-short-break" class="block mb-1 text-sm font-medium text-gray-700">Short
                            Break</label>
                        <input type="number" id="setting-short-break" value="5" min="1"
                            class="bg-white border border-yellow-400 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5">
                    </div>
                    <div>
                        <label for="setting-long-break" class="block mb-1 text-sm font-medium text-gray-700">Long
                            Break</label>
                        <input type="number" id="setting-long-break" value="15" min="1"
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
                    <input type="number" id="setting-long-break-interval" value="4" min="1"
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