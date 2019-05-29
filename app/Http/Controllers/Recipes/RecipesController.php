<?php

namespace App\Http\Controllers\Recipes;

use App\Http\Controllers\Controller; // Required for validation
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\CreateRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Models\Recipes\Recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
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
   public function __construct()
   {
      // Only allow authenticated users access to these functions
      $this->middleware('auth')->except('index','show','archive');
      $this->enablePermissions = true;
      // $this->middleware('subscribed')->except('store');
   }


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
      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

		$archives = Recipe::with('user', 'category')
         ->whereYear('published_at','=', $year)
			->whereMonth('published_at','=', $month)
			->where('published_at', '<=', Carbon::now())
         ->orderBy('title')
			->get();

		return view('recipes.archive', compact('archives','year','month','categories'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_create')) { abort(401, 'Unauthorized Access'); }
      }

      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

      return view('recipes.create', compact('categories'));
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
      if($this->enablePermissions) {
         if(!checkPerm('recipe_trash')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::onlyTrashed()->findOrFail($id);

      return view('recipes.delete', compact('recipe'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_delete')) { abort(401, 'Unauthorized Access'); }
      }

      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');

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
      if($this->enablePermissions) {
         if(!checkPerm('recipe_delete')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::withTrashed()->findOrFail($id);

      // Delete the associated image if any
      File::delete('_recipes/' . $recipe->image);

      $recipe->forceDelete();

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
      $recipe = Recipe::find($id);

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_duplicate', $recipe)) { abort(401, 'Unauthorized Access'); }
      }
      
      $newRecipe = $recipe->replicate();
      $newRecipe->user_id = Auth::user()->id;
      $newRecipe->save();

      Session::flash ('success','The recipe was duplicated successfully!');
      return redirect()->back();
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
      // Find the article to edit
      $recipe = Recipe::findOrFail($id);

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_edit', $recipe)) { abort(401, 'Unauthorized Access'); }
      }

      // find all categories in the categories table and pass them to the view
      $categories = Category::with('children')->where('parent_id',1)->get();

      return view('recipes.edit', compact('recipe','categories'));
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
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('recipe_favorite')) { abort(401, 'Unauthorized Access'); }
      // }

      $recipe = Recipe::find($id);
      $recipe->addFavorite();

      Session::flash ('success','The recipe was successfully added to your Favorites list!');
      // return redirect()->route('recipes.'. Session::get('pageName'));
      return redirect()->back();
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
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('recipe_favorite')) { abort(401, 'Unauthorized Access'); }
      // }

      $recipe = Recipe::find($id);
      $recipe->removeFavorite();

      Session::flash ('success','The recipe was successfully removed to your Favorites list!');
      // return redirect()->route('recipes.'. Session::get('pageName'));
      return redirect()->back();
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
      // Set the session to the current page route
      Session::put('fromPage', Route::currentRouteName());

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_future')) { abort(401, 'Unauthorized Access'); }
      }

      $alphas = DB::table('recipes')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         ->where('published_at','>', Carbon::Now())
         ->orderBy('letter')
         ->get();

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

      return view('recipes.future', compact('recipes','letters'));
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
      // Check if user has required permission
      // if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

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
      // Check if user has required permission
      // if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

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
      // Set the session to the current page route
      Session::put('fromPage', Route::currentRouteName());
      // dd(Route::current()->parameters['cat']);
      
      if(!Route::current()->parameters['cat'] == '') {
         Session::put('cat', Route::current()->parameters['cat']);
      }

      // if(!Route::current()->parameters['key'] == '') {
      //    Session::put('key', Route::current()->parameters['key']);
      // }
      

      // $current_params = Route::current()->parameters();
      // dd($current_params->$key);
      // dd(Route::current()->parameters['key']);
      // dd(Session::get('fromPage'));

      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();
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
            ->paginate(15);

         if($request->key){
            // echo " and grouped by " .$request->key;
            $recipes = Recipe::with('user','category')
               ->published()
               ->public()
               ->where('title', 'like', $request->key . '%')
               ->orderBy('title', 'asc')
               ->paginate(15);
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
               ->paginate(15);

            if($request->key){
               // echo " and grouped by " .$request->key;
               $recipes = Recipe::with('user','category')
                  ->published()
                  ->public()
                  ->where('category_id', '=', $byCatName->id)
                  ->where('title', 'like', $request->key . '%')
                  ->orderBy('title', 'asc')
                  ->paginate(15);
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
               ->paginate(15);

            if($request->key){
               // echo " and grouped by " .$request->key;
               $recipes = Recipe::with('user','category')
                  ->published()
                  ->public()
                  ->whereIn('category_id', $allc)
                  ->where('title', 'like', $request->key . '%')
                  ->orderBy('title', 'asc')
                  ->paginate(15);
            }
         }
      }

      $letters = [];
      foreach($alphas as $alpha) {
         $letters[] = $alpha->letter;
      }
      
      return view('recipes.index', compact('recipes','categories','letters','byCatName'));
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
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      // }

      if(Auth::check()) {
         $user = Auth::user();
         $recipes = $user->favorite(Recipe::class)->sortBy('title');
      }

      return view('recipes.myFavorites', compact('recipes'));
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
      // Set the session to the current page route
      Session::put('fromPage', Route::currentRouteName());

      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      // }

		if (Auth::check()) {
			$alphas = DB::table('recipes')
				->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
				->where('user_id','=', Auth::user()->id)
				->orderBy('letter')
				->get();

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

			return view('recipes.myRecipes', compact('recipes','letters'));
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
      // Set the session to the current page route
      Session::put('fromPage', Route::currentRouteName());

      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      // }

      if (Auth::check()) {
         // Get list of recips by year and month
         $recipelinks = DB::table('recipes')
            ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
            ->where('published_at', '<=', Carbon::now())
            ->where('personal', '=', 1)
            ->groupBy('year')
            ->groupBy('month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

         $alphas = DB::table('recipes')
            ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
            ->where('user_id','=', Auth::user()->id)
            ->where('personal', '=', 1)
            ->orderBy('letter')
            ->get();

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

         return view('recipes.myPrivateRecipes', compact('recipes','letters', 'recipelinks'));
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
      // Set the session to the current page route
      Session::put('fromPage', Route::currentRouteName());

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_new')) { abort(401, 'Unauthorized Access'); }
      }

      $alphas = DB::table('recipes')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         ->where('created_at', '>=' , Auth::user()->last_login_date)
         ->orderBy('letter')
         ->get();

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

      return view('recipes.newRecipes', compact('recipes','letters'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_print')) { abort(401, 'Unauthorized Access'); }
      }

		$recipe = Recipe::find($id);

		return view('recipes.print', compact('recipe'));
	}


##################################################################################################################
# ██████╗ ██████╗ ██╗███╗   ██╗████████╗     █████╗ ██╗     ██╗     
# ██╔══██╗██╔══██╗██║████╗  ██║╚══██╔══╝    ██╔══██╗██║     ██║     
# ██████╔╝██████╔╝██║██╔██╗ ██║   ██║       ███████║██║     ██║     
# ██╔═══╝ ██╔══██╗██║██║╚██╗██║   ██║       ██╔══██║██║     ██║     
# ██║     ██║  ██║██║██║ ╚████║   ██║       ██║  ██║███████╗███████╗
# ╚═╝     ╚═╝  ╚═╝╚═╝╚═╝  ╚═══╝   ╚═╝       ╚═╝  ╚═╝╚══════╝╚══════╝
##################################################################################################################
   public function printAll($category)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_print')) { abort(401, 'Unauthorized Access'); }
      }

      if($category == "all"){
         $recipes = Recipe::orderBy('title', 'asc')->get();
      } else {
         $cCat = Category::where('name', $category)->pluck('id');
         // dd($cName);
         $sCats = Category::where('parent_id', $cCat)->pluck('id');
         // dd($sCats);

         if($sCats->count() <= 0){
            $recipes = Recipe::where('category_id', $cCat)->orderBy('title', 'asc')->get();
         } else {
            $recipes = Recipe::whereIn('category_id', $sCats)->orderBy('title', 'asc')->get();
         }
      }

      return view('recipes.printAll', compact('recipes'));
   }


##################################################################################################################
# ██████╗ ██████╗ ██╗██╗   ██╗ █████╗ ████████╗██╗███████╗███████╗
# ██╔══██╗██╔══██╗██║██║   ██║██╔══██╗╚══██╔══╝██║╚══███╔╝██╔════╝
# ██████╔╝██████╔╝██║██║   ██║███████║   ██║   ██║  ███╔╝ █████╗  
# ██╔═══╝ ██╔══██╗██║╚██╗ ██╔╝██╔══██║   ██║   ██║ ███╔╝  ██╔══╝  
# ██║     ██║  ██║██║ ╚████╔╝ ██║  ██║   ██║   ██║███████╗███████╗
# ╚═╝     ╚═╝  ╚═╝╚═╝  ╚═══╝  ╚═╝  ╚═╝   ╚═╝   ╚═╝╚══════╝╚══════╝
##################################################################################################################
   public function privatize($id)
   {
      $recipe = Recipe::find($id);
      
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_private', $recipe)) { abort(401, 'Unauthorized Access'); }
      }

      $recipe->personal = 1;
      $recipe->save();

      // Delete this recipe's favorites
      DB::table('favorites')->where('favoriteable_id', '=', $id)->delete();

      Session::flash('success','The recipe was successfully made private');
      return redirect()->back();
   }


##################################################################################################################
# ██████╗ ██╗   ██╗██████╗ ██╗     ██╗ ██████╗██╗███████╗███████╗
# ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║╚══███╔╝██╔════╝
# ██████╔╝██║   ██║██████╔╝██║     ██║██║     ██║  ███╔╝ █████╗  
# ██╔═══╝ ██║   ██║██╔══██╗██║     ██║██║     ██║ ███╔╝  ██╔══╝  
# ██║     ╚██████╔╝██████╔╝███████╗██║╚██████╗██║███████╗███████╗
# ╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝ ╚═════╝╚═╝╚══════╝╚══════╝
##################################################################################################################
   public function publicize($id)
   {
      $recipe = Recipe::find($id);

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_private', $recipe)) { abort(401, 'Unauthorized Access'); }
      }

      $recipe->personal = 0;
      $recipe->save();

      Session::flash('success','The recipe was successfully made public');
      return redirect()->back();
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_publish')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::find($id);
        $recipe->published_at = Carbon::now();
        $recipe->deleted_at = Null;
      $recipe->save();

      Session::flash ('success','The recipe was successfully published.');
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_publish')) { abort(401, 'Unauthorized Access'); }
      }

      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');

      foreach ($checked as $item) {
         $recipe = Recipe::withTrashed()->find($item);
            $recipe->published_at = Carbon::now();
            $recipe->deleted_at = Null;
         $recipe->save();
      }

      Session::flash('success','The recipes were published successfully.');
      return redirect()->back();
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
      Session::put('fromPage', 'recipes.published');

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_published')) { abort(401, 'Unauthorized Access'); }
      }

     $alphas = DB::table('recipes')
      ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
      ->where('published_at','<', Carbon::Now())
      ->where('deleted_at','=', Null)
      ->where('personal', '!=', 1)
      ->orderBy('letter')
      ->get();

      $letters = [];
      foreach($alphas as $alpha) {
        $letters[] = $alpha->letter;
      }

      // If $key value is passed
      if ($key) {
         $recipes = Recipe::with('user','category')
            ->published()
            ->public()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
      } else {
         // No $key value is passed
         $recipes = Recipe::with('user','category')
            ->published()
            ->public()
            ->get();
      }

      return view('recipes.published', compact('recipes','letters'));
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
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      // }

      $recipe = Recipe::find($id);
         $recipe->views = 0;
      $recipe->save();

      Session::flash('success','The recipe\'s views count was reset to 0.');
      return redirect()->back();
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_restore')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::withTrashed()->findOrFail($id);
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_restore')) { abort(401, 'Unauthorized Access'); }
      }

      $checked = $request->input('checked');

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
      // Session::put('fromPage', 'recipes.published');
      
      $recipe = Recipe::withTrashed()->find($id);

      // Increase the view count since this is viewed from the frontend
      DB::table('recipes')->where('id','=',$recipe->id)->increment('views',1);

      $categories = Category::where('parent_id',1)->get();

      return view('recipes.show', compact('recipe','categories'));
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
   public function store(CreateRecipeRequest $request, Recipe $recipe)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_create')) { abort(401, 'Unauthorized Access'); }
      }

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

      Session::flash('success','Recipe created successfully!');
      // return redirect()->route('recipes.'. Session::get('pageName'));
      return redirect()->back();
      // return redirect()->route('recipes.index');
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
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('comment_store')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::find($id);

      $comment = new Comment();
      $comment->user_id = Auth::user()->id;
      $comment->comment = $request->comment;
      $recipe->comments()->save($comment);

      Session::flash('success', 'Comment added succesfully.');
      // return redirect()->route('recipes.show', $recipe->id);
      return redirect()->back();
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
      if($this->enablePermissions) {
         if(!checkPerm('recipe_trash')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::findOrFail($id);

      return view('recipes.trash', compact('recipe'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_trash')) { abort(401, 'Unauthorized Access'); }
      }

      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');

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
      if($this->enablePermissions) {
         if(!checkPerm('recipe_delete')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::find($id);

      // Delete this recipe's favorites
      DB::table('favorites')->where('favoriteable_id', '=', $id)->delete();
      // Delete the recipe
      $recipe->delete();

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
      if($this->enablePermissions) {
         if(!checkPerm('recipe_trashed')) { abort(401, 'Unauthorized Access'); }
      }

      $alphas = DB::table('recipes')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         ->where('deleted_at','!=', Null)
         ->orderBy('letter')
         ->get();

      $letters = [];
      foreach($alphas as $alpha) {
        $letters[] = $alpha->letter;
      }

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
      
      return view('recipes.trashed', compact('recipes','letters'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_trashed')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::withTrashed()->find($id);

      return view('recipes.trashedView', compact('recipe'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_publish')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::find($id);
         $recipe->published_at = NULL;
         // Delete this recipe's favorites
         DB::table('favorites')->where('favoriteable_id', '=', $recipe->id)->delete();
      $recipe->save();

      Session::flash ('success','The recipe was successfully unpublished.');
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
      // Set the session to the current page route
      Session::put('fromPage', Route::currentRouteName());

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_published')) { abort(401, 'Unauthorized Access'); }
      }

     $alphas = DB::table('recipes')
      ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
      ->where('published_at','=', null)
      ->orderBy('letter')
      ->get();

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

      return view('recipes.unpublished', compact('recipes','letters'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_publish')) { abort(401, 'Unauthorized Access'); }
      }

      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');

      foreach ($checked as $item) {
         $recipe = Recipe::withTrashed()->find($item);
            $recipe->published_at = Null;
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
      // dd($recipe);

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_edit', $recipe)) { abort(401, 'Unauthorized Access'); }
      }

      

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

         // Update database
         $recipe->image = $filename;

         // Delete old photo
         //Storage::delete($oldImageName);
         File::delete('_recipes/'.$oldImageName);
      }

      $recipe->save();

      // set a flash message to be displayed on screen
      Session::flash('success','The recipe was successfully updated!');
      // dd(Session::get('fromPage'));
      return redirect()->route(Session::get('fromPage'));
      // return redirect()->route('recipes.index', 'all');

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
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      // }

      $recipe = Recipe::withTrashed()->find($id);

      $categories = Category::where('parent_id',1)->get();

      return view('recipes.view', compact('recipe','categories'));
   }













   












}

