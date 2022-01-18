<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    
    public function home() {

        return view('home');
    }

    public function workouts() {

        return view('workouts');
    }

    public function nutrition() {

        return view('nutrition');
    }

    public function profile() {

        return view('profile');
    }
}
