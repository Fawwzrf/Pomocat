<?php // database/seeders/TaskSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Buat beberapa tugas untuk setiap user
            Task::factory()->count(5)->create([
                'user_id' => $user->id,
                'completed' => true,
                // Beri jumlah sesi selesai secara acak
                'sessions_completed' => rand(1, 10)
            ]);
        }
    }
}
