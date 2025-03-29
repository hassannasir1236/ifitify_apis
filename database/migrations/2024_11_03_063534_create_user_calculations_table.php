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
        Schema::create('user_calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('calculation_type');
            $table->decimal('result', 10, 2);
            $table->string('units')->nullable();
            
            // Columns for BMR and TDEE
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('height', 8, 2)->nullable();
            $table->integer('age')->nullable();
            $table->string('activity_level')->nullable();
    
            // Columns for Goal Weight
            $table->decimal('current_weight', 8, 2)->nullable();
            $table->decimal('goal_weight', 8, 2)->nullable();
            $table->integer('days')->nullable();
    
            // Columns for Macronutrient Ratios
            $table->decimal('total_calories', 8, 2)->nullable();
            $table->decimal('carb_percentage', 5, 2)->nullable();
            $table->decimal('protein_percentage', 5, 2)->nullable();
            $table->decimal('fat_percentage', 5, 2)->nullable();
            // $table->decimal('grams_of_carbs', 5, 2)->nullable();
            // $table->decimal('grams_of_protein', 5, 2)->nullable();
            // $table->decimal('grams_of_fat', 5, 2)->nullable();

    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_calculations');
    }
};
