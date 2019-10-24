<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Articles\Article;
use Carbon\Carbon;
use DB;

class ArticleServiceProvider extends ServiceProvider
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
      // view()->composer('blog.blocks.popularPosts', function ($view) {
      //    $popularPosts = Post::published()
      //        ->where('views', '>=', 10)
      //        ->orderBy('views', 'desc')
      //        ->take(setting('homepage_favorite_article_count'))
      //        ->get();
      //    $view->with('popularPosts', $popularPosts);
      // });

      view()->composer('admin.articles.blocks.archives', function ($view) {
         $articlelinks = DB::table('articles')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
            ->where('published_at', '<=', Carbon::now())
            //->where('created_at', '<=', Carbon::now()->subMonth(3))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('articlelinks', $articlelinks);
      });

      view()->composer('articles.blocks.archives', function ($view) {
         $articlelinks = DB::table('articles')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
            ->where('published_at', '<=', Carbon::now())
            //->where('created_at', '<=', Carbon::now()->subMonth(3))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('articlelinks', $articlelinks);
      });
   }

}
