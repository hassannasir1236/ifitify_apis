<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCalculation extends Model
{
    use HasFactory;
     // Define the fillable attributes for mass assignment
     protected $fillable = [
        'user_id',
        'calculation_type',
        'result',
        'units',

        // Fields for BMR and TDEE
        'sex',
        'weight',
        'height',
        'age',
        'activity_level',

        // Fields for Goal Weight Calculation
        'current_weight',
        'goal_weight',
        'days',
        'daily_goal_weight_change',
        'start_goal_weight_date',
        'end_goal_weight_date',

        // Fields for Macronutrient Ratios
        'total_calories',
        'grams_of_carbs',
        'grams_of_protein',
        'grams_of_fat',
        'calories_from_carbs',
        'calories_from_protein', 
        'calories_from_fat',
        'carb_percentage',
        'protein_percentage',
        'fat_percentage',
    ];

    /**
     * Set up the relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
