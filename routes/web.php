<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\WeddingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Guest routes (admin login)
Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])
    ->name('admin.login');
// Auth check handled in controller (AC: 3)

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.post');

// Protected admin routes (require authentication and super-admin role)
Route::middleware(['auth', 'role:super-admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Wedding account management routes (Story 1.2)
        Route::get('/weddings/create', [WeddingController::class, 'create'])->name('weddings.create');
        Route::post('/weddings', [WeddingController::class, 'store'])->name('weddings.store');
        Route::get('/weddings', [WeddingController::class, 'index'])->name('weddings.index'); // For future Story 7.1

        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    });

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
