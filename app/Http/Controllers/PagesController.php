<?php

namespace App\Http\Controllers;

use App\Classes\MacroCalculator;
use Illuminate\Http\Request;
use App\Models\Log;

class PagesController extends Controller
{
    
    public function home() {

        //dd( Log::all() );
        //dd( Log::find(2) );

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

        $foodItems = [
            [
                "img" => "",
                "item" => "Huel Black (2 scoops)",
                "carbs" => "23",
                "protein" => "40",
                "fat" => "18",
                "calories" => "414",
            ],
            [
                "img" => "",
                "item" => "Tin of Tuna",
                "carbs" => "0",
                "protein" => "28",
                "fat" => "1.5",
                "calories" => "125",
            ],
            [
                "img" => "",
                "item" => "Ravioli",
                "carbs" => "51",
                "protein" => "10",
                "fat" => "6",
                "calories" => "298",
            ],
        ];

        $consumeds = [
            [
                "img" => "",
                "item" => "",
                "quantity" => 1,
            ],
            [
                "img" => "",
                "item" => "",
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
        
        dd($request);
    }

    public function profile() {

        return view('profile');
    }
}
