<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::get('/', function () {
    return view('backend.pages. dashboard');
});

Route::get('/signup', function () {
    return view('backend.pages.signup');
})->name('sign_up') ;

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
// Auth Routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);


    // Password Reset
    Route::get('/forgot-password', function() {
        return view('auth.forgot-password');
    })->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard

Route::middleware(['auth', RoleMiddleware::class.':user'])->group(function () {
    Route::get('/user/dashboard', fn() => view('user.dashboard'));
});

Route::middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('admin.dashboard'));
});


