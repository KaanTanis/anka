<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'], '/login', [LoginController::class, 'login'])
    ->middleware(['throttle:10:1'])
    ->name('login');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->group(function () {
    Route::view('/', 'admin.home')
        ->name('admin.home');

    // Pages
    Route::prefix('/')->group(function () {
        Route::get('/{type}', [PageController::class, 'index'])
            ->name('admin.pages.index');
        Route::post('/{type}/order', [PageController::class, 'order'])
            ->name('admin.pages.order');
        Route::get('/{type}/edit/{page?}', [PageController::class, 'edit'])
            ->name('admin.pages.edit');
        Route::post('/{type}/{page?}', [PageController::class, 'updateOrCreate'])
            ->name('admin.pages.updateOrCreate');
        Route::delete('/{type}/{page?}', [PageController::class, 'destroy'])
            ->name('admin.pages.destroy');
        Route::post('/{type}/destroy-image/{page?}/{imageId?}', [PageController::class, 'destroyImage'])
            ->name('admin.pages.destroyImage');
        Route::post('/{type}/destroy-single-image/{post?}/{field_name?}', [PageController::class, 'destroySingleImage'])
            ->name('admin.pages.destroySingleImage');

        Route::post('{type}/destroy-array/{post}/{field}/{arrayId}', [PageController::class, 'destroyArrayField'])
            ->name('admin.pages.destroyArrayFields');
    });
});
