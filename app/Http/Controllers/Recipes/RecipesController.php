<?php

namespace App\Http\Controllers\Recipes;

use App\Http\Controllers\Controller; // Required for validation
// use App\Http\Requests\CreateCommentRequest;
use App\Models\Category;
// use App\Models\Comment;
// use App\Models\User;
use App\Models\Recipes\Recipe;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
// use Illuminate\Support\Facades\Input;
use Auth;
use DB;
// use Image;
use Route;
use Session;
// use Storage;

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
      $this->middleware('auth')->except('index','show');
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
      Session::put('fromLocation', 'recipes.index'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());
      
      if(!Route::current()->parameters['cat'] == '') {
         Session::put('cat', Route::current()->parameters['cat']);
      }

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

         $recipes = Recipe::with('user','category')
            ->published()
            ->public()
            ->orderBy('title', 'asc')
            ->paginate(15);

         if($request->key){
            $recipes = Recipe::with('user','category')
               ->published()
               ->public()
               ->where('title', 'like', $request->key . '%')
               ->orderBy('title', 'asc')
               ->paginate(15);
         }
      } else {
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
      
      // dd($byCatName);
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
   public function myFavoriteRecipes(Request $request, $key=null)
   {
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      // }

      // Fake get categories needed for back button to work properly
      $categories = [];

      if(Auth::check()) {
         $user = Auth::user();
         $recipes = $user->favorite(Recipe::class)->sortBy('title');
      }

      return view('recipes.myFavoriteRecipes', compact('recipes','categories'));
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
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      // }

      // Set the session to the current page route
      Session::put('fromLocation', 'recipes.myPrivateRecipes'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());

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
      // Check if user has required permission
      // if($this->enablePermissions) {
      //    if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      // }

      // Set the session to the current page route
      Session::put('fromLocation', 'recipes.myRecipes'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());

      if (Auth::check()) {
         $alphas = DB::table('recipes')
            ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
            ->where('user_id','=', Auth::user()->id)
            ->where('deleted_at','=',Null)
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
# ███████╗██╗  ██╗ ██████╗ ██╗    ██╗
# ██╔════╝██║  ██║██╔═══██╗██║    ██║
# ███████╗███████║██║   ██║██║ █╗ ██║
# ╚════██║██╔══██║██║   ██║██║███╗██║
# ███████║██║  ██║╚██████╔╝╚███╔███╔╝
# ╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚══╝╚══╝ 
// Display the specified resource
##################################################################################################################
   public function show(Request $request, $id, $previous=null, $next=null)
   {
      $byCatName = $request->byCatName;
      // dd($byCatName);

      $recipe = Recipe::findOrFail($id);

      // Increase the view count since this is viewed from the frontend
      DB::table('recipes')->where('id','=',$recipe->id)->increment('views',1);

      $categories = Category::where('parent_id',1)->get();

      // GET PREVIOUS RECIPE //
      // If a sub category has been selected
      if($byCatName) {
         $previous = Recipe::where('title', '<', $recipe->title)
            ->where('category_id', $byCatName)
            ->orderBy('title','asc')
            ->max('title');
      // If no sub category has been selected
      } else {
         $previous = Recipe::where('title', '<', $recipe->title)
            ->orderBy('title','asc')
            ->max('title');
      }

      // if a previous record exists
      if($previous){
         // If a sub category has been selected
         if($byCatName) {
            $p = Recipe::where('title',$previous)
               ->where('category_id', $byCatName)
               ->get();
            // return only the ID of the previous record
            $previous = $p[0]->id;
         // If no sub category has been selected
         } else {
            $p = Recipe::where('title',$previous)->get();
            // return only the ID of the previous record
            $previous = $p[0]->id;
         }
      }

      // GET NEXT RECIPE //
      // If a sub category has been selected
      if($byCatName) {
         $next = Recipe::where('title', '>', $recipe->title)
            ->where('category_id', $byCatName)
            ->orderBy('title','desc')
            ->min('title');
      // If no sub category has been selected
      } else {
         $next = Recipe::where('title', '>', $recipe->title)
         ->orderBy('title','desc')
         ->min('title');
      }

      // if a next record exists
      if($next){
         // If a sub category has been selected
         if($byCatName) {
            $n = Recipe::where('title',$next)
            ->where('category_id', $byCatName)
            ->get();
            // return only the ID of the next record
            $next = $n[0]->id;
         // If no sub category has been selected
         } else {
            $n = Recipe::where('title',$next)->get();
            // return only the ID of the next record
            $next = $n[0]->id;
         }
      }

      return view('recipes.show', compact('recipe','categories','previous','next','byCatName'));
   }


}