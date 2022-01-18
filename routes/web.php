<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/home', [PagesController::class, 'home'])
    ->middleware('LogRoute')
    ->name('home');

Route::get('/workouts', [PagesController::class, 'workouts'])
    ->middleware('LogRoute')
    ->name('workouts');

Route::get('/nutrition', [PagesController::class, 'nutrition'])
    ->middleware('LogRoute')
    ->name('nutrition');

Route::get('/profile', [PagesController::class, 'profile'])
    ->middleware('LogRoute')
    ->name('profile');

Route::get('/login', [LoginController::class, 'index'])
    ->middleware('LogRoute')
    ->name('login');
Route::post('/login', [LoginController::class, 'action'])
    ->middleware('LogRoute');

Route::get('/register', [RegisterController::class, 'index'])
    ->middleware('LogRoute')
    ->name('register');
Route::post('/register', [RegisterController::class, 'action'])
    ->middleware('LogRoute');
    
Route::post('/logout', [LogoutController::class, 'index'])
    ->middleware('LogRoute')
    ->name('logout');

Route::get('/', [PagesController::class, 'home']);
