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
        Schema::table('exercises', function (Blueprint $table) {
            if (!Schema::hasColumn('exercises', 'training_level_id')) {
                $table->bigInteger('training_level_id')->nullable();
            }
            if (!Schema::hasColumn('exercises', 'exercise_equipment_id')) {
                $table->bigInteger('exercise_equipment_id')->nullable();
            }
            if (!Schema::hasColumn('exercises', 'batch_id')) {
                $table->bigInteger('batch_id')->nullable();
            }
            if (!Schema::hasColumn('exercises', 'batch_type')) {
                $table->bigInteger('batch_type')->nullable();
            }
            if (!Schema::hasColumn('exercises', 'type')) {
                $table->string('type')->nullable();
            }
            if (!Schema::hasColumn('exercises', 'video_url')) {
                $table->string('video_url')->nullable();
            }
            if (!Schema::hasColumn('exercises', 'image_url')) {
                $table->string('image_url')->nullable();
            }
            if (!Schema::hasColumn('exercises', 'instructions')) {
                $table->string('instructions')->nullable();
            }
            if (!Schema::hasColumn('exercises', 'thumbnail')) {
                $table->string('thumbnail')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exercises', function (Blueprint $table) {
            $table->dropColumn(['training_level_id', 'exercise_equipment_id', 'batch_id', 'batch_type', 'type', 'video_url', 'image_url', 'instructions', 'thumbnail']);
        });
    }
};
