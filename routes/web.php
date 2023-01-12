<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/dashboard', [PagesController::class, 'dashboard'])
    ->middleware('LogRoute')
    ->name('dashboard');

Route::get('/schedule', [PagesController::class, 'schedule'])
    ->middleware(['auth', 'LogRoute'])
    ->name('schedule');

Route::get('/workouts', [PagesController::class, 'workouts'])
    ->middleware(['auth', 'LogRoute'])
    ->name('workouts');
Route::post('/workouts', [PagesController::class, 'addWorkout'])
    ->middleware(['auth', 'LogRoute'])
    ->name('workouts');

Route::get('/nutrition', [PagesController::class, 'nutrition'])
    ->middleware(['auth', 'LogRoute'])
    ->name('nutrition');
Route::post('/nutrition', [PagesController::class, 'nutritionInsertHandler'])
    ->middleware('LogRoute');

Route::get('/weight', [PagesController::class, 'weight'])
    ->middleware(['auth', 'LogRoute'])
    ->name('weight');
Route::post('/weight', [PagesController::class, 'record_weight'])
    ->middleware(['auth', 'LogRoute'])
    ->name('record_weight');

Route::get('/body_weight_goals', [PagesController::class, 'body_weight_goals'])
    ->middleware(['auth', 'LogRoute'])
    ->name('body_weight_goals');
Route::post('/body_weight_goals', [PagesController::class, 'save_body_weight_goals'])
    ->middleware(['auth', 'LogRoute'])
    ->name('save_body_weight_goals');

Route::get('/profile', [PagesController::class, 'profile'])
    ->middleware(['auth', 'LogRoute'])
    ->name('profile');
Route::post('/profile', [PagesController::class, 'action'])
    ->middleware('LogRoute');

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
    ->middleware(['auth', 'LogRoute'])
    ->name('logout');

Route::get('/', [PagesController::class, 'dashboard']);
