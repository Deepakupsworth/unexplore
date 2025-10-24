<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('backend.pages. dashboard');
});

Route::get('/signup', function () {
    return view('backend.pages.signup');
})->name('sign_up') ;;



