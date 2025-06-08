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

