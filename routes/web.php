<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\VotesController;
use App\Http\Middleware\IsAuthorized;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [MovieController::class, 'index'])->name('index');

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', function () {
        return Inertia::render('Auth/Login');
    })->name('login');
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::middleware([IsAuthorized::class])->group(function () {
    Route::get('/movie/create', [MovieController::class, 'create'])->name('movie.create');
    Route::post('/movie/store', [MovieController::class, 'store'])->name('movie.store');
    Route::post('/votes/store', [VotesController::class, 'storeOrUpdate'])->name('vote.store');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

