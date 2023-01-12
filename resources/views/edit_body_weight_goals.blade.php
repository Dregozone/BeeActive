@extends('layout.app')

@section('title')
    Weight
@endsection

@section('content')
    <h1>
        Edit body weight goals
    </h1>

    <div class="recordContainer">
        <form action="{{ route('save_body_weight_goals') }}" method="post" style="display: flex; flex-direction: column; width: 100%; align-items: center; justify-content: center;">
            @csrf 

            <div class="form-group" style="width: 20%;">
                <label for="startWeight">Start Weight (lbs):</label>
                <input class="form-control" type="number" min="0.1" step="0.1" id="startWeight" name="startWeight" value="{{ ROUND($existingBodyWeightGoal["start_weight"], 1) }}" />
            </div>

            <div class="form-group" style="width: 20%;">
                <label for="endGoalWeight">End goal Weight (lbs):</label>
                <input class="form-control" type="number" min="0.1" step="0.1" id="endGoalWeight" name="endGoalWeight" value="{{ ROUND($existingBodyWeightGoal["end_goal_weight"], 1) }}" />
            </div>

            <div class="form-group" style="width: 20%;">
                <label for="milestoneGoalWeight">Milestone goal Weight (lbs):</label>
                <input class="form-control" type="number" min="0.1" step="0.1" id="milestoneGoalWeight" name="milestoneGoalWeight" value="{{ ROUND($existingBodyWeightGoal["milestone_goal_weight"], 1) }}" />
            </div>

            <div class="form-group" style="width: 20%;">
                <label for="milestoneDate">Milestone date:</label>
                <input class="form-control" type="date" id="milestoneDate" name="milestoneDate" value="{{ substr($existingBodyWeightGoal["milestone_date"], 0, 10) }}" />
            </div>

            <div class="form-group" style="margin-top: 1%;">
                <input class="btn btn-primary" type="submit" value="Save" aria-label="Save a new set of goals button" />
            </div>
        </form>
    </div>
@endsection
