<?php

namespace Database\Seeders;

use App\Models\Session;
use Illuminate\Database\Seeder;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Session::truncate();

        Session::create([
            'session' => 'a',
            'primary' => 'Chest',
            'secondary' => 'Shoulders',
        ]);
        Session::create([
            'session' => 'b',
            'primary' => 'Arms',
            'secondary' => 'Back',
        ]);
        Session::create([
            'session' => 'c',
            'primary' => 'Legs',
            'secondary' => 'Abs',
        ]);
    }
}
