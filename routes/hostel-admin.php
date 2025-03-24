<?php

use App\Http\Controllers\Hostel\Admin\BillStatusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Hostel\Admin\HomeController;
use App\Http\Controllers\Hostel\Admin\UserController;


Route::name('app.hostel-admin.')->middleware('auth')->group(function(){
    // Dashboard Route
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

    // User Routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('create', [UserController::class, 'create'])->name('create');
        Route::post('store', [UserController::class, 'storeOrUpdate'])->name('store-or-update');
        Route::get('{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::post('delete', [UserController::class, 'delete'])->name('delete');
        Route::post('status', [UserController::class, 'changeStatus'])->name('status');
    }); 

    // Bill Status Routes
    Route::prefix('bill-statuses')->name('statuses.')->group(function () {
        Route::get('/', [BillStatusController::class, 'index'])->name('index');
        Route::post('store-or-update', [BillStatusController::class, 'storeOrUpdate'])->name('store-or-update');
        Route::get('edit', [BillStatusController::class, 'edit'])->name('edit');
    });

    // Profile Route
    Route::get('profile', [ProfileController::class, 'showForm'])->name('profile');
    Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');
    Route::post('password/update', [ProfileController::class, 'passwordUpdate'])->name('password.update');
});


Route::get('unauthorized',function(){
    return view('unauthorized');
});