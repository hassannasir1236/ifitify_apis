<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_exercises', function (Blueprint $table) {
            $table->string('custom_workout_id')->default(Str::uuid());
            $table->string('name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_exercises', function (Blueprint $table) {
            $table->dropColumn(['custom_workout_id', 'name']);
        });
    }
};
