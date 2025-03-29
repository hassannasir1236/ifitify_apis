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
        Schema::create('user_metrics', function (Blueprint $table) {
            $table->id();
            $table->integer('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->integer('body_fat')->nullable();
            $table->string('chest')->nullable();
            $table->string('waist')->nullable();
            $table->string('hip')->nullable();
            $table->string('left_thigh')->nullable();
            $table->string('right_thigh')->nullable();
            $table->string('left_calf')->nullable();
            $table->string('right_calf')->nullable();
            $table->string('left_bicep')->nullable();
            $table->string('right_bicep')->nullable();
            $table->string('progress_image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_metrics');
    }
};
