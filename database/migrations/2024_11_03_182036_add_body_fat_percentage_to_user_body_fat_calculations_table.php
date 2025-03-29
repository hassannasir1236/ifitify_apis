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
        Schema::table('user_body_fat_calculations', function (Blueprint $table) {
            $table->decimal('body_fat_percentage', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_body_fat_calculations', function (Blueprint $table) {
            $table->dropColumn('body_fat_percentage');
        });
    }
};
