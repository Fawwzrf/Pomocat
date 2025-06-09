// File: resources/js/pomodoro/report.js

// File: resources/js/pomodoro/report.js

export function initReport(elements, headers, isGuest) {
    const { reportBtn } = elements;
    const { baseHeaders } = headers;
    const reportBtnGuest = document.getElementById('report-btn-guest');

    let charts = {};
    let currentRange = 'week';
    let detailTabInitialized = false;
    let rankingTabInitialized = false;
    let debounceTimer;

    if (isGuest) {
        if (reportBtnGuest) {
            reportBtnGuest.addEventListener('click', () => {
                alert('Silakan login atau daftar untuk mengakses fitur laporan dan peringkat.');
            });
        }
        return; // Hentikan eksekusi untuk tamu
    }


    // --- Inisialisasi Komponen Flowbite ---
    const tabsWrapper = document.getElementById('report-tabs-wrapper');
    if (tabsWrapper) {
        const tabElements = [{ id: 'summary', triggerEl: document.getElementById('summary-tab'), targetEl: document.getElementById('summary-content') }, { id: 'detail', triggerEl: document.getElementById('detail-tab'), targetEl: document.getElementById('detail-content') }, { id: 'ranking', triggerEl: document.getElementById('ranking-tab'), targetEl: document.getElementById('ranking-content') }];
        const options = {
            defaultTabId: 'summary', activeClasses: 'text-indigo-900 border-indigo-900', inactiveClasses: 'text-slate-500 hover:text-indigo-900 border-transparent',
            onShow: (tabs, tab) => {
                if (tab.id === 'detail' && !detailTabInitialized) { fetchDetailTable('/report/details'); detailTabInitialized = true; }
                if (tab.id === 'ranking' && !rankingTabInitialized) { fetchRankingData(); rankingTabInitialized = true; }
            }
        };
        new Tabs(tabsWrapper, tabElements, options, { id: 'report-tabs', override: true });
    }

    async function fetchReportData() {
        try {
            // Kirim parameter 'range' ke API
            const response = await fetch(`/report/summary?range=${currentRange}`, { method: 'GET', headers: baseHeaders, credentials: 'same-origin' });
            if (!response.ok) throw new Error('Gagal mengambil data laporan');
            const data = await response.json();
            updateReportUI(data);
        } catch (error) { console.error("Error fetching report data:", error); }
    }

    function updateReportUI(data) {
        function formatMinutes(minutes) { if (minutes < 60) return `${minutes}m`; const hours = Math.floor(minutes / 60); const remainingMinutes = minutes % 60; return `${hours}j ${remainingMinutes}m`; }

        document.getElementById('report-total-sessions').textContent = data.total_focus_sessions;
        document.getElementById('report-total-minutes').textContent = formatMinutes(data.total_focus_minutes);
        document.getElementById('report-day-accessed').textContent = data.day_accessed;
        document.getElementById('report-day-streak').textContent = data.day_streak;

        document.getElementById('report-period-total').textContent = data.total_for_period;
        document.getElementById('report-period-label').textContent = `Sesi ${data.period_label}`;

        renderReportCharts(data);
    }

    function getReportChartsOptions(data) {
        const chartData = data.chart_data || { labels: [], data: [] };
        const summaryAreaChartOptions = { series: [{ name: "Sesi Selesai", data: chartData.data, color: "#312e81" }], chart: { height: "100%", maxWidth: "100%", type: "area", fontFamily: "Poppins, sans-serif", toolbar: { show: false } }, xaxis: { categories: chartData.labels, labels: { show: true, style: { colors: '#4b5563' } } }, tooltip: { enabled: true, x: { show: false } }, fill: { type: "gradient", gradient: { opacityFrom: 0.55, opacityTo: 0, shade: "#312e81", gradientToColors: ["#312e81"] } }, dataLabels: { enabled: false }, stroke: { width: 4, curve: 'smooth' }, grid: { show: false }, yaxis: { show: false } };
        return { summaryAreaChartOptions };
    }

    function renderReportCharts(data) {
        const summaryChartEl = document.getElementById("summary-area-chart");
        if (charts['summary']) { charts['summary'].destroy(); }
        if (data && summaryChartEl && typeof ApexCharts !== 'undefined') {
            const { summaryAreaChartOptions } = getReportChartsOptions(data);
            const chart = new ApexCharts(summaryChartEl, summaryAreaChartOptions);
            chart.render();
            charts['summary'] = chart;
        }
    }

    async function fetchDetailTable(url) {
        const container = document.getElementById('detail-table-container');
        if (!container) return;
        container.innerHTML = '<p class="text-center text-gray-500">Memuat data...</p>';
        try {
            const response = await fetch(url, { headers: baseHeaders, credentials: 'same-origin' });
            container.innerHTML = await response.text();
        } catch (error) {
            console.error('Gagal memuat tabel detail:', error);
            container.innerHTML = '<p class="text-center text-red-500">Gagal memuat data.</p>';
        }
    }

    async function fetchRankingData(searchTerm = '') {
        const container = document.getElementById('ranking-container');
        if (!container) return;
        container.innerHTML = '<p class="text-center text-gray-500">Memuat data peringkat...</p>';
        try {
            const response = await fetch(`/report/ranking?search=${searchTerm}`, { headers: baseHeaders, credentials: 'same-origin' });
            const data = await response.json();
            renderRankingUI(data, searchTerm); // Kirim data dan search term ke fungsi render
        } catch (error) { console.error('Gagal memuat data peringkat:', error); container.innerHTML = '<p class="text-center text-red-500">Gagal memuat data peringkat.</p>'; }
    }

    // --- Fungsi Rendering ---
    function renderRankingUI(data, searchTerm) {
        const container = document.getElementById('ranking-container');
        if (!container) return;

        const myRankHtml = renderMyRank(data.my_rank);
        const podiumHtml = renderPodium(data.podium);
        const tableHtml = renderRankingTable(data.full_ranking, searchTerm);

        container.innerHTML = myRankHtml + podiumHtml + tableHtml;
    }

    function renderMyRank(myData) {
        if (!myData) return '<div class="mb-8 p-4 bg-indigo-100 rounded-lg text-center text-indigo-800">Anda belum memiliki peringkat. Selesaikan beberapa sesi!</div>';
        const photoUrl = myData.profile_photo_path ? `/storage/${myData.profile_photo_path}` : 'https://img.icons8.com/fluency/96/user-male-circle.png';
        return `
            <div class="mb-8 p-4 bg-indigo-100 border-2 border-indigo-300 rounded-lg flex items-center justify-between shadow-lg">
                <div class="flex items-center gap-x-4">
                    <span class="text-2xl font-bold text-indigo-800">#${myData.rank}</span>
                    <img src="${photoUrl}" alt="${myData.name}" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <div class="font-bold text-indigo-900">${myData.name} (Anda)</div>
                        <div class="text-sm text-indigo-700">${myData.total_hours} Jam Fokus</div>
                    </div>
                </div>
            </div>`;
    }

    function renderPodium(topThree) {
        if (!topThree || topThree.length === 0) return '';
        const podiumOrder = [1, 0, 2];
        let podiumHtml = '<div class="flex justify-center items-end gap-4 md:gap-2 mb-8">';
        podiumOrder.forEach(index => {
            const user = topThree[index];
            if (!user) return;
            const heights = ['h-32 md:h-40', 'h-24 md:h-32', 'h-20 md:h-24'];
            const colors = ['bg-amber-400', 'bg-slate-400', 'bg-amber-600'];
            const photoUrl = user.profile_photo_path ? `/storage/${user.profile_photo_path}` : 'https://img.icons8.com/fluency/96/user-male-circle.png';
            podiumHtml += `
                <div class="text-center w-1/3">
                    <img src="${photoUrl}" alt="${user.name}" class="w-16 h-16 md:w-20 md:h-20 rounded-full object-cover mx-auto border-4 border-white shadow-lg z-10 relative">
                    <div class="font-bold mt-2 text-indigo-900 text-sm md:text-base truncate">${user.name}</div>
                    <div class="text-xs text-gray-600">${user.total_hours} Jam</div>
                    <div class="${heights[index]} ${colors[index]} w-full rounded-t-lg flex items-center justify-center text-3xl font-bold text-white shadow-inner">${user.rank}</div>
                </div>`;
        });
        podiumHtml += '</div>';
        return podiumHtml;
    }

    function renderRankingTable(fullRanking, searchTerm) {
        let tableRowsHtml = fullRanking.map(user => `
            <tr class="bg-white border-b hover:bg-yellow-50">
                <td class="w-4 p-4"><div class="flex items-center"><input type="checkbox" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-indigo-500 focus:ring-2"><label class="sr-only">checkbox</label></div></td>
                <td class="px-6 py-4 font-bold text-center">${user.rank}</td>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"><div class="flex items-center gap-x-3"><img src="${user.profile_photo_path ? `/storage/${user.profile_photo_path}` : 'https://img.icons8.com/fluency/96/user-male-circle.png'}" class="w-8 h-8 rounded-full object-cover"><span>${user.name}</span></div></th>
                <td class="px-6 py-4">${user.total_hours}</td>
            </tr>`
        ).join('');

        return `
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="p-4 bg-yellow-50">
                    <label for="ranking-table-search" class="sr-only">Search</label>
                    <div class="relative mt-1">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"><svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/></svg></div>
                        <input type="text" id="ranking-table-search" class="block pt-2 ps-10 text-sm text-indigo-900 border border-yellow-300 rounded-lg w-80 bg-white focus:ring-amber-500 focus:border-amber-500" placeholder="Cari pengguna..." value="${searchTerm}">
                    </div>
                </div>
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-amber-800 uppercase bg-yellow-200/50">
                        <tr>
                            <th scope="col" class="p-4"><div class="flex items-center"><input type="checkbox" class="w-4 h-4 text-indigo-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-indigo-500 focus:ring-2"><label class="sr-only">checkbox</label></div></th>
                            <th scope="col" class="px-6 py-3 text-center">Rank</th>
                            <th scope="col" class="px-6 py-3">Pengguna</th>
                            <th scope="col" class="px-6 py-3">Jam Fokus</th>
                        </tr>
                    </thead>
                    <tbody>${tableRowsHtml}</tbody>
                </table>
            </div>
        `;
    }

    // --- EVENT LISTENERS ---
    document.body.addEventListener('click', function (e) {
        if (e.target.matches('#detail-table-container .pagination a')) { e.preventDefault(); const url = e.target.getAttribute('href'); fetchDetailTable(url); }
        if (e.target.matches('.range-toggle-btn')) { currentRange = e.target.dataset.range; document.querySelectorAll('.range-toggle-btn').forEach(btn => btn.classList.remove('bg-white', 'shadow')); e.target.classList.add('bg-white', 'shadow'); fetchReportData(); }
    });

    document.body.addEventListener('input', function (e) {
        if (e.target.matches('#ranking-table-search')) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                fetchRankingData(e.target.value);
            }, 500);
        }
    });

    if (reportBtn) { reportBtn.addEventListener('click', () => { if (!charts['summary']) fetchReportData(); }); }

    // Semua fungsi internal yang tidak diekspor, salin dari kode sebelumnya
    updateReportUI = function(data) { function formatMinutes(minutes) { if (minutes < 60) return `${minutes}m`; const hours = Math.floor(minutes / 60); const remainingMinutes = minutes % 60; return `${hours}j ${remainingMinutes}m`; } const totalSessionsEl = document.getElementById('report-total-sessions'); const totalMinutesEl = document.getElementById('report-total-minutes'); const tasksCompletedEl = document.getElementById('report-tasks-completed'); const dayAccessedEl = document.getElementById('report-day-accessed'); const dayStreakEl = document.getElementById('report-day-streak'); const periodTotalEl = document.getElementById('report-period-total'); const periodLabelEl = document.getElementById('report-period-label'); if(totalSessionsEl) totalSessionsEl.textContent = data.total_focus_sessions; if(totalMinutesEl) totalMinutesEl.textContent = formatMinutes(data.total_focus_minutes); if(tasksCompletedEl) tasksCompletedEl.textContent = data.tasks_completed; if(dayAccessedEl) dayAccessedEl.textContent = data.day_accessed; if(dayStreakEl) dayStreakEl.textContent = data.day_streak; if(periodTotalEl) periodTotalEl.textContent = data.total_for_period; if(periodLabelEl) periodLabelEl.textContent = `Sesi ${data.period_label}`; renderReportCharts(data); }
    getReportChartsOptions = function(data) { const chartData = data.chart_data || { labels: [], data: [] }; const summaryAreaChartOptions = { series: [{ name: "Sesi Selesai", data: chartData.data, color: "#312e81" }], chart: { height: "100%", maxWidth: "100%", type: "area", fontFamily: "Poppins, sans-serif", toolbar: { show: false } }, xaxis: { categories: chartData.labels, labels: { show: true, style: { colors: '#4b5563' } } }, tooltip: { enabled: true, x: { show: false } }, fill: { type: "gradient", gradient: { opacityFrom: 0.55, opacityTo: 0, shade: "#312e81", gradientToColors: ["#312e81"] } }, dataLabels: { enabled: false }, stroke: { width: 4, curve: 'smooth' }, grid: { show: false }, yaxis: { show: false }, }; return { summaryAreaChartOptions }; }
    renderReportCharts = function(data) { const summaryChartEl = document.getElementById("summary-area-chart"); if (charts['summary']) { charts['summary'].destroy(); } if (data && summaryChartEl && typeof ApexCharts !== 'undefined') { const { summaryAreaChartOptions } = getReportChartsOptions(data); const chart = new ApexCharts(summaryChartEl, summaryAreaChartOptions); chart.render(); charts['summary'] = chart; } }
    fetchDetailTable = async function (url) { const container = document.getElementById('detail-table-container'); if (!container) return; container.innerHTML = '<p class="text-center text-gray-500">Memuat data...</p>'; try { const response = await fetch(url, { headers: baseHeaders, credentials: 'same-origin' }); container.innerHTML = await response.text(); } catch (error) { console.error('Gagal memuat tabel detail:', error); container.innerHTML = '<p class="text-center text-red-500">Gagal memuat data.</p>'; } }
    fetchReportData = async function() { try { const response = await fetch(`/report/summary?range=${currentRange}`, { method: 'GET', headers: baseHeaders, credentials: 'same-origin' }); if (!response.ok) throw new Error('Gagal mengambil data laporan'); const data = await response.json(); updateReportUI(data); } catch (error) { console.error("Error fetching report data:", error); } }
}