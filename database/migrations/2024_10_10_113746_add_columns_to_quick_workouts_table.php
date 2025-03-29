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
        Schema::table('quick_workouts', function (Blueprint $table) {
          $table->renameColumn('duration', 'workout_duration');
          $table->renameColumn('rest_between_events', 'rest_between_sets');
          $table->integer('exercises_duration')->default(0);
          $table->integer('rest_between_exercises')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quick_workouts', function (Blueprint $table) {
            $table->renameColumn('workout_duration', 'duration');
            $table->renameColumn('rest_between_sets', 'rest_between_events');
            $table->dropColumn(['exercises_duration']);
            $table->dropColumn(['rest_between_exercises']);
        });
    }
};
