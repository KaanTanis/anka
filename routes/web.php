<?php

use App\Helper;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserPageController;
use App\Models\Room;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserPageController::class, 'home'])->name('user.home');
Route::get('/s/{page}/{title?}', [UserPageController::class, 'page'])->name('user.page');

Route::post('/send-contact-form', [EmailController::class, 'contactForm'])
    ->middleware(['throttle:sendmail'])
    ->name('sendContactForm');
















