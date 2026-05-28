<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TierController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\RedemptionController;

Route::resource('merchants', MerchantController::class);
Route::resource('vouchers', VoucherController::class);
Route::resource('redemptions', RedemptionController::class);
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('tiers', TierController::class);
Route::resource('missions', MissionController::class);
Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');

