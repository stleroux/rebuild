<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Movies\Movie;
use Carbon\Carbon;
use DB;

class MovieServiceProvider extends ServiceProvider
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
      view()->composer('movies.blocks.popular', function ($view) {
         $popular = Movie::published()
             // ->where('deleted_at', NULL)
             ->where('views', '>=', 10)
             ->orderBy('views', 'desc')
             ->take(setting('homepage_popular_count'))
             ->get();
         $view->with('popular', $popular);
      });

      view()->composer('admin.movies.blocks.archives', function ($view) {
         $archivesLinks = DB::table('movies')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) archivesLinks_count'))
            ->where('created_at', '<=', Carbon::now())
            ->where('deleted_at', NULL)
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('archivesLinks', $archivesLinks);
      });

      view()->composer('movies.blocks.archives', function ($view) {
         $archivesLinks = DB::table('movies')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) archivesLinks_count'))
            ->where('created_at', '<=', Carbon::now())
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
