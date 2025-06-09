<?php
// File: app/Http/Controllers/SettingsController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        // PERBAIKAN: Validasi sekarang menggunakan nama kunci dari JavaScript (camelCase)
        $validatedData = $request->validate([
            'pomodoro' => 'required|integer|min:1',
            'shortBreak' => 'required|integer|min:1',
            'longBreak' => 'required|integer|min:1',
            'longBreakInterval' => 'required|integer|min:1',
            'autoStartBreaks' => 'required|boolean',
            'autoStartPomodoros' => 'required|boolean',
            'autoCheckTasks' => 'required|boolean',
            'autoSwitchTasks' => 'required|boolean',
        ]);

        // Update data user dengan menambahkan prefix 'setting_'
        $user->update([
            'setting_pomodoro' => $validatedData['pomodoro'],
            'setting_short_break' => $validatedData['shortBreak'],
            'setting_long_break' => $validatedData['longBreak'],
            'setting_long_break_interval' => $validatedData['longBreakInterval'],
            'setting_auto_start_breaks' => $validatedData['autoStartBreaks'],
            'setting_auto_start_pomodoros' => $validatedData['autoStartPomodoros'],
            'setting_auto_check_tasks' => $validatedData['autoCheckTasks'],
            'setting_auto_switch_tasks' => $validatedData['autoSwitchTasks'],
        ]);

        return response()->json(['message' => 'Pengaturan berhasil diperbarui.']);
    }
}
