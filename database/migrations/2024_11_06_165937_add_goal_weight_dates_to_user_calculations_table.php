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
        Schema::table('user_calculations', function (Blueprint $table) {
            $table->date('daily_goal_weight_change')->nullable()->after('days');
            $table->date('start_goal_weight_date')->nullable()->after('daily_goal_weight_change');
            $table->date('end_goal_weight_date')->nullable()->after('start_goal_weight_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_calculations', function (Blueprint $table) {
            $table->dropColumn(['start_goal_weight_date', 'end_goal_weight_date', 'daily_goal_weight_change']);
        });
    }
};
