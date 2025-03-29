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
        Schema::table('user_exercises', function (Blueprint $table) {

            $table->integer('duration')->nullable()->change();

        });
        Schema::table('user_interval_workouts', function (Blueprint $table) {

            $table->integer('full_screen_duration')->nullable()->change();
            $table->integer('preparation_duration')->nullable()->change();
            $table->integer('rest_between_events')->nullable()->change();

        });
        Schema::table('quick_workouts', function (Blueprint $table) {

            $table->integer('duration')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quick_workouts', function (Blueprint $table) {
            $table->string('duration')->nullable()->change();
        });
        Schema::table('user_interval_workouts', function (Blueprint $table) {
            $table->string('full_screen_duration')->nullable()->change();
            $table->string('preparation_duration')->nullable()->change();
            $table->string('rest_between_events')->nullable()->change();

        });
        Schema::table('user_exercises', function (Blueprint $table) {
            $table->string('duration')->nullable()->change();
        });
    }
};
