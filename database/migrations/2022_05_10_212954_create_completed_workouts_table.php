<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletedWorkoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completed_workouts', function (Blueprint $table) {
            $table->id();
            $table->integer("userId"); 
            $table->string("equipment"); 
            $table->integer("sets"); 
            $table->integer("reps"); 
            $table->float("weight"); 
            $table->boolean("isDeleted"); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completed_workouts');
    }
}
