<?php

namespace App\Http\Controllers\Admin\Recipes;

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
use File;
use Image;
use Route;
use Session;
use Storage;

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
      $this->middleware('auth');
      $this->enablePermissions = false;
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

      // Get id of specified category
      $pcat = Category::where('name','recipes')->first();
      
      // Get all related categories
      $categories = Category::where('parent_id', $pcat->id)->with('children')->get();

      return view('admin.recipes.create', compact('categories'));
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

      return view('admin.recipes.delete', compact('recipe'));
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
      return redirect()->route('admin.recipes.trashed');
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

      return view('admin.recipes.edit', compact('recipe','categories'));
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
   public function index(Request $request, $key=null) // PUBLISHED RECIPES
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_browse')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromLocation', 'admin.recipes.index'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());

      // Get all categories related to Recipe Category (id=>1)
      // $categories = Category::where('parent_id',1)->get();
      $categories = [];

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
            ->orderBy('title', 'asc')
            ->get();
      }

      // return view('admin.recipes.index', compact('recipes','letters','categories'));
      return view('admin.recipes.index', compact('recipes','letters'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_show')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::withTrashed()->findOrFail($id);

      // Increase the view count since this is viewed from the frontend
      // DB::table('recipes')->where('id','=',$recipe->id)->increment('views',1);

      $categories = Category::where('parent_id',1)->get();

      // get previous project
      $previous = Recipe::where('title', '<', $recipe->title)->orderBy('title','asc')->max('title');
      if($previous){
         $p = Recipe::where('title',$previous)->get();
         $previous = $p[0]->id;
      }

      // get next project
      $next = Recipe::where('title', '>', $recipe->title)->orderBy('title','desc')->min('title');
      if($next){
         $n = Recipe::where('title',$next)->get();
         $next = $n[0]->id;
      }

      return view('admin.recipes.show', compact('recipe','categories','previous','next'));
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
      return redirect()->back();
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

      if(Session::get('fromPage') === 'recipes.index') {
         return redirect()->route('recipes.index', 'all');
      } else {
         // return redirect()->route(Session::get('fromPage'));
         return redirect(Session::get('fromPage'));
      }
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
      if($this->enablePermissions) {
         if(!checkPerm('recipe_show')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::withTrashed()->find($id);

      $categories = Category::where('parent_id',1)->get();

      return view('recipes.view', compact('recipe','categories'));
   }


}
