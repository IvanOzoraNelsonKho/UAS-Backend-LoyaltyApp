<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\CartController;
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
use App\Http\Controllers\ReferralController; 
use App\Http\Controllers\AuthController;       
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\IsAdmin;

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

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('tiers', TierController::class);
    
    // Fitur Klaim Misi - Wajib diletakkan di atas Route::resource agar tidak dianggap parameter ID
    Route::post('/missions/{id}/claim', [MissionController::class, 'claim'])->name('missions.claim');
    Route::resource('missions', MissionController::class);


    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/point-histories', [PointHistoryController::class, 'index'])->name('point_histories.index');
    Route::get('/admin/orders', [TransactionController::class, 'adminDashboard'])->name('admin.orders.dashboard');
    Route::post('/admin/orders/{id}/update-status', [TransactionController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    
    // Route untuk Admin melihat riwayat poin user tertentu
    Route::get('/admin/users/{id}/point-history', [PointHistoryController::class, 'adminUserHistory'])->name('admin.users.pointHistory');

    Route::get('/referral/claim', function () {
        return view('referrals.claim');
    })->name('referral.claim.form');    
    Route::post('/referral/claim', [ReferralController::class, 'processReferral'])->name('referral.claim');


    Route::get('/outlets', [App\Http\Controllers\MerchantController::class, 'outletsUser']);
   
    Route::get('/offers', [App\Http\Controllers\VoucherController::class, 'offersUser']);


    Route::resource('merchants', MerchantController::class);
    Route::resource('vouchers', VoucherController::class);
    Route::resource('redemptions', RedemptionController::class);

    Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
    Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');

    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    Route::resource('wishlists', WishlistController::class);

    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index']);
    Route::post('/cart/tambah', [\App\Http\Controllers\CartController::class, 'store']);
    Route::post('/cart/checkout', [\App\Http\Controllers\CartController::class, 'checkout']);

});

Route::resource('categories', CategoryController::class);
Route::resource('rewards', RewardController::class);
Route::resource('carts', CartController::class);




Route::middleware(['auth', IsAdmin::class])->group(function () {
    
    // --- RUTE ADMIN PESANAN DUIT (Punya Temen Lu) ---
    Route::get('/admin/orders', [\App\Http\Controllers\TransactionController::class, 'adminDashboard'])->name('admin.orders.dashboard');
    Route::post('/admin/orders/{id}/update-status', [\App\Http\Controllers\TransactionController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    
    // --- RUTE ADMIN NUKER POIN (Punya Lu) ---
    Route::get('/admin/redemptions', [\App\Http\Controllers\RedemptionController::class, 'adminIndex'])->name('admin.redemptions.index');
    Route::post('/admin/redemptions/{id}/update-status', [\App\Http\Controllers\RedemptionController::class, 'adminUpdateStatus'])->name('admin.redemptions.updateStatus');

    // --- RUTE ADMIN KELOLA KATALOG MENU ---
    Route::get('/admin/rewards', [\App\Http\Controllers\RewardController::class, 'adminIndex'])->name('admin.rewards.index');
    Route::post('/admin/rewards/tambah', [\App\Http\Controllers\RewardController::class, 'adminStore'])->name('admin.rewards.store');
    Route::post('/admin/rewards/{id}/hapus', [\App\Http\Controllers\RewardController::class, 'adminDestroy'])->name('admin.rewards.destroy');
    
});
