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
        Schema::table('users', function (Blueprint $table) {
            // Kita gunakan prefix 'setting_' untuk membedakan dengan kolom lain
            $table->integer('setting_pomodoro')->default(25)->after('remember_token');
            $table->integer('setting_short_break')->default(5)->after('setting_pomodoro');
            $table->integer('setting_long_break')->default(15)->after('setting_short_break');
            $table->integer('setting_long_break_interval')->default(4)->after('setting_long_break');
            $table->boolean('setting_auto_start_breaks')->default(true)->after('setting_long_break_interval');
            $table->boolean('setting_auto_start_pomodoros')->default(false)->after('setting_auto_start_breaks');
            $table->boolean('setting_auto_check_tasks')->default(true)->after('setting_auto_start_pomodoros');
            $table->boolean('setting_auto_switch_tasks')->default(true)->after('setting_auto_check_tasks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'setting_pomodoro',
                'setting_short_break',
                'setting_long_break',
                'setting_long_break_interval',
                'setting_auto_start_breaks',
                'setting_auto_start_pomodoros',
                'setting_auto_check_tasks',
                'setting_auto_switch_tasks',
            ]);
        });
    }
};
