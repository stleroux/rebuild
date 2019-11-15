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

class FunctionsController extends RecipesController
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
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗     █████╗ ██╗     ██╗     
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝    ██╔══██╗██║     ██║     
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗      ███████║██║     ██║     
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝      ██╔══██║██║     ██║     
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗    ██║  ██║███████╗███████╗
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝╚══════╝
// Mass Delete selected rows - all selected records
##################################################################################################################
   // public function deleteAll(Request $request)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_delete')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $this->validate($request, [
   //       'checked' => 'required',
   //    ]);

   //    $checked = $request->input('checked');

   //    Recipe::whereIn('id', $checked)->forceDelete();

   //    Session::flash('success','The recipes were deleted successfully.');
   //    return redirect()->route($ref);
   // }


##################################################################################################################
# ██████╗ ██╗   ██╗██████╗ ██╗     ██╗ ██████╗ █████╗ ████████╗███████╗
# ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██╔══██╗╚══██╔══╝██╔════╝
# ██║  ██║██║   ██║██████╔╝██║     ██║██║     ███████║   ██║   █████╗  
# ██║  ██║██║   ██║██╔═══╝ ██║     ██║██║     ██╔══██║   ██║   ██╔══╝  
# ██████╔╝╚██████╔╝██║     ███████╗██║╚██████╗██║  ██║   ██║   ███████╗
# ╚═════╝  ╚═════╝ ╚═╝     ╚══════╝╚═╝ ╚═════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
// DUPLICATE :: Duplicate the specified resource in storage.
##################################################################################################################
   // public function duplicate($id)
   // {
   //    $recipe = Recipe::find($id);

   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_duplicate', $recipe)) { abort(401, 'Unauthorized Access'); }
   //    }
      
   //    $newRecipe = $recipe->replicate();
   //    $newRecipe->user_id = Auth::user()->id;
   //    $newRecipe->save();

   //    Session::flash ('success','The recipe was duplicated successfully!');
   //    return redirect()->back();
   // }


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
      return redirect()->back();
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

      $recipe = Recipe::findorFail($id);

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
         $sCats = Category::where('parent_id', $cCat)->pluck('id');

         if($sCats->count() <= 0){
            $recipes = Recipe::where('category_id', $cCat)->orderBy('title', 'asc')->get();
         } else {
            $recipes = Recipe::whereIn('category_id', $sCats)->orderBy('title', 'asc')->get();
         }
      }

      return view('recipes.printAll', compact('recipes'));
   }


##################################################################################################################
##################################################################################################################
# PRINT PDF
##################################################################################################################
##################################################################################################################
   public function printPDF($id)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_print')) { abort(401, 'Unauthorized Access'); }
      }
      
      $recipe = Recipe::findOrFail($id);
      $recipedata = ['recipe'=>$recipe];
      $pdf = PDF::loadView('recipes.printPDF', array('recipedata'=>$recipedata));
      $pdf->setOptions(['isPhpEnabled' => true,'isRemoteEnabled' => true]);
      $filename = $recipe->title . ".pdf";

      //Download Pdf
      return $pdf->download($filename);
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
   // public function publish($id)
   // {
   //    $recipe = Recipe::find($id);

   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_publish', $recipe)) { abort(401, 'Unauthorized Access'); }
   //    }

   //       $recipe->published_at = Carbon::now();
   //       $recipe->deleted_at = Null;
   //    $recipe->save();

   //    Session::flash ('success','The recipe was successfully published.');
   //    return redirect()->back();
   // }


##################################################################################################################
# ██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗     █████╗ ██╗     ██╗     
# ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║    ██╔══██╗██║     ██║     
# ██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║    ███████║██║     ██║     
# ██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║    ██╔══██║██║     ██║     
# ██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║    ██║  ██║███████╗███████╗
# ╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝    ╚═╝  ╚═╝╚══════╝╚══════╝
##################################################################################################################
   // public function publishAll(Request $request)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_publish')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $this->validate($request, [
   //       'checked' => 'required',
   //    ]);

   //    $checked = $request->input('checked');

   //    foreach ($checked as $item) {
   //       $recipe = Recipe::withTrashed()->find($item);
   //          $recipe->published_at = Carbon::now();
   //          $recipe->deleted_at = Null;
   //       $recipe->save();
   //    }

   //    Session::flash('success','The recipes were published successfully.');
   //    return redirect()->back();
   // }


##################################################################################################################
# ██████╗ ███████╗███████╗███████╗████████╗    ██╗   ██╗██╗███████╗██╗    ██╗███████╗
# ██╔══██╗██╔════╝██╔════╝██╔════╝╚══██╔══╝    ██║   ██║██║██╔════╝██║    ██║██╔════╝
# ██████╔╝█████╗  ███████╗█████╗     ██║       ██║   ██║██║█████╗  ██║ █╗ ██║███████╗
# ██╔══██╗██╔══╝  ╚════██║██╔══╝     ██║       ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║╚════██║
# ██║  ██║███████╗███████║███████╗   ██║        ╚████╔╝ ██║███████╗╚███╔███╔╝███████║
# ╚═╝  ╚═╝╚══════╝╚══════╝╚══════╝   ╚═╝         ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ ╚══════╝
// RESET VIEWS COUNT
##################################################################################################################
   // public function resetViews($id)
   // {
   //    // Check if user has required permission
   //    // if($this->enablePermissions) {
   //    //    if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
   //    // }

   //    $recipe = Recipe::find($id);
   //       $recipe->views = 0;
   //    $recipe->save();

   //    Session::flash('success','The recipe\'s views count was reset to 0.');
   //    return redirect()->back();
   // }


##################################################################################################################
# ██████╗ ███████╗███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ██████╔╝█████╗  ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ██╔══██╗██╔══╝  ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ██║  ██║███████╗███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚═╝  ╚═╝╚══════╝╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// RESTORE TRASHED FILE
##################################################################################################################
   // public function restore($id)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_restore')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $recipe = Recipe::withTrashed()->findOrFail($id);
   //    $recipe->restore();

   //    Session::flash ('success','The recipe was successfully restored.');
   //    return redirect()->route('admin.recipes.trashed');
   // }


##################################################################################################################
# ██████╗ ███████╗███████╗████████╗ ██████╗ ██████╗ ███████╗     █████╗ ██╗     ██╗     
# ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝    ██╔══██╗██║     ██║     
# ██████╔╝█████╗  ███████╗   ██║   ██║   ██║██████╔╝█████╗      ███████║██║     ██║     
# ██╔══██╗██╔══╝  ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝      ██╔══██║██║     ██║     
# ██║  ██║███████╗███████║   ██║   ╚██████╔╝██║  ██║███████╗    ██║  ██║███████╗███████╗
# ╚═╝  ╚═╝╚══════╝╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝    ╚═╝  ╚═╝╚══════╝╚══════╝
// RESTORE ALL TRASHED FILE
##################################################################################################################
   // public function restoreAll(Request $request)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_restore')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $checked = $request->input('checked');

   //    Recipe::whereIn('id', $checked)->restore();

   //    Session::flash('success','The recipes were restored successfully.');
   //    return redirect()->route('recipes.trashed');
   // }


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
         if(!checkPerm('comment_add')) { abort(401, 'Unauthorized Access'); }
      }

      $recipe = Recipe::find($id);
         $comment = new Comment();
         $comment->user_id = Auth::user()->id;
         $comment->comment = $request->comment;
      $recipe->comments()->save($comment);

      Session::flash('success','Comment added succesfully.');
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
   // public function trash($id)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_trash')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $recipe = Recipe::findOrFail($id);

   //    return view('admin.recipes.trash', compact('recipe'));
   // }


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
   // public function trashAll(Request $request)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_trash')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $this->validate($request, [
   //       'checked' => 'required',
   //    ]);

   //    $checked = $request->input('checked');

   //    Recipe::destroy($checked);

   //    Session::flash('success','The recipes were trashed successfully.');
   //    return redirect()->back();
   // }


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
   // public function trashDestroy($id)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_delete')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $recipe = Recipe::find($id);

   //    // Delete this recipe's favorites
   //    DB::table('favorites')->where('favoriteable_id', '=', $id)->delete();
   //    // Delete the recipe
   //    $recipe->delete();

   //    Session::flash('success', 'The recipe was successfully trashed!');
   //    // return redirect(Session::get('fromPage'));
   //    return redirect()->back();
   // }


##################################################################################################################
# ██╗   ██╗███╗   ██╗██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗
# ██║   ██║████╗  ██║██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║
# ██║   ██║██╔██╗ ██║██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║
# ██║   ██║██║╚██╗██║██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║
# ╚██████╔╝██║ ╚████║██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║
#  ╚═════╝ ╚═╝  ╚═══╝╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝
##################################################################################################################
   // public function unpublish($id)
   // {
   //    $recipe = Recipe::find($id);

   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_publish', $recipe)) { abort(401, 'Unauthorized Access'); }
   //    }

   //       $recipe->published_at = NULL;
   //       // Delete this recipe's favorites
   //       DB::table('favorites')->where('favoriteable_id', '=', $recipe->id)->delete();
   //    $recipe->save();

   //    Session::flash ('success','The recipe was successfully unpublished.');
   //    return redirect()->back();
   // }


##################################################################################################################
# ██╗   ██╗███╗   ██╗██████╗ ██╗   ██╗██████╗ ██╗     ██╗███████╗██╗  ██╗     █████╗ ██╗     ██╗     
# ██║   ██║████╗  ██║██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██║  ██║    ██╔══██╗██║     ██║     
# ██║   ██║██╔██╗ ██║██████╔╝██║   ██║██████╔╝██║     ██║███████╗███████║    ███████║██║     ██║     
# ██║   ██║██║╚██╗██║██╔═══╝ ██║   ██║██╔══██╗██║     ██║╚════██║██╔══██║    ██╔══██║██║     ██║     
# ╚██████╔╝██║ ╚████║██║     ╚██████╔╝██████╔╝███████╗██║███████║██║  ██║    ██║  ██║███████╗███████╗
#  ╚═════╝ ╚═╝  ╚═══╝╚═╝      ╚═════╝ ╚═════╝ ╚══════╝╚═╝╚══════╝╚═╝  ╚═╝    ╚═╝  ╚═╝╚══════╝╚══════╝
##################################################################################################################
   // public function unpublishAll(Request $request)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_publish')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $this->validate($request, [
   //       'checked' => 'required',
   //    ]);

   //    $checked = $request->input('checked');

   //    foreach ($checked as $item) {
   //       $recipe = Recipe::withTrashed()->find($item);
   //          $recipe->published_at = Null;
   //          // Delete this recipe's favorites
   //          DB::table('favorites')->where('favoriteable_id', '=', $recipe->id)->delete();
   //       $recipe->save();
   //    }
      
   //    Session::flash('success','The recipes were unpublished successfully.');
   //    return redirect()->route('recipes.'. Session::get('pageName'));
   // }


}
