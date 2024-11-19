<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use \App\Http\Controllers\Auth\LoginController;
use \App\Http\Controllers\UsersController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\SettingsController;

// alternative way to use Inertia without rendering the view directly:
//Route::get('/', function () {
//    return inertia('Welcome');
//});

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    });

    // Home page
    Route::get('/', [HomeController::class, 'index'])->name('home.index');

    // User main page
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');

    // Create user
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create')->can('create', 'App\Models\User');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');

    // User show page
    Route::get('/users/{user}/show', [UsersController::class, 'show'])->name('users.show')->can('show', 'user');

    // Edit user
    Route::get('/users/{user}/edit', [UsersController::class, 'edit'])->name('users.edit')->can('edit', 'user');
    Route::post('/users/{user}/update', [UsersController::class, 'update'])->name('users.update')->can('edit', 'user');

    // Settings main page
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

});
