<?php 

    namespace App\Classes;

    Class MacroCalculator 
    {
        const BULKING = 1.1; // +10%
        const MAINTAINING = 1;
        const CUTTING = 0.9; // -10%

        private $weight; // In Lbs for calculations
        private $goal;
        private $carbs; // in grams
        private $protein; // in grams
        private $fat; // in grams
        private $calories;

        public function __construct() {
            //
        }

        public function findMacros() {
            
            $this->protein = $this->carbs = $this->weight;
            
            $perc1Calories = ($this->protein * 4) / 40; // To find 1 percent of the calories. 4 calories per gram of protein, 40/40/20 p/c/f split

            $fatCalories = $perc1Calories * 20;
            $this->fat = floor($fatCalories / 9); // 9 calories per gram of fat

            // Make adjustment for goal
            if ( $this->goal == "Bulking" ) {
                $modifier = self::BULKING;
            } else if ( $this->goal == "Maintaining" ) {
                $modifier = self::MAINTAINING;
            } else if ( $this->goal == "Cutting" ) {
                $modifier = self::CUTTING;
            }

            $this->protein *= $modifier;
            $this->carbs *= $modifier;
            $this->fat *= $modifier;

            // Calculate calories from macros
            $this->calories = 
                ($this->protein * 4) + 
                ($this->carbs * 4) + 
                ($this-> fat * 9)
            ;

            return true;
        }







        public function setWeightLbs($weight) {
            $this->weight = $weight;

            return true;
        }

        public function setGoal($goal) {

            $validGoals = [
                "Bulking",
                "Maintaining",
                "Cutting",
            ];

            if ( in_array($goal, $validGoals) ) {
                $this->goal = $goal;
            } else {
                die("Goal is not recognised!");
            }

            return true;
        }




        public function getWeight() {

            return $this->weight;
        }

        public function getGoal() {

            return $this->goal;
        }

        public function getCarbs() {

            return $this->carbs;
        }

        public function getProtein() {

            return $this->protein;
        }

        public function getFat() {

            return $this->fat;
        }

        public function getCalories() {

            return $this->calories;
        }
    }
