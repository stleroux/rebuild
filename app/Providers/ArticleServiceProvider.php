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
      view()->composer('articles.blocks.popular', function ($view) {
         $popular = Article::published()
             ->where('views', '>=', 10)
             ->orderBy('views', 'desc')
             ->take(setting('homepage_favorite_post_count'))
             ->get();
         $view->with('popular', $popular);
      });

      view()->composer('articles.blocks.archives', function ($view) {
         $links = DB::table('articles')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
            ->where('published_at', '<=', Carbon::now())
            //->where('created_at', '<=', Carbon::now()->subMonth(3))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('links', $links);
      });

      // Admin
      view()->composer('admin.articles.blocks.archives', function ($view) {
         $links = DB::table('articles')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
            ->where('published_at', '<=', Carbon::now())
            //->where('created_at', '<=', Carbon::now()->subMonth(3))
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('links', $links);
      });
   }

}
