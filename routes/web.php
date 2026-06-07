<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TierController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\RedemptionController;
use App\Http\Controllers\PointHistoryController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReferralController; // Perbaikan typo kapital (COntrollers -> Controllers)
use App\Http\Controllers\AuthController;       // Import AuthController baru

// Halaman Utama: Jika sudah login arahkan berdasarkan Role, jika belum lempar ke Login
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->is_admin) {
            return redirect()->route('missions.index'); // Admin ke dashboard kelola data
        }
        return redirect()->route('users.show', auth()->id()); // Customer ke profil member digital
    }
    return redirect()->route('login');
});

// 🔑 Rute Autentikasi (Bisa diakses publik / Guest)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// 🔒 Grup Rute Aplikasi (Wajib Login Terlebih Dahulu)
Route::middleware(['auth'])->group(function () {

    // 📦 Paket 1: Core User & Gamification
    Route::resource('users', UserController::class);
    Route::resource('tiers', TierController::class);
    
    // Fitur Klaim Misi - Wajib diletakkan di atas Route::resource agar tidak dianggap parameter ID
    Route::post('/missions/{id}/claim', [MissionController::class, 'claim'])->name('missions.claim');
    Route::resource('missions', MissionController::class);


    // 📦 Paket 3: Transaksi & Saldo Poin
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/point-histories', [PointHistoryController::class, 'index'])->name('point_histories.index');
    
    // Fitur Referral
    Route::get('/referral/claim', function () {
        return view('referrals.claim');
    })->name('referral.claim.form');    
    Route::post('/referral/claim', [ReferralController::class, 'processReferral'])->name('referral.claim');


    // 📦 Paket 4: Penukaran & Operasional
    Route::resource('merchants', MerchantController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('redemptions', RedemptionController::class);


    // 📦 Paket 5: Engagement & Promo
    Route::resource('promotions', PromotionController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('notifications', NotificationController::class);

});
