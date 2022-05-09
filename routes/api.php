<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiController;

Route::get('consumed', [ApiController::class, 'consumedAll'])->name('consumedAll');

Route::get('/consumed/{user}', [ApiController::class, 'consumed'])
    ->name('consumed');
Route::post('/consumed/{user}', [ApiController::class, 'addConsumed']);
