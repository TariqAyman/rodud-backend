<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderMessagesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('orders', OrderController::class)->names('admin.orders');

    Route::resource('orders/{order}/messages', OrderMessagesController::class)
        ->names('admin.messages')
        ->only(['index', 'store']);
});

require __DIR__ . '/auth.php';
