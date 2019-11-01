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
		view()->composer('recipes.blocks.popular', function ($view) {
			 $popular = Recipe::published()
					->public()
					->orderBy('views', 'desc')
					->orderBy('title')            
					->take(setting('homepage_favorite_recipe_count'))
					->get();
			 $view->with('popular', $popular);
		});

		view()->composer('recipes.blocks.archives', function ($view) {
			 $recipelinks = DB::table('recipes')
					->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
					->where('published_at', '<=', Carbon::now())
					// ->where('personal', '=', 0)
					->where('deleted_at', null)
					->groupBy('year')
					->groupBy('month')
					->orderBy('year', 'desc')
					->orderBy('month', 'desc')
					->get();
			 $view->with('recipelinks', $recipelinks);
		});
	}

}
