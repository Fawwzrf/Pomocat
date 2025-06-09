<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Data untuk Kartu Statistik Atas ---
        $userCount = User::count();
        $taskCount = Task::withTrashed()->count();
        $completedTaskCount = Task::withTrashed()->where('completed', true)->count();
        $totalSessions = (int) Task::withTrashed()->sum('sessions_completed');

        // --- Data untuk Grafik Performa Tugas (Donut Chart) ---
        $activeTaskCount = $taskCount - $completedTaskCount - Task::onlyTrashed()->count();
        $taskPerformanceData = [
            'labels' => ['Selesai', 'Aktif', 'Dihapus'],
            'series' => [$completedTaskCount, $activeTaskCount, Task::onlyTrashed()->count()],
        ];

        // --- Data untuk Top User ---
        $topUser = User::withSum(['tasks' => fn($q) => $q->withTrashed()], 'sessions_completed')
            ->orderBy('tasks_sum_sessions_completed', 'desc')
            ->first();

        // --- Data untuk Grafik Laporan Aktivitas (Area Chart) ---
        $reportChartData = [];
        // Kita ambil data untuk 7 hari terakhir untuk tampilan default
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $completedCount = Task::withTrashed()->where('completed', true)->whereDate('updated_at', $date)->count();

            $reportChartData['labels'][] = $date->format('d M');
            $reportChartData['data'][] = $completedCount;
        }
        $reportChartData['total_this_week'] = array_sum($reportChartData['data']);

        return view('admin.dashboard', compact(
            'userCount',
            'taskCount',
            'completedTaskCount',
            'totalSessions',
            'taskPerformanceData',
            'topUser',
            'reportChartData'
        ));
    }
}
