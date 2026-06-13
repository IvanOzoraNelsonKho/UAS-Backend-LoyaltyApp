<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('categories', CategoryController::class);
Route::resource('rewards', RewardController::class);
Route::resource('carts', CartController::class);