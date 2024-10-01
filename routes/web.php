<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Item\Controllers\ItemController;
use App\Modules\Role\Controllers\RoleController;
use App\Modules\User\Controllers\UserController;
use App\Modules\Profile\Controllers\ProfileController;
use App\Modules\Permission\Controllers\PermissionController;


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
        Route::group(['namespace' => 'App\Modules\Role\Controllers'], function () {

            Route::get('/role', [RoleController::class, 'index'])->name('role.index');
            Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
            Route::get('/role/edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
            Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
            Route::put('/role/store', [RoleController::class, 'update'])->name('role.update');
            Route::delete('/role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
            Route::get('/role/{role}/permissions', [RoleController::class, 'editPermissions'])->name('role.edit_permissions');
            Route::put('/role/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('role.update_permissions');
        });
        Route::group(['middleware' => ['auth', 'role:admin']], function () {
            Route::resource('permission', PermissionController::class);
        });
        Route::group(['middleware' => ['auth', 'role:admin']], function () {
            Route::resource('user', UserController::class);
        });
        Route::group(['middleware' => ['auth', 'role:admin']], function () {
            Route::get('/item', [itemController::class, 'index'])->name('item.index');
            Route::get('/item/create', [itemController::class, 'create'])->name('item.create');
            Route::get('/item/edit/{id}', [itemController::class, 'edit'])->name('item.edit');
            Route::delete('/item/destroy/{id}', [itemController::class, 'destroy'])->name('item.destroy');
            Route::post('/item/store', [itemController::class, 'store'])->name('item.store');
            Route::put('/item/store/{item}', [itemController::class, 'update'])->name('item.update');
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
