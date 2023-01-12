@extends('layout.app')

@section('title')
    Weight
@endsection

@section('content')
    <h1>
        Weight
    </h1>

    <div class="recordContainer">
        <h2 style="text-align: center;">Record a weight</h2>

        @if ( Session::has('success') ) 
            <div id="message" class="message">
                {{ Session::get('success') }}
            </div>

            <script>
                setTimeout(function() {
                    document.getElementById("message").style.display = "none";
                }, 3000);
            </script>
        @endif 

        <form action="{{ route('weight') }}" method="post" style="display: flex; width: 100%; align-items: flex-end; justify-content: center;">
            @csrf 

            <div class="form-group">
                <label for="weight">Weight (lbs):</label>
                <input class="form-control" type="number" min="0.1" step="0.1" id="weight" name="weight" />
            </div>

            <div class="form-group" style="margin-left: 1%;">
                <input class="btn btn-primary" type="submit" value="Record" aria-label="Record a completed workout" />
            </div>
        </form>
    </div>

    <hr />

    <section class="container flex" style="justify-content: space-between;">

        {{-- 
        <div>
            <h2 class="center">Projections</h2>
            <table class="table table-sm table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 18%;">Days from now</th>
                        <th style="width: 23%;">Predicted weight (lb)</th>
                        <th style="width: 20%;">Actual weight (lb)</th>
                        <th style="width: 20%;">lbs from predicted</th>
                        <th style="width: 19%;">lbs from target</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ( $projections as $daysFromNow => $projection )
                        <tr>
                            <td>{{ $daysFromNow }}</td>
                            <td>{{ $projection["predicted"] }}</td>
                            <td>
                                <input 
                                    class="form-control" 
                                    type="number" 
                                    step="0.1" 
                                    name="actual-{{ $daysFromNow }}" 
                                    id="actual-{{ $daysFromNow }}" 
                                    aria-label="Actual weight value"
                                    value="{{ $actualWeights[$daysFromNow] ?? 0 }}"
                                >    
                            </td>
                            <td>
                                @if ( 
                                    isset($actualWeights[$daysFromNow]) && 
                                    ROUND(($actualWeights[$daysFromNow] ?? 0) - $projection["predicted"], 1) > 0  
                                )
                                    <span style="color: rgb(131, 28, 10);">
                                        {{ ROUND(($actualWeights[$daysFromNow] ?? 0) - $projection["predicted"], 1) }}
                                    </span>

                                @elseif (
                                    isset($actualWeights[$daysFromNow]) && 
                                    ROUND(($actualWeights[$daysFromNow] ?? 0) - $projection["predicted"], 1) < 0  
                                ) 
                                    <span style="color: green;">
                                        {{ ROUND(($actualWeights[$daysFromNow] ?? 0) - $projection["predicted"], 1) }}
                                    </span>

                                @endif    
                            </td>
                            <td>
                                @if ( isset($actualWeights[$daysFromNow]) )
                                    {{ ROUND(($actualWeights[$daysFromNow] ?? 0) - $targetWeight, 1) }}
                                @endif
                            </td>
                        </tr>
                    @endforeach 

                </tbody>
            </table>
        </div>
        --}} 

        <div>
            <h2 class="center">
                Recent {{ $numToShow }}
            </h2>

            <table class="table table-sm table-hover table-striped">
                <thead>
                    <tr>
                        <th title="Most recent at the top">Date recorded</th>
                        <th>Weight (lbs)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $bodyWeights as $bodyWeight )
                        <tr>
                            <td title="{{ $bodyWeight->created_at }}">{{ $bodyWeight->created_at->diffForHumans() }}</td>
                            <td>{{ ROUND($bodyWeight->weight_in_lbs, 1) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="weightGoals">
            
            <div class="flex" style="align-items: center; justify-content: center;">
                <h2 class="center">
                    Current goals
                </h2>
                <a class="btn btn-light" style="margin-left: 1%; margin-top: -4px;" href="{{ route('body_weight_goals') }}">Edit</a>
            </div>

            <div class="row">
                <div class="col">
                    <h3 title="Weight recorded at start of this schedule">Start weight (lb)</h3>
                    {{ $currentWeight }}
                </div>

                <div class="col">
                    <h3 title="Where you would like to be ultimately">End goal weight (lb)</h3>
                    {{ $endGoal }} (Diff: {{ $currentWeight - $endGoal }})
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h3 title="The next milestone weight you would like to reach">Target weight (lb)</h3>
                    {{ $targetWeight }} (Diff: {{ $currentWeight - $targetWeight }})
                </div>

                <div class="col">
                    <h3 title="You would like to reach your milestone target weight in this many days">Days in schedule</h3>
                    <span title="{{ $milestoneDateText }}">{{ $daysInSchedule }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h3 title="In order to reach the milestone in time, this much loss is required per day (Average)">Required loss per day</h3>
                    {{ ROUND($requiredLossPerDay, 1) }} lbs
                </div>
            </div>

            <hr />

            <div class="row">
                <h3 class="center">Change over time</h3>

                (graph)
            </div>
        </div>

    </section>
@endsection
