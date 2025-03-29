<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCalculation;
use App\Models\UserBodyFatCalculation;
use Carbon\Carbon;
class UserCalculationController extends Controller
{
    public function calculateBMR(Request $request)
    {
        $validated = $request->validate([
            'sex' => 'required|in:male,female',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'age' => 'required|integer',
            'unit_type' => 'required|in:US,Metric',
            // 'weight_unit' => 'required|in:lb,kg',
            // 'height_unit' => 'required|in:ft,cm',
        ]);
    
        $weight = (float) $validated['weight'];
        $height = (float) $validated['height'];

        $metricWeight = $weight;
        $metricHeight = $height;
    
        if ($validated['unit_type'] === 'US') {
            // if ($validated['weight_unit'] === 'kg') {
            //     $metricWeight = $weight; 
            // } else {
                $metricWeight = $weight * 0.453592; 
            // }
            // if ($validated['height_unit'] === 'cm') {
            //     $metricHeight = $height; 
            // } else {
                $metricHeight = $height * 30.48; 
            // }
        } 
        else { 
            // if ($validated['weight_unit'] === 'lb') {
            //     $metricWeight = $weight * 0.453592;
            // }
            // if ($validated['height_unit'] === 'ft') {
            //     $metricHeight = $height * 30.48; 
            // }
        }
    
        // if ($validated['sex'] === 'male') {
        //     $bmr = 88.362 + (13.397 * $metricWeight) + (4.799 * $metricHeight) - (5.677 * $validated['age']);
        // } else {
        //     $bmr = 447.593 + (9.247 * $metricWeight) + (3.098 * $metricHeight) - (4.330 * $validated['age']);
        // }
        if ($validated['sex'] === 'male') {
            $bmr = (10 * $metricWeight) + (6.25 * $metricHeight) - (5 * $validated['age']) + 5;
        } else {
            $bmr =  (10 * $metricWeight) + (6.25 * $metricHeight) - (5 * $validated['age']) - 161;
        }
     
        UserCalculation::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'calculation_type' => 'BMR'
            ],
            [
                'result' => round($bmr, 2),
                'units' => $validated['unit_type'],
                'sex' => $validated['sex'],
                'weight' => round($metricWeight, 2),
                'height' => round($metricHeight, 2),
                'age' => $validated['age']
            ]
        );
        
    
       
        return response()->json([
            'bmr' => round($bmr, 2),
            'message' => "BMR is " . round($bmr, 2) . " calories/day."
        ]);
    }
    
    public function calculateTDEE(Request $request)
    {
        $validated = $request->validate([
            'bmr' => 'required|numeric',
            'activity_level' => 'required|in:sedentary,lightly_active,moderately_active,very_active,extra_active',
            // 'unit_type' => 'required|in:US,Metric',
        ]);

        $multipliers = [
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            'extra_active' => 1.9,
        ];

        $tdee = $validated['bmr'] * $multipliers[$validated['activity_level']];

        UserCalculation::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'calculation_type' => 'TDEE'
            ],
            [
                'result' => round($tdee, 2),
                'units' => $validated['unit_type'] ?? null,
                'activity_level' => $validated['activity_level']
            ]
        );

        return response()->json(['tdee' => round($tdee, 2), 'message' => "TDEE is $tdee calories/day."]);
    }
    

    // public function calculateGoalWeight(Request $request)
    // {
    //     $validated = $request->validate([
    //         'current_weight' => 'required|numeric',
    //         'goal_weight' => 'required|numeric',
    //         'days' => 'required|integer|min:1',
    //         'unit_type' => 'required|in:US,Metric',
    //         'weight_unit' => 'required|in:lb,kg',
    //     ]);
    
    //     $currentWeightKg = $validated['current_weight'];
    //     $goalWeightKg = $validated['goal_weight'];
    
    //     if ($validated['unit_type'] === 'US') {
    //         if ($validated['weight_unit'] === 'lb') {
    //             $currentWeightKg *= 0.453592; 
    //             $goalWeightKg *= 0.453592; 
    //         }
    //     } else { 
    //         if ($validated['weight_unit'] === 'lb') {
    //             $currentWeightKg *= 0.453592;
    //             $goalWeightKg *= 0.453592; 
    //         }
    //     }
    
    //     $dailyChange = ($currentWeightKg - $goalWeightKg) / $validated['days'];
    //     $weeklyChange = $dailyChange * 7;
    
    //     UserCalculation::create([
    //         'user_id' => auth()->user()->id,
    //         'calculation_type' => 'Goal Weight',
    //         'result' => round($dailyChange, 2),
    //         'units' => $validated['unit_type'],
    //         'current_weight' => round($currentWeightKg, 2),
    //         'goal_weight' => round($goalWeightKg, 2),
    //         'days' => $validated['days']
    //     ]);
    
    //     return response()->json([
    //         'daily_weight_change' => round($dailyChange, 3),
    //         'weekly_weight_change' => round($weeklyChange, 3),
    //         'message' => "Daily weight change is " . round($dailyChange, 3) . " kg."
    //     ]);
    // }
    // public function calculateGoalWeight(Request $request)
    // {
    //     // Validate the incoming request
    //     $validated = $request->validate([
    //         'current_weight' => 'required|numeric',
    //         'goal_weight' => 'required|numeric',
    //         'days' => 'required|integer',
    //         'unit_type' => 'required|in:US,Metric',
    //         // 'weight_unit' => 'required|string',
    //     ]);
        
    //     $current_weight = (float) $validated['current_weight'];
    //     $goal_weight = (float) $validated['goal_weight'];

    //     $currentWeight = $current_weight;
    //     $goalWeight = $goal_weight;
    
    //     $days = $validated['days'];
        
    //     // $currentWeight = $request->input('current_weight');
    //     // $goalWeight = $request->input('goal_weight');

    //     if ($validated['unit_type'] === 'US') {
    //         $metric_Current_Weight = $currentWeight * 0.453592; 
    //         $metric_Goal_Weight = $goalWeight * 0.453592; 
    //     }else{
    //         $metric_Current_Weight = $currentWeight; 
    //         $metric_Goal_Weight = $goalWeight; 
    //     }

    //     $weightChangeNeeded = $metric_Goal_Weight - $metric_Current_Weight;

    //     $dailyWeightChange = $weightChangeNeeded / $days;

    //     $targetWeight = $metric_Current_Weight + ($dailyWeightChange * $days);

    //     UserCalculation::updateOrCreate(
    //         [
    //             'user_id' => auth()->user()->id,
    //             'calculation_type' => 'Goal Weight'
    //         ],
    //         [
    //             'result' => round($targetWeight, 2),
    //             'units' => $validated['unit_type'],
    //             'current_weight' => round($metric_Current_Weight, 2),
    //             'goal_weight' => round($metric_Goal_Weight, 2),
    //             'days' => $validated['days'],
    //             'daily_goal_weight_change' => null,
    //             'start_goal_weight_date' => date('Y-m-d'),
    //             'end_goal_weight_date'  => date('Y-m-d', strtotime("+$days days"))
    //         ]
    //     );
    //     return response()->json([
    //         'start_date' => strtotime(date('Y-m-d')),
    //         'end_date' => strtotime(date('Y-m-d', strtotime("+$days days"))),
    //         'target_weight' => round($targetWeight, 2) . 'lb',
    //     ]);
    // }
    public function calculateGoalWeight(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'current_weight' => 'required|numeric',
            'goal_weight' => 'required|numeric',
            'days' => 'required|integer',
            'unit_type' => 'required|in:US,Metric',
        ]);
    
        $current_weight = (float) $validated['current_weight'];
        $goal_weight = (float) $validated['goal_weight'];
        $days = $validated['days'];
    
        // Convert weights to metric if needed
        if ($validated['unit_type'] === 'US') {
            $metric_Current_Weight = $current_weight * 0.453592;
            $metric_Goal_Weight = $goal_weight * 0.453592;
        } else {
            $metric_Current_Weight = $current_weight;
            $metric_Goal_Weight = $goal_weight;
        }
    
        $weightChangeNeeded = $metric_Goal_Weight - $metric_Current_Weight;
        $dailyWeightChange = $weightChangeNeeded / $days;
    
        // Monthly target weight calculation
        $monthlyGoals = [];
        $currentDate = strtotime(date('Y-m-d'));
        $monthlyDays = 30;  // average days in a month
    
        for ($i = 1; $i <= ceil($days / $monthlyDays); $i++) {
            $daysPassed = $i * $monthlyDays;
            $monthlyTargetWeight = $metric_Current_Weight + ($dailyWeightChange * min($daysPassed, $days));
            
            $goalDate = strtotime("+$daysPassed days", $currentDate);
    
            $monthlyGoals[] = [
                'month' => $i,
                'date' => date('Y-m-d', $goalDate),
                'formatted_date' => date('M j', $goalDate), 
               'target_weight' => round($validated['unit_type'] === 'US' ? $monthlyTargetWeight / 0.453592 : $monthlyTargetWeight, 2)
            ];
        }

        // Format the main target weight according to the unit type
        $finalTargetWeight = $validated['unit_type'] === 'US' 
        ? round($metric_Goal_Weight / 0.453592, 2) . ' lb' 
        : round($metric_Goal_Weight, 2) . ' kg';
    
        // Update or create the UserCalculation record
        UserCalculation::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'calculation_type' => 'Goal Weight'
            ],
            [
                'result' => round($metric_Goal_Weight, 2),
                'units' => $validated['unit_type'],
                'current_weight' => round($metric_Current_Weight, 2),
                'goal_weight' => round($metric_Goal_Weight, 2),
                'days' => $validated['days'],
                'start_goal_weight_date' => date('Y-m-d'),
                'end_goal_weight_date' => date('Y-m-d', strtotime("+$days days")),
            ]
        );
    
        return response()->json([
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d', strtotime("+$days days")),
            'target_weight' => $finalTargetWeight,
            'monthly_goals' => $monthlyGoals,
        ]);
    }
    

    
    
    public function calculateMacros(Request $request)
    {
        $tdeeCalculation = UserCalculation::where('user_id', auth()->user()->id)
            ->where('calculation_type', 'TDEE')
            ->first();
            
        $defaultCalories = $tdeeCalculation->result;

        $goal_weight_Calculation = UserCalculation::where('user_id', auth()->user()->id)
            ->where('calculation_type', 'Goal Weight')
            ->first();
        $goalWeight = $goal_weight_Calculation->goal_weight;
        $currentWeight = $goal_weight_Calculation->current_weight;

        $validated = $request->validate([
            'macronutrient_option' => 'required|in:Default,Ketogenic,Low-fat,High-protein,Low-carbohydrates',
            'total_calories' => 'nullable|numeric',
            'carb_percentage' => 'nullable|numeric',
            'protein_percentage' => 'nullable|numeric',
            'fat_percentage' => 'nullable|numeric',
        ]);

        if ($goalWeight > $currentWeight) {
            $totalCalories = $defaultCalories + ($defaultCalories * 0.15);
        } elseif ($goalWeight < $currentWeight) {
            $totalCalories = $defaultCalories - ($defaultCalories * 0.20);
        } else {
            $totalCalories = $defaultCalories;
        }

        $macronutrientOptions = [
            'Default' => ['carb_percentage' => 40, 'protein_percentage' => 30, 'fat_percentage' => 30],
            'Low-fat' => ['carb_percentage' => 60, 'protein_percentage' => 20, 'fat_percentage' => 20],
            'High-protein' => ['carb_percentage' => 40, 'protein_percentage' => 50, 'fat_percentage' => 10],
            'Low-carbohydrates' => ['carb_percentage' => 20, 'protein_percentage' => 25, 'fat_percentage' => 55],
            'Ketogenic' => ['carb_percentage' => 10, 'protein_percentage' => 20, 'fat_percentage' => 70],
        ];

        $macronutrientPercentages = $macronutrientOptions[$validated['macronutrient_option']];
        $caloriesFromCarbs = ($macronutrientPercentages['carb_percentage'] / 100) * $totalCalories;
        $caloriesFromProtein = ($macronutrientPercentages['protein_percentage'] / 100) * $totalCalories;
        $caloriesFromFat = ($macronutrientPercentages['fat_percentage'] / 100) * $totalCalories;

        $gramsOfCarbs = $caloriesFromCarbs / 4;
        $gramsOfProtein = $caloriesFromProtein / 4;
        $gramsOfFat = $caloriesFromFat / 9;

        UserCalculation::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'calculation_type' => 'Macronutrients'
            ],
            [
                'result' => round($totalCalories, 2),
                'units' => $validated['unit_type'] ?? 'g',
                'total_calories' => $totalCalories,
                'carb_percentage' => $macronutrientPercentages['carb_percentage'],
                'protein_percentage' => $macronutrientPercentages['protein_percentage'],
                'fat_percentage' => $macronutrientPercentages['fat_percentage'],
                'grams_of_carbs' => round($gramsOfCarbs, 2),
                'grams_of_protein' => round($gramsOfProtein, 2),
                'grams_of_fat' => round($gramsOfFat, 2),
                'calories_from_carbs' => round($caloriesFromCarbs, 2),
                'calories_from_protein' => round($caloriesFromProtein, 2),
                'calories_from_fat' => round($caloriesFromFat, 2),
            ]
        );

        return response()->json([
            'carb_percentage' => $macronutrientPercentages['carb_percentage'] . '%',
            'protein_percentage' => $macronutrientPercentages['protein_percentage'] . '%',
            'fat_percentage' => $macronutrientPercentages['fat_percentage'] . '%',
            'grams_of_carbs' => round($gramsOfCarbs, 2),
            'grams_of_protein' => round($gramsOfProtein, 2),
            'grams_of_fat' => round($gramsOfFat, 2),
            'calories_from_carbs' => round($caloriesFromCarbs, 2) . 'cal',
            'calories_from_protein' => round($caloriesFromProtein, 2) . 'cal',
            'calories_from_fat' => round($caloriesFromFat, 2) . 'cal',
            'total_calories' => round($totalCalories, 2),
            'message' => "Daily intake: carbs " . round($gramsOfCarbs, 2) . "g, protein " . 
                        round($gramsOfProtein, 2) . "g, fat " . round($gramsOfFat, 2) . "g."
        ]);
    }    
    // get the report for BMR Calculator
    public function bmr_report_generate()
    {
        $bmrCalculation = UserCalculation::where('user_id', auth()->user()->id)
                                         ->where('calculation_type', 'BMR')
                                         ->first();
    
        $tdeeCalculation = UserCalculation::where('user_id', auth()->user()->id)
                                          ->where('calculation_type', 'TDEE')
                                          ->first();
    
        $goalWeightCalculation = UserCalculation::where('user_id', auth()->user()->id)
                                                ->where('calculation_type', 'Goal Weight')
                                                ->first();
    
        $macronutrientCalculation = UserCalculation::where('user_id', auth()->user()->id)
                                                   ->where('calculation_type', 'Macronutrients')
                                                   ->first();
    
        $goalWeightResponse = null;
        if ($goalWeightCalculation) {
            $startDate = $goalWeightCalculation->start_goal_weight_date;
            $endDate = $goalWeightCalculation->end_goal_weight_date;
            $currentWeight = $goalWeightCalculation->current_weight;
            $targetWeight = $goalWeightCalculation->goal_weight;
            $days = $goalWeightCalculation->days;
            $unitType = $goalWeightCalculation->units;
    
            $currentWeightInUnit = $unitType === 'US' ? round($currentWeight / 0.453592, 2) : round($currentWeight, 2);
            $targetWeightInUnit = $unitType === 'US' ? round($targetWeight / 0.453592, 2) : round($targetWeight, 2);
    
            $targetWeightWithUnit = $targetWeightInUnit . ($unitType === 'US' ? ' lb' : ' kg');
            
            $weightChangeNeeded = $goalWeightCalculation->goal_weight - $goalWeightCalculation->current_weight;
            $dailyWeightChange = $weightChangeNeeded / $days;
    
            $monthlyGoals = [];
            $currentDate = strtotime($startDate);
            $monthlyDays = 30;  
    
            for ($i = 1; $i <= ceil($days / $monthlyDays); $i++) {
                $daysPassed = $i * $monthlyDays;
                $monthlyTargetWeight = $currentWeight + ($dailyWeightChange * min($daysPassed, $days));
                $monthlyTargetWeightInUnit = $unitType === 'US'
                                            ? round($monthlyTargetWeight / 0.453592, 2)
                                            : round($monthlyTargetWeight, 2);
    
                $monthlyGoals[] = [
                    'month' => $i,
                    'date' => date('Y-m-d', strtotime("+$daysPassed days", $currentDate)),
                    'target_weight' => $monthlyTargetWeightInUnit 
                ];
            }
    
            $goalWeightResponse = [
                'start_date' => $startDate,
                'end_date' => $endDate,
                'target_weight' => $targetWeightWithUnit,
                'monthly_goals' => $monthlyGoals,
            ];
        }
    
        return response()->json([
            'bmr' => $bmrCalculation ? [
                'result' => $bmrCalculation->result,
                'units' => $bmrCalculation->units,
                'sex' => $bmrCalculation->sex,
                'weight' => $bmrCalculation->weight,
                'height' => $bmrCalculation->height,
                'age' => $bmrCalculation->age
            ] : null,
    
            'tdee' => $tdeeCalculation ? [
                'result' => $tdeeCalculation->result,
                'units' => $tdeeCalculation->units,
                'activity_level' => $tdeeCalculation->activity_level,
                'weight' => $tdeeCalculation->weight,
                'height' => $tdeeCalculation->height,
                'age' => $tdeeCalculation->age
            ] : null,
    
            'goal_weight' => $goalWeightResponse,
    
            'macronutrients' => $macronutrientCalculation ? [
                'carb_percentage' => $macronutrientCalculation->carb_percentage . '%',
                'protein_percentage' => $macronutrientCalculation->protein_percentage . '%',
                'fat_percentage' => $macronutrientCalculation->fat_percentage . '%',
                'grams_of_carbs' => $macronutrientCalculation->grams_of_carbs . 'g',
                'grams_of_protein' => $macronutrientCalculation->grams_of_protein . 'g',
                'grams_of_fat' => $macronutrientCalculation->grams_of_fat . 'g',
                'calories_from_carbs' => $macronutrientCalculation->calories_from_carbs . 'cal',
                'calories_from_protein' => $macronutrientCalculation->calories_from_protein . 'cal',
                'calories_from_fat' => $macronutrientCalculation->calories_from_fat . 'cal',
                'total_calories' => $macronutrientCalculation->total_calories,
            ] : null,
        ]);
    }     
    
    // calculate the body fat
    public function calculateBodyFat(Request $request)
    {
        $validated = $request->validate([
            'gender' => 'required|in:male,female',
            'waist' => 'required|numeric',
            'neck' => 'required|numeric',
            'height_cm' => 'required|numeric',
            'hips' => 'nullable|numeric', 
        ]);
    
        $heightInches = $validated['height_cm'] * 0.393701;
    
        if ($validated['gender'] === 'male') {
            $waistNeckDifference = $validated['waist'] - $validated['neck'];
            $bodyFatPercentage = (86.010 * log10($waistNeckDifference)) - 
                                (70.041 * log10($heightInches)) + 36.76;
        } else {
            if (!isset($validated['hips'])) {
                return response()->json(['message' => 'Hips measurement is required for women.'], 400);
            }
            $waistHipNeckSum = $validated['waist'] + $validated['hips'] - $validated['neck'];
            $bodyFatPercentage = (163.205 * log10($waistHipNeckSum)) - 
                                (97.684 * log10($heightInches)) - 78.387;
        }
    
        $bodyFatPercentage = round($bodyFatPercentage, 2);
    
        // UserBodyFatCalculation::updateOrCreate(
        //     [
        //         'user_id' => auth()->user()->id,
        //     ],
        //     [
        //         'body_fat_percentage' => $bodyFatPercentage,
        //         'gender' => $validated['gender'],
        //         'waist' => $validated['waist'],
        //         'neck' => $validated['neck'],
        //         'height_cm' => $validated['height_cm'],
        //         'hips' => $validated['hips'],
        //     ]
        // );
    
        return response()->json([
            'body_fat_percentage' => $bodyFatPercentage,
            'message' => "Your estimated body fat percentage is {$bodyFatPercentage}%.",
        ]);
    }
    // MET values for common activities
    protected $metValues = [
        'hiit' => 10.0,
        'running' => 8.3,
        'jump_rope' => 12.0,
        'swimming' => 8.0,
        'boxing' => 7.8,
        'cycling' => 8.0,
        'rowing' => 6.0,
        'stair_climbing' => 8.8,
        'dancing' => 6.5,
        'mountain_climbers' => 8.0
    ];
    
    public function calculateCalories(Request $request)
    {
        $validated = $request->validate([
            'weight_kg' => 'required|numeric|min:1', 
            'activity' => 'required|in:' . implode(',', array_keys($this->metValues)), 
            'time' => 'required|numeric|min:1', 
        ]);
    
        $durationHours = $validated['time'] / 60;
    
        $metValue = $this->metValues[$validated['activity']];
    
        $caloriesBurned = $metValue * $validated['weight_kg'] * $durationHours;
    
        return response()->json([
            'calories_burned' => round($caloriesBurned, 2),
            'message' => "You burned " . round($caloriesBurned, 2) . " calories."
        ]);
    }    
    


    




}
