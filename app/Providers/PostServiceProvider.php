<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Posts\Post;
use Carbon\Carbon;
use DB;

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
         $popularPosts = Post::published()
             ->where('views', '>=', 10)
             ->orderBy('views', 'desc')
             ->take(setting('homepage_favorite_post_count'))
             ->get();
         $view->with('popularPosts', $popularPosts);
      });

      view()->composer('blog.blocks.archives', function ($view) {
         $postlinks = DB::table('posts')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) post_count'))
            ->where('published_at', '<=', Carbon::now())
            //->where('created_at', '<=', Carbon::now()->subMonth(3))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('postlinks', $postlinks);
      });
   }

}
