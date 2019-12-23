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
             // ->where('deleted_at', NULL)
             ->where('views', '>=', 10)
             ->orderBy('views', 'desc')
             ->take(setting('homepage_popular_count'))
             ->get();
         $view->with('popular', $popular);
      });

      view()->composer('admin.articles.blocks.archives', function ($view) {
         $archivesLinks = DB::table('articles')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) archivesLinks_count'))
            ->where('published_at', '<=', Carbon::now())
            ->where('deleted_at', NULL)
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('archivesLinks', $archivesLinks);
      });

      view()->composer('articles.blocks.archives', function ($view) {
         $archivesLinks = DB::table('articles')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) archivesLinks_count'))
            ->where('published_at', '<=', Carbon::now())
            ->where('deleted_at', NULL)
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('archivesLinks', $archivesLinks);
      });
   }

}
