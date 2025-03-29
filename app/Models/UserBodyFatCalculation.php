<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBodyFatCalculation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'body_fat_percentage',
        'gender',
        'waist',
        'neck',
        'height_cm',
        'hips',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
