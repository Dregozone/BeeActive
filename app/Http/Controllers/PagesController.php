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
use Illuminate\Support\Carbon;
use App\Classes\MacroCalculator;
use App\Models\CompletedWorkout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    private $expectedWeight = 200;
    private $expectedGoal = "Cutting";

    public function dashboard() {

        if ( auth()->user() ) { // User is logged in

            $mealItemsRecorded = Consumed:: 
                  selectRaw('SUM(quantity) AS num')
                ->where('user_id', auth()->user()->id)
                ->groupBy('user_id')
                ->get()
                ->toArray();
            $mealItemsRecorded = isset($mealItemsRecorded[0]) ? $mealItemsRecorded[0]["num"] : 0;

            $workoutsRecorded = sizeof(CompletedWorkout:: 
                  where('userId', Auth()->User()->id)
                ->get());

                
            // Todays workout
            $currentDay = (new \DateTime())->format("l");
            $currentWeek = (new \DateTime())->format("W");
            $currentRotation = ($currentWeek) % 3;
            $currentRotation = (Rotation:: 
                  where('week', $currentRotation + 1)
                ->get()->toArray())[0];

            $currentSession = (Day:: 
                  where('day', $currentDay)
                ->get()
                ->toArray())[0]["session"]; // ""

            if ( $currentSession != "" ) { // If there is a workout to be done
                $currentSession = (Session:: 
                      where('session', $currentSession)
                    ->get()
                    ->toArray())[0];

                $currentPrimaryExercises = Workout:: 
                      where('session', $currentSession["primary"]) 
                    ->orderBy('exercise_no', 'ASC')
                    ->get()
                    ->toArray();

                $currentSecondaryExercises = Workout:: 
                      where('session', $currentSession["secondary"]) 
                    ->orderBy('exercise_no', 'ASC')
                    ->get()
                    ->toArray();

            } else {
                $currentPrimaryExercises = [];
                $currentSecondaryExercises = [];
            }


            // Tomorrows workout
            $tomorrowsDay = (new \DateTime())->modify("+1 days")->format("l");
            $tomorrowsWeek = (new \DateTime())->modify("+1 days")->format("W");
            $tomorrowsRotation = ($tomorrowsWeek) % 3;
            $tomorrowsRotation = (Rotation:: 
                  where('week', $tomorrowsRotation + 1)
                ->get()->toArray())[0];

            $tomorrowsSession = (Day:: 
                 where('day', $tomorrowsDay)
                ->get()
                ->toArray())[0]["session"];

            if ( $tomorrowsSession != "" ) { // If there is a workout to be done
                $tomorrowsSession = (Session:: 
                      where('session', $tomorrowsSession)
                    ->get()
                    ->toArray())[0];

                $tomorrowsPrimaryExercises = Workout:: 
                      where('session', $tomorrowsSession["primary"]) 
                    ->orderBy('exercise_no', 'ASC')
                    ->get()
                    ->toArray();

                $tomorrowsSecondaryExercises = Workout:: 
                      where('session', $tomorrowsSession["secondary"]) 
                    ->orderBy('exercise_no', 'ASC')
                    ->get()
                    ->toArray();

            } else {
                $tomorrowsPrimaryExercises = [];
                $tomorrowsSecondaryExercises = [];
            }


            // Personal bests
            $pb = CompletedWorkout::
                  where([
                      ['userId', auth()->user()->id],
                      ['equipment', 'like', '(Ben.) %'],
                      ['isDeleted', false],
                  ])
                ->selectRaw('MAX(weight) AS lbs, equipment')
                ->groupBy('equipment')
                ->get()
                ->toArray();
            $pbs = [];
            foreach ( $pb as $item ) {
                $pbs[$item['equipment']] = $item['lbs'];
            }
            $pbOrder = [
                'Overhead press',
                'Bench press',
                'Squat',
                'Deadlift',
            ];

            // Daily macros remaining 
            $calculator = new MacroCalculator();

            $calculator->setWeightLbs($this->expectedWeight);
            $calculator->setGoal($this->expectedGoal);
    
            $calculator->findMacros();
    
            $carbs = $calculator->getCarbs();
            $protein = $calculator->getProtein();
            $fat = $calculator->getFat();
            $calories = $calculator->getCalories();

            $used = Consumed::
                  selectRaw('
                    SUM(consumeds.quantity * meal_items.carbs) AS carbs, 
                    SUM(consumeds.quantity * meal_items.protein) AS protein, 
                    SUM(consumeds.quantity * meal_items.fat) AS fat, 
                    SUM(consumeds.quantity * meal_items.calories) AS calories 
                    ')
                ->join('meal_items', 'consumeds.meal_item_id', '=', 'meal_items.id') 
                ->whereDate('consumeds.created_at', '=', Carbon::now()->toDateString())
                ->get()[0];

            return view('dashboard', [
                'mealItemsRecorded' => $mealItemsRecorded,
                'workoutsRecorded' => $workoutsRecorded,

                'currentRotation' => $currentRotation,
                'tomorrowsRotation' => $tomorrowsRotation,

                'currentProgram' => $currentRotation["program"],
                'currentWeek' => $currentWeek,
                'currentDay' => $currentDay,
                'currentPrimaryExercises' => $currentPrimaryExercises,
                'currentSecondaryExercises' => $currentSecondaryExercises,

                'tomorrowsProgram' => $tomorrowsRotation["program"],
                'tomorrowsWeek' => $tomorrowsWeek,
                'tomorrowsDay' => $tomorrowsDay,
                'tomorrowsPrimaryExercises' => $tomorrowsPrimaryExercises,
                'tomorrowsSecondaryExercises' => $tomorrowsSecondaryExercises,

                'pbs' => $pbs,
                'pbOrder' => $pbOrder,

                'carbs' => $carbs,
                'protein' => $protein,
                'fat' => $fat,
                'calories' => $calories,
                'used' => $used,
            ]);
        } else {

            return view('dashboard');
        }        
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

        $workouts = Workout::
              select('equipment')
            ->get()
            ->toArray();

        $completedWorkouts = CompletedWorkout:: 
              where('userId', Auth()->User()->id) 
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get();
        
        return view('workouts', [
            'workouts' => $workouts,
            'completedWorkouts' => $completedWorkouts,
        ]);
    }

    public function addWorkout(Request $request) {

        $userId = Auth()->User()->id;

        CompletedWorkout::create([
            "userId" => $userId,
            "equipment" => $request->equipment,
            "sets" => $request->sets,
            "reps" => $request->reps,
            "weight" => $request->weight,
            "isDeleted" => false,
        ]);

        return redirect()->route('workouts')->with('success', 'Your workout was recorded successfully!');
    }

    public function nutrition() {

        $calculator = new MacroCalculator();

        $calculator->setWeightLbs($this->expectedWeight);
        $calculator->setGoal($this->expectedGoal);

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
              selectRaw('
                meal_items.img, 
                meal_items.name, 
                SUM(consumeds.quantity) AS quantity
              ')
            ->join('meal_items', 'consumeds.meal_item_id', '=', 'meal_items.id') 
            ->whereDate('consumeds.created_at', '=', Carbon::now()->toDateString())
            ->groupBy(['meal_items.name', 'meal_items.img'])
            ->get();

        $totals = Consumed::
              selectRaw('
                SUM(consumeds.quantity * meal_items.carbs) AS carbs, 
                SUM(consumeds.quantity * meal_items.protein) AS protein, 
                SUM(consumeds.quantity * meal_items.fat) AS fat, 
                SUM(consumeds.quantity * meal_items.calories) AS calories 
              ')
            ->join('meal_items', 'consumeds.meal_item_id', '=', 'meal_items.id') 
            ->whereDate('consumeds.created_at', '=', Carbon::now()->toDateString())
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

    public function weight() {

        $currentWeight = 205;
        $endGoal = 170;
        $targetWeight = 195;
        $daysInSchedule = 30;
        $requiredLossPerDay = ($currentWeight - $targetWeight) / ($daysInSchedule != 0 ? $daysInSchedule : 1);

        $actualWeights = [
            210,
            209,
            208,
            207,
            206,
            205,
            204,
            203,
            202,
            201,
            200,
            199,
            198,
            197,
            196,
            195,
        ];

        $projections = [];
        for ( $day = 0; $day <= $daysInSchedule; $day++ ) {
            $projections[$day] = [
                'predicted' => ROUND($currentWeight - ($day * $requiredLossPerDay), 1),
                'actual' => '',
                'lbsFromPredicted' => '',
                'lbsFromActual' => '',
            ];
        }

        return view('weight', [
            'currentWeight' => $currentWeight,
            'endGoal' => $endGoal,
            'targetWeight' => $targetWeight,
            'projections' => $projections,
            'daysInSchedule' => $daysInSchedule,
            'requiredLossPerDay' => $requiredLossPerDay,
            'actualWeights' => $actualWeights,
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
