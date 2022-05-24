@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <h1>
        Dashboard
    </h1>

    @auth 
    <section class="container" style="display: flex;">
        
        <div style="width: 48%; margin-right: 2%;">
            <h2 class="center">
                Next workouts in schedule
            </h2>

            <small class="center" style="display: inline-block; width: 100%;">
                Today - Week: ?, Program: ?, Day: ?
            </small>
            <div>
                <table class="table table-sm table-hover table-striped center">
                    <thead>
                        <tr>
                            <th>.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr style="border: 2px dotted rgb(168, 145, 39); background-color: transparent;" />

            <small class="center" style="display: inline-block; width: 100%;">
                Tomorrow - Week: ?, Program: ?, Day: ?
            </small>
            <div>
                <table class="table table-sm table-hover table-striped center">
                    <thead>
                        <tr>
                            <th>.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h2 class="center" style="margin-top: 6%;">
                Macros (Remaining today)
            </h2>
            <div>
                
                <div class="macroContainer">
                    <div>
                        <h3>Carbs</h3>
                        ?
                    </div>
                    
                    <div>
                        <h3>Protein</h3>
                        ?
                    </div>
                    
                    <div>
                        <h3>Fat</h3>
                        ?
                    </div>
                    
                    <div>
                        <h3>Calories</h3>
                        ?
                    </div>
                </div>

            </div>

        </div>

        <div style="width: 48%; margin-left: 2%;">
            <h2 class="center">
                Wall of fame
            </h2>

            <h3>Personal Records</h3>
            <div class="personalRecords">
                <div>
                    <h4>Overhead press</h4>
                    ? lbs / ? kg
                </div>

                <div>
                    <h4>Bench press</h4>
                    ? lbs / ? kg
                </div>

                <div>
                    <h4>Squat</h4>
                    ? lbs / ? kg
                </div>

                <div>
                    <h4>Deadlift</h4>
                    ? lbs / ? kg
                </div>
            </div>

            <h3 style="margin-top: 30px;">Achievements</h3>
            <div class="achievements">
                <div>
                    <h4>Ach. x</h4>
                    ...
                </div>

                <div>
                    <h4>Ach. x</h4>
                    ...
                </div>

                <div>
                    <h4>Ach. x</h4>
                    ...
                </div>

                <div>
                    <h4>Ach. x</h4>
                    ...
                </div>

                <div>
                    <h4>Ach. x</h4>
                    ...
                </div>

                <div>
                    <h4>Ach. x</h4>
                    ...
                </div>

                <div>
                    <h4>Ach. x</h4>
                    ...
                </div>

                <div>
                    <h4>Ach. x</h4>
                    ...
                </div>
            </div>

            <div class="userParticipationCounts">
                <div>
                    <div>{{ $workoutsRecorded }}</div>
                    Workouts<br />recorded
                </div>
                
                <div style="margin-left: 5%;">
                    <div>{{ $mealItemsRecorded }}</div>
                    Meal items<br />recorded
                </div>
            </div>

        </div>


    </section>
    @endauth 

    @guest 
    <section class="contaner">
        <h2>News</h2>
        ... 
    </section>
    @endguest 

@endsection
