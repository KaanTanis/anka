<?php

namespace App\Providers;

use App\Helper;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*if (Schema::hasTable('pages'))
            $pages = Post::all();

        View::share(['pages' => $pages ?? null]);*/
    }
}
