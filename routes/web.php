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
















