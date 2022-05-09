<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Consumed;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function consumedAll() {
        
        $consumeds = Consumed::
            get();

        return json_encode($consumeds);
    }

    public function consumed(User $user) {

        $consumeds = Consumed:: 
              where('user_id', $user->id)
            ->get();

        return json_encode($consumeds);
    }

    public function addConsumed(User $user, Request $request) {

        //echo $user->id;
        //die();

        Consumed::create([
            'user_id' => $request->$user->id,
            'meal_item_id' => $request->meal_item_id,
            'quantity' => $request->quantity,
        ]);
    }
}
