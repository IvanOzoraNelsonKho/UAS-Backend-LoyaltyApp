<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PointHistoryController;
use App\Http\Controllers\ReferralController;


Route::get('/', function () {
    return view('welcome');
});

// semacam hrs login dlu baru bisa kesini
Route::middleware(['auth'])->group(function (){
    Route::get('/referral/claim', function () {
            return view('referrals.claim');
        })->name('referral.claim.form');    
    Route::post('/referral/claim', [ReferralController::class, 'processReferral'])->name('referral.claim');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    Route::get('/point-histories', [PointHistoryController::class, 'index'])->name('point_histories.index');

});

Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');