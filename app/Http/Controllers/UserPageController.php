<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Room;
use Illuminate\Http\Request;

class UserPageController extends Controller
{
    public function home()
    {
        return view('front.home');
    }
}
