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
                    <input class="btn btn-primary" type="submit" value="Record" aria-label="Record a completed workout" />
                </div>

            </form>


        </div>

        {{-- 
            Can record workouts
            Can estimate calories burned
            Can recommend workouts to achieve current goal - maybe on home instead... 
        --}}

    </section>
@endsection
