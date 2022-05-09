<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Log;
use App\Models\User;
use App\Models\Session;
use App\Models\Workout;
use App\Models\Consumed;
use App\Models\MealItem;
use App\Models\Rotation;
use Illuminate\Http\Request;
use App\Classes\MacroCalculator;
use Illuminate\Support\Facades\DB;
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

        $consumeds = Consumed::
              join('meal_items', 'consumeds.meal_item_id', '=', 'meal_items.id') 
            ->get([
                'meal_items.img', 
                'meal_items.name', 
                'consumeds.quantity',
                'meal_items.carbs',
                'meal_items.protein',
                'meal_items.fat',
                'meal_items.calories',
            ]);

        $totals = Consumed::
              selectRaw('
                SUM(consumeds.quantity * meal_items.carbs) AS carbs, 
                SUM(consumeds.quantity * meal_items.protein) AS protein, 
                SUM(consumeds.quantity * meal_items.fat) AS fat, 
                SUM(consumeds.quantity * meal_items.calories) AS calories 
              ')
            ->join('meal_items', 'consumeds.meal_item_id', '=', 'meal_items.id') 
            ->get()[0];

        return view('nutrition', [
            'goal' => $goal,
            'carbs' => $carbs,
            'protein' => $protein,
            'fat' => $fat,
            'calories' => $calories,
            'foodItems' => $foodItems,
            'consumeds' => $consumeds,
            'used' => $totals,
        ]);
    }

    public function nutritionInsertHandler(Request $request) {

        if ( $request->action == "addMealItem" ) {

            $macroCalculator = new MacroCalculator();

            $toInsert = [
                'img' => '',
                'name' => $request->item,
                'carbs' => round((float)$request->carbs, 1),
                'protein' => round((float)$request->protein, 1),
                'fat' => round((float)$request->fat, 1),
                'calories' => round((float)$macroCalculator->calculateCalories($request->carbs, $request->protein, $request->fat), 1),
                'is_active' => 1,
            ];

            MealItem::create($toInsert);

        } else if ( $request->action == "addConsumed" ) {

            Consumed::create([
                'user_id' => auth()->user()->id,
                'meal_item_id' => $request->meal_item_id,
                'quantity' => $request->quantity,
            ]);
        }

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
