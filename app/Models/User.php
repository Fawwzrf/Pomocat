<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'setting_pomodoro',
        'setting_short_break',
        'setting_long_break',
        'setting_long_break_interval',
        'setting_auto_start_breaks',
        'setting_auto_start_pomodoros',
        'setting_auto_check_tasks',
        'setting_auto_switch_tasks',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getRankAttribute()
    {
        $rankedUsers = User::query()
            ->withSum(['tasks' => fn($query) => $query->withTrashed()], 'sessions_completed')
            ->get()
            ->map(function ($user) {
                $totalSessions = $user->tasks_sum_sessions_completed ?? 0;
                $pomodoroDuration = $user->setting_pomodoro ?? 25;
                $user->total_minutes = $totalSessions * $pomodoroDuration;
                return $user;
            })
            ->sortByDesc('total_minutes')
            ->pluck('id')
            ->flip(); // Balik array, value jadi key, key jadi value

        return ($rankedUsers[$this->id] ?? 0) + 1;
    }
}
