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
                        <td>{{ $used->carbs }}g</td>
                        <td>{{ $carbs - $used->carbs }}g</td>
                    </tr>
                    <tr>
                        <th>Protein</th>
                        <td>{{ $protein }}g</td>
                        <td>{{ $used->protein }}g</td>
                        <td>{{ $protein - $used->protein }}g</td>
                    </tr>
                    <tr>
                        <th>Fat</th>
                        <td>{{ $fat }}g</td>
                        <td>{{ $used->fat }}g</td>
                        <td>{{ $fat - $used->fat }}g</td>
                    </tr>
                    <tr>
                        <th style="border-top: 1px dotted black;">Calories</th>
                        <td style="border-top: 1px dotted black;">{{ $calories }} kcal</td>
                        <td style="border-top: 1px dotted black;">{{ $used->calories }} kcal</td>
                        <td style="border-top: 1px dotted black;">{{ $calories - $used->calories }}</td>
                    </tr>
                </table>
            </div>

            <div class="block" style="width: 45%; margin-left: 6%;">
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
                                <td>
                                    @if ( file_exists('img/' . $consumed["img"] . '.png') )    
                                        <img src="{{ asset('img/' . $consumed["img"] . '.png') }}" class="mealItemImg" alt="{{ $consumed["img"] }}" />
                                    @else 
                                        {{-- No img --}} 
                                    @endif
                                </td>
                                <td>{{ $consumed["name"] }}</td>
                                <td>{{ $consumed["quantity"] }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>

        <hr />

        <div class="block">
            <h2 style="text-align: center;">
                Add a new meal item
            </h2>

            <form style="display: flex; align-items: flex-end; justify-content: space-between;" action="{{ route('nutrition') }}" method="post" autocomplete="off">
                @csrf

                <input type="hidden" name="action" value="addMealItem" />

                <div class="form-group">
                    <label for="item">Item</label>
                    <input type="text" name="item" id="item" class="form-control" placeholder="Enter item name" value="" />
                </div>

                <div class="form-group">
                    <label for="carbs">Carbs</label>
                    <input type="number" step="0.1" name="carbs" id="carbs" class="form-control" placeholder="Enter carbs (g)" value="" />
                </div>

                <div class="form-group">
                    <label for="protein">Protein</label>
                    <input type="number" step="0.1" name="protein" id="protein" class="form-control" placeholder="Enter protein (g)" value="" />
                </div>

                <div class="form-group">
                    <label for="fat">Fat</label>
                    <input type="number" step="0.1" name="fat" id="fat" class="form-control" placeholder="Enter fat (g)" value="" />
                </div>

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Add" aria-label="Add new meal item button" />
                </div>
            </form>
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
                        <th> Quantity </th>
                        <th> Add </th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($foodItems as $item)
                        <tr>
                            <td>
                                @if ( file_exists('img/' . $item["img"] . '.png') )    
                                    <img src="{{ asset('img/' . $item["img"] . '.png') }}" class="mealItemImg" alt="{{ $item["img"] }}" />
                                @else 
                                    {{-- No img --}} 
                                @endif    
                            </td>
                            <td>{{ $item["name"] }}</td>
                            <td>{{ ROUND($item["carbs"], 1) }}</td>
                            <td>{{ ROUND($item["protein"], 1) }}</td>
                            <td>{{ ROUND($item["fat"], 1) }}</td>
                            <td>{{ ROUND($item["calories"], 1) }}</td>
                            <td>(calculate)</td>

                            <form action="{{ route('nutrition') }}" method="post">
                                @csrf 

                                <input type="hidden" name="action" value="addConsumed" />
                                <input type="hidden" name="meal_item_id" value="{{ $item["id"] }}" />

                                <td>
                                    <input 
                                        type="number"
                                        name="quantity"
                                        value="1" 
                                        min="1" 
                                        max="100" 
                                        id="qty-{{ $item["id"] }}" 
                                        aria-label="Quantity of meal item" 
                                        style="max-width: 50px;"
                                    />
                                </td>
                                <td>
                                    <input type="submit" class="btn btn-success" value="+">
                                </td>
                            </form>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </section>
@endsection
