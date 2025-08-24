<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\EvenementController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;



// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


// 🌍 Public site
Route::get('/', [SiteController::class, 'dashboard'])->name('site.dashboard');
// 🔐 Admin site
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Admin can manage participants
    Route::get('/admin/participants', [ParticipantController::class, 'index'])->name('participants.index');
});

Route::get('/inscription', [ParticipantController::class, 'create'])->name('participants.create');
Route::post('/inscription', [ParticipantController::class, 'store'])->name('participants.store');

Route::get('/dashboard', [\App\Http\Controllers\SiteController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); // 👈 important
// About Us Management

        Route::get('/about-us/edit', [AboutUsController::class, 'edit'])->name('aboutus.edit');
        Route::put('/about-us', [AboutUsController::class, 'update'])->name('aboutus.update');

// Public show route
Route::get('/evenements/add', [EvenementController::class, 'create'])->name('evenements.add');
Route::get('evenements/{evenement}', [EvenementController::class, 'show'])
    ->name('evenements.show');

// Socialite Routes
Route::prefix('auth')->group(function () {
    Route::get('/google', [RegisteredUserController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/google/callback', [RegisteredUserController::class, 'handleGoogleCallback']);
    
    Route::get('/apple', [RegisteredUserController::class, 'redirectToApple'])->name('auth.apple');
    Route::get('/apple/callback', [RegisteredUserController::class, 'handleAppleCallback']);
});
//aboutus routes
Route::get('/about-us', [AboutUsController::class, 'index'])->name('aboutus.index');
Route::get('/about-us/edit', [AboutUsController::class, 'edit'])->name('aboutus.edit')->middleware('auth');
Route::put('/about-us/update', [AboutUsController::class, 'update'])->name('aboutus.update')->middleware('auth');Route::prefix('aboutus')->group(function() {
    Route::get('/', [AboutUsController::class, 'index'])->name('aboutus.index');
    Route::get('/edit', [AboutUsController::class, 'edit'])->name('aboutus.edit');
    Route::put('/', [AboutUsController::class, 'update'])->name('aboutus.update');
});


// If you're using resource controller
Route::resource('evenements', EvenementController::class);

// OR if you want to define it manually
Route::get('/evenements', [EvenementController::class, 'index'])->name('evenements.index');



// Payment routes
Route::get('/payment/{event?}', [PaymentController::class, 'index'])->name('payment.form');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success/{id}', [PaymentController::class, 'success'])->name('payment.success');

require __DIR__.'/auth.php';