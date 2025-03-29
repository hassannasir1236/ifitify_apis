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
            $table->string('preparation_duration');
            $table->string('rest_between_events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quick_workouts', function (Blueprint $table) {
            $table->dropColumn(['rest_between_events', 'preparation_duration']);
        });
    }
};
