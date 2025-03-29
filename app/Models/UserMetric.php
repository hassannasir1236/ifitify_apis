<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'weight',
        'weight_unit',
        'body_fat',
        'chest',
        'waist',
        'hip',
        'left_thigh',
        'right_thigh',
        'left_calf',
        'right_calf',
        'left_bicep',
        'right_bicep',
        'progress_image_url',
        'previous_image_url'
    ];
}
