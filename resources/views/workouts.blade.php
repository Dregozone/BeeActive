@extends('layout.app')

@section('title')
    Workouts
@endsection

@section('content')
    <h1>
        Workouts
    </h1>

    <section class="container">

        <div class="recordContainer">
            <h2 style="text-align: center;">Record a workout</h2>

            ...
        </div>

        <hr />

        <div class="benchmarkContainer">
            <div style="width: 37%;">
                <table class="table table-sm table-hover table-striped center">
                    <thead>
                        <tr>
                            <th colspan="5" class="center">
                                <h2>Compound Benchmarks (lbs)</h2> 
                                <small style="font-style: italic; font-weight: 100; display: block; margin-top: -10px;">[1 plate = 20kg]</small>
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>
                                Overhead press<br />
                                <small style="font-style: italic; font-weight: 100;">1 plate: 61kg/134lb</small>
                            </th>
                            <th>
                                Bench press<br />
                                <small style="font-style: italic; font-weight: 100;">2 plates: 101kg/225lb</small>
                            </th>
                            <th>
                                Squat<br />
                                <small style="font-style: italic; font-weight: 100;">3 plates: 141kg/310lb</small>
                            </th>
                            <th>
                                Deadlift<br />
                                <small style="font-style: italic; font-weight: 100;">4 plates: 181kg/400lb</small>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1RM</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <th>(93% 1RM) 3RM</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <th>225lb reps</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="width: 28%;">
                <table class="table table-sm table-hover table-striped center">
                    <thead>
                        <tr>
                            <th colspan="5" class="center">
                                <h2>Bodyweight Benchmarks</h2> 
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>
                                Press ups
                            </th>
                            <th>
                                Sit ups
                            </th>
                            <th>
                                Pull ups
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>120s</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <th>60s</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <th>Max 1 sitting</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div style="width: 28%;">
                <table class="table table-sm table-hover table-striped center">
                    <thead>
                        <tr>
                            <th colspan="5" class="center">
                                <h2>Cardio Benchmarks (min:sec)</h2>
                            </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>
                                Run
                            </th>
                            <th>
                                Cycle
                            </th>
                            <th>
                                Row
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>5mi (8km)</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <th>3mi (5km)</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <th>1.5mi (2.4km)</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <hr />

        <div class="scheduleContainer">
            <div style="width: 37%;">
                <table class="table table-sm table-hover table-striped center">
                    <thead>
                        <tr>
                            <th colspan="5">
                                <h2>
                                    Training schedule
                                </h2>
                                <small style="font-style: italic; font-weight: 100; display: block; margin-top: -10px;">
                                    (View all in advance)
                                </small>
                            </th>
                        </tr>
                        <tr>
                            <th>Program</th>
                            <th>Session</th>
                            <th>Equipment</th>
                            <th>Sets x Reps</th>
                            <th>Weight (lb)</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ( $rotations as $week ) 
                            @foreach ( $days as $day ) 
                                
                                <tr>
                                    <th colspan="5">
                                        Week: {{ $week->week }}, Day: {{ $day->day }}
                                    </th>
                                </tr>

                                @if ( 
                                    isset( $sessionIndexed[$day->session]["primary"] ) && 
                                    isset( $workoutIndexed[$sessionIndexed[$day->session]["primary"]] )
                                )
                                    @foreach ( $workoutIndexed[$sessionIndexed[$day->session]["primary"]] as $primary )
                                        <tr>
                                            <td>{{ $week->program }}</td>
                                            <td>{{ $primary["session"] }}</td>
                                            <td>{{ $primary["equipment"] }}</td>
                                            <td>{{ $week->sets }} x {{ $week->reps }}</td>
                                            <td>{{ round(($week->weight_percent * round($primary["weight_1rm"], 1)) / 100, 1) }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            Rest day.
                                        </td>
                                    </tr>
                                @endif 

                                @if ( 
                                    isset( $sessionIndexed[$day->session]["secondary"] ) && 
                                    isset( $workoutIndexed[$sessionIndexed[$day->session]["secondary"]] )
                                )
                                    @foreach ( $workoutIndexed[$sessionIndexed[$day->session]["secondary"]] as $secondary )
                                        <tr>
                                            <td>{{ $week->program }}</td>
                                            <td>{{ $secondary["session"] }}</td>
                                            <td>{{ $secondary["equipment"] }}</td>
                                            <td>{{ $week->sets }} x {{ $week->reps }}</td>
                                            <td>{{ round(($week->weight_percent * round($secondary["weight_1rm"], 1)) / 100, 1) }}</td>
                                        </tr>
                                    @endforeach
                                @endif

                            @endforeach
                        @endforeach 

                    </tbody>
                </table>
            </div>

            <div style="width: 28%;">
                <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: center; width: 100%;">
                
                    <div style="width: 100%;">
                        <table class="table table-sm table-striped table-hover center">
                            <thead>
                                <tr>
                                    <th colspan="5">
                                        <h2>
                                            Rotation
                                        </h2>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="width: 19%;">Week</th>
                                    <th style="width: 19%;">Program</th>
                                    <th style="width: 18%;">Reps</th>
                                    <th style="width: 18%;">Sets</th>
                                    <th style="width: 26%;">Weight (% 1RM)</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($rotations as $rotation)
                                    <tr>
                                        <td>{{ $rotation->week }}</td>
                                        <td>{{ $rotation->program }}</td>
                                        <td>{{ $rotation->reps }}</td>
                                        <td>{{ $rotation->sets }}</td>
                                        <td>{{ $rotation->weight_percent }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div style="width: 100%;">
                        <table class="table table-sm table-striped table-hover center">
                            <thead>
                                <tr>
                                    <th style="width: 33%;">Session</th>
                                    <th style="width: 33%;">Primary</th>
                                    <th style="width: 33%;">Secondary</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ( $sessions as $session )
                                    <tr>
                                        <td>{{ $session->session }}</td>
                                        <td>{{ $session->primary }}</td>
                                        <td>{{ $session->secondary }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div style="width: 100%;">
                        <table class="table table-sm table-striped table-hover center">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Day</th>
                                    <th style="width: 50%;">Session</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ( $days as $day )
                                    <tr>
                                        <td>{{ $day->day }}</td>
                                        <td>{{ $day->session }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div style="width: 100%;">
                        <table class="table table-sm table-striped table-hover center">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <h3>
                                            Bleep test
                                        </h3>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th style="width: 50%;">Distance</th>
                                    <td style="width: 50%;"></td>
                                </tr>

                                <tr>
                                    <th>Goal level</th>
                                    <td></td>
                                </tr>

                                <tr>
                                    <th>Achieved level</th>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div style="width: 28%;">
                <table class="table table-sm table-hover table-striped center">
                    <thead>
                        <tr>
                            <th colspan="5">
                                <h2>
                                    Workout
                                </h2>
                                <small style="font-style: italic; font-weight: 100; display: block; margin-top: -10px;">
                                    (Set up workouts)
                                </small>
                            </th>
                        </tr>
                        <tr>
                            <th>Session</th>
                            <th>Exercise No.</th>
                            <th>Equipment</th>
                            <th>1RM weight (lb)</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($workouts as $workout)
                            <tr>
                                <td>{{ $workout->session }}</td>
                                <td>{{ $workout->exercise_no }}</td>
                                <td>{{ $workout->equipment }}</td>
                                <td>{{ round($workout->weight_1rm, 1) }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>



        {{-- 
            Can record workouts
            Can estimate calories burned
            Can recommend workouts to achieve current goal
        --}}
    </section>
@endsection
