<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReplaceUserExerciseRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your authorization logic
    }

    public function rules()
    {
        return [
            'workout_id' => 'required|integer|exists:user_exercises,custom_workout_id',
            'previous_exercise_id' => 'required|integer|exists:user_exercises,exercise_id',
            'new_exercise_id' => 'required|integer|distinct',
        ];
    }

    public function messages()
    {
        return [
            'workout_id.required' => 'The workout ID is required.',
            'previous_exercise_id.required' => 'The previous exercise ID is required.',
            'new_exercise_id.required' => 'The new exercise ID is required.',
            'new_exercise_id.distinct' => 'The new exercise ID must be different from the previous exercise ID.',
        ];
    }
}
