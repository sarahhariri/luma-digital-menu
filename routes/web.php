<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CafeSettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ExtraController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MenuController::class, 'index'])
    ->name('home');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.submit');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('/logout', [AdminAuthController::class, 'logout'])
            ->name('logout');
        Route::resource('categories', CategoryController::class)
            ->except('show');
        Route::put('products/{product}/extras', [ProductController::class, 'syncExtras'])
            ->name('products.extras.sync');
        Route::resource('products', ProductController::class)
            ->except('show');
        Route::resource('products.sizes', ProductSizeController::class)->only(['store', 'update', 'destroy'])
            ->shallow();
        Route::resource('extras', ExtraController::class)
            ->except('show');

        Route::get('/cafe-settings', [CafeSettingController::class, 'edit'])
            ->name('cafe-settings.edit');

        Route::put('/cafe-settings', [CafeSettingController::class, 'update'])
            ->name('cafe-settings.update');
    });
});
