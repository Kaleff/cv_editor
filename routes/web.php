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
})->name('homepage');

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
    ->name('destroy', 'resume_delete')
    ->name('show', 'resume_show')
    ->name('index', 'resume_list')->middleware('auth');

Route::resource('experience', ExperienceController::class)
    ->name('edit', 'experience_edit_form')
    ->name('store', 'store_experience')
    ->name('destroy', 'experience_delete')->middleware('auth');

Route::get('create_experience/{id}', [ExperienceController::class, 'create'])->name('experience_create_form')->middleware('auth');