<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \Cache;
use DB;
use App\Models\Setting;
use Carbon\Carbon;
use App\Models\Recipes\Recipe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // cache settings for database table
        // https://stackoverflow.com/questions/32824781/laravel-load-settings-from-database
        Cache::forever('setting', Setting::all());

        view()->composer('blocks.popularRecipes', function ($view) {
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

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            // $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
            // $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
        }
    }
    
}
