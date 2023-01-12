<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BodyWeight extends Model
{
    use HasFactory;

    protected $table = 'body_weights';

    protected $fillable = [
        'user_id',
        'weight_in_lbs',
    ];
}
