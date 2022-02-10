@extends('layout.app')

@section('title')
    Nutrition
@endsection

@section('content')
    <h1>
        Nutrition
    </h1>

    <section class="container">

        {{-- 
            Can enter weight and overall goal to calculate daily macros
            Can record macros used by selecting meals/combinations of ingredients
        --}}

        <div style="display: flex; width: 100%;">
            <div class="block" style="width: 45%;">
                <table style="width: 100%; text-align: center;">
                    <tr>
                        <th colspan="4">
                            <h2>
                                Daily macros (Goal: {{ $goal }})
                            </h2>
                        </th>
                    </tr>
                    <tr>
                        <th style="width: 25%;"></th>
                        <th style="width: 25%;">Target</th>
                        <th style="width: 25%;">Used</th>
                        <th style="width: 25%;">Remain</th>
                    </tr>
                    <tr>
                        <th>Carbs</th>
                        <td>{{ $carbs }}g</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Protein</th>
                        <td>{{ $protein }}g</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Fat</th>
                        <td>{{ $fat }}g</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th style="border-top: 1px dotted black;">Calories</th>
                        <td style="border-top: 1px dotted black;">{{ $calories }} kcal</td>
                        <td style="border-top: 1px dotted black;"></td>
                        <td style="border-top: 1px dotted black;"></td>
                    </tr>
                </table>
            </div>

            <div class="block" style="width: 55%;">
                <table style="width: 100%; text-align: center;">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <h2>
                                    Consumed today
                                </h2>
                            </th>
                        </tr>
                        <tr>
                            <th>Img</th>
                            <th>Item</th>
                            <th>Qty</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($consumeds as $consumed)
                            <tr>
                                <td>img</td>
                                <td>Item</td>
                                <td>Qty</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>


        <div class="block">
            <table class="table table-striped table-hover" style="text-align: center;">
                <thead>
                    <tr>
                        <th colspan="8">
                            <h2>
                                Record a meal
                            </h2>
                        </th>
                    </tr>
                    <tr>
                        <th> img </th>
                        <th> Item </th>
                        <th> Carbs </th>
                        <th> Protein </th>
                        <th> Fat </th>
                        <th> Calories </th>
                        <th> Status (Good|Neutral|Bad) </th>
                        <th> Add </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($foodItems as $item)
                        <tr>
                            <td>{{ $item["img"] }}</td>
                            <td>{{ $item["item"] }}</td>
                            <td>{{ $item["carbs"] }}</td>
                            <td>{{ $item["protein"] }}</td>
                            <td>{{ $item["fat"] }}</td>
                            <td>{{ $item["calories"] }}</td>
                            <td>(calculate)</td>
                            <td>
                                <div class="btn btn-success">
                                    +
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="block">
            <h2 style="text-align: center;">
                Add a new meal item
            </h2>

            <form style="display: flex; align-items: flex-end; justify-content: space-between;" action="{{ route('nutrition') }}" method="post" autocomplete="off">
                @csrf

                <div class="form-group">
                    <label for="item">Item</label>
                    <input type="text" name="item" id="item" class="form-control" placeholder="Enter item name" value="" />
                </div>

                <div class="form-group">
                    <label for="carbs">Carbs</label>
                    <input type="number" name="carbs" id="carbs" class="form-control" placeholder="Enter carbs (g)" value="" />
                </div>

                <div class="form-group">
                    <label for="protein">Protein</label>
                    <input type="number" name="protein" id="protein" class="form-control" placeholder="Enter protein (g)" value="" />
                </div>

                <div class="form-group">
                    <label for="fat">Fat</label>
                    <input type="number" name="fat" id="fat" class="form-control" placeholder="Enter fat (g)" value="" />
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Add" aria-label="" />
                </div>
            </form>
        </div>

    </section>
@endsection
