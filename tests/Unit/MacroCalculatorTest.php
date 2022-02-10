<?php

namespace Tests\Unit;

use App\Classes\MacroCalculator;
use PHPUnit\Framework\TestCase;

class MacroCalculatorTest extends TestCase
{
    
    public function setUp() : void {
        parent::setUp();
        
        //
    }

    public function tearDown() : void {
        parent::tearDown();

        //
    }

    /**
     * 
     *
     * @return void
     */
    public function test_calorie_calculation_from_macros_is_correct()
    {
        $calculator = new MacroCalculator();

        $expectedWeight = 200;
        $expectedGoal = "Cutting";

        $expectedCarbs = 180;
        $expectedProtein = 180;
        $expectedFat = 39.6;
        $expectedCalories = 1796.4;

        $this->assertTrue( $calculator->setWeightLbs($expectedWeight) );
        $this->assertTrue( $calculator->setGoal($expectedGoal) );

        $this->assertTrue( $calculator->findMacros() );

        $carbs = $calculator->getCarbs();
        $protein = $calculator->getProtein();
        $fat = $calculator->getFat();

        $calories = $calculator->getCalories();

        $goal = $calculator->getGoal();

        $this->assertEquals($expectedGoal, $goal);
        $this->assertEquals($expectedCarbs, $carbs);
        $this->assertEquals($expectedProtein, $protein);
        $this->assertEquals($expectedFat, $fat);
        $this->assertEquals($expectedCalories, $calories);

        /*
        echo "
            Goal: {$goal}

            Carbs: {$carbs}g
            Protein: {$protein}g
            Fat: {$fat}g
            Calories: {$calories} kcal
        ";
        */
    }
}
