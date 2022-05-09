<?php

namespace App\Models;

use App\Models\MealItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consumed extends Model
{
    use HasFactory;

    protected $table = 'consumeds';

    protected $fillable = [
        'user_id',
        'meal_item_id',
        'quantity',
    ];

    public function meal_items() {
        return $this->hasMany(MealItem::class);
    }
}
