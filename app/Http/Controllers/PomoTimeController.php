<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PomoTimeController extends Controller
{
    /**
     * Pastikan hanya user yang terotentikasi yang bisa mengakses.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Menampilkan halaman Pomotime beserta data pengaturan user.
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil semua data pengaturan dari user dan format agar sesuai dengan JavaScript
        $settings = [
            'pomodoro' => $user->setting_pomodoro,
            'shortBreak' => $user->setting_short_break,
            'longBreak' => $user->setting_long_break,
            'longBreakInterval' => $user->setting_long_break_interval,
            'autoStartBreaks' => (bool)$user->setting_auto_start_breaks,
            'autoStartPomodoros' => (bool)$user->setting_auto_start_pomodoros,
            'autoCheckTasks' => (bool)$user->setting_auto_check_tasks,
            'autoSwitchTasks' => (bool)$user->setting_auto_switch_tasks,
        ];

        // Kirim data settings ke view 'pomotime'
        return view('pomotime', ['settings' => $settings]);
    }
}
