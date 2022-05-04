<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Day::truncate();

        Day::create([
            'day' => 'Monday',
            'session' => 'a',
        ]);
        Day::create([
            'day' => 'Tuesday',
            'session' => '',
        ]);
        Day::create([
            'day' => 'Wednesday',
            'session' => 'b',
        ]);
        Day::create([
            'day' => 'Thursday',
            'session' => '',
        ]);
        Day::create([
            'day' => 'Friday',
            'session' => 'c',
        ]);
        Day::create([
            'day' => 'Saturday',
            'session' => '',
        ]);
        Day::create([
            'day' => 'Sunday',
            'session' => '',
        ]);
    }
}
