<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notifications/create/{user?}', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications/{user?}', [NotificationController::class, 'store'])->name('notifications.store');
    Route::patch('/notifications/{id}', [NotificationController::class, 'mark'])->name('notifications.mark');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    Route::get('/{user}/impersonate', [UsersController::class, 'impersonate'])
        ->middleware('role:admin')
        ->name('users.impersonate');
    Route::get('/leave-impersonate', [UsersController::class, 'leaveImpersonate'])
        ->name('users.leave-impersonate');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
