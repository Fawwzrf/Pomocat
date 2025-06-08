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
                        {{-- ... isi konten summary Anda ... --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-yellow-50 rounded-lg shadow p-4">
                                <h5 class="leading-none text-3xl font-bold text-indigo-900 pb-2">128</h5>
                                <p class="text-base font-normal text-amber-700">Total Sesi Fokus</p>
                            </div>
                            <div class="bg-yellow-50 rounded-lg shadow p-4">
                                <h5 class="leading-none text-3xl font-bold text-indigo-900 pb-2">53j 20m</h5>
                                <p class="text-base font-normal text-amber-700">Total Waktu Fokus</p>
                            </div>
                            <div class="bg-yellow-50 rounded-lg shadow p-4">
                                <h5 class="leading-none text-3xl font-bold text-indigo-900 pb-2">4.5</h5>
                                <p class="text-base font-normal text-amber-700">Sesi / Hari</p>
                            </div>
                        </div>
                        <div class="w-full bg-yellow-50 rounded-lg shadow mt-6 p-4 md:p-6">
                            <div class="flex justify-between">
                                <div>
                                    <h5 class="leading-none text-3xl font-bold text-indigo-900 pb-2">32.4k</h5>
                                    <p class="text-base font-normal text-amber-700">Menit Fokus Minggu Ini</p>
                                </div>
                                <div
                                    class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 text-center">
                                    12%
                                    <svg class="w-3 h-3 ms-1" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                                        <path stroke="currentColor" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2"
                                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                                    </svg>
                                </div>
                            </div>
                            <div id="summary-area-chart"></div>
                        </div>
                    </div>
                    {{-- KONTEN TAB DETAIL --}}
                    <div class="hidden" id="detail-content" role="tabpanel" aria-labelledby="detail-tab">
                        {{-- ... isi konten detail Anda ... --}}
                        <div class="w-full bg-yellow-50 rounded-lg shadow p-4 md:p-6">
                            <div class="flex justify-between border-yellow-200 border-b pb-3">
                                <dl>
                                    <dt class="text-base font-normal text-amber-700 pb-1">Total Sesi Selesai</dt>
                                    <dd class="leading-none text-3xl font-bold text-indigo-900">128</dd>
                                </dl>
                                <div>
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md">
                                        <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 10 14">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M5 13V1m0 0L1 5m4-4 4 4" />
                                        </svg>
                                        Produktifitas 23.5%
                                    </span>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 py-3">
                                <dl>
                                    <dt class="text-base font-normal text-amber-700 pb-1">Sesi Fokus</dt>
                                    <dd class="leading-none text-xl font-bold text-green-500">102</dd>
                                </dl>
                                <dl>
                                    <dt class="text-base font-normal text-amber-700 pb-1">Sesi Istirahat</dt>
                                    <dd class="leading-none text-xl font-bold text-orange-500">26</dd>
                                </dl>
                            </div>
                            <div id="detail-bar-chart"></div>
                        </div>
                    </div>
                    {{-- KONTEN TAB RANKING --}}
                    <div class="hidden" id="ranking-content" role="tabpanel" aria-labelledby="ranking-tab">
                        {{-- ... isi konten ranking Anda ... --}}
                        <div class="w-full bg-yellow-50 rounded-lg shadow p-4 md:p-6">
                            <h3 class="text-lg font-bold text-indigo-900 mb-4">Peringkat Task Berdasarkan Sesi</h3>
                            <ol class="list-decimal list-inside space-y-3 text-gray-700">
                                <li class="p-3 rounded-lg bg-yellow-200 flex justify-between items-center">
                                    <span>Mengerjakan Laporan Keuangan</span>
                                    <span class="font-bold text-indigo-900">12 Sesi</span>
                                </li>
                                <li class="p-3 rounded-lg bg-yellow-100 flex justify-between items-center">
                                    <span>Belajar Laravel 12</span>
                                    <span class="font-bold text-indigo-900">8 Sesi</span>
                                </li>
                                <li class="p-3 rounded-lg bg-yellow-100 flex justify-between items-center">
                                    <span>Riset Desain UI/UX</span>
                                    <span class="font-bold text-indigo-900">5 Sesi</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>