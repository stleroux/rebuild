<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Cache;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // cache settings for database table
        // https://stackoverflow.com/questions/32824781/laravel-load-settings-from-database
        Cache::forever('setting', Setting::all());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
