@extends('layout.app')

@section('title')
    Workouts
@endsection

@section('content')
    <h1>
        Weight
    </h1>

    <section class="container flex" style="justify-content: space-between;">

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

        <div class="weightGoals">
            <div class="row">
                <div class="col">
                    <h3>Current weight (lb)</h3>
                    {{ $currentWeight }}
                </div>

                <div class="col">
                    <h3>End goal weight (lb)</h3>
                    {{ $endGoal }} (Diff: {{ $currentWeight - $endGoal }})
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h3>Target weight (lb)</h3>
                    {{ $targetWeight }} (Diff: {{ $currentWeight - $targetWeight }})
                </div>

                <div class="col">
                    <h3>Days in schedule</h3>
                    {{ $daysInSchedule }}
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h3>Required loss per day</h3>
                    {{ ROUND($requiredLossPerDay, 1) }}
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
