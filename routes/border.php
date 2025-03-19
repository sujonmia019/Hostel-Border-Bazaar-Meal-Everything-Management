<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Hostel\Border\BazaarController;

Auth::routes([
    'password.confirm' => false, // 404 disabled
    'password.email'   => false, // 404 disabled
    'password.request' => false, // 404 disabled
    'password.reset'   => false, // 404 disabled
    'password.update'  => false, // 404 disabled
]);

Route::name('app.')->middleware('auth')->group(function(){
    // Profile Route
    Route::get('profile', [ProfileController::class, 'showForm'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');

    Route::name('border.')->group(function(){
        // Bazaar Routes
        Route::prefix('bazaars')->name('bazaars.')->group(function(){
            Route::get('/', [BazaarController::class, 'index'])->name('index');
            Route::post('store', [BazaarController::class, 'store'])->name('store');
        });
    });

});


