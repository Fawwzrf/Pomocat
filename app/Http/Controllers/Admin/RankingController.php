<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RankingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $rankedUsers = User::query()
            ->withSum(['tasks' => fn($query) => $query->withTrashed()], 'sessions_completed')
            ->when($search, fn($query, $term) => $query->where('name', 'like', "%{$term}%"))
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

        return view('admin.ranking.index', compact('rankedUsers'));
    }
}
