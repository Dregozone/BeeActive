<?php

namespace Database\Seeders;

use App\Models\Workout;
use Illuminate\Database\Seeder;

class WorkoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Workout::truncate();

        Workout::create([
            'session' => 'Chest',
            'exercise_no' => 1,
            'equipment' => 'Pec fly',
            'weight_1rm' => 56.0,
        ]);
        Workout::create([
            'session' => 'Chest',
            'exercise_no' => 2,
            'equipment' => 'Chest press',
            'weight_1rm' => 50.0,
        ]);
        Workout::create([
            'session' => 'Chest',
            'exercise_no' => 3,
            'equipment' => 'Close chest squeeze',
            'weight_1rm' => 36.0,
        ]);
        Workout::create([
            'session' => 'Chest',
            'exercise_no' => 4,
            'equipment' => '(Ben.) Bench press',
            'weight_1rm' => 134.2,
        ]);
        Workout::create([
            'session' => 'Chest',
            'exercise_no' => 5,
            'equipment' => 'Press ups',
            'weight_1rm' => 0.0,
        ]);

        Workout::create([
            'session' => 'Shoulders',
            'exercise_no' => 1,
            'equipment' => 'Shoulder raises',
            'weight_1rm' => 24.0,
        ]);
        Workout::create([
            'session' => 'Shoulders',
            'exercise_no' => 2,
            'equipment' => '(Ben.) Overhead press',
            'weight_1rm' => 80.4,
        ]);
        Workout::create([
            'session' => 'Shoulders',
            'exercise_no' => 3,
            'equipment' => 'Chicken flaps',
            'weight_1rm' => 19.0,
        ]);
        Workout::create([
            'session' => 'Shoulders',
            'exercise_no' => 4,
            'equipment' => 'Reverse fly',
            'weight_1rm' => 30.0,
        ]);
        Workout::create([
            'session' => 'Shoulders',
            'exercise_no' => 5,
            'equipment' => 'Full arnold press',
            'weight_1rm' => 19.0,
        ]);

        Workout::create([
            'session' => 'Arms',
            'exercise_no' => 1,
            'equipment' => 'Bicep curls',
            'weight_1rm' => 26.0,
        ]);
        Workout::create([
            'session' => 'Arms',
            'exercise_no' => 2,
            'equipment' => 'Tricep extensions',
            'weight_1rm' => 32.0,
        ]);
        Workout::create([
            'session' => 'Arms',
            'exercise_no' => 3,
            'equipment' => 'Black ball tricep exten.',
            'weight_1rm' => 28.0,
        ]);
        Workout::create([
            'session' => 'Arms',
            'exercise_no' => 4,
            'equipment' => 'Assisted chin ups',
            'weight_1rm' => 0.0,
        ]);
        Workout::create([
            'session' => 'Arms',
            'exercise_no' => 5,
            'equipment' => 'Assisted dips',
            'weight_1rm' => 0.0,
        ]);

        Workout::create([
            'session' => 'Back',
            'exercise_no' => 1,
            'equipment' => 'Seated row',
            'weight_1rm' => 38.0,
        ]);
        Workout::create([
            'session' => 'Back',
            'exercise_no' => 2,
            'equipment' => 'Reverse fly',
            'weight_1rm' => 30.0,
        ]);
        Workout::create([
            'session' => 'Back',
            'exercise_no' => 3,
            'equipment' => 'Lat pull down',
            'weight_1rm' => 30.0,
        ]);
        Workout::create([
            'session' => 'Back',
            'exercise_no' => 4,
            'equipment' => 'Assisted pull ups',
            'weight_1rm' => 0.0,
        ]);
        Workout::create([
            'session' => 'Back',
            'exercise_no' => 5,
            'equipment' => 'Seated push downs',
            'weight_1rm' => 45.0,
        ]);

        Workout::create([
            'session' => 'Legs',
            'exercise_no' => 1,
            'equipment' => 'Leg extensions',
            'weight_1rm' => 50.0,
        ]);
        Workout::create([
            'session' => 'Legs',
            'exercise_no' => 2,
            'equipment' => '(Ben.) Deadlift',
            'weight_1rm' => 190.4,
        ]);
        Workout::create([
            'session' => 'Legs',
            'exercise_no' => 3,
            'equipment' => 'Leg press',
            'weight_1rm' => 90.0,
        ]);
        Workout::create([
            'session' => 'Legs',
            'exercise_no' => 4,
            'equipment' => 'Calve press',
            'weight_1rm' => 220.0,
        ]);
        Workout::create([
            'session' => 'Legs',
            'exercise_no' => 5,
            'equipment' => '(Ben.) Squat',
            'weight_1rm' => 146.2,
        ]);

        Workout::create([
            'session' => 'Abs',
            'exercise_no' => 1,
            'equipment' => 'Weighted ab crunches',
            'weight_1rm' => 30.0,
        ]);
        Workout::create([
            'session' => 'Abs',
            'exercise_no' => 2,
            'equipment' => 'Leg raises',
            'weight_1rm' => 0.0,
        ]);
        Workout::create([
            'session' => 'Abs',
            'exercise_no' => 3,
            'equipment' => 'Plank',
            'weight_1rm' => 0.0,
        ]);
        Workout::create([
            'session' => 'Abs',
            'exercise_no' => 4,
            'equipment' => 'Sit ups',
            'weight_1rm' => 0.0,
        ]);
        Workout::create([
            'session' => 'Abs',
            'exercise_no' => 5,
            'equipment' => 'Ab roller',
            'weight_1rm' => 0.0,
        ]);
    }
}
