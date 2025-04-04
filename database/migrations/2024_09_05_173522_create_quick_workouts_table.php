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
        Schema::create('quick_workouts', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            $table->string('category');
            $table->string('duration');
            $table->string('video_url');
            $table->string('gif_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_workouts');
    }
};
