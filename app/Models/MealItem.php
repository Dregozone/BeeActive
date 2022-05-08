<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealItem extends Model
{
    use HasFactory;

    protected $table = 'meal_items';

    protected $fillable = [
        'img',
        'name',
        'carbs',
        'protein',
        'fat',
        'calories',
        'is_active'
    ];
}
