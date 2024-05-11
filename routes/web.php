<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome')->name('homepage');
});

Route::controller(UserController::class)->group(function () {
    // Login routes
    Route::get('/login', 'loginShow')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
    // Registration Routes...
    Route::get('/register', 'registerShow')->name('register');
    Route::post('/register', 'register');    
});