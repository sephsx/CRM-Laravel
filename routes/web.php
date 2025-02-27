<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCreateController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware(['auth', 'verified'])->group(function () {
    //client routes
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/Users', [UserCreateController::class, 'index'])->name('users.index');
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});





// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users/create', [UserCreateController::class, 'create'])->name('users.create');
    Route::post('/users', [RegisteredUserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserCreateController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserCreateController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserCreateController::class, 'destroy'])->name('users.destroy');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
});

require __DIR__ . '/auth.php';
