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
        Schema::table('videos', function (Blueprint $table) {
            $table->string('image_url')->nullable();
            $table->longText('instructions')->nullable();  
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->json('training_level_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn(['instruction', 'image_url']);
        });
        Schema::table('videos', function (Blueprint $table) {
            $table->bigInteger('training_level_id')->change();
        });
    }
};
