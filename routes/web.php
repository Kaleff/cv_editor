<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return to_route('resume_list');
    }
    return view('welcome');
});

Route::controller(UserController::class)->group(function () {
    // Login routes
    Route::get('/login', 'loginShow')->name('login');
    Route::post('/login', 'login');
    // Registration Routes...
    Route::get('/register', 'registerShow')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
});

Route::resource('resume', ResumeController::class)
    ->name('create', 'resume_create_form')
    ->name('edit', 'resume_edit_form')
    ->name('index', 'resume_list')->middleware('auth');
Route::resources([
    'experience' => ExperienceController::class
]);
