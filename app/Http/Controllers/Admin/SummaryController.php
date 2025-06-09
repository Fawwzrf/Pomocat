<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SummaryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $sortBy = $request->query('sort_by', 'total_hours');
        $sortDirection = $request->query('sort_direction', 'desc');

        // Query utama menggunakan JOIN dan kalkulasi langsung di database
        $usersQuery = User::query()
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.profile_photo_path',
                'users.created_at',
                // Kalkulasi semua data agregat menggunakan selectRaw
                DB::raw('COALESCE(SUM(tasks.sessions_completed), 0) as total_sessions'),
                DB::raw('COUNT(DISTINCT DATE(tasks.updated_at)) as days_accessed'),
                DB::raw('ROUND((COALESCE(SUM(tasks.sessions_completed), 0) * users.setting_pomodoro) / 60, 1) as total_hours')
            )
            // Gunakan LEFT JOIN untuk tetap menampilkan user meskipun belum punya task
            ->leftJoin('tasks', 'users.id', '=', 'tasks.user_id')
            ->when($search, function ($query, $searchTerm) {
                return $query->where('users.name', 'like', "%{$searchTerm}%");
            })
            ->groupBy('users.id', 'users.name', 'users.email', 'users.profile_photo_path', 'users.created_at', 'users.setting_pomodoro')
            ->orderBy($sortBy, $sortDirection)
            ->paginate(15)
            ->withQueryString();

        return view('admin.summary.index', [
            'users' => $usersQuery,
            'currentSortBy' => $sortBy,
            'currentSortDirection' => $sortDirection,
        ]);
    }
}
