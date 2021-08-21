<?php

namespace App\Providers;

use App\Helper;
use App\Models\Gallery;
use App\Models\Option;
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
        if (Schema::hasTable('options'))
            $options = new Option();

        View::share(['options' => $options ?? null]);
    }
}
