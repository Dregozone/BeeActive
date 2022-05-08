<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Log;
use App\Models\User;
use App\Models\Session;
use App\Models\Workout;
use App\Models\MealItem;
use App\Models\Rotation;
use Illuminate\Http\Request;
use App\Classes\MacroCalculator;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    
    public function home() {

        //dd( Log::all() );
        //dd( Log::find(2) );

        return view('home');
    }

    public function schedule() {

        $rotations = Rotation::all();
        $workouts = Workout::all();
        $sessions = Session::all();
        $days = Day::all();

        $sessionIndexed = [];
        foreach ( $sessions->toArray() as $session ) {
            $sessionIndexed[$session["session"]] = $session;
        }

        $workoutIndexed = [];
        foreach ( $workouts->toArray() as $workout ) {
            $workoutIndexed[$workout["session"]][$workout["exercise_no"]] = $workout;
        }

        return view('schedule', [
            'rotations' => $rotations,
            'workouts' => $workouts,
            'workoutIndexed' => $workoutIndexed,
            'sessions' => $sessions, 
            'sessionIndexed' => $sessionIndexed,
            'days' => $days, 
        ]);
    }

    public function workouts() {

        //
        
        return view('workouts', [
            'a' => '',
        ]);
    }

    public function nutrition() {

        $calculator = new MacroCalculator();

        $expectedWeight = 200;
        $expectedGoal = "Cutting";

        $calculator->setWeightLbs($expectedWeight);
        $calculator->setGoal($expectedGoal);

        $calculator->findMacros();

        $carbs = $calculator->getCarbs();
        $protein = $calculator->getProtein();
        $fat = $calculator->getFat();

        $calories = $calculator->getCalories();

        $goal = $calculator->getGoal();

        $foodItems = MealItem::
              where('is_active', true)
            ->get();

        $consumeds = [
            [
                "img" => "",
                "name" => "",
                "quantity" => 1,
            ],
            [
                "img" => "",
                "name" => "",
                "quantity" => 1,
            ],
        ];

        return view('nutrition', [
            'goal' => $goal,
            'carbs' => $carbs,
            'protein' => $protein,
            'fat' => $fat,
            'calories' => $calories,
            'foodItems' => $foodItems,
            'consumeds' => $consumeds,
        ]);
    }

    public function nutritionInsertHandler(Request $request) {

        $macroCalculator = new MacroCalculator();

        $toInsert = [
            'img' => '',
            'name' => $request->item,
            'carbs' => (float)$request->carbs,
            'protein' => (float)$request->protein,
            'fat' => (float)$request->fat,
            'calories' => (float)$macroCalculator->calculateCalories($request->carbs, $request->protein, $request->fat),
            'is_active' => 1,
        ];

        //dd( $toInsert );

        MealItem::create($toInsert);

        return redirect()->route('nutrition');
    }

    public function profile() {

        $user = User::
              where('id', Auth::user()->id)
            ->get()[0]
            ->toArray();

        return view('profile', [
            'user' => $user,
        ]);
    }

    /** Reset password
     * 
     * 
     */
    public function action(Request $request) {

        dd($request);

    }
}
