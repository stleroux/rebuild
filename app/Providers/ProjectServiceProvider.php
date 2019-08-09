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
            $popularProjects = Project::where('views', '>=', 10)
                ->orderBy('views', 'desc')
                ->take(10)
                ->get();
            $view->with('popularProjects', $popularProjects);
        });
    }
}