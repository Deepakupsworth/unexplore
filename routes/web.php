<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

// routes/web.php
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de', 'ar'])) {
        Session::put('locale', $locale); 
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('lang.switch');


Route::get('/', function () {
    return view('backend.pages.dashboard');
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
    Route::get('/admin/dashboard', fn() => view('backend.pages.dashboard'));
});

// Route::get('/profile', function () {
//     return view('backend.pages.profile');
// });

Route::middleware(['auth', RoleMiddleware::class.':admin'])->group(function () {
    // Profile Routes
    // Route::get('/admin/profile', fn() => view('backend.pages.profile'));
    // Route::get('/admin/profile/edit', fn() => view('backend.pages.Profile_edit'));
    Route::get('/admin/profile', [AuthController::class, 'profile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AuthController::class, 'editProfile'])->name('admin.profile.edit');
    Route::post('/admin/profile/update', [AuthController::class, 'updateProfile'])->name('admin.profile.update');
});

Route::get('/basic_form', function () {
    return view('backend.pages.basicform');
})->name('form.view');

Route::get('/basic_table', function () {
    return view('backend.pages.basic_table');
})->name('table.view');

Route::get('/categories', function () {
    return view('backend.pages.categories');
})->name('categories.view');


Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');


