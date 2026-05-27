<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerchantController;

Route::resource('merchants', MerchantController::class);

Route::get('/', function () {
    return view('welcome');
});
