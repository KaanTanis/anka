<?php

use App\Http\Controllers\FeatureController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::match(['GET', 'POST'], '/login', function (Request $request) {
    if (request()->isMethod('get'))
        return view('admin.login');

    // todo: controller & validate, logout and change password

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();

        return redirect()->intended('admin.home');
    }

    return back()->withMessage(__('Kullanıcı adı veya şifre hatalı'));
})->name('login');

Route::middleware('auth')->group(function () {
    Route::view('/', 'admin.home')->name('admin.home');

    Route::prefix('/pages/')->group(function () {
        Route::get('/{type}', [PageController::class, 'index'])->name('admin.pages.index');
        Route::post('/{type}/order', [PageController::class, 'order'])->name('admin.pages.order');
        Route::get('/{type}/edit/{page?}', [PageController::class, 'edit'])->name('admin.pages.edit');
        Route::post('/{type}/{page?}', [PageController::class, 'updateOrCreate'])->name('admin.pages.updateOrCreate');
        Route::delete('/{type}/{page?}', [PageController::class, 'destroy'])->name('admin.pages.destroy');
        Route::post('/{type}/image-destroy/{page?}/{imageId?}', [PageController::class, 'destroyImage'])->name('admin.pages.destroyImage');
    });

    Route::prefix('/sliders/')->group(function () {
        Route::get('/', [SliderController::class, 'index'])->name('admin.sliders.index');
        Route::get('/edit/{slider?}', [SliderController::class, 'edit'])->name('admin.sliders.edit');
        Route::post('/{slider?}', [SliderController::class, 'updateOrCreate'])->name('admin.sliders.updateOrCreate');
        Route::delete('/{slider?}', [SliderController::class, 'destroy'])->name('admin.sliders.destroy');
    });
});
