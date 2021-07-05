<?php

use App\Http\Controllers\FeatureController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'], '/login', [LoginController::class, 'login'])->middleware(['throttle:10:1'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::view('/', 'admin.home')->name('admin.home');



    // Sliders
    Route::prefix('/sliders/')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('admin.sliders.index');
        Route::get('/edit/{slider?}', [SliderController::class, 'edit'])->name('admin.sliders.edit');
        Route::post('/{slider?}', [SliderController::class, 'updateOrCreate'])->name('admin.sliders.updateOrCreate');
        Route::delete('/{slider?}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');
    });


    // Pages
    Route::prefix('/')->group(function () {
        Route::get('/{type}', [PageController::class, 'index'])->name('admin.pages.index');
        Route::post('/{type}/order', [PageController::class, 'order'])->name('admin.pages.order');
        Route::get('/{type}/edit/{page?}', [PageController::class, 'edit'])->name('admin.pages.edit');
        Route::post('/{type}/{page?}', [PageController::class, 'updateOrCreate'])->name('admin.pages.updateOrCreate');
        Route::delete('/{type}/{page?}', [PageController::class, 'destroy'])->name('admin.pages.destroy');
        Route::post('/{type}/destroy-image/{page?}/{imageId?}', [PageController::class, 'destroyImage'])->name('admin.pages.destroyImage');
        Route::post('/{type}/destroy-single-image/{page?}/', [PageController::class, 'destroySingleImage'])->name('admin.pages.destroySingleImage');
    });
});
