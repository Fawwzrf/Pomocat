<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Kita tidak perlu user_id di sini karena akan diisi oleh Seeder
            'title' => $this->faker->sentence(4), // Membuat judul acak dengan 4 kata
            'notes' => $this->faker->boolean(50) ? $this->faker->paragraph(2) : null, // 50% kemungkinan memiliki catatan
            'sessions_needed' => $this->faker->numberBetween(1, 8), // Estimasi sesi antara 1-8
            'sessions_completed' => 0, // Default sesi selesai adalah 0
            'completed' => false, // Default status belum selesai
        ];
    }
}
