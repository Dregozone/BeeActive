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
use App\Models\BodyWeight;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Classes\MacroCalculator;
use App\Models\BodyWeightGoals;
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

            $achievements = Achievement::
                  join('completed_workouts', 'achievements.satisfied_by_item', '=', 'completed_workouts.equipment')
                ->selectRaw('
                    achievements.name, 
                    achievements.img,
                    achievements.details,
                    achievements.satisfied_by_amount,
                    MAX(completed_workouts.weight) AS pb
                ')
                ->where([
                    ['userId', auth()->user()->id],
                    ['isDeleted', 0],
                ])
                ->groupBy('achievements.name', 'achievements.img', 'achievements.details', 'achievements.satisfied_by_amount')
                //->orderBy('', 'ASC')
                ->get();

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

                'achievements' => $achievements,
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

        $numToShow = 10;

        $userId = Auth::user()->id;
        
        $bodyWeights = BodyWeight::
              where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->take($numToShow)
            ->get();

        $bodyWeightGoals = BodyWeightGoals::where('user_id', $userId)->get();

        if ( sizeof($bodyWeightGoals) > 0 ) { // There is a body weight goal set for this user
            $bodyWeightGoals = $bodyWeightGoals[0];

            $currentWeight = ROUND($bodyWeightGoals->start_weight, 1);
            $endGoal = ROUND($bodyWeightGoals->end_goal_weight, 1);
            $targetWeight = ROUND($bodyWeightGoals->milestone_goal_weight, 1);

            $now = new \DateTime();
            $milestoneDate = new \DateTime($bodyWeightGoals->milestone_date);
            $milestoneDateText = $bodyWeightGoals->milestone_date;
            
            $daysInSchedule = (int)$now->diff($milestoneDate)->format("%r%a");

            $requiredLossPerDay = ($currentWeight - $targetWeight) / ($daysInSchedule != 0 ? $daysInSchedule : 1);
        } else { // No body weight goals have yet been set for this user
            $currentWeight = 0;
            $endGoal = 0;
            $targetWeight = 0;
            $milestoneDate = '25-12-2030';
            $milestoneDateText = '25-12-2030';
            $daysInSchedule = 999;
            $requiredLossPerDay = 0;
        }

        // Graph data
        $graphDatas = [];
        $i = 1;

        foreach ( array_reverse($bodyWeights->toArray()) as $data ) { // Reverse to show most recent entry on right
            $graphDatas[] = ["label" => $i, "y" => ROUND($data["weight_in_lbs"], 1)];
            $i++;
        }
        
        return view('weight', [
            'currentWeight' => $currentWeight,
            'endGoal' => $endGoal,
            'targetWeight' => $targetWeight,
            'daysInSchedule' => $daysInSchedule,
            'requiredLossPerDay' => $requiredLossPerDay,

            'bodyWeights' => $bodyWeights,
            'numToShow' => $numToShow,
            'milestoneDateText' => $milestoneDateText,
            'graphDatas' => $graphDatas,
        ]);
    }

    public function record_weight(Request $request) {

        BodyWeight::create([
            'user_id' => Auth::user()->id,
            'weight_in_lbs' => $request->weight,
        ]);

        return redirect()->route('weight')->with('success', 'New weight recorded');
    }

    public function body_weight_goals() {

        $userId = Auth::user()->id;

        $existingBodyWeightGoal = BodyWeightGoals::where('user_id', $userId)->get()->toArray();

        if ( sizeof($existingBodyWeightGoal) == 0 ) { // This user hasnt yet set any goals
            // Provide some defaults
            $existingBodyWeightGoal = [
                'start_weight' => 0,
                'end_goal_weight' => 0,
                'milestone_goal_weight' => 0,
                'milestone_date' => '',
            ];
        } else {
            $existingBodyWeightGoal = $existingBodyWeightGoal[0];
        }

        return view('edit_body_weight_goals', [
            'existingBodyWeightGoal' => $existingBodyWeightGoal,
        ]);
    }

    public function save_body_weight_goals(Request $request) {

        $userId = Auth::user()->id;

        $existingBodyWeightGoal = BodyWeightGoals::where('user_id', $userId)->get();

        if ( sizeof($existingBodyWeightGoal) > 0 ) {
            // This user already has goals set, update them
            $existingBodyWeightGoal[0]->update([
                'start_weight' => $request->startWeight,
                'end_goal_weight' => $request->endGoalWeight,
                'milestone_goal_weight' => $request->milestoneGoalWeight,
                'milestone_date' => $request->milestoneDate,
            ]);
        } else {
            // This user hasnt yet set their goals, create them
            BodyWeightGoals::create([
                'user_id' => $userId,
                'start_weight' => $request->startWeight,
                'end_goal_weight' => $request->endGoalWeight,
                'milestone_goal_weight' => $request->milestoneGoalWeight,
                'milestone_date' => $request->milestoneDate,
            ]);
        }

        return redirect()->route('weight')->with('success', 'New goals saved!');
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
