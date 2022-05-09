<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\DaysSeeder;
use Database\Seeders\SessionsSeeder;
use Database\Seeders\WorkoutsSeeder;
use Database\Seeders\ConsumedsSeeder;
use Database\Seeders\MealItemsSeeder;
use Database\Seeders\RotationsSeeder;
use Database\Seeders\SharedLogsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(SharedLogsSeeder::class);
        $this->call(RotationsSeeder::class);
        $this->call(WorkoutsSeeder::class);
        $this->call(SessionsSeeder::class);
        $this->call(DaysSeeder::class);
        //$this->call(MealItemsSeeder::class);
        $this->call(ConsumedsSeeder::class);
    }
}
