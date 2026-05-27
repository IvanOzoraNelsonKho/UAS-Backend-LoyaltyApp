<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

