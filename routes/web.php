<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TouristSpotController;
use App\Http\Controllers\AdminController;
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

Route::middleware(['auth', 'DB'])->group(function () {

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');


    Route::delete('/tourist-spots/{id}', [TouristSpotController::class, 'destroy'])->name('spot.destroy');
    Route::get('/spot/ratings', [TouristSpotController::class, 'sort_rating'])->name('spot.rating');
    Route::get('/spot/beach', [TouristSpotController::class, 'beach_category'])->name('spot.beach');
    Route::get('/spot/heritage', [TouristSpotController::class, 'heritage_category'])->name('spot.heritage');
    Route::get('/spot/mountain', [TouristSpotController::class, 'mountain_category'])->name('spot.mountain');
    Route::resource('spot', TouristSpotController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::post('/admin/refresh', [AdminController::class, 'refreshMaterializedView'])->name('admin.refresh');
        Route::get('/admin/avgrating', [AdminController::class, 'GetAvgRating'])->name('admin.avgrating');
        Route::get('/admin/spotlist', [AdminController::class, 'GetTourguideSpotlist'])->name('admin.spotlist');
    });
});

require __DIR__.'/auth.php';
