<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TierController;
use App\Http\Controllers\MissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('tiers', TierController::class);
Route::resource('missions', MissionController::class);