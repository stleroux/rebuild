<?php

namespace App\Http\Controllers\Admin\Recipes;

use App\Http\Controllers\Controller; // Required for validation
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

class ExtraViewsController extends RecipesController
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
      // $this->middleware('auth')->except('archives','myFavorites','myPrivateRecipes','myRecipes');
      $this->middleware('auth')->except('archives');
      $this->enablePermissions = false;
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
   public function archives($year, $month)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_future')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromLocation', 'recipes.archives'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());

      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

      $archives = Recipe::with('user', 'category')
         ->whereYear('published_at','=', $year)
         ->whereMonth('published_at','=', $month)
         ->where('published_at', '<=', Carbon::now())
         ->orderBy('title')
         ->get();

      return view('recipes.archives', compact('archives','year','month','categories'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_future')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromLocation', 'recipes.future'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());

      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

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

      return view('admin.recipes.pages.future', compact('recipes','letters','categories'));
   }





// ##################################################################################################################
// # ███╗   ███╗██╗   ██╗    ██████╗ ██████╗ ██╗██╗   ██╗ █████╗ ████████╗███████╗    ██████╗ ███████╗ ██████╗██╗██████╗ ███████╗███████╗
// # ████╗ ████║╚██╗ ██╔╝    ██╔══██╗██╔══██╗██║██║   ██║██╔══██╗╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝██╔════╝██║██╔══██╗██╔════╝██╔════╝
// # ██╔████╔██║ ╚████╔╝     ██████╔╝██████╔╝██║██║   ██║███████║   ██║   █████╗      ██████╔╝█████╗  ██║     ██║██████╔╝█████╗  ███████╗
// # ██║╚██╔╝██║  ╚██╔╝      ██╔═══╝ ██╔══██╗██║╚██╗ ██╔╝██╔══██║   ██║   ██╔══╝      ██╔══██╗██╔══╝  ██║     ██║██╔═══╝ ██╔══╝  ╚════██║
// # ██║ ╚═╝ ██║   ██║       ██║     ██║  ██║██║ ╚████╔╝ ██║  ██║   ██║   ███████╗    ██║  ██║███████╗╚██████╗██║██║     ███████╗███████║
// # ╚═╝     ╚═╝   ╚═╝       ╚═╝     ╚═╝  ╚═╝╚═╝  ╚═══╝  ╚═╝  ╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝ ╚═════╝╚═╝╚═╝     ╚══════╝╚══════╝
// // Display a listing of the resource that belong to a specific user.
// ##################################################################################################################
//    public function myPrivateRecipes($key=null)
//    {
//       // Check if user has required permission
//       if($this->enablePermissions) {
//          if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
//       }

//       // Set the session to the current page route
//       Session::put('fromLocation', 'recipes.myPrivateRecipes'); // Required for Alphabet listing
//       Session::put('fromPage', url()->full());

//       if (Auth::check()) {
//          // Get list of recips by year and month
//          $recipelinks = DB::table('recipes')
//             ->select(DB::raw('YEAR(published_at) year, MONTH(published_at) month, MONTHNAME(published_at) month_name, COUNT(*) recipe_count'))
//             ->where('published_at', '<=', Carbon::now())
//             ->where('personal', '=', 1)
//             ->groupBy('year')
//             ->groupBy('month')
//             ->orderBy('year', 'desc')
//             ->orderBy('month', 'desc')
//             ->get();

//          $alphas = DB::table('recipes')
//             ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
//             ->where('user_id','=', Auth::user()->id)
//             ->where('personal', '=', 1)
//             ->orderBy('letter')
//             ->get();

//          $letters = [];
//          foreach($alphas as $alpha) {
//             $letters[] = $alpha->letter;
//          }

//          // If $key value is passed
//          if ($key) {
//             $recipes = Recipe::with('user','category')
//                ->myRecipes()
//                ->private()
//                ->where('title', 'like', $key . '%')
//                ->orderBy('title', 'asc')
//                ->paginate(18);
//          } else {
//             // No $key value is passed
//             $recipes = Recipe::with('user','category')
//                ->myRecipes()
//                ->private()
//                ->orderBy('title', 'asc')
//                ->paginate(18);
//          }

//          return view('recipes.myPrivateRecipes', compact('recipes','letters', 'recipelinks'));
//       } else {
//          return ('You need to be logged in');
//       }
//    }


// ##################################################################################################################
// # ███╗   ███╗██╗   ██╗    ██████╗ ███████╗ ██████╗██╗██████╗ ███████╗███████╗
// # ████╗ ████║╚██╗ ██╔╝    ██╔══██╗██╔════╝██╔════╝██║██╔══██╗██╔════╝██╔════╝
// # ██╔████╔██║ ╚████╔╝     ██████╔╝█████╗  ██║     ██║██████╔╝█████╗  ███████╗
// # ██║╚██╔╝██║  ╚██╔╝      ██╔══██╗██╔══╝  ██║     ██║██╔═══╝ ██╔══╝  ╚════██║
// # ██║ ╚═╝ ██║   ██║       ██║  ██║███████╗╚██████╗██║██║     ███████╗███████║
// # ╚═╝     ╚═╝   ╚═╝       ╚═╝  ╚═╝╚══════╝ ╚═════╝╚═╝╚═╝     ╚══════╝╚══════╝
// // Display a listing of the resource that belong to a specific user.
// ##################################################################################################################
//    public function myRecipes($key=null)
//    {
//       // Check if user has required permission
//       if($this->enablePermissions) {
//          if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
//       }

//       // Set the session to the current page route
//       Session::put('fromLocation', 'recipes.myRecipes'); // Required for Alphabet listing
//       Session::put('fromPage', url()->full());

//       if (Auth::check()) {
//          $alphas = DB::table('recipes')
//             ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
//             ->where('user_id','=', Auth::user()->id)
//             ->orderBy('letter')
//             ->get();

//          $letters = [];
//          foreach($alphas as $alpha) {
//             $letters[] = $alpha->letter;
//          }

//          // If $key value is passed
//          if ($key) {
//             $recipes = Recipe::with('user','category')
//                ->myRecipes()
//                ->where('title', 'like', $key . '%')
//                ->orderBy('title', 'asc')
//                ->paginate(18);
//          } else {
//             // No $key value is passed
//             $recipes = Recipe::with('user','category')
//                ->myRecipes()
//                ->orderBy('title', 'asc')
//                ->paginate(18);
//          }

//          return view('recipes.myRecipes', compact('recipes','letters'));
//       } else {
//          return ('You need to be logged in');
//       }
//    }


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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_new')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromLocation', 'recipes.newRecipes'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());

      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

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

      return view('admin.recipes.pages.newRecipes', compact('recipes','letters','categories'));
   }


##################################################################################################################
# ██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗███████╗██████╗ 
# ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║██╔════╝██╔══██╗
# ██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║█████╗  ██║  ██║
# ██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║██╔══╝  ██║  ██║
# ██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║███████╗██████╔╝
# ╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝ 
##################################################################################################################
   // public function published(Request $request, $key=null)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_published')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    // Set the session to the current page route
   //    Session::put('fromLocation', 'recipes.published'); // Required for Alphabet listing
   //    Session::put('fromPage', url()->full());

   //    // Get all categories related to Recipe Category (id=>1)
   //    $categories = Category::where('parent_id',1)->get();

   //   $alphas = DB::table('recipes')
   //    ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
   //    ->where('published_at','<', Carbon::Now())
   //    ->where('deleted_at','=', Null)
   //    ->where('personal', '!=', 1)
   //    ->orderBy('letter')
   //    ->get();

   //    $letters = [];
   //    foreach($alphas as $alpha) {
   //      $letters[] = $alpha->letter;
   //    }

   //    // If $key value is passed
   //    if ($key) {
   //       $recipes = Recipe::with('user','category')
   //          ->published()
   //          ->public()
   //          ->where('title', 'like', $key . '%')
   //          ->orderBy('title', 'asc')
   //          ->get();
   //    } else {
   //       // No $key value is passed
   //       $recipes = Recipe::with('user','category')
   //          ->published()
   //          ->public()
   //          ->get();
   //    }

   //    return view('recipes.published', compact('recipes','letters','categories'));
   // }


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

      // Set the session to the current page route
      Session::put('fromLocation', 'admin.recipes.trashed'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());

      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

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
      
      return view('admin.recipes.pages.trashed', compact('recipes','letters','categories'));
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
   // public function trashedView($id)
   // {
   //    $recipe = Recipe::withTrashed()->find($id);

   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_trashed')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    return view('recipes.trashedView', compact('recipe'));
   // }


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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_published')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromLocation', 'admin.recipes.unpublished'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());

      // Get all categories related to Recipe Category (id=>1)
      $categories = Category::where('parent_id',1)->get();

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

      return view('admin.recipes.pages.unpublished', compact('recipes','letters','categories'));
   }


}