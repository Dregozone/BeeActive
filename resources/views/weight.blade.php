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
                    <h3 title="This is when you set this goal">Start date</h3>

                </div>

                <div class="col">
                    <h3 title="Weight recorded at start of this schedule">Start weight (lb)</h3>
                    {{ $currentWeight }}
                </div>
            </div>

            <div class="row">
                <div class="col" style="padding: 0; margin:  0; border: none; text-align: center; background: none;">
                    &darr;<br />
                    To lose 
                    <span style="font-weight: 600;">{{ $currentWeight - $targetWeight }} lbs</span> 
                    in 
                    <span style="font-weight: 600;">{{ $daysInSchedule }} days</span> 
                    requires an avg. loss of 
                    <span style="font-weight: 600;">{{ ROUND($requiredLossPerDay, 1) }} lbs / day</span>.<br />

                    <span 
                        @if ( $recentLossPerDay > 0 )
                            style="color: red;" 
                        @else 
                            style="color: green;" 
                        @endif
                    >Your recent average loss per day was <span style="font-weight: 600;">{{ $recentLossPerDay }} lbs</span></span><br />
                    
                    &darr;
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <h3 title="">Mini goal date</h3>
                    {{ str_replace(" 00:00:00.000", "", $milestoneDateText) }}
                </div>

                <div class="col">
                    <h3 title="The next milestone weight you would like to reach">Mini goal weight (lb)</h3>
                    {{ $targetWeight }} 
                </div>
            </div>

            <br />

            {{-- 
            <div class="row">
                <div class="col" style="padding: 0; margin:  0; border: none; text-align: center;">
                    &darr;<br />
                    ? days<br />
                    &darr;
                </div>
            </div>
            --}} 

            {{-- 
            <div class="row">
                <div class="col">
                    <h3 title="">End goal date</h3>
                    Ongoing
                </div>

                <div class="col">
                    <h3 title="Where you would like to be ultimately">End goal weight (lb)</h3>
                    {{ $endGoal }} (Diff: {{ $currentWeight - $endGoal }})
                </div>
            </div>
            --}} 

            <hr />

            <div class="row">
                <div id="chartContainer" style="padding: 0; height: 300px; width: 100%;"></div>
            </div>
        </div>
    </section>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script type="text/javascript">
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                title:{
                    text: "Change in weight over time"              
                },
                data: [              
                {
                    type: "line",
                    dataPoints: [
                        <?php 
                            foreach ( $graphDatas as $graphData ) {
                                echo '{ label: "' . $graphData["label"] . '", y: ' . $graphData["y"] . ' }';

                                if ( $graphData["label"] < sizeof($graphDatas) ) {
                                    echo ',';
                                }
                            }
                        ?>
                    ]
                }
                ]
            });
            chart.render();
        }
    </script>
@endsection
