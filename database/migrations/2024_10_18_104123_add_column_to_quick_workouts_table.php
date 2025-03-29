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
            $table->bigInteger('exercise_each_set')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quick_workouts', function (Blueprint $table) {
            $table->dropColumn('exercise_each_set');
        });
    }
};
