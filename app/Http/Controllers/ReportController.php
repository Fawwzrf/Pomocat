<?php

namespace App\Http\Controllers;

use App\Models\User; // <-- PERBAIKAN UTAMA ADA DI SINI. PASTIKAN BARIS INI ADA.
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    /**
     * Mengumpulkan, menghitung, dan mengembalikan data ringkasan untuk laporan.
     */
    public function summary(Request $request)
    {
        $user = Auth::user();
        $range = $request->query('range', 'week');

        $activeDates = $user->tasks()->withTrashed()->where('sessions_completed', '>', 0)
            ->selectRaw('DATE(updated_at) as date')->groupBy('date')->orderBy('date', 'desc')
            ->pluck('date')->map(fn($dateString) => Carbon::parse($dateString));

        $dayAccessed = $activeDates->count();
        $dayStreak = 0;

        if ($activeDates->isNotEmpty() && ($activeDates->first()->isToday() || $activeDates->first()->isYesterday())) {
            $dayStreak = 1;
            $previousDate = $activeDates->first();
            foreach ($activeDates->slice(1) as $date) {
                if ($previousDate->diffInDays($date) == 1) {
                    $dayStreak++;
                    $previousDate = $date;
                } else {
                    break;
                }
            }
        }
        if ($activeDates->isNotEmpty() && !$activeDates->first()->isToday() && !$activeDates->first()->isYesterday()) {
            $dayStreak = 0;
        }

        $chartData = [];
        $totalForPeriod = 0;
        $periodLabel = ($range === 'month') ? 'Bulan Ini' : 'Minggu Ini';
        $daysToLoop = ($range === 'month') ? 29 : 6;
        $startDate = Carbon::today()->subDays($daysToLoop);

        $totalForPeriod = $user->tasks()->withTrashed()->whereBetween('updated_at', [$startDate, Carbon::now()])->sum('sessions_completed');

        for ($i = $daysToLoop; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $sessions = $user->tasks()->withTrashed()->whereDate('updated_at', $date)->sum('sessions_completed');
            $chartData['labels'][] = $date->format('d M');
            $chartData['data'][] = (int) $sessions;
        }

        return response()->json([
            'total_focus_sessions' => (int) $user->tasks()->withTrashed()->sum('sessions_completed'),
            'total_focus_minutes' => (int) ($user->tasks()->withTrashed()->sum('sessions_completed') * $user->setting_pomodoro),
            'tasks_completed' => $user->tasks()->withTrashed()->where('completed', true)->count(),
            'day_accessed' => $dayAccessed,
            'day_streak' => $dayStreak,
            'chart_data' => $chartData,
            'total_for_period' => (int) $totalForPeriod,
            'period_label' => $periodLabel,
        ]);
    }

    public function details(Request $request)
    {
        $user = Auth::user();
        $pomodoroDuration = $user->setting_pomodoro;

        // Ambil keyword pencarian dari request
        $search = $request->query('search');

        $completedTasksQuery = $user->tasks()
            ->withTrashed()
            ->where('completed', true)
            ->when($search, function ($query, $searchTerm) {
                // Lakukan pencarian pada kolom title dan notes
                return $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', "%{$searchTerm}%")
                        ->orWhere('notes', 'like', "%{$searchTerm}%");
                });
            })
            ->latest('updated_at');

        $completedTasks = $completedTasksQuery->paginate(5)->withQueryString();

        return view('pomotime.partials._report-detail-table', compact('completedTasks', 'pomodoroDuration'));
    }

    /**
     * BARU: Mengekspor data tugas yang selesai ke dalam file CSV.
     */
    public function exportCsv()
    {
        $user = Auth::user();
        $tasks = $user->tasks()->withTrashed()->where('completed', true)->get();
        $pomodoroDuration = $user->setting_pomodoro;

        $fileName = 'pomocat_report_' . date('Y-m-d') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function () use ($tasks, $pomodoroDuration) {
            $file = fopen('php://output', 'w');
            // Tambahkan header kolom
            fputcsv($file, ['Tanggal Selesai', 'Judul Tugas', 'Catatan', 'Total Menit']);

            // Tambahkan data baris per baris
            foreach ($tasks as $task) {
                fputcsv($file, [
                    $task->updated_at->format('d M Y, H:i'),
                    $task->title,
                    $task->notes,
                    $task->sessions_completed * $pomodoroDuration
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function ranking(Request $request)
    {
        $search = $request->query('search');

        $rankedUsersData = User::query() // Sekarang Laravel tahu User merujuk ke App\Models\User
            ->withSum(['tasks' => fn($query) => $query->withTrashed()], 'sessions_completed')
            ->when($search, function ($query, $searchTerm) {
                return $query->where('name', 'like', "%{$searchTerm}%");
            })
            ->get()
            ->map(function ($user) {
                $totalSessions = $user->tasks_sum_sessions_completed ?? 0;
                $pomodoroDuration = $user->setting_pomodoro ?? 25;
                $user->total_minutes = $totalSessions * $pomodoroDuration;
                return $user;
            })
            ->sortByDesc('total_minutes')
            ->values()
            ->map(function ($user, $key) {
                $user->rank = $key + 1;
                $user->total_hours = round($user->total_minutes / 60, 1);
                return $user;
            });

        $myRank = $rankedUsersData->firstWhere('id', Auth::id());
        $podium = $rankedUsersData->take(3);

        return response()->json([
            'my_rank' => $myRank,
            'podium' => $podium,
            'full_ranking' => $rankedUsersData,
        ]);
    }
}