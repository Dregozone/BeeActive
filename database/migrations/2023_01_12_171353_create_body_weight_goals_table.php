<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBodyWeightGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('body_weight_goals', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id");
            $table->float("start_weight");
            $table->float("end_goal_weight");
            $table->float("milestone_goal_weight");
            $table->datetime("milestone_date");
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
        Schema::dropIfExists('body_weight_goals');
    }
}
