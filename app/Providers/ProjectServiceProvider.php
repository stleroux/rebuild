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
        view()->composer('projects.blocks.popularProjects', function ($view) {
            $popularProjects = Project::get()->sortByDesc('views')->take(10);
            $view->with('popularProjects', $popularProjects);
        });
    }
}