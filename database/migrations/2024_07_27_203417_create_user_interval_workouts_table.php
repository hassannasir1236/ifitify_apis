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
        Schema::create('user_interval_workouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('video_id')->constrained('videos');
            $table->string('interval_workout_id')->default(Str::uuid());
            $table->string('interval_workout_name')->nullable();
            $table->string('full_screen_duration');
            $table->string('preparation_duration');
            $table->string('rest_between_events');
            $table->integer('number_of_exercises')->default(0);
            $table->integer('number_of_sets')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_interval_workouts');
    }
};
