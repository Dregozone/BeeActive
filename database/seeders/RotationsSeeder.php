<?php

namespace Database\Seeders;

use App\Models\Rotation;
use Illuminate\Database\Seeder;

class RotationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rotation::truncate();

        Rotation::create([
            'week' => 1,
            'program' => 'Heavy',
            'sets' => 5,
            'reps' => 5,
            'weight_percent' => 80,
        ]);

        Rotation::create([
            'week' => 2,
            'program' => 'Volume',
            'sets' => 3,
            'reps' => 12,
            'weight_percent' => 50,
        ]);

        Rotation::create([
            'week' => 3,
            'program' => 'Contraction',
            'sets' => 4,
            'reps' => 8,
            'weight_percent' => 65,
        ]);
    }
}
