<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string| max:200',
            'last_name' => 'required|string| max:200',
            'email' => 'required|unique:users|string|email| max:200',
            'password' => 'required|confirmed|min:8|string',
            'country_code' => 'required_with:phone|string| max:10',
            'phone' => 'required_with:country_code|string|unique:users|max:25',
            // 'goal_id' => 'required|integer|exists:goals,id',
            // 'user_level_id' => 'required|integer|exists:user_levels,id',
            'goal_ids' => 'required|array',
            'goal_ids.*' => 'integer|exists:goals,id',
        
            // Allow user_level_id to be an array and validate each value exists in user_levels table
            'user_level_ids' => 'required|array',
            'user_level_ids.*' => 'integer|exists:user_levels,id',
            'height' => 'required|numeric',
            'height_metric' => 'required|string| max:4',
            'weight' => 'required|numeric',
            'weight_metric' => 'required|string| max:4',
            'date_of_birth' => 'required|date',
            'gender' => 'required|string'
        ];
    }
}
