<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Projects\Project;

class ProjectServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('projects.blocks.popular', function ($view) {
            $popular = Project::where('views', '>=', 10)
                ->orderBy('views', 'desc')
                ->take(setting('homepage_popular_count'))
                ->get();
            $view->with('popular', $popular);
        });
    }
}