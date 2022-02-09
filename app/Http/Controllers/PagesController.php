<?php

namespace App\Http\Controllers;

use App\Classes\MacroCalculator;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    public function home() {

        return view('home');
    }

    public function workouts() {

        return view('workouts');
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

        echo "
            Goal: {$goal}

            Carbs: {$carbs}g
            Protein: {$protein}g
            Fat: {$fat}g
            Calories: {$calories} kcal
        ";

        return view('nutrition');
    }

    public function profile() {

        return view('profile');
    }
}
