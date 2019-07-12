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
            // $popularPosts = Post::published()->get()->sortByDesc('views')->take(setting('homepage_favorite_post_count'));
            $popularProjects = Project::get()->sortByDesc('views')->take(10);
            // dd($popularProjects);
            $view->with('popularProjects', $popularProjects);
        });
    }
}