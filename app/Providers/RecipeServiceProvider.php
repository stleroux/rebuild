<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Recipes\Recipe;
use Carbon\Carbon;
use DB;

class RecipeServiceProvider extends ServiceProvider
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
      view()->composer('recipes.blocks.popularRecipes', function ($view) {
         $popularRecipes = Recipe::published()->public()->get()->sortBy('title')->sortByDesc('views')->take(setting('homepage_favorite_recipe_count'));
         $view->with('popularRecipes', $popularRecipes);
      });

      view()->composer('recipes.blocks.archives', function ($view) {
         $recipelinks = DB::table('recipes')
            ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
            ->where('published_at', '<=', Carbon::now())
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
         $view->with('recipelinks', $recipelinks);
      });
   }
}
