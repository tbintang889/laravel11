<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Profile\Controllers\ProfileController;

Route::middleware('auth')->group(
    function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('dashboard');

        Route::get('/dashboard', function () {
            // return view('dashboard');
            return view('admin.index');
        })->middleware(['auth', 'verified'])->name('dashboard');


        Route::group(['namespace' => 'App\Modules\Profile\Controllers'], function () {
            // Route::get('/', 'UserController@index');
            // Route::get('/profile', 'UserController@profile');
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    }
);


Route::middleware('auth')->group(function () {

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', function () {
            echo 1;
        })->name('admin');
    });
});

require __DIR__ . '/auth.php';
