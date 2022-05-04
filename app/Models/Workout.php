<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;

    protected $table = 'workouts';

    protected $fillable = [
        'session',
        'exercise_no',
        'equipment',
        'weight_1rm',
    ];
}
