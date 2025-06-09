<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PomoTimeController extends Controller
{
    /**
     * Pastikan hanya user yang terotentikasi yang bisa mengakses.
     */
    

    /**
     * Menampilkan halaman Pomotime beserta data pengaturan user.
     */
    public function index()
    {
        $settings = [];
        $isGuest = Auth::guest();

        if (!$isGuest) {
            $user = Auth::user();
            // Jika login, ambil pengaturan dari database
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
        }

        return view('pomotime', [
            'settings' => $settings, // Kirim settings (bisa kosong jika tamu)
            'isGuest' => $isGuest,   // Kirim status tamu
        ]);
    }
}
