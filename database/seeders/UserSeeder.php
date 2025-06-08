<?php // database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun yang bisa Anda gunakan untuk login
        User::factory()->create([
            'name' => 'User PomoCat',
            'email' => 'user@pomocat.test',
        ]);

        // Membuat 2 user acak lainnya
        User::factory()->count(2)->create();
    }
}
