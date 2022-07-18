@extends('layout.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <h1>
        Dashboard
    </h1>

    @auth 
    <section class="container flex">
        
        <div style="margin-right: 2%;">
            <h2 class="center">
                Next workouts in schedule
            </h2>

            <small class="center" style="display: inline-block; width: 100%;">
                Today - Week: {{ $currentWeek }}, Program: {{ $currentProgram }}, Day: {{ $currentDay }}
            </small>
            <div>
                <table class="table table-sm table-hover table-striped center">
                    <thead>
                        <tr>
                            <th>Program</th>
                            <th>Session</th>
                            <th>Equipment</th>
                            <th>Sets x Reps</th>
                            <th>Weight</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if ( sizeof($currentPrimaryExercises) > 0 )
                            @foreach ( $currentPrimaryExercises as $exercise )
                                <tr>
                                    <td>{{ $currentProgram }}</td>
                                    <td>{{ $exercise["session"] }}</td>
                                    <td>{{ $exercise["equipment"] }}</td>
                                    <td>{{ $currentRotation["sets"] }} x {{ $currentRotation["reps"] }}</td>
                                    <td>{{ ROUND(($exercise["weight_1rm"] * $currentRotation["weight_percent"]) / 100, 1) }}</td>
                                </tr>
                            @endforeach 
                        @else 
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    Rest day
                                </td>
                            </tr>
                        @endif 

                        @if ( sizeof($currentSecondaryExercises) > 0 )
                            @foreach ( $currentSecondaryExercises as $exercise )
                                <tr>
                                    <td>{{ $currentProgram }}</td>
                                    <td>{{ $exercise["session"] }}</td>
                                    <td>{{ $exercise["equipment"] }}</td>
                                    <td>{{ $currentRotation["sets"] }} x {{ $currentRotation["reps"] }}</td>
                                    <td>{{ ROUND(($exercise["weight_1rm"] * $currentRotation["weight_percent"]) / 100, 1) }}</td>
                                </tr>
                            @endforeach 
                        @endif 

                    </tbody>
                </table>
            </div>

            <hr style="border: 2px dotted rgb(168, 145, 39); background-color: transparent;" />

            <small class="center" style="display: inline-block; width: 100%;">
                Tomorrow - Week: {{ $tomorrowsWeek }}, Program: {{ $tomorrowsProgram }}, Day: {{ $tomorrowsDay }}
            </small>
            <div>
                <table class="table table-sm table-hover table-striped center">
                    <thead>
                        <tr>
                            <th>Program</th>
                            <th>Session</th>
                            <th>Equipment</th>
                            <th>Sets x Reps</th>
                            <th>Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @if ( sizeof($tomorrowsPrimaryExercises) > 0 )
                            @foreach ( $tomorrowsPrimaryExercises as $exercise )
                                <tr>
                                    <td>{{ $tomorrowsProgram }}</td>
                                    <td>{{ $exercise["session"] }}</td>
                                    <td>{{ $exercise["equipment"] }}</td>
                                    <td>{{ $tomorrowsRotation["sets"] }} x {{ $tomorrowsRotation["reps"] }}</td>
                                    <td>{{ ROUND(($exercise["weight_1rm"] * $tomorrowsRotation["weight_percent"]) / 100, 1) }}</td>
                                </tr>
                            @endforeach 
                        @else 
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    Rest day
                                </td>
                            </tr>
                        @endif 

                        @if ( sizeof($tomorrowsSecondaryExercises) > 0 )
                            @foreach ( $tomorrowsSecondaryExercises as $exercise )
                                <tr>
                                    <td>{{ $tomorrowsProgram }}</td>
                                    <td>{{ $exercise["session"] }}</td>
                                    <td>{{ $exercise["equipment"] }}</td>
                                    <td>{{ $tomorrowsRotation["sets"] }} x {{ $tomorrowsRotation["reps"] }}</td>
                                    <td>{{ ROUND(($exercise["weight_1rm"] * $tomorrowsRotation["weight_percent"]) / 100, 1) }}</td>
                                </tr>
                            @endforeach 
                        @endif 

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
                        {{ ROUND($carbs - $used->carbs, 1) }}g 
                    </div>
                    
                    <div>
                        <h3>Protein</h3>
                        {{ ROUND($protein - $used->protein, 1) }}g 
                    </div>
                    
                    <div>
                        <h3>Fat</h3>
                        {{ ROUND($fat - $used->fat, 1) }}g 
                    </div>
                    
                    <div>
                        <h3>Calories</h3>
                        {{ ROUND($calories - $used->calories, 1) }} kcal 
                    </div>
                </div>

            </div>

        </div>

        <div style="margin-left: 2%;">
            <h2 class="center">
                Wall of fame
            </h2>

            <h3>Personal Records</h3>
            <div class="personalRecords">
                @foreach ($pbOrder as $type)
                    <div>
                        <h4>{{ $type }}</h4>
                        {{ isset($pbs['(Ben.) ' . $type]) ? ROUND($pbs['(Ben.) ' . $type], 1) : '?' }} lbs / 
                        {{ isset($pbs['(Ben.) ' . $type]) ? ROUND($pbs['(Ben.) ' . $type] / 2.2, 1) : '?' }} kg
                    </div>
                @endforeach 
            </div>

            <h3 style="margin-top: 30px;">Achievements</h3>
            <div class="achievements">

                @foreach ( $achievements as $achievement )
                    <div @if ( $achievement->pb < $achievement->satisfied_by_amount ) style="cursor: no-drop; background: rgba(0, 0, 0, 0.25);" @endif title="{{ $achievement->details }}">
                        <h4>{{ $achievement->name }}</h4>
                        
                        <img src="{{ asset('img/' . $achievement->img) }}" style="max-width: 90%; max-height: 90px; border-radius: 9px; opacity: 0.7;" />

                        @if ( $achievement->pb < $achievement->satisfied_by_amount )
                            <p>
                                {{ ROUND($achievement->pb, 1) }} / {{ ROUND($achievement->satisfied_by_amount, 1) }}
                            </p>
                        @else 
                            <p>
                                Achieved
                            </p>
                        @endif
                    </div>
                @endforeach 

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
