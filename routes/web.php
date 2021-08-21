<?php

use App\Helper;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserPageController;
use App\Models\Room;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserPageController::class, 'home'])->name('user.home');
Route::get('/projeler', [UserPageController::class, 'projects'])->name('user.projects');
Route::get('/proje/{post}/{title?}', [UserPageController::class, 'project'])->name('user.project');
Route::get('/s/{post}/{title?}', [UserPageController::class, 'page'])->name('user.page');
Route::get('/iletisim', [UserPageController::class, 'contact'])->name('user.contact');

Route::post('/send-contact-form', [EmailController::class, 'contactForm'])
    ->middleware(['throttle:sendmail']);

Route::post('/subscribe', [SubscribeController::class, 'subscribeForm'])
    ->middleware(['throttle:sendmail']);

/*Route::get('/test', function () {
   dd($options);
});*/
















