<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Tests\Test;
use Carbon\Carbon;
use DB;

class TestServiceProvider extends ServiceProvider
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
      view()->composer('tests.blocks.popular', function ($view) {
         $popular = Test::published()
             ->where('views', '>=', 10)
             ->orderBy('views', 'desc')
             ->take(setting('homepage_favorite_post_count'))
             ->get();
         $view->with('popular', $popular);
      });

      view()->composer('admin.tests.blocks.archives', function ($view) {
         $archivesLinks = DB::table('tests')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) archivesLinks_count'))
            ->where('published_at', '<=', Carbon::now())
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('archivesLinks', $archivesLinks);
      });

      view()->composer('tests.blocks.archives', function ($view) {
         $archivesLinks = DB::table('tests')
            ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) archivesLinks_count'))
            ->where('published_at', '<=', Carbon::now())
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('archivesLinks', $archivesLinks);
      });
   }

}
