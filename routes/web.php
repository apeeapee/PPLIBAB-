<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\SellerRegistrationController;
use App\Http\Controllers\Admin\SellerVerificationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ReportController;


/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Products & Reviews
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

// Reviews (SRS-MartPlace-06 - allow guest reviews)
Route::post('/products/{product:slug}/reviews', [ReviewController::class, 'store'])
    ->name('reviews.store');

/*
|--------------------------------------------------------------------------
| Landing / Utility
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');   // resources/views/home.blade.php
})->name('home');

Route::get('/home', function () {
    return redirect()->route('home');
});

Route::get('/market', function () {
    return redirect()->route('products.index');
})->name('market');

/*
|--------------------------------------------------------------------------
| Forgot Password
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

/*
|--------------------------------------------------------------------------
| Note: Seller Registration is now combined with user registration
| SRS-MartPlace-01: Register creates both User + Seller in one step
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| Admin Area
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'can:verify-sellers'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 🔹 Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // 🔹 (opsional) kalau mau index seller tetap di bawah /admin/toko
        Route::prefix('toko')->name('sellers.')->group(function () {
            Route::get('/registrasi', [SellerVerificationController::class, 'index'])
                ->name('index');
            Route::get('/registrasi/{seller}', [SellerVerificationController::class, 'show'])
                ->name('show');
            Route::post('/{seller}/approve', [SellerVerificationController::class, 'approve'])
                ->name('approve');
            Route::post('/{seller}/reject', [SellerVerificationController::class, 'reject'])
                ->name('reject');
        });

        // 🔹 Laporan Admin (SRS-09, 10, 11) - Platform Level Reports
        Route::prefix('laporan')->name('reports.')->group(function () {
            Route::get('/', [ReportController::class, 'index'])
                ->name('index'); // Report landing page
            
            Route::get('/sellers', [ReportController::class, 'sellers'])
                ->name('sellers'); // SRS-09
            Route::get('/sellers/export-excel', [ReportController::class, 'exportSellersExcel'])
                ->name('sellers.export-excel'); // SRS-09 Excel Export
            Route::get('/sellers/export-pdf', [ReportController::class, 'exportSellersPDF'])
                ->name('sellers.export-pdf'); // SRS-09 PDF Export
            
            Route::get('/sellers-by-location', [ReportController::class, 'sellersByLocation'])
                ->name('sellers-location'); // SRS-10
            Route::get('/sellers-by-location/export-excel', [ReportController::class, 'exportSellersByLocationExcel'])
                ->name('sellers-location.export-excel'); // SRS-10 Excel Export
            Route::get('/sellers-by-location/export-pdf', [ReportController::class, 'exportSellersByLocationPDF'])
                ->name('sellers-location.export-pdf'); // SRS-10 PDF Export
            
            Route::get('/product-ranking', [ReportController::class, 'productRanking'])
                ->name('product-ranking'); // SRS-11
            Route::get('/product-ranking/export-excel', [ReportController::class, 'exportProductRankingExcel'])
                ->name('product-ranking.export-excel'); // SRS-11 Excel Export
            Route::get('/product-ranking/export-pdf', [ReportController::class, 'exportProductRankingPDF'])
                ->name('product-ranking.export-pdf'); // SRS-11 PDF Export
        });
    });

Route::middleware('auth')->get('/market/dashboard', [\App\Http\Controllers\Seller\DashboardController::class, 'index'])
    ->name('seller.dashboard');

/*
|--------------------------------------------------------------------------
| Seller Notifications (SRS-MartPlace-02: Email Verifikasi)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('seller')->name('seller.')->group(function () {
    Route::get('/notifications', [\App\Http\Controllers\Seller\NotificationController::class, 'index'])
        ->name('notifications.index');
    Route::get('/notifications/{notification}', [\App\Http\Controllers\Seller\NotificationController::class, 'show'])
        ->name('notifications.show');
    Route::post('/notifications/{notification}/mark-read', [\App\Http\Controllers\Seller\NotificationController::class, 'markAsRead'])
        ->name('notifications.mark-read');
    Route::post('/notifications/mark-all-read', [\App\Http\Controllers\Seller\NotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-read');
});

/*
|--------------------------------------------------------------------------
| Seller Registration
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/seller/register', [SellerRegistrationController::class, 'create'])
        ->name('seller.register');
    Route::post('/seller/register', [SellerRegistrationController::class, 'store'])
        ->name('seller.register.store');
});

/*
|--------------------------------------------------------------------------
| Seller Product Management (SRS-MartPlace-03)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('seller')->name('seller.')->group(function () {
    Route::resource('products', \App\Http\Controllers\Seller\ProductManagementController::class)
        ->except(['show']);
    
    // 🔹 Seller Reports
    Route::prefix('laporan')->name('reports.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Seller\ReportController::class, 'index'])
            ->name('index');

        Route::get('/stock', [\App\Http\Controllers\Seller\ReportController::class, 'stock'])
            ->name('stock');
        Route::get('/stock/export', [\App\Http\Controllers\Seller\ReportController::class, 'exportStock'])
            ->name('stock.export');

        Route::get('/rating', [\App\Http\Controllers\Seller\ReportController::class, 'rating'])
            ->name('rating');
        Route::get('/rating/export', [\App\Http\Controllers\Seller\ReportController::class, 'exportRating'])
            ->name('rating.export');

        Route::get('/restock', [\App\Http\Controllers\Seller\ReportController::class, 'restock'])
            ->name('restock');
        Route::get('/restock/export', [\App\Http\Controllers\Seller\ReportController::class, 'exportRestock'])
            ->name('restock.export');
    });
});

// Route test untuk debug auth
Route::get('/test-auth', function () {
    $user = auth()->user();
    if (!$user) {
        return response()->json([
            'logged_in' => false,
            'message' => 'NOT LOGGED IN',
            'login_url' => url('/login')
        ]);
    }
    return response()->json([
        'logged_in' => true,
        'user' => $user->only(['id', 'name', 'email', 'is_admin']),
        'can_verify_sellers' => $user->can('verify-sellers'),
        'is_admin' => (bool) $user->is_admin,
        'message' => $user->can('verify-sellers') ? 'CAN access admin area ✅' : 'CANNOT access admin area ❌'
    ]);
});
