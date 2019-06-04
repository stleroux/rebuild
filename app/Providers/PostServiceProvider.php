<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Post;

class PostServiceProvider extends ServiceProvider
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
        view()->composer('blog.blocks.popularPosts', function ($view) {
            $popularPosts = Post::published()->get()->sortByDesc('views')->take(setting('homepage_favorite_post_count'));
            $view->with('popularPosts', $popularPosts);
        });
    }
}
