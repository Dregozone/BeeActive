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

            <form action="{{ route('workouts') }}" method="post" style="display: flex; width: 100%; align-items: center; justify-content: space-evenly;">
                @csrf 

                <div class="form-group">
                    <label for="equipment">Action:</label>
                    <select name="equipment" id="equipment" class="form-control">
                        <option value="none"> -- Please select -- </option>
                        @foreach ( $workouts as $workout )
                            <option value="{{ $workout["equipment"] }}">{{ $workout["equipment"] }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="sets">Sets: </label>
                    <input class="form-control" type="number" id="sets" name="sets" />
                </div>

                <div class="form-group">
                    <label for="reps">Reps:</label>
                    <input class="form-control" type="number" id="reps" name="reps" />
                </div>

                <div class="form-group">
                    <label for="weight">Weight (lbs):</label>
                    <input class="form-control" type="number" step="0.1" id="weight" name="weight" />
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Record" aria-label="Record a completed workout" />
                </div>

            </form>


        </div>

        <hr />

        <h2 class="center">
            Recorded workouts 
        </h2>

        <div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th style="width: 25%;">Action</th>
                        <th style="width: 25%;">Sets</th>
                        <th style="width: 25%;">Reps</th>
                        <th style="width: 25%;">Weight</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $completedWorkouts as $completedWorkout ) 
                        <tr>
                            <td>{{ $completedWorkout->equipment }}</td>
                            <td>{{ $completedWorkout->sets }}</td>
                            <td>{{ $completedWorkout->reps }}</td>
                            <td>{{ ROUND($completedWorkout->weight, 1) }}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>

        {{-- 
            Can record workouts
            Can estimate calories burned
            Can recommend workouts to achieve current goal - maybe on home instead... 
        --}}

    </section>
@endsection
