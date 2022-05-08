<?php

namespace Database\Seeders;

use App\Models\MealItem;
use Illuminate\Database\Seeder;

class MealItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MealItem::truncate();

        MealItem::create([
            'img' => '',
            'name' => 'Huel Black (2 scoops)',
            'carbs' => 23,
            'protein' => 40,
            'fat' => 18,
            'calories' => 414,
            'is_active' => true,
        ]);
        MealItem::create([
            'img' => '',
            'name' => 'Tin of Tuna',
            'carbs' => 0,
            'protein' => 28,
            'fat' => 1.5,
            'calories' => 125,
            'is_active' => true,
        ]);
        MealItem::create([
            'img' => '',
            'name' => 'Ravioli',
            'carbs' => 51,
            'protein' => 10,
            'fat' => 6,
            'calories' => 298,
            'is_active' => true,
        ]);
    }
}
