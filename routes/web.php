<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TouristSpotController;
use App\Http\Controllers\TouristOfficerController;
use App\Http\Controllers\TouristGuideController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
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

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('spot', TouristSpotController::class);
    Route::resource('officer', TouristOfficerController::class);
    Route::resource('guide', TouristGuideController::class);
    
    
    Route::delete('/tourist-spots/{id}', [TouristSpotController::class, 'destroy'])->name('spot.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
