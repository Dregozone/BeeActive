<?php

namespace Database\Seeders;

use App\Models\Consumed;
use Illuminate\Database\Seeder;

class ConsumedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Consumed::truncate();

        Consumed::create([
            'user_id' => 3,
            'meal_item_id' => 2,
            'quantity' => 2
        ]);
        Consumed::create([
            'user_id' => 3,
            'meal_item_id' => 1,
            'quantity' => 1
        ]);
    }
}
