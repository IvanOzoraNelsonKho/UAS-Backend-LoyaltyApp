<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\RedemptionController;

Route::resource('merchants', MerchantController::class);
Route::resource('vouchers', VoucherController::class);
Route::resource('redemptions', RedemptionController::class);

Route::get('/', function () {
    return view('welcome');
});
