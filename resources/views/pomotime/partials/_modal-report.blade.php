<div id="report-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-0 w-full max-w-4xl max-h-full">
        {{-- Modal content --}}
        <div class="relative bg-yellow-100 rounded-lg shadow-lg border border-yellow-300">
            {{-- Modal header --}}
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-yellow-300">
                <h3 class="text-xl font-bold text-indigo-900" style="font-family: 'Poppins', sans-serif;">
                    Laporan Sesi
                </h3>
                <button type="button"
                    class="text-amber-700 bg-transparent hover:bg-yellow-200 hover:text-indigo-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="report-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            {{-- INI BAGIAN YANG DIPERBAIKI --}}
            {{-- Modal body with Tabs Wrapper --}}
            <div class="p-4 md:p-5">
                {{-- 1. Wrapper untuk Tab yang dibutuhkan oleh Flowbite --}}
                <div id="report-tabs-wrapper">
                    {{-- Navigasi Tab --}}
                    <div class="border-b border-yellow-300">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="report-tab-nav"
                            role="tablist">
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="summary-tab"
                                    data-tabs-target="#summary-content" type="button" role="tab"
                                    aria-controls="summary" aria-selected="true">Summary</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="detail-tab"
                                    data-tabs-target="#detail-content" type="button" role="tab"
                                    aria-controls="detail" aria-selected="false">Detail</button>
                            </li>
                            <li class="me-2" role="presentation">
                                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="ranking-tab"
                                    data-tabs-target="#ranking-content" type="button" role="tab"
                                    aria-controls="ranking" aria-selected="false">Ranking</button>
                            </li>
                        </ul>
                    </div>

                    {{-- Konten Tab --}}
                    <div id="report-tab-content" class="pt-4">
                        {{-- KONTEN TAB SUMMARY --}}
                        <div id="summary-content" role="tabpanel" aria-labelledby="summary-tab">

                            {{-- 4 KARTU RINGKASAN BARU --}}
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                                <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
                                    <h5 id="report-total-sessions"
                                        class="leading-none text-3xl font-bold text-indigo-900 pb-2">0</h5>
                                    <p class="text-sm font-normal text-amber-700">Total Sesi</p>
                                </div>
                                <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
                                    <h5 id="report-total-minutes"
                                        class="leading-none text-3xl font-bold text-indigo-900 pb-2">0m</h5>
                                    <p class="text-sm font-normal text-amber-700">Total Waktu (mnt)</p>
                                </div>
                                <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
                                    <h5 id="report-day-accessed"
                                        class="leading-none text-3xl font-bold text-indigo-900 pb-2">0</h5>
                                    <p class="text-sm font-normal text-amber-700">Hari Diakses</p>
                                </div>
                                <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
                                    <h5 id="report-day-streak"
                                        class="leading-none text-3xl font-bold text-indigo-900 pb-2">0</h5>
                                    <p class="text-sm font-normal text-amber-700">Rentetan Hari</p>
                                </div>
                            </div>

                            {{-- KONTROL GRAFIK BARU --}}
                            <div class="w-full bg-yellow-50 rounded-lg shadow mt-6 p-4 md:p-6">
                                <div class="flex justify-between items-center mb-5">
                                    <div>
                                        <h5 id="report-period-total"
                                            class="leading-none text-3xl font-bold text-indigo-900">...</h5>
                                        <p id="report-period-label" class="text-base font-normal text-amber-700">Sesi
                                            Minggu Ini</p>
                                    </div>
                                    <div class="flex items-center rounded-lg bg-gray-200 p-1 text-sm font-semibold">
                                        <button type="button"
                                            class="range-toggle-btn px-3 py-1 rounded-md bg-white shadow"
                                            data-range="week">Mingguan</button>
                                        <button type="button" class="range-toggle-btn px-3 py-1 rounded-md"
                                            data-range="month">Bulanan</button>
                                    </div>
                                </div>
                                <div id="summary-area-chart"></div>
                            </div>
                        </div>
                        {{-- KONTEN TAB DETAIL --}}
                        {{-- KONTEN TAB DETAIL --}}
                        <div class="hidden p-4 rounded-lg bg-gray-50" id="detail-content" role="tabpanel"
                            aria-labelledby="detail-tab">
                            <div class="flex justify-end mb-4">
                                <a href="{{ route('report.export-csv') }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300">
                                    <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0 0-1.414Z" />
                                        <path
                                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Z" />
                                    </svg>
                                    Unduh CSV
                                </a>
                            </div>

                            {{-- Wadah ini akan diisi oleh JavaScript --}}
                            <div id="detail-table-container">
                                <p class="text-center text-gray-500">Memuat data...</p>
                            </div>
                        </div>
                        {{-- KONTEN TAB RANKING --}}
                        {{-- KONTEN TAB RANKING --}}
                        {{-- File: resources/views/pomotime/partials/_modal-report.blade.php --}}

                        {{-- ... (konten tab Summary dan Detail) ... --}}

                        {{-- KONTEN TAB RANKING --}}
                        <div class="hidden p-4 rounded-lg bg-yellow-50" id="ranking-content" role="tabpanel"
                            aria-labelledby="ranking-tab">

                            {{-- Wadah ini akan diisi sepenuhnya oleh JavaScript --}}
                            <div id="ranking-container">
                                <p class="text-center text-gray-500">Memuat data peringkat...</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
