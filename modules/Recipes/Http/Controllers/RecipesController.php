<?php

namespace Modules\Recipes\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller; // Required for validation
use Modules\Recipes\Entities\Recipe;
use Illuminate\Support\Facades\Input;

use App\Category;
use App\Comment;
use App\Module;
use App\User;
use Carbon\Carbon;
use Auth;
use DB;
use Excel;
use File;
use Image;
use JavaScript;
use Log;
use PDF;
use Purifier;
use Route;
use Session;
use Storage;
use Table;
use URL;

use Modules\Recipes\Http\Requests\CreateRecipeRequest;
use Modules\Recipes\Http\Requests\UpdateRecipeRequest;
use App\Http\Requests\CreateCommentRequest;

class RecipesController extends Controller
{

##################################################################################################################
#  ██████╗ ██████╗ ███╗   ██╗███████╗████████╗██████╗ ██╗   ██╗ ██████╗████████╗
# ██╔════╝██╔═══██╗████╗  ██║██╔════╝╚══██╔══╝██╔══██╗██║   ██║██╔════╝╚══██╔══╝
# ██║     ██║   ██║██╔██╗ ██║███████╗   ██║   ██████╔╝██║   ██║██║        ██║   
# ██║     ██║   ██║██║╚██╗██║╚════██║   ██║   ██╔══██╗██║   ██║██║        ██║   
# ╚██████╗╚██████╔╝██║ ╚████║███████║   ██║   ██║  ██║╚██████╔╝╚██████╗   ██║   
#  ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝  ╚═════╝   ╚═╝   
##################################################################################################################


##################################################################################################################
#  █████╗ ██████╗  ██████╗██╗  ██╗██╗██╗   ██╗███████╗
# ██╔══██╗██╔══██╗██╔════╝██║  ██║██║██║   ██║██╔════╝
# ███████║██████╔╝██║     ███████║██║██║   ██║█████╗  
# ██╔══██║██╔══██╗██║     ██╔══██║██║╚██╗ ██╔╝██╔══╝  
# ██║  ██║██║  ██║╚██████╗██║  ██║██║ ╚████╔╝ ███████╗
# ╚═╝  ╚═╝╚═╝  ╚═╝ ╚═════╝╚═╝  ╚═╝╚═╝  ╚═══╝  ╚══════╝
# Display the archived resources
##################################################################################################################
	public function archive($year, $month)
	{

      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'archive');

      // $categories = Category::where('module_id',3)->where('parent_id',0)->get();
      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

		$archives = Recipe::with('user', 'category')
         ->whereYear('published_at','=', $year)
			->whereMonth('published_at','=', $month)
			->where('published_at', '<=', Carbon::now())
         ->orderBy('title')
			->get();

      $popularRecipes = Recipe::published()->public()->get()->sortBy('title')->sortByDesc('views')->take(setting('homepage_favorite_recipe_count'));

		// Get list of recips by year and month
		$recipelinks = DB::table('recipes')
			->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
         ->where('published_at', '<=', Carbon::now())
         ->where('deleted_at', '=', null)
			->groupBy('year')
         ->groupBy('month')
         ->orderBy('year', 'desc')
         ->orderBy('month', 'desc')
         ->get();

		return view('recipes::frontend.archive', compact('archives','year','month','recipelinks','categories','popularRecipes'));
	}


##################################################################################################################
#  ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
# ██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
# ██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
# ██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
# ╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
#  ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
// Show the form for creating a new resource
##################################################################################################################
   public function create()
   {
      // if(!checkACL('author')) {
      //     return view('errors.403');
      // }

      // // find all categories in the categories table and pass them to the view
      // $categories = Category::whereHas('module', function ($query) {
      //    $query->where('name', '=', 'recipes');
      // })->orderBy('name','asc')->get();

      // // Create an empty array to store the categories
      // $cats = [];
      // // Store the category values into the $cats array
      // foreach ($categories as $category) {
      //    $cats[$category->id] = $category->name;
      // }
      // $categories = Category::where('module_id',3)->where('parent_id',0)->get();
      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

      // return view('recipes::backend.create')->withCategories($cats);
      return view('recipes::backend.create', compact('categories'));
   }


##################################################################################################################
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
// 
##################################################################################################################
   public function delete($id)
   {
      // Check if user has required permission
      // if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

      $recipe = Recipe::onlyTrashed()->findOrFail($id);
      // dd($recipe);

      // Session::put('pageName', 'trashed');

      return view('recipes::backend.delete', compact('recipe'));
   }


##################################################################################################################
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗     █████╗ ██╗     ██╗     
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝    ██╔══██╗██║     ██║     
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗      ███████║██║     ██║     
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝      ██╔══██║██║     ██║     
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗    ██║  ██║███████╗███████╗
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝╚══════╝
// Mass Delete selected rows - all selected records
##################################################################################################################
   public function deleteAll(Request $request)
   {
      // Set the variable so we can use a button in other pages to come back to this page
      // Session::put('pageName', '');

      //dd('TEST_DELETE');
      $this->validate($request, [
         'checked' => 'required',
      ]);
      //dd('TEST_DELETE');

      $checked = $request->input('checked');
      //dd($checked);

      // $article = Article::withTrashed()->findOrFail($checked);
      //Article::destroy($checked);
      Recipe::whereIn('id', $checked)->forceDelete();

      Session::flash('success','The recipes were deleted successfully.');
      return redirect()->route($ref);
   }


##################################################################################################################
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗    ██████╗ ███████╗███████╗████████╗██████╗  ██████╗ ██╗   ██╗
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔══██╗██╔═══██╗╚██╗ ██╔╝
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗      ██║  ██║█████╗  ███████╗   ██║   ██████╔╝██║   ██║ ╚████╔╝ 
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝      ██║  ██║██╔══╝  ╚════██║   ██║   ██╔══██╗██║   ██║  ╚██╔╝  
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗    ██████╔╝███████╗███████║   ██║   ██║  ██║╚██████╔╝   ██║   
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝    ╚═════╝ ╚══════╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝    ╚═╝  
// Remove the specified resource from storage
// Used in the index page and trashAll action to soft delete multiple records
##################################################################################################################
   public function deleteDestroy($id)
   {
      // Check if user has required permission
      // if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

      $recipe = Recipe::withTrashed()->findOrFail($id);

      // remove any references to this post from the post_tag table
      // $post->tags()->detach();

      // Delete the associated image if any
      File::delete('_recipes/' . $recipe->image);

      $recipe->forceDelete();

      // Save entry to log file using built-in Monolog
      // Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED post (" . $post->id . ")\r\n", 
      //    [json_decode($post, true)]
      // );

      Session::flash('success', 'The recipe was successfully deleted!');
      return redirect()->route('recipes.trashed');
   }


##################################################################################################################
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗    ████████╗██████╗  █████╗ ███████╗██╗  ██╗███████╗██████╗ 
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝    ╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██║  ██║██╔════╝██╔══██╗
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗         ██║   ██████╔╝███████║███████╗███████║█████╗  ██║  ██║
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝         ██║   ██╔══██╗██╔══██║╚════██║██╔══██║██╔══╝  ██║  ██║
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗       ██║   ██║  ██║██║  ██║███████║██║  ██║███████╗██████╔╝
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝       ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝ 
// Permanently remove the specified resource from storage - individual record
##################################################################################################################
   // public static function deleteTrashed($id)
   // {
   //    // if(!checkACL('manager')) {
   //       // return view('errors.403');
   //    // }
   //    //dd($id);
   //    $recipe = Recipe::withTrashed()->findOrFail($id);
   //    $recipe->forceDelete();

   //    Session::flash ('success','The recipe was deleted successfully.');
   //    return redirect()->route('recipes.trashed');
   // }


##################################################################################################################
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗    ██████╗ ███████╗███████╗████████╗██████╗  ██████╗ ██╗   ██╗
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔══██╗██╔═══██╗╚██╗ ██╔╝
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗      ██║  ██║█████╗  ███████╗   ██║   ██████╔╝██║   ██║ ╚████╔╝ 
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝      ██║  ██║██╔══╝  ╚════██║   ██║   ██╔══██╗██║   ██║  ╚██╔╝  
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗    ██████╔╝███████╗███████║   ██║   ██║  ██║╚██████╔╝   ██║   
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝    ╚═════╝ ╚══════╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝    ╚═╝  
// Remove the specified resource from storage
// Used in the index page and trashAll action to soft delete multiple records
##################################################################################################################
   // public function deleteDestroy($id)
   // {
   //    // if(!checkACL('author')) {
   //    //     return view('errors.403');
   //    // }

   //    // Set the variable so we can use a button in other pages to come back to this page
   //    // Session::put('pageName', '');

   //    $recipe = Recipe::withTrashed()->findOrFail($id);
   //    $recipe->forceDelete();

   //    // Save entry to log file using built-in Monolog
   //    //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED article (" . $article->id . ")\r\n",
   //    //    [json_decode($article, true)]
   //    //);

   //    Session::flash('success','The recipe was deleted successfully.');
   //    return redirect()->route('recipes.trashed');
   // }


##################################################################################################################
# ██████╗  ██████╗ ██╗    ██╗███╗   ██╗██╗      ██████╗  █████╗ ██████╗     ███████╗██╗  ██╗ ██████╗███████╗██╗     
# ██╔══██╗██╔═══██╗██║    ██║████╗  ██║██║     ██╔═══██╗██╔══██╗██╔══██╗    ██╔════╝╚██╗██╔╝██╔════╝██╔════╝██║     
# ██║  ██║██║   ██║██║ █╗ ██║██╔██╗ ██║██║     ██║   ██║███████║██║  ██║    █████╗   ╚███╔╝ ██║     █████╗  ██║     
# ██║  ██║██║   ██║██║███╗██║██║╚██╗██║██║     ██║   ██║██╔══██║██║  ██║    ██╔══╝   ██╔██╗ ██║     ██╔══╝  ██║     
# ██████╔╝╚██████╔╝╚███╔███╔╝██║ ╚████║███████╗╚██████╔╝██║  ██║██████╔╝    ███████╗██╔╝ ██╗╚██████╗███████╗███████╗
# ╚═════╝  ╚═════╝  ╚══╝╚══╝ ╚═╝  ╚═══╝╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚═════╝     ╚══════╝╚═╝  ╚═╝ ╚═════╝╚══════╝╚══════╝
##################################################################################################################
   public function downloadExcel($type)
   {
      // if(!checkACL('manager')) {
      //   // Save entry to log file of failure
      //   Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Articles / Download");
      //   return view('errors.403');
      // }

      // $referrer = request()->headers->get('referer');
      // //dd($referrer);
      // if ($referrer == 'http://localhost:8000/recipes/myRecipes') {
      //    $data = Recipe::myRecipes()->get()->toArray();
      // // } elseif ($referrer == 'http://localhost:8000/backend/articles'){
      // //     $data = Article::get()->toArray();
      // } else {
      //    $data = Recipe::get()->toArray();
      // }
      if(!checkACL('manager')) {
         return view('errors.403');
      }

      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'recipes.index') {
            $data = Recipe::published()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'recipes.newRecipes') {
            $data = Recipe::newRecipes()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'recipes.myRecipes') {
            $data = Recipe::myRecipes()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'recipes.unpublished') {
            $data = Recipe::unpublished()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'recipes.future') {
            $data = Recipe::future()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'recipes.trashed') {
            $data = Recipe::trashedCount()->get()->toArray();
      }

      // Save entry to log file of failure
      //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") downloaded :: articles");

      return Excel::create('Recipes_List', function($excel) use ($data) {
         $excel->sheet('mySheet', function($sheet) use ($data)
         {
            $sheet->fromArray($data);
         });
      })->download($type);
   }


##################################################################################################################
# ██████╗ ██╗   ██╗██████╗ ██╗     ██╗ ██████╗ █████╗ ████████╗███████╗
# ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██╔══██╗╚══██╔══╝██╔════╝
# ██║  ██║██║   ██║██████╔╝██║     ██║██║     ███████║   ██║   █████╗  
# ██║  ██║██║   ██║██╔═══╝ ██║     ██║██║     ██╔══██║   ██║   ██╔══╝  
# ██████╔╝╚██████╔╝██║     ███████╗██║╚██████╗██║  ██║   ██║   ███████╗
# ╚═════╝  ╚═════╝ ╚═╝     ╚══════╝╚═╝ ╚═════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
// DUPLICATE :: Duplicate the specified resource in storage.
##################################################################################################################
   public function duplicate($id)
   {
      //if(!checkACL('manager')) {
      //  // Save entry to log file of failure
      //  Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Articles / Duplicate");
      //  return view('errors.403');
      //}

      // Set the variable so we can use a button in other pages to come back to this page
      // Session::put('pageName', '');

      $recipe = Recipe::find($id);
        $newRecipe = $recipe->replicate();
        $newRecipe->user_id = Auth::user()->id;
      $newRecipe->save();

      // change the user_id field to be that of the user that is currently logged in
      
      //$newArticle->views = 0;
      //$newArticle->save();

      // Save entry to log file using built-in Monolog
      //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") duplicated :: article " . $article->id . " to article ". $newArticle->id);

      Session::flash ('success','The recipe was duplicated successfully!');
      return redirect()->route($ref);
   }


##################################################################################################################
# ███████╗██████╗ ██╗████████╗
# ██╔════╝██╔══██╗██║╚══██╔══╝
# █████╗  ██║  ██║██║   ██║   
# ██╔══╝  ██║  ██║██║   ██║   
# ███████╗██████╔╝██║   ██║   
# ╚══════╝╚═════╝ ╚═╝   ╚═╝   
// Show the form for editing the specified resource
##################################################################################################################
   public function edit($id)
   {
      // if(!checkACL('author')) {
      //     return view('errors.403');
      // }

      // Find the article to edit
      $recipe = Recipe::findOrFail($id);

      // find all categories in the categories table and pass them to the view
      // $categories = Category::whereHas('module', function ($query) {
      //    $query->where('name', '=', 'recipes');
      // })->get();

      // // Create an empty array to store the categories
      // $cats = [];
      // // Store the category values into the $cats array
      // foreach ($categories as $category) {
      //    $cats[$category->id] = $category->name;
      // }

      // $categories = Category::where('parent_id',1)->pluck('id','name');
      $categories = Category::with('children')->where('parent_id',1)->get();
      // dd($categories);

      return view('recipes::backend.edit', compact('recipe','categories'));
   }


##################################################################################################################
# ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗     █████╗ ██████╗ ██████╗ 
# ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝    ██╔══██╗██╔══██╗██╔══██╗
# █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗      ███████║██║  ██║██║  ██║
# ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝      ██╔══██║██║  ██║██║  ██║
# ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗    ██║  ██║██████╔╝██████╔╝
# ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚═════╝ ╚═════╝ 
##################################################################################################################
   public function favoriteAdd($id)
   {
      $recipe = Recipe::find($id);
      $recipe->addFavorite();

      Session::flash ('success','The recipe was successfully added to your Favorites list!');
      //return redirect()->route('recipes.myFavorites','all');
      // return redirect()->route('recipes.show', $id);
      return redirect()->route('recipes.'. Session::get('pageName'));
   }


##################################################################################################################
# ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗    ██████╗ ███████╗███╗   ███╗ ██████╗ ██╗   ██╗███████╗
# ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝████╗ ████║██╔═══██╗██║   ██║██╔════╝
# █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗      ██████╔╝█████╗  ██╔████╔██║██║   ██║██║   ██║█████╗  
# ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝      ██╔══██╗██╔══╝  ██║╚██╔╝██║██║   ██║╚██╗ ██╔╝██╔══╝  
# ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗    ██║  ██║███████╗██║ ╚═╝ ██║╚██████╔╝ ╚████╔╝ ███████╗
# ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝╚═╝     ╚═╝ ╚═════╝   ╚═══╝  ╚══════╝
##################################################################################################################
   public function favoriteRemove($id)
   {
      // $user = Auth::user()->id;
      // $recipe = Recipe::find($id);

      // $recipe->favorites()->detach($user);

      $recipe = Recipe::find($id);
      $recipe->removeFavorite();

      Session::flash ('success','The recipe was successfully removed to your Favorites list!');
      // return redirect()->route('recipes.index','all');
      //return redirect()->route('recipes.myFavorites','all');
      // return redirect()->route('recipes.show', $id);
      return redirect()->route('recipes.'. Session::get('pageName'));
   }


##################################################################################################################
# ███████╗██╗   ██╗████████╗██╗   ██╗██████╗ ███████╗
# ██╔════╝██║   ██║╚══██╔══╝██║   ██║██╔══██╗██╔════╝
# █████╗  ██║   ██║   ██║   ██║   ██║██████╔╝█████╗  
# ██╔══╝  ██║   ██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ██║     ╚██████╔╝   ██║   ╚██████╔╝██║  ██║███████╗
# ╚═╝      ╚═════╝    ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// Display a list of resources that will be published at a later date
##################################################################################################################
   public function future(Request $request, $key=null)
   {
      // if(!checkACL('guest')) {
      //     return view('errors.403');
      // }

      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'future');

      //$alphas = range('A', 'Z');
      $alphas = DB::table('recipes')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         // ->where('personal', '!=', 1)
         ->where('published_at','>', Carbon::Now())
         ->orderBy('letter')
         ->get();
         //dd($alphas);

      $letters = [];
      foreach($alphas as $alpha) {
         $letters[] = $alpha->letter;
      }

      // If $key value is passed
      if ($key) {
         $recipes = Recipe::with('user','category')
            ->future()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
      } else {
         // No $key value is passed
         $recipes = Recipe::with('user','category')
            ->future()
            ->get();
      }

      return view('recipes::backend.future', compact('recipes','letters'));
   }


##################################################################################################################
# ██╗███╗   ███╗██████╗  ██████╗ ██████╗ ████████╗
# ██║████╗ ████║██╔══██╗██╔═══██╗██╔══██╗╚══██╔══╝
# ██║██╔████╔██║██████╔╝██║   ██║██████╔╝   ██║   
# ██║██║╚██╔╝██║██╔═══╝ ██║   ██║██╔══██╗   ██║   
# ██║██║ ╚═╝ ██║██║     ╚██████╔╝██║  ██║   ██║   
# ╚═╝╚═╝     ╚═╝╚═╝      ╚═════╝ ╚═╝  ╚═╝   ╚═╝   
// IMPORT :: Show the form for importing entries to storage.
##################################################################################################################
   public function import()
   {
      // if(!checkACL('manager')) {
      //   // Save entry to log file of failure
      //   Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Articles / Import");
      //   return view('errors.403');
      // }

      // Save entry to log file of failure
      //Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") accessed :: Articles / Import");

      return view('recipes.import');
   }


##################################################################################################################
# ██╗███╗   ███╗██████╗  ██████╗ ██████╗ ████████╗    ███████╗██╗   ██╗███╗   ██╗ ██████╗████████╗██╗ ██████╗ ███╗   ██╗
# ██║████╗ ████║██╔══██╗██╔═══██╗██╔══██╗╚══██╔══╝    ██╔════╝██║   ██║████╗  ██║██╔════╝╚══██╔══╝██║██╔═══██╗████╗  ██║
# ██║██╔████╔██║██████╔╝██║   ██║██████╔╝   ██║       █████╗  ██║   ██║██╔██╗ ██║██║        ██║   ██║██║   ██║██╔██╗ ██║
# ██║██║╚██╔╝██║██╔═══╝ ██║   ██║██╔══██╗   ██║       ██╔══╝  ██║   ██║██║╚██╗██║██║        ██║   ██║██║   ██║██║╚██╗██║
# ██║██║ ╚═╝ ██║██║     ╚██████╔╝██║  ██║   ██║       ██║     ╚██████╔╝██║ ╚████║╚██████╗   ██║   ██║╚██████╔╝██║ ╚████║
# ╚═╝╚═╝     ╚═╝╚═╝      ╚═════╝ ╚═╝  ╚═╝   ╚═╝       ╚═╝      ╚═════╝ ╚═╝  ╚═══╝ ╚═════╝   ╚═╝   ╚═╝ ╚═════╝ ╚═╝  ╚═══╝
##################################################################################################################
   public function importExcel()
   {
      // if(!checkACL('manager')) {
      //   // Save entry to log file of failure
      //   Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") tried to access :: Admin / Articles / Import");
      //   return view('errors.403');
      // }

      if(Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
         })->get();

         if(!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
               $insert[] = [
                  'user_id'            => $value->user_id,
                  'category_id'        => $value->category_id,
                  'title'              => $value->title,            
                  'description_eng'    => $value->description_eng,
                  'description_fre'    => $value->description_fre,
                  'views'              =>  0,
                  'deleted_at'         => $value->deleted_at,
                  'published_at'       => $value->published_at,
                  'created_at'         => $value->created_at,
                  'updated_at'         => $value->updated_at,
               ];
            }

            if(!empty($insert)) {
               DB::table('articles')->insert($insert);

               // Save entry to log file of failure
               //Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") imported :: articles");

               Session::flash('success', $data->count() . ' articles imported successfully!');
               return redirect()->route('articles.index');
            }
         }
      }
      return back();
   }


##################################################################################################################
# ██╗███╗   ██╗██████╗ ███████╗██╗  ██╗
# ██║████╗  ██║██╔══██╗██╔════╝╚██╗██╔╝
# ██║██╔██╗ ██║██║  ██║█████╗   ╚███╔╝ 
# ██║██║╚██╗██║██║  ██║██╔══╝   ██╔██╗ 
# ██║██║ ╚████║██████╔╝███████╗██╔╝ ██╗
# ╚═╝╚═╝  ╚═══╝╚═════╝ ╚══════╝╚═╝  ╚═╝
// Display a list of resources
##################################################################################################################
   public function index(Request $request)
   {
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'index');

      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

      // Get the popular recipes
      $popularRecipes = Recipe::published()->public()->get()->sortBy('title')->sortByDesc('views')->take(setting('homepage_favorite_recipe_count'));

      // Get list of recips by year and month
      $recipelinks = DB::table('recipes')
         ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
         ->where('published_at', '<=', Carbon::now())
         ->groupBy('year')->groupBy('month')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

      $byCatName = Category::where('name', $request->cat)->first();

      if($request->cat == 'all'){
         $alphas = DB::table('recipes')
            ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
            ->where('published_at', '<=', Carbon::now())
            ->where('deleted_at', '=', null)
            ->where('personal', '=', 0)
            ->orderBy('letter')
            ->get();

         // echo "All recipes";
         $recipes = Recipe::with('user','category')
            ->published()
            ->public()
            ->orderBy('title', 'asc')
            ->paginate(18);

         if($request->key){
            // echo " and grouped by " .$request->key;
            $recipes = Recipe::with('user','category')
               ->published()
               ->public()
               ->where('title', 'like', $request->key . '%')
               ->orderBy('title', 'asc')
               ->paginate(18);
         }
      } else {
         // echo "Recipes categorized by " .$request->cat;
         if($byCatName->parent_id != 1) {
            $alphas = DB::table('recipes')
               ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
               ->where('published_at', '<=', Carbon::now())
               ->where('deleted_at', '=', null)
               ->where('personal', '=', 0)
               ->where('category_id', '=', $byCatName->id)
               ->orderBy('letter')
               ->get();

            $recipes = Recipe::with('user','category')
               ->published()
               ->public()
               ->where('category_id', '=', $byCatName->id)
               ->orderBy('title', 'asc')
               ->paginate(18);

            if($request->key){
               // echo " and grouped by " .$request->key;
               $recipes = Recipe::with('user','category')
                  ->published()
                  ->public()
                  ->where('category_id', '=', $byCatName->id)
                  ->where('title', 'like', $request->key . '%')
                  ->orderBy('title', 'asc')
                  ->paginate(18);
            }
         } else {
            $allc = Category::where('parent_id', $byCatName->id)->pluck('id');
            
            $alphas = DB::table('recipes')
               ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
               ->where('published_at', '<=', Carbon::now())
               ->where('deleted_at', '=', null)
               ->where('personal', '=', 0)
               ->whereIn('category_id', $allc)
               ->orderBy('letter')
               ->get();

            $recipes = Recipe::with('user','category')
               ->published()
               ->public()
               ->whereIn('category_id', $allc)
               ->orderBy('title', 'asc')
               ->paginate(18);

            if($request->key){
               // echo " and grouped by " .$request->key;
               $recipes = Recipe::with('user','category')
                  ->published()
                  ->public()
                  ->whereIn('category_id', $allc)
                  ->where('title', 'like', $request->key . '%')
                  ->orderBy('title', 'asc')
                  ->paginate(18);
            }
         }
      }

      $letters = [];
      foreach($alphas as $alpha) {
         $letters[] = $alpha->letter;
      }
      
      return view('recipes::frontend.index', compact('recipes','categories','popularRecipes','recipelinks','letters'));
   }


##################################################################################################################
# ███╗   ███╗ █████╗ ██╗  ██╗███████╗    ██████╗ ██████╗ ██╗██╗   ██╗ █████╗ ████████╗███████╗
# ████╗ ████║██╔══██╗██║ ██╔╝██╔════╝    ██╔══██╗██╔══██╗██║██║   ██║██╔══██╗╚══██╔══╝██╔════╝
# ██╔████╔██║███████║█████╔╝ █████╗      ██████╔╝██████╔╝██║██║   ██║███████║   ██║   █████╗  
# ██║╚██╔╝██║██╔══██║██╔═██╗ ██╔══╝      ██╔═══╝ ██╔══██╗██║╚██╗ ██╔╝██╔══██║   ██║   ██╔══╝  
# ██║ ╚═╝ ██║██║  ██║██║  ██╗███████╗    ██║     ██║  ██║██║ ╚████╔╝ ██║  ██║   ██║   ███████╗
# ╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝    ╚═╝     ╚═╝  ╚═╝╚═╝  ╚═══╝  ╚═╝  ╚═╝   ╚═╝   ╚══════╝
##################################################################################################################
   public function makePrivate($id)
   {
      $recipe = Recipe::find($id);
         $recipe->personal = 1;
      $recipe->save();

      // Save entry to log file using built-in Monolog
      //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") MADE recipe (" . $recipe->id . ") PRIVATE \r\n", [json_decode($recipe, true)]);

      // Delete this recipe's favorites
      DB::table('favorites')->where('favoriteable_id', '=', $id)->delete();

      Session::flash('success','The recipe was successfully made private');
      // return redirect()->route('recipes.'. Session::get('pageName'));
      return redirect()->back();

   }


##################################################################################################################
# ███╗   ███╗ █████╗ ██╗  ██╗███████╗    ██████╗ ██╗   ██╗██████╗ ██╗     ██╗ ██████╗
# ████╗ ████║██╔══██╗██║ ██╔╝██╔════╝    ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝
# ██╔████╔██║███████║█████╔╝ █████╗      ██████╔╝██║   ██║██████╔╝██║     ██║██║     
# ██║╚██╔╝██║██╔══██║██╔═██╗ ██╔══╝      ██╔═══╝ ██║   ██║██╔══██╗██║     ██║██║     
# ██║ ╚═╝ ██║██║  ██║██║  ██╗███████╗    ██║     ╚██████╔╝██████╔╝███████╗██║╚██████╗
# ╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝    ╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝ ╚═════╝
##################################################################################################################
   public function makePublic($id)
   {
      $recipe = Recipe::find($id);
         $recipe->personal = 0;
      $recipe->save();

      // Save entry to log file using built-in Monolog
      //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") REMOVE PRIVATE from recipe (" . $recipe->id . ")\r\n", 
      //    [json_decode($recipe, true)]
      //);

      Session::flash('success','The recipe was successfully made public');
      
      // f(Session::get('pageName') != 'show') {
      //    return redirect()->route('recipes.'. Session::get('pageName'), $id);
      // }

      // return redirect()->route('recipes.'. Session::get('pageName'));
      return redirect()->back();
   }


##################################################################################################################
# ███╗   ███╗██╗   ██╗    ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗███████╗
# ████╗ ████║╚██╗ ██╔╝    ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝██╔════╝
# ██╔████╔██║ ╚████╔╝     █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗  ███████╗
# ██║╚██╔╝██║  ╚██╔╝      ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝  ╚════██║
# ██║ ╚═╝ ██║   ██║       ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗███████║
# ╚═╝     ╚═╝   ╚═╝       ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝╚══════╝
// MY FAVORITES :: Display a listing of the resource that have been favorited by a specific user.
##################################################################################################################
	public function myFavorites(Request $request, $key=null)
	{
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'myFavorites');

      // Get list of recips by year and month
      $recipelinks = DB::table('recipes')
         ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
         ->where('published_at', '<=', Carbon::now())
         ->groupBy('year')->groupBy('month')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

      if(Auth::check()) {
         $user = Auth::user();
         $recipes = $user->favorite(Recipe::class)->sortBy('title');
      }

      $popularRecipes = Recipe::published()->public()->get()->sortBy('title')->sortByDesc('views')->take(setting('homepage_favorite_recipe_count'));

      return view('recipes::frontend.myFavorites', compact('recipes','recipelinks','popularRecipes'));
	}


##################################################################################################################
# ███╗   ███╗██╗   ██╗    ██████╗ ███████╗ ██████╗██╗██████╗ ███████╗███████╗
# ████╗ ████║╚██╗ ██╔╝    ██╔══██╗██╔════╝██╔════╝██║██╔══██╗██╔════╝██╔════╝
# ██╔████╔██║ ╚████╔╝     ██████╔╝█████╗  ██║     ██║██████╔╝█████╗  ███████╗
# ██║╚██╔╝██║  ╚██╔╝      ██╔══██╗██╔══╝  ██║     ██║██╔═══╝ ██╔══╝  ╚════██║
# ██║ ╚═╝ ██║   ██║       ██║  ██║███████╗╚██████╗██║██║     ███████╗███████║
# ╚═╝     ╚═╝   ╚═╝       ╚═╝  ╚═╝╚══════╝ ╚═════╝╚═╝╚═╝     ╚══════╝╚══════╝
// Display a listing of the resource that belong to a specific user.
##################################################################################################################
	public function myRecipes($key=null)
	{
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'myRecipes');

		if (Auth::check()) {
         // Get list of recips by year and month
         $recipelinks = DB::table('recipes')
            ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
            ->where('published_at', '<=', Carbon::now())
            ->groupBy('year')->groupBy('month')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

			$alphas = DB::table('recipes')
				->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
				->where('user_id','=', Auth::user()->id)
				// ->where('published_at', '<', Carbon::now())
				->orderBy('letter')
				->get();
			//dd($alphas);

			$letters = [];
			foreach($alphas as $alpha) {
				$letters[] = $alpha->letter;
			}

			// If $key value is passed
			if ($key) {
				$recipes = Recipe::with('user','category')
               ->myRecipes()
					->where('title', 'like', $key . '%')
					->orderBy('title', 'asc')
					->paginate(18);
			} else {
            // No $key value is passed
            $recipes = Recipe::with('user','category')
               ->myRecipes()
               ->orderBy('title', 'asc')
               ->paginate(18);
         }

			return view('recipes::backend.myRecipes', compact('recipes','letters', 'recipelinks'));
		} else {
         return ('You need to be logged in');
      }
	}


##################################################################################################################
# ███╗   ███╗██╗   ██╗    ██████╗ ██████╗ ██╗██╗   ██╗ █████╗ ████████╗███████╗    ██████╗ ███████╗ ██████╗██╗██████╗ ███████╗███████╗
# ████╗ ████║╚██╗ ██╔╝    ██╔══██╗██╔══██╗██║██║   ██║██╔══██╗╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝██╔════╝██║██╔══██╗██╔════╝██╔════╝
# ██╔████╔██║ ╚████╔╝     ██████╔╝██████╔╝██║██║   ██║███████║   ██║   █████╗      ██████╔╝█████╗  ██║     ██║██████╔╝█████╗  ███████╗
# ██║╚██╔╝██║  ╚██╔╝      ██╔═══╝ ██╔══██╗██║╚██╗ ██╔╝██╔══██║   ██║   ██╔══╝      ██╔══██╗██╔══╝  ██║     ██║██╔═══╝ ██╔══╝  ╚════██║
# ██║ ╚═╝ ██║   ██║       ██║     ██║  ██║██║ ╚████╔╝ ██║  ██║   ██║   ███████╗    ██║  ██║███████╗╚██████╗██║██║     ███████╗███████║
# ╚═╝     ╚═╝   ╚═╝       ╚═╝     ╚═╝  ╚═╝╚═╝  ╚═══╝  ╚═╝  ╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝ ╚═════╝╚═╝╚═╝     ╚══════╝╚══════╝
// Display a listing of the resource that belong to a specific user.
##################################################################################################################
   public function myPrivateRecipes($key=null)
   {
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'myPrivateRecipes');

      if (Auth::check()) {
         // Get list of recips by year and month
         $recipelinks = DB::table('recipes')
            ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
            ->where('published_at', '<=', Carbon::now())
            ->where('personal', '=', 1)
            // ->private()
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

         $alphas = DB::table('recipes')
            ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
            ->where('user_id','=', Auth::user()->id)
            // ->where('published_at', '<', Carbon::now())
            ->where('personal', '=', 1)
            // ->private()
            ->orderBy('letter')
            ->get();
         //dd($alphas);

         $letters = [];
         foreach($alphas as $alpha) {
            $letters[] = $alpha->letter;
         }

         // If $key value is passed
         if ($key) {
            $recipes = Recipe::with('user','category')
               ->myRecipes()
               ->private()
               ->where('title', 'like', $key . '%')
               ->orderBy('title', 'asc')
               ->paginate(18);
         } else {
            // No $key value is passed
            $recipes = Recipe::with('user','category')
               ->myRecipes()
               ->private()
               ->orderBy('title', 'asc')
               ->paginate(18);
         }

         return view('recipes::backend.myPrivateRecipes', compact('recipes','letters', 'recipelinks'));
      } else {
         return ('You need to be logged in');
      }
   }


##################################################################################################################
# ███╗   ██╗███████╗██╗    ██╗    ██████╗ ███████╗ ██████╗██╗██████╗ ███████╗███████╗
# ████╗  ██║██╔════╝██║    ██║    ██╔══██╗██╔════╝██╔════╝██║██╔══██╗██╔════╝██╔════╝
# ██╔██╗ ██║█████╗  ██║ █╗ ██║    ██████╔╝█████╗  ██║     ██║██████╔╝█████╗  ███████╗
# ██║╚██╗██║██╔══╝  ██║███╗██║    ██╔══██╗██╔══╝  ██║     ██║██╔═══╝ ██╔══╝  ╚════██║
# ██║ ╚████║███████╗╚███╔███╔╝    ██║  ██║███████╗╚██████╗██║██║     ███████╗███████║
# ╚═╝  ╚═══╝╚══════╝ ╚══╝╚══╝     ╚═╝  ╚═╝╚══════╝ ╚═════╝╚═╝╚═╝     ╚══════╝╚══════╝
// Display a listing of the resource that were created since the user's last login.
##################################################################################################################
   public function newRecipes(Request $request, $key=null)
   {
      // if(!checkACL('author')) {
      //     return view('errors.403');
      // }

      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'newRecipes');

      //$alphas = range('A', 'Z');
      $alphas = DB::table('recipes')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         ->where('created_at', '>=' , Auth::user()->last_login_date)
         //->where('user_id', '=', Auth::user()->id)
         // ->where('personal', '!=', 1)
         // ->where('published_at','!=', null)
         ->orderBy('letter')
         ->get();
      //dd($alphas);

      $letters = [];
      foreach($alphas as $alpha) {
        $letters[] = $alpha->letter;
      }

      // If $key value is passed
      if ($key) {
         $recipes = Recipe::with('user','category')
            ->newRecipes()
            ->where('title', 'like', $key . '%')
            ->paginate(18);
      } else {
         $recipes = Recipe::with('user','category')
            ->newRecipes()
            ->paginate(18);
      }

      return view('recipes::backend.newRecipes', compact('recipes','letters'));
   }


##################################################################################################################
# ██████╗ ██████╗ ███████╗    ██╗   ██╗██╗███████╗██╗    ██╗
# ██╔══██╗██╔══██╗██╔════╝    ██║   ██║██║██╔════╝██║    ██║
# ██████╔╝██║  ██║█████╗      ██║   ██║██║█████╗  ██║ █╗ ██║
# ██╔═══╝ ██║  ██║██╔══╝      ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║
# ██║     ██████╔╝██║          ╚████╔╝ ██║███████╗╚███╔███╔╝
# ╚═╝     ╚═════╝ ╚═╝           ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ 
// 
##################################################################################################################
   // public function exportPDF()
   // {
   //   // if(!checkACL('manager')) {
   //   //   return view('errors.403');
   //   // }

   //   $data = Article::get()->toArray();
   //   return Excel::create('Articles_List', function($excel) use ($data) {
   //     $excel->sheet('mySheet', function($sheet) use ($data)
   //     {
   //       $sheet->fromArray($data);
   //     });
   //   })->download("pdf");
   // }

   // public function downloadPDF()
   // {
   //   $pdf = PDF::loadView('articles.pdfView');
   //   return $pdf->download('articles.pdf');
   // }

   public function pdfview(Request $request)
   {
      //$articles = DB::table("articles")->get();

      $referrer = request()->headers->get('referer');
      if ($referrer == 'http://localhost:8000/backend/recipes/myRecipes') {
         $data = Recipe::myRecipes()->get();
      } else {
         $data = Recipe::All();
      }

      view()->share('recipes',$data);

      if($request->has('download')){
         $pdf = PDF::loadView('recipes.pdfDownload');
         //$pdf->setPaper('A4', 'landscape');
         return $pdf->download('recipes.pdf');
      }

      return view('recipes.pdfPreview');
   }


##################################################################################################################
# ██████╗ ██████╗ ██╗███╗   ██╗████████╗
# ██╔══██╗██╔══██╗██║████╗  ██║╚══██╔══╝
# ██████╔╝██████╔╝██║██╔██╗ ██║   ██║   
# ██╔═══╝ ██╔══██╗██║██║╚██╗██║   ██║   
# ██║     ██║  ██║██║██║ ╚████║   ██║   
# ╚═╝     ╚═╝  ╚═╝╚═╝╚═╝  ╚═══╝   ╚═╝   
##################################################################################################################
	public function print($id)
	{
		$recipe = Recipe::find($id);

		// Save entry to log file using built-in Monolog
		// Log::info(Auth::user()->username . " (" . Auth::user()->id . ") PRINTED recipe (" . $recipe->id . ")\r\n", [json_decode($recipe, true)]);

		return view('recipes.print')->withRecipe($recipe);
	}


##################################################################################################################
# ██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗
# ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║
# ██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║
# ██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║
# ██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║
# ╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝
##################################################################################################################
   public function publish($id)
   {
      $recipe = Recipe::find($id);
        $recipe->published_at = Carbon::now();
        $recipe->deleted_at = Null;
      $recipe->save();

      Session::flash ('success','The recipe was successfully published.');
      // return redirect()->route('recipes.show', $id);
      return redirect()->back();
   }


##################################################################################################################
# ██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗     █████╗ ██╗     ██╗     
# ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║    ██╔══██╗██║     ██║     
# ██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║    ███████║██║     ██║     
# ██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║    ██╔══██║██║     ██║     
# ██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║    ██║  ██║███████╗███████╗
# ╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝    ╚═╝  ╚═╝╚══════╝╚══════╝
##################################################################################################################
   public function publishAll(Request $request)
   {
      // Pass along the ROUTE value of the previous page
      $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

      //dd('TEST_DELETE');
      $this->validate($request, [
         'checked' => 'required',
      ]);
      //dd('TEST_DELETE');

      $checked = $request->input('checked');
      //dd($checked);

      // $article = Article::withTrashed()->findOrFail($checked);
      //Article::destroy($checked);
      //Article::whereIn('id', $checked)->publish();
      foreach ($checked as $item) {
         //dd($item);
         $recipe = Recipe::withTrashed()->find($item);
         //dd($article);
            $recipe->published_at = Carbon::now();
            $recipe->deleted_at = Null;
         $recipe->save();
      }

      Session::flash('success','The recipes were published successfully.');
      return redirect()->route($ref);
   }


##################################################################################################################
# ██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗███████╗██████╗ 
# ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║██╔════╝██╔══██╗
# ██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║█████╗  ██║  ██║
# ██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║██╔══╝  ██║  ██║
# ██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║███████╗██████╔╝
# ╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝ 
##################################################################################################################
   public function published(Request $request, $key=null)
   {
      // if(!checkACL('user')) {
      //     return view('errors.403');
      // }

      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'published');

      //$alphas = range('A', 'Z');
        $alphas = DB::table('recipes')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         ->where('published_at','<', Carbon::Now())
         ->where('deleted_at','=', Null)
         ->orderBy('letter')
         ->get();

      // Get list of recips by year and month
      $recipelinks = DB::table('recipes')
         ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
         ->where('published_at', '<=', Carbon::now())
         ->groupBy('year')
         ->groupBy('month')
         ->orderBy('year', 'desc')
         ->orderBy('month', 'desc')
         ->get();

      $letters = [];
      foreach($alphas as $alpha) {
        $letters[] = $alpha->letter;
      }

      // If $key value is passed
      if ($key) {
         $recipes = Recipe::with('user','category')
            ->published()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
      } else {
         // No $key value is passed
         $recipes = Recipe::with('user','category')
            ->published()
            ->get();
      }

      return view('recipes::backend.published', compact('recipes','letters','recipelinks'));
   }


##################################################################################################################
# ██████╗ ███████╗███████╗███████╗████████╗    ██╗   ██╗██╗███████╗██╗    ██╗███████╗
# ██╔══██╗██╔════╝██╔════╝██╔════╝╚══██╔══╝    ██║   ██║██║██╔════╝██║    ██║██╔════╝
# ██████╔╝█████╗  ███████╗█████╗     ██║       ██║   ██║██║█████╗  ██║ █╗ ██║███████╗
# ██╔══██╗██╔══╝  ╚════██║██╔══╝     ██║       ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║╚════██║
# ██║  ██║███████╗███████║███████╗   ██║        ╚████╔╝ ██║███████╗╚███╔███╔╝███████║
# ╚═╝  ╚═╝╚══════╝╚══════╝╚══════╝   ╚═╝         ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ ╚══════╝
// RESET VIEWS COUNT
##################################################################################################################
   public function resetViews($id)
   {
      // Pass along the ROUTE value of the previous page
      $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

      $recipe = Recipe::find($id);
         $recipe->views = 0;
      $recipe->save();

      // Save entry to log file using built-in Monolog
      //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") MADE recipe (" . $recipe->id . ") PRIVATE \r\n", [json_decode($recipe, true)]);

      Session::flash('success','The recipe\'s views count was reset to 0.');
      return redirect()->route($ref);
   }


##################################################################################################################
# ██████╗ ███████╗███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ██████╔╝█████╗  ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ██╔══██╗██╔══╝  ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ██║  ██║███████╗███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚═╝  ╚═╝╚══════╝╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// RESTORE TRASHED FILE
##################################################################################################################
   public function restore($id)
   {
      $recipe = Recipe::withTrashed()->findOrFail($id);
      //$article->deleted_at = NULL;
      //$article->save();
      $recipe->restore();

      Session::flash ('success','The recipe was successfully restored.');
      return redirect()->route('recipes.trashed');
   }


##################################################################################################################
# ██████╗ ███████╗███████╗████████╗ ██████╗ ██████╗ ███████╗     █████╗ ██╗     ██╗     
# ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝    ██╔══██╗██║     ██║     
# ██████╔╝█████╗  ███████╗   ██║   ██║   ██║██████╔╝█████╗      ███████║██║     ██║     
# ██╔══██╗██╔══╝  ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝      ██╔══██║██║     ██║     
# ██║  ██║███████╗███████║   ██║   ╚██████╔╝██║  ██║███████╗    ██║  ██║███████╗███████╗
# ╚═╝  ╚═╝╚══════╝╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝    ╚═╝  ╚═╝╚══════╝╚══════╝
// RESTORE ALL TRASHED FILE
##################################################################################################################
   public function restoreAll(Request $request)
   {
      //dd('TEST_RESTORE');
      //dd($request);
      //$this->validate($request, [
      //    'checked' => 'required',
      //]);
      //dd('TEST_RESTORE');

      $checked = $request->input('checked');
      //dd($checked);

      // $article = new Article();
      // $article->restore($checked);
      Recipe::whereIn('id', $checked)->restore();

      Session::flash('success','The recipes were restored successfully.');
      return redirect()->route('recipes.trashed');
   }


##################################################################################################################
# ███████╗██╗  ██╗ ██████╗ ██╗    ██╗
# ██╔════╝██║  ██║██╔═══██╗██║    ██║
# ███████╗███████║██║   ██║██║ █╗ ██║
# ╚════██║██╔══██║██║   ██║██║███╗██║
# ███████║██║  ██║╚██████╔╝╚███╔███╔╝
# ╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚══╝╚══╝ 
// Display the specified resource
##################################################################################################################
   public function show($id)
   {
      $recipe = Recipe::withTrashed()->find($id);

      // Set the variable so we can use a button in other pages to come back to this page
      // Session::put('pageName', 'show');

      // get previous recipe id
      // $previous = Recipe::published()->where('id', '<', $recipe->id)->max('id');

      // get next recipe id
      // $next = Recipe::published()->where('id', '>', $recipe->id)->min('id');

      //$next = Recipe::published()->orderBy("title")->first();
      // dd($next);
      //$previous = Recipe::orderBy("title", 'desc')->first();

      // Add 1 to views column
      if(
         (Session::get('pageName') === 'index') ||
         (Session::get('pageName') === 'myFavorites') ||
         (Session::get('pageName') === 'archive') ||
         (Session::get('pageName') === 'home')
      ){
         DB::table('recipes')->where('id','=',$recipe->id)->increment('views',1);
      }


      // If user is logged in, update the last_viewed_by_id and last_viewed_on fields in the recipes table
      // if (Auth::check()) {
      //    DB::statement("UPDATE recipes SET last_viewed_by_id = " . Auth::user()->id . " where id = " . $id );
      //    DB::statement("UPDATE recipes SET last_viewed_on = " . DB::raw('NOW()') . " where id = " . $id );
      // }

      $categories = Category::where('parent_id',1)->get();

      $popularRecipes = Recipe::published()->public()->get()->sortBy('title')->sortByDesc('views')->take(setting('homepage_favorite_recipe_count'));

      // Get list of recips by year and month
      $recipelinks = DB::table('recipes')
         ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
         ->where('published_at', '<=', Carbon::now())
         //->subMonth(3)) --Only show the last 3 months
         //->whereRaw('published = 1') -- field no longer used
         ->groupBy('year')
         ->groupBy('month')
         ->orderBy('year', 'desc')
         ->orderBy('month', 'desc')
         ->get();

      // Save entry to log file using built-in Monolog
      if (Auth::check()) {
         //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") viewed :: Recipe (" . $recipe->id . ")");
      } else {
         //Log::info(getClientIP() . " viewed :: Recipe (" . $recipe->id . ")");
      }

      return view('recipes::common.show', compact('recipe','recipelinks','categories','popularRecipes'));
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// Store a newly created resource in storage
##################################################################################################################
   public function store(CreateRecipeRequest $request)
   // public function store(Request $request)
   {
      // if(!checkACL('author')) {
      //     return view('errors.403');
      // }

      $recipe = new Recipe;
         $recipe->title = $request->title;
         // $recipe->ingredients = Purifier::clean($request->ingredients);
         $recipe->ingredients = $request->ingredients;
         // $recipe->methodology = Purifier::clean($request->methodology);
         $recipe->methodology = $request->methodology;
         $recipe->category_id = $request->category_id;
         $recipe->published_at = $request->published_at;
         $recipe->servings = $request->servings;
         $recipe->prep_time = $request->prep_time;
         $recipe->cook_time = $request->cook_time;
         $recipe->personal = $request->personal;
         $recipe->source = $request->source;
         $recipe->private_notes = $request->private_notes;
         $recipe->public_notes = $request->public_notes;
         $recipe->modified_by_id = Auth::user()->id;
         $recipe->last_viewed_by_id = Auth::user()->id;
         $recipe->last_viewed_on = Carbon::Now();
         $recipe->user_id = Auth::user()->id;

         // Save the image if there is one
         if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('_recipes/' . $filename);
            Image::make($image)->resize(800, 400)->save($location);
            $recipe->image = $filename;
         }

      $recipe->save();

      // Save entry to log file using built-in Monolog
      //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED article (" . $article->id . ")\r\n", [json_decode($article, true)]
      //);

      Session::flash('success','The article has been created successfully!');
      // return redirect()->route('recipes.index');
      return redirect()->route('recipes.'. Session::get('pageName'));
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗     ██████╗ ██████╗ ███╗   ███╗███╗   ███╗███████╗███╗   ██╗████████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝    ██╔════╝██╔═══██╗████╗ ████║████╗ ████║██╔════╝████╗  ██║╚══██╔══╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗      ██║     ██║   ██║██╔████╔██║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝      ██║     ██║   ██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗    ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝     ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   
##################################################################################################################
	 public function storeComment(CreateCommentRequest $request, $id)
		  // public function storeComment(Request $request, $id)
	 {
		  //dd($id);
		  $recipe = Recipe::find($id);
		  //dd($project);

		  $comment = new Comment();
				// $comment->name = $request->name;
				// $comment->email = $request->email;
				$comment->user_id = Auth::user()->id;
				$comment->comment = $request->comment;
			$recipe->comments()->save($comment);
		  //$comment->save();

		  // Save entry to log file using built-in Monolog
		  // if (Auth::check()) {
		  //     Log::info(Auth::user()->username . " (" . Auth::user()->id . ") commented on post (" . $post->id . ")\r\n", [json_decode($comment, true)]);
		  // } else {
		  //     Log::info(Request::ip() . " commented on post " . $post->id);
		  // }

		  Session::flash('success', 'Comment added succesfully.');
		  return redirect()->route('recipes.show', $recipe->id);
	 }


##################################################################################################################
# ████████╗██████╗  █████╗ ███████╗██╗  ██╗
# ╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██║  ██║
#    ██║   ██████╔╝███████║███████╗███████║
#    ██║   ██╔══██╗██╔══██║╚════██║██╔══██║
#    ██║   ██║  ██║██║  ██║███████║██║  ██║
#    ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
##################################################################################################################
   public function trash($id)
   {
      // Check if user has required permission
      // if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

      $recipe = Recipe::findOrFail($id);

      // dd($recipe);
      // $model = "recipe";
      // dd($model);
      // Set the $page variable so we can come back to the calling page    
      // if (app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'posts.index') {
      //    $page = 'index';
      // }elseif (app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'posts.unpublished') {
      //    $page = 'unpublished';
      // }elseif (app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'posts.newPosts') {
      //    $page = 'newPosts';
      // }

      // Session::put('pageName', 'trashed');

      return view('recipes::backend.trash', compact('recipe'));
      // return view('common.trash', compact('recipe','model'));
   }


##################################################################################################################
# ████████╗██████╗  █████╗ ███████╗██╗  ██╗     █████╗ ██╗     ██╗     
# ╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██║  ██║    ██╔══██╗██║     ██║     
#    ██║   ██████╔╝███████║███████╗███████║    ███████║██║     ██║     
#    ██║   ██╔══██╗██╔══██║╚════██║██╔══██║    ██╔══██║██║     ██║     
#    ██║   ██║  ██║██║  ██║███████║██║  ██║    ██║  ██║███████╗███████╗
#    ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝    ╚═╝  ╚═╝╚══════╝╚══════╝
// Remove the specified resource from storage
// Used in the index page to soft delete multiple records
##################################################################################################################
   public function trashAll(Request $request)
   {
      // Pass along the ROUTE value of the previous page
      // $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');
      // dd($checked);

      Recipe::destroy($checked);

      Session::flash('success','The recipes were trashed successfully.');
      return redirect()->route('recipes.'. Session::get('pageName'));

   }


##################################################################################################################
# ████████╗██████╗  █████╗ ███████╗██╗  ██╗    ██████╗ ███████╗███████╗████████╗██████╗  ██████╗ ██╗   ██╗
# ╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██║  ██║    ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔══██╗██╔═══██╗╚██╗ ██╔╝
#    ██║   ██████╔╝███████║███████╗███████║    ██║  ██║█████╗  ███████╗   ██║   ██████╔╝██║   ██║ ╚████╔╝ 
#    ██║   ██╔══██╗██╔══██║╚════██║██╔══██║    ██║  ██║██╔══╝  ╚════██║   ██║   ██╔══██╗██║   ██║  ╚██╔╝  
#    ██║   ██║  ██║██║  ██║███████║██║  ██║    ██████╔╝███████╗███████║   ██║   ██║  ██║╚██████╔╝   ██║   
#    ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝    ╚═════╝ ╚══════╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝    ╚═╝   
// Remove the specified resource from storage
// Used in the index page and trashAll action to soft delete multiple records
##################################################################################################################
   public function trashDestroy($id)
   {
      // Check if user has required permission
      // if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

      $recipe = Recipe::find($id);

      // Delete this recipe's favorites
      DB::table('favorites')->where('favoriteable_id', '=', $id)->delete();
      // Delete the recipe
      $recipe->delete();

      // Save entry to log file using built-in Monolog
      // Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED post (" . $post->id . ")\r\n", 
      //    [json_decode($post, true)]
      // );

      Session::flash('success', 'The recipe was successfully deleted!');
      return redirect()->route('recipes.'. Session::get('pageName'));
   }


##################################################################################################################
# ████████╗██████╗  █████╗ ███████╗██╗  ██╗███████╗██████╗ 
# ╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██║  ██║██╔════╝██╔══██╗
#    ██║   ██████╔╝███████║███████╗███████║█████╗  ██║  ██║
#    ██║   ██╔══██╗██╔══██║╚════██║██╔══██║██╔══╝  ██║  ██║
#    ██║   ██║  ██║██║  ██║███████║██║  ██║███████╗██████╔╝
#    ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝ 
// Display a list of resources that have been trashed (Soft Deleted)
##################################################################################################################
   public function trashed(Request $request, $key=null)
   {
      // Check if user has required permission
      // if(!checkPerm('post_index')) { abort(401, 'Unauthorized Access'); }

      //$alphas = range('A', 'Z');
      $alphas = DB::table('recipes')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         //->where('published_at','<', Carbon::Now())
         ->where('deleted_at','!=', Null)
         ->orderBy('letter')
         ->get();

      $letters = [];
      foreach($alphas as $alpha) {
        $letters[] = $alpha->letter;
      }

      // Get list of posts by year and month
      $recipelinks = DB::table('recipes')
         ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) recipe_count'))
         ->where('published_at', '<=', Carbon::now())
         //->where('created_at', '<=', Carbon::now()->subMonth(3))
         ->groupBy('year')
         ->groupBy('month')
         ->orderBy('year', 'desc')
         ->orderBy('month', 'desc')
         ->get();
      // dd($postlinks);

      Session::put('pageName', 'trashed');

      // If $key value is passed
      if ($key) {
         $recipes = Recipe::with('user','category')
            ->onlyTrashed()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
      } else {
         $recipes = Recipe::with('user','category')
            ->onlyTrashed()
            ->orderBy('id','desc')
            ->get();
      }
      
      return view('recipes::backend.trashed', compact('recipes','letters', 'recipelinks'));


       //   public function trashed(Request $request)
   // {
      // if(!checkACL('guest')) {
      //     return view('errors.403');
      // }

   //    $recipes = Recipe::with('user','category')->onlyTrashed()->get();
   //    return view('recipes.trashed', compact('recipes'));
   // }
   }


##################################################################################################################
# ████████╗██████╗  █████╗ ███████╗██╗  ██╗███████╗██████╗     ██╗   ██╗██╗███████╗██╗    ██╗
# ╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██║  ██║██╔════╝██╔══██╗    ██║   ██║██║██╔════╝██║    ██║
#    ██║   ██████╔╝███████║███████╗███████║█████╗  ██║  ██║    ██║   ██║██║█████╗  ██║ █╗ ██║
#    ██║   ██╔══██╗██╔══██║╚════██║██╔══██║██╔══╝  ██║  ██║    ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║
#    ██║   ██║  ██║██║  ██║███████║██║  ██║███████╗██████╔╝     ╚████╔╝ ██║███████╗╚███╔███╔╝
#    ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝       ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ 
// Display the specified resource
##################################################################################################################
   public function trashedView($id)
   {
      $recipe = Recipe::withTrashed()->find($id);

      // Set the variable so we can use a button in other pages to come back to this page
      // Session::put('pageName', 'show');

      // get previous recipe id
      // $previous = Recipe::published()->where('id', '<', $recipe->id)->max('id');

      // get next recipe id
      // $next = Recipe::published()->where('id', '>', $recipe->id)->min('id');

      //$next = Recipe::published()->orderBy("title")->first();
      // dd($next);
      //$previous = Recipe::orderBy("title", 'desc')->first();

      // Add 1 to views column
      // DB::table('recipes')->where('id','=',$recipe->id)->increment('views',1);

      // If user is logged in, update the last_viewed_by_id and last_viewed_on fields in the recipes table
      // if (Auth::check()) {
      //    DB::statement("UPDATE recipes SET last_viewed_by_id = " . Auth::user()->id . " where id = " . $id );
      //    DB::statement("UPDATE recipes SET last_viewed_on = " . DB::raw('NOW()') . " where id = " . $id );
      // }

      // Get list of recips by year and month
      // $recipelinks = DB::table('recipes')
      //    ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
      //    ->where('published_at', '<=', Carbon::now())
      //    //->subMonth(3)) --Only show the last 3 months
      //    //->whereRaw('published = 1') -- field no longer used
      //    ->groupBy('year')
      //    ->groupBy('month')
      //    ->orderBy('year', 'desc')
      //    ->orderBy('month', 'desc')
      //    ->get();

      // Save entry to log file using built-in Monolog
      if (Auth::check()) {
         //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") viewed :: Recipe (" . $recipe->id . ")");
      } else {
         //Log::info(getClientIP() . " viewed :: Recipe (" . $recipe->id . ")");
      }

      // return view('recipes::backend.view', compact('recipe','recipelinks','next','previous'));
      return view('recipes::backend.trashedView', compact('recipe'));
   }


##################################################################################################################
# ██╗   ██╗███╗   ██╗██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗
# ██║   ██║████╗  ██║██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║
# ██║   ██║██╔██╗ ██║██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║
# ██║   ██║██║╚██╗██║██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║
# ╚██████╔╝██║ ╚████║██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║
#  ╚═════╝ ╚═╝  ╚═══╝╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝
##################################################################################################################
   public function unpublish($id)
   {
      // Pass along the ROUTE value of the previous page
      //$ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

      $recipe = Recipe::find($id);
         $recipe->published_at = NULL;
         // $article->favoriteArticles()->delete(); // Remove associated rows from article_user (favorites table)
        
         $favorites = DB::select('select * from recipe_user where recipe_id = '. $id, [1]);
         //dd ($favorites);
         foreach($favorites as $favorite) {
            //dd($favorite);
            $recipe->favorites()->detach($favorite);
         }
      $recipe->save();

      Session::flash ('success','The recipe was successfully unpublished.');
      //return redirect()->route($ref);
      // return redirect()->route('recipes.show', $id);
      return redirect()->back();
   }


##################################################################################################################
# ██╗   ██╗███╗   ██╗██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗███████╗██████╗ 
# ██║   ██║████╗  ██║██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║██╔════╝██╔══██╗
# ██║   ██║██╔██╗ ██║██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║█████╗  ██║  ██║
# ██║   ██║██║╚██╗██║██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║██╔══╝  ██║  ██║
# ╚██████╔╝██║ ╚████║██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║███████╗██████╔╝
#  ╚═════╝ ╚═╝  ╚═══╝╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝ 
// Display a list of resources that have not been published
##################################################################################################################
   public function unpublished(Request $request, $key=null)
   {
      // if(!checkACL('editor')) {
      //     return view('errors.403');
      // }

      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'unpublished');


      //$alphas = range('A', 'Z');
        $alphas = DB::table('recipes')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         // ->where('personal', '!=', 1)
         ->where('published_at','=', null)
         ->orderBy('letter')
         ->get();
         //dd($alphas);

      $letters = [];
      foreach($alphas as $alpha) {
         $letters[] = $alpha->letter;
      }

      // If $key value is passed
      if ($key) {
         $recipes = Recipe::with('user','category')
            ->unpublished()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
      } else {
         // No $key value is passed
         $recipes = Recipe::with('user','category')
            ->unpublished()
            ->get();
      }

      return view('recipes::backend.unpublished', compact('recipes','letters'));
   }


##################################################################################################################
# ██╗   ██╗███╗   ██╗██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗     █████╗ ██╗     ██╗     
# ██║   ██║████╗  ██║██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║    ██╔══██╗██║     ██║     
# ██║   ██║██╔██╗ ██║██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║    ███████║██║     ██║     
# ██║   ██║██║╚██╗██║██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║    ██╔══██║██║     ██║     
# ╚██████╔╝██║ ╚████║██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║    ██║  ██║███████╗███████╗
#  ╚═════╝ ╚═╝  ╚═══╝╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝    ╚═╝  ╚═╝╚══════╝╚══════╝
##################################################################################################################
   public function unpublishAll(Request $request)
   {
      // Pass along the ROUTE value of the previous page
      $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');

      foreach ($checked as $item) {
         //dd($item);
         $recipe = Recipe::withTrashed()->find($item);
            $recipe->published_at = Null;

         // Delete related favorites
         // $favorites = DB::select('select * from recipe_user where recipe_id = '. $recipe->id, [1]);
         // foreach($favorites as $favorite) {
         //    $recipe->favoriteRecipes()->detach($favorite);
         // }
         // Delete this recipe's favorites
         DB::table('favorites')->where('favoriteable_id', '=', $recipe->id)->delete();

         $recipe->save();
      }
      

      Session::flash('success','The recipes were unpublished successfully.');
      return redirect()->route('recipes.'. Session::get('pageName'));
   }


##################################################################################################################
# ██╗   ██╗██████╗ ██████╗  █████╗ ████████╗███████╗
# ██║   ██║██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
# ██║   ██║██████╔╝██║  ██║███████║   ██║   █████╗  
# ██║   ██║██╔═══╝ ██║  ██║██╔══██║   ██║   ██╔══╝  
# ╚██████╔╝██║     ██████╔╝██║  ██║   ██║   ███████╗
#  ╚═════╝ ╚═╝     ╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝
// UPDATE :: Update the specified resource in storage
##################################################################################################################
   public function update(UpdateRecipeRequest $request, $id)
   {
      // Get the recipe values from the database
      $recipe = Recipe::find($id);

      // save the data in the database
      $recipe->title = $request->title;
      // $recipe->ingredients = Purifier::clean($request->ingredients);
      $recipe->ingredients = $request->ingredients;
      // $recipe->methodology = Purifier::clean($request->methodology);
      $recipe->methodology = $request->methodology;
      $recipe->category_id = $request->category_id;
      $recipe->published_at = $request->published_at;
      $recipe->servings = $request->servings;
      $recipe->prep_time = $request->prep_time;
      $recipe->cook_time = $request->cook_time;
      $recipe->personal = $request->personal;
      $recipe->source = $request->source;
      $recipe->private_notes = $request->private_notes;
      $recipe->public_notes = $request->public_notes;
      $recipe->modified_by_id = Auth::user()->id;
      $recipe->last_viewed_by_id = Auth::user()->id;
      $recipe->last_viewed_on = Carbon::Now();

      // Check if a new image was submitted
      if ($request->hasFile('image')) {
         //Add new photo
         $image = $request->file('image');
         $filename = time() . '.' . $image->getClientOriginalExtension();
         $location = public_path('_recipes/' . $filename);
         Image::make($image)->resize(800, 400)->save($location);

         // get name of old image
         $oldImageName = $recipe->image;
         //dd($oldImageName);

         // Update database
         $recipe->image = $filename;

         // Delete old photo
         //Storage::delete($oldImageName);
         File::delete('_recipes/'.$oldImageName);
      }

      $recipe->save();

      // Save entry to log file using built-in Monolog
      //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") updated :: Recipe (" . $recipe->id .")");

      // set a flash message to be displayed on screen
      Session::flash('success','The recipe was successfully updated!');
      // redirect to another page
      //return redirect()->route('recipes.index');
      // return redirect(Session::get('fullURL'));
      return redirect()->route('recipes.'. Session::get('pageName'));
  }


##################################################################################################################
# ██╗   ██╗██╗███████╗██╗    ██╗
# ██║   ██║██║██╔════╝██║    ██║
# ██║   ██║██║█████╗  ██║ █╗ ██║
# ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║
#  ╚████╔╝ ██║███████╗╚███╔███╔╝
#   ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝
// Display the specified resource
##################################################################################################################
   public function view($id)
   {
      $recipe = Recipe::find($id);

      // Set the variable so we can use a button in other pages to come back to this page
      // Session::put('pageName', 'show');

      // get previous recipe id
      // $previous = Recipe::published()->where('id', '<', $recipe->id)->max('id');

      // get next recipe id
      // $next = Recipe::published()->where('id', '>', $recipe->id)->min('id');

      //$next = Recipe::published()->orderBy("title")->first();
      // dd($next);
      //$previous = Recipe::orderBy("title", 'desc')->first();

      // Add 1 to views column
      // DB::table('recipes')->where('id','=',$recipe->id)->increment('views',1);

      // If user is logged in, update the last_viewed_by_id and last_viewed_on fields in the recipes table
      // if (Auth::check()) {
      //    DB::statement("UPDATE recipes SET last_viewed_by_id = " . Auth::user()->id . " where id = " . $id );
      //    DB::statement("UPDATE recipes SET last_viewed_on = " . DB::raw('NOW()') . " where id = " . $id );
      // }

      // Get list of recips by year and month
      $recipelinks = DB::table('recipes')
         ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
         ->where('published_at', '<=', Carbon::now())
         //->subMonth(3)) --Only show the last 3 months
         //->whereRaw('published = 1') -- field no longer used
         ->groupBy('year')
         ->groupBy('month')
         ->orderBy('year', 'desc')
         ->orderBy('month', 'desc')
         ->get();

      // Save entry to log file using built-in Monolog
      if (Auth::check()) {
         //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") viewed :: Recipe (" . $recipe->id . ")");
      } else {
         //Log::info(getClientIP() . " viewed :: Recipe (" . $recipe->id . ")");
      }

      return view('recipes::backend.view', compact('recipe','recipelinks','next','previous'));
   }


   public function test() {
      
      // Popular recipes
      $popularRecipes = Recipe::published()->public()->get()->sortBy('title')->sortByDesc('views')->take(setting('homepage_favorite_recipe_count'));

      // Get list of recips by year and month
      $recipelinks = DB::table('recipes')
         ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
         ->where('published_at', '<=', Carbon::now())
         ->groupBy('year')->groupBy('month')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

      return view('recipes::frontend.test', compact('popularRecipes', 'recipelinks'));
   }


}
