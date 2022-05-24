<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedWorkout extends Model
{
    use HasFactory;

    protected $table = 'completed_workouts';

    protected $fillable = [
        "userId",
        "equipment",
        "sets",
        "reps",
        "weight",
        "isDeleted",
    ];
    
}
