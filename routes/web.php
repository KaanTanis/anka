<?php

use App\Helper;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserPageController;
use App\Models\Room;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::post('/send-contact-form', [EmailController::class, 'contactForm'])
    ->middleware(['throttle:sendmail']);

Route::post('/subscribe', [SubscribeController::class, 'subscribeForm'])
    ->middleware(['throttle:sendmail']);

Route::get('/locale/{lang}', function ($lang) {
    session()->put('lang', $lang);
    return back();
})->name('locale');

Route::get('/', [UserPageController::class, 'home']);
Route::get('/s/{post}/{title}', [UserPageController::class, 'page'])->name('user.page');

Route::get('test', function () {
    dd(\App\Helper::langDetails('en'));
});














