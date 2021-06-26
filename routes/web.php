<?php

use App\Helper;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserPageController;
use App\Models\Room;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserPageController::class, 'home'])->name('user.home');



















