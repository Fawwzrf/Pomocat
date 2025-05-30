<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'usersActive' => 23,
            'totalUsers' => 199,
            'activeTasks' => 89,
            'completedTasks' => 28,
            'productivity' => 76,
            'taskData' => [
                'completed' => 76,
                'inProgress' => 32,
                'behind' => 13,
            ],
            'topUsers' => [
                ['name' => 'Irfan Romadhon', 'time' => '180:00', 'status' => 'Active'],
                ['name' => 'M. Zaki Dzulfikar', 'time' => '120:00', 'status' => 'Inactive'],
                ['name' => 'Revalina Fidya A.', 'time' => '90:00', 'status' => 'Active'],
                ['name' => 'Reno Barak', 'time' => '80:00', 'status' => 'Active'],
            ],
        ]);
    }
}