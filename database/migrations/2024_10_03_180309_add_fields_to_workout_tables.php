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
            $table->string('duration')->nullable();
        });
        Schema::table('user_interval_workouts', function (Blueprint $table) {
            $table->string('is_completed')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_interval_workouts', function (Blueprint $table) {
            $table->dropColumn(['is_completed']);
        });
        Schema::table('user_exercises', function (Blueprint $table) {
            $table->dropColumn(['duration']);
        });
    }
};
