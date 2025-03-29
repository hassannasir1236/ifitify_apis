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
            $table->decimal('grams_of_carbs', 5, 2)->nullable();
            $table->decimal('grams_of_protein', 5, 2)->nullable();
            $table->decimal('grams_of_fat', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_calculations', function (Blueprint $table) {
            $table->dropColumn(['grams_of_carbs', 'grams_of_protein', 'grams_of_fat']);
        });
    }
};
