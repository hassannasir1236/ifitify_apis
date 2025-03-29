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
        Schema::table('user_interval_workouts', function (Blueprint $table) {
            $table->string('interval_workout_type')->default("INTERVAL_WORKOUT");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_interval_workouts', function (Blueprint $table) {
            $table->dropColumn('interval_workout_type');
        });
    }
};
