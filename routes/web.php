<?php

use App\Http\Controllers\PercentageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/percentage', [PercentageController::class, 'index']);
Route::post('/percentage', [PercentageController::class, 'operation'])->name('operation');

Route::get('/percentage-increase-calculator', [PercentageController::class, 'increase_calculator']);
Route::post('/percentage-increase-calculator', [PercentageController::class, 'post_increase_calculator']);

Route::get('/percentage-decrease-calculator', [PercentageController::class, 'decrease_calculator']);
Route::post('/percentage-decrease-calculator', [PercentageController::class, 'post_decrease_calculator']);

Route::get('/percentage-change-calculator', [PercentageController::class, 'change_calculator']);
Route::post('/percentage-change-calculator', [PercentageController::class, 'post_change_calculator']);

require __DIR__.'/auth.php';
