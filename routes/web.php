<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCreateController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['auth, verified'], function () {
    // users
    // Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
    // Route::get('/users/create', function () {
    //     return view('user.create');
    // })->name('users.create');

    // Route::post('/users', [RegisteredUserController::class, 'store'])->name('users.store');
    // Route::get('/users/{user}/edit', [UserCreateController::class, 'edit'])->name('users.edit');
    // Route::put('/users/{user}', [UserCreateController::class, 'update'])->name('users.update');
    // Route::delete('/users/{user}', [UserCreateController::class, 'destroy'])->name('users.destroy');

    // client
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
});

// admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [RegisteredUserController::class, 'index'])->name('users.index');
    Route::get('/users/create', function () {
        return view('user.create');
    })->name('users.create');

    Route::post('/users', [RegisteredUserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserCreateController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserCreateController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserCreateController::class, 'destroy'])->name('users.destroy');
});

require __DIR__ . '/auth.php';
