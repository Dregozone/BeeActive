<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyWeightGoals extends Model
{
    use HasFactory;

    protected $table = 'body_weight_goals';

    protected $fillable = [
        'user_id',
        'start_weight',
        'end_goal_weight',
        'milestone_goal_weight',
        'milestone_date',
    ];
}
