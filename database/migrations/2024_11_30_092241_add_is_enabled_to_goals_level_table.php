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
        Schema::table('goal_levels', function (Blueprint $table) {
            $table->boolean('is_enabled')->nullable()->after('training_level_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('goal_levels', function (Blueprint $table) {
            $table->dropColumn('is_enabled');
        });
    }
};
