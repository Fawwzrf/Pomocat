<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        // Mengambil data untuk kartu ringkasan (General Overview)
        $allUserTasks = $user->tasks()->withTrashed();
        $totalFocusSessions = (int) $allUserTasks->clone()->sum('sessions_completed');
        $pomodoroDuration = $user->setting_pomodoro ?? 25;

        $reportData = [
            'total_focus_sessions' => $totalFocusSessions,
            'total_focus_hours' => round(($totalFocusSessions * $pomodoroDuration) / 60, 1),
            'tasks_completed' => (int) $allUserTasks->clone()->where('completed', true)->count(),
            'rank' => User::find($user->id)->rank, // Asumsi ada method rank di model User
        ];

        // Mengambil 5 tugas terakhir yang dikerjakan untuk tabel "Latest Tasks"
        $latestTasks = $user->tasks()
            ->withTrashed()
            ->orderBy('updated_at', 'desc')
            ->take(5)
            ->get();

        return view('profile.edit', [
            'user' => $user,
            'reportData' => $reportData,
            'latestTasks' => $latestTasks,
            'pomodoroDuration' => $pomodoroDuration,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
        ]);

        $user->fill($validated);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * BARU: Method untuk memperbarui password pengguna.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }

    /**
     * BARU: Method untuk memperbarui foto profil pengguna.
     */
    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => ['required', 'image', 'max:2048'], // Maksimal 2MB
        ]);

        $user = $request->user();

        // Hapus foto lama jika ada
        if ($user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Simpan foto baru dan update path di database
        $path = $request->file('photo')->store('profile-photos', 'public');
        $user->update(['profile_photo_path' => $path]);

        return back()->with('status', 'photo-updated');
    }
}
