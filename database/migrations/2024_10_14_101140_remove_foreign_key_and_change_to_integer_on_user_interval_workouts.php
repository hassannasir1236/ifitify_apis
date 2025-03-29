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
            // Drop the foreign key constraint
            $table->dropForeign(['video_id']);

            // Change the column to integer
            $table->bigInteger('video_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_interval_workouts', function (Blueprint $table) {
            // Recreate the foreign key constraint
            $table->foreign('video_id')->references('id')->on('videos');

            // Change the column back to unsignedBigInteger (or whatever it was before)
            $table->unsignedBigInteger('video_id')->change();
        });
    }
};
