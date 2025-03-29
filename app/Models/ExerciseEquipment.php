<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExerciseEquipment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'exercise_equipments';
    protected $fillable = [
        'name',
        'equipment_type'
    ];

}
