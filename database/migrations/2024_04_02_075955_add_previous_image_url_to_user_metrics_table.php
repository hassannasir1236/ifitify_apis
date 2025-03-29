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
        Schema::table('user_metrics', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable();
            $table->string('previous_image_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_metrics', function (Blueprint $table) {
            $table->dropColumn(['user_id','previous_image_url']);
        });
    }
};
