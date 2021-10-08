<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserPageController extends Controller
{
    public function home()
    {
        return view('front.home');
    }

    public function page(Post $post, $title)
    {
        return view('front.page', compact('post'));
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function products($cat_id, $title = null)
    {
        $category = Post::find($cat_id);
        if (! $title)
            return redirect()->route('products', ['cat_id' => $cat_id, 'title' => Str::slug($category->translate('title'))]);

        $products = Post::where('type', 'product')->where('fields->categories', $cat_id)->get();
        return view('front.products', compact('products', 'category'));
    }
}
