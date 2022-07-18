<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class AchievementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Achievement::truncate();
        
        $toAdd = [
            [
                'name' => 'Bench press 225lb (2 plates)',
                'img' => 'benchPress.jpg',
                'details' => '1RM 102kg/225lb',
                'satisfied_by_item' => '(Ben.) Bench press',
                'satisfied_by_amount' => 225.0,
            ],
            [
                'name' => 'Overhead press 135lb (1 plate)',
                'img' => 'overheadPress.jpg',
                'details' => '1RM 61kg/135lb',
                'satisfied_by_item' => '(Ben.) Overhead press',
                'satisfied_by_amount' => 135.0,
            ],
            [
                'name' => 'Squat 225lb (2 plates)',
                'img' => 'squat.jpg',
                'details' => '1RM 102kg/225lb',
                'satisfied_by_item' => '(Ben.) Squat',
                'satisfied_by_amount' => 225.0,
            ],
            [
                'name' => 'Squat 315lb (3 plates)',
                'img' => 'squat.jpg',
                'details' => '1RM 143kg/315lb',
                'satisfied_by_item' => '(Ben.) Squat',
                'satisfied_by_amount' => 315.0,
            ],
            [
                'name' => 'Deadlift 405lb (4 plates)',
                'img' => 'deadlift.jpg',
                'details' => '1RM 184kg/405lb',
                'satisfied_by_item' => '(Ben.) Deadlift',
                'satisfied_by_amount' => 405.0,
            ],
            [
                'name' => 'Deadlift 315lb (3 plates)',
                'img' => 'deadlift.jpg',
                'details' => '1RM 143kg/315lb',
                'satisfied_by_item' => '(Ben.) Deadlift',
                'satisfied_by_amount' => 315.0,
            ],
            [
                'name' => 'Deadlift 225lb (2 plates)',
                'img' => 'deadlift.jpg',
                'details' => '1RM 102kg/225lb',
                'satisfied_by_item' => '(Ben.) Deadlift',
                'satisfied_by_amount' => 225.0,
            ],
        ];

        foreach ( $toAdd as $details ) {
            Achievement::create($details);
        }
    }
}
