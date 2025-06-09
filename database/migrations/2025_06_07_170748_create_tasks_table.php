<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // Menghubungkan task ke user. Jika user dihapus, semua task miliknya juga terhapus.
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('title'); // Judul task
            $table->text('notes')->nullable(); // Catatan untuk task (opsional)
            $table->integer('sessions_needed')->default(1); // Jumlah sesi pomodoro yang dibutuhkan
            $table->integer('sessions_completed')->default(0); // Jumlah sesi yang sudah selesai
            $table->boolean('completed')->default(false); // Status task (selesai/belum)

            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
