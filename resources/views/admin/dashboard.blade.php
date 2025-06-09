@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')
<div class="space-y-6">
    {{-- Bagian Kartu Statistik Atas --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                <p class="text-3xl font-bold text-gray-800">{{ $userCount }}</p>
            </div>
            <div class="p-3 rounded-full bg-blue-100"><svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.225-1.26-.632-1.742M17 20V5a2 2 0 00-2-2H9a2 2 0 00-2 2v15m7 0a2 2 0 01-2 2H9a2 2 0 01-2-2m7 0a2 2 0 002 2h1a2 2 0 002-2m-8.5-10.5h.01M12 5.354a4 4 0 110 5.292M12 5.354a4 4 0 010 5.292m0-5.292a4 4 0 01-3.536 2.646m3.536-2.646a4 4 0 003.536 2.646"/></svg></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Tugas Dibuat</p>
                <p class="text-3xl font-bold text-gray-800">{{ $taskCount }}</p>
            </div>
            <div class="p-3 rounded-full bg-green-100"><svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Tugas Selesai</p>
                <p class="text-3xl font-bold text-gray-800">{{ $completedTaskCount }}</p>
            </div>
            <div class="p-3 rounded-full bg-yellow-100"><svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Sesi Fokus</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalSessions }}</p>
            </div>
            <div class="p-3 rounded-full bg-red-100"><svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></div>
        </div>
    </div>

    {{-- Bagian Grafik dan Top User --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Grafik Performa Tugas --}}
        <div class="lg:col-span-1 bg-white p-4 md:p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-start w-full">
                <div class="flex-col items-center">
                  <h5 class="leading-none text-xl font-bold text-gray-900">Performa Tugas</h5>
                </div>
            </div>
            <div class="py-6" id="task-performance-chart"></div>
        </div>

        {{-- Grafik Laporan Aktivitas --}}
        <div class="lg:col-span-2 bg-white p-4 md:p-6 rounded-lg shadow-md">
            <div class="flex justify-between">
                <div>
                  <h5 class="leading-none text-3xl font-bold text-gray-900 pb-2">{{ $reportChartData['total_this_week'] }}</h5>
                  <p class="text-base font-normal text-gray-500">Tugas Selesai Minggu Ini</p>
                </div>
                <div class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 text-center">
                  {{-- Logic untuk persentase bisa ditambahkan nanti --}}
                </div>
            </div>
            <div id="activity-report-chart"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data dari Controller
        const taskPerformanceData = @json($taskPerformanceData);
        const reportChartData = @json($reportChartData);

        // 1. Grafik Performa Tugas (Donut Chart)
        const taskPerformanceOptions = {
            series: taskPerformanceData.series,
            labels: taskPerformanceData.labels,
            chart: { type: 'donut', height: 320 },
            colors: ['#10B981', '#6B7280', '#EF4444'], // Selesai (Hijau), Aktif (Abu-abu), Dihapus (Merah)
            legend: { position: 'bottom' },
            plotOptions: {
                pie: {
                    donut: {
                        labels: {
                            show: true,
                            name: { show: true },
                            value: { show: true },
                            total: {
                                show: true,
                                label: 'Total Tugas',
                                formatter: function (w) {
                                    const sum = w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                    return sum;
                                }
                            }
                        }
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val.toFixed(1) + "%"
                },
            },
        };
        if (document.getElementById("task-performance-chart")) {
            const chart = new ApexCharts(document.getElementById("task-performance-chart"), taskPerformanceOptions);
            chart.render();
        }

        // 2. Grafik Laporan Aktivitas (Area Chart)
        const activityReportOptions = {
            chart: { height: "100%", type: "area", fontFamily: "Inter, sans-serif", dropShadow: { enabled: false }, toolbar: { show: false } },
            tooltip: { enabled: true, x: { show: false } },
            fill: { type: "gradient", gradient: { opacityFrom: 0.55, opacityTo: 0, shade: "#1C64F2", gradientToColors: ["#1C64F2"] } },
            dataLabels: { enabled: false },
            stroke: { width: 4 },
            grid: { show: false },
            series: [{ name: "Tugas Selesai", data: reportChartData.data, color: "#1A56DB" }],
            xaxis: { categories: reportChartData.labels, labels: { show: false }, axisBorder: { show: false }, axisTicks: { show: false } },
            yaxis: { show: false },
        };
        if (document.getElementById("activity-report-chart")) {
            const chart = new ApexCharts(document.getElementById("activity-report-chart"), activityReportOptions);
            chart.render();
        }
    });
</script>
@endpush