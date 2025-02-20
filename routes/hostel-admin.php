<?php

use App\Http\Controllers\Hostel\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Route::name('app.')->middleware('auth')->group(function(){

    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

    // Profile Route
    Route::get('profile', [ProfileController::class, 'showForm'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
});
