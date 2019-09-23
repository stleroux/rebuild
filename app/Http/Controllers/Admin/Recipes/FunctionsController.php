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
# ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗     █████╗ ██████╗ ██████╗ 
# ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝    ██╔══██╗██╔══██╗██╔══██╗
# █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗      ███████║██║  ██║██║  ██║
# ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝      ██╔══██║██║  ██║██║  ██║
# ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗    ██║  ██║██████╔╝██████╔╝
# ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚═════╝ ╚═════╝ 
##################################################################################################################
   // public function favoriteAdd($id)
   // {
   //    // Check if user has required permission
   //    // if($this->enablePermissions) {
   //    //    if(!checkPerm('recipe_favorite')) { abort(401, 'Unauthorized Access'); }
   //    // }

   //    $recipe = Recipe::find($id);
   //    $recipe->addFavorite();

   //    Session::flash ('success','The recipe was successfully added to your Favorites list!');
   //    return redirect()->back();
   // }


##################################################################################################################
# ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗    ██████╗ ███████╗███╗   ███╗ ██████╗ ██╗   ██╗███████╗
# ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝████╗ ████║██╔═══██╗██║   ██║██╔════╝
# █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗      ██████╔╝█████╗  ██╔████╔██║██║   ██║██║   ██║█████╗  
# ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝      ██╔══██╗██╔══╝  ██║╚██╔╝██║██║   ██║╚██╗ ██╔╝██╔══╝  
# ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗    ██║  ██║███████╗██║ ╚═╝ ██║╚██████╔╝ ╚████╔╝ ███████╗
# ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝╚═╝     ╚═╝ ╚═════╝   ╚═══╝  ╚══════╝
##################################################################################################################
   // public function favoriteRemove($id)
   // {
   //    // Check if user has required permission
   //    // if($this->enablePermissions) {
   //    //    if(!checkPerm('recipe_favorite')) { abort(401, 'Unauthorized Access'); }
   //    // }

   //    $recipe = Recipe::find($id);
   //    $recipe->removeFavorite();

   //    Session::flash ('success','The recipe was successfully removed to your Favorites list!');
   //    return redirect()->back();
   // }


##################################################################################################################
# ██████╗ ██████╗ ██╗███╗   ██╗████████╗
# ██╔══██╗██╔══██╗██║████╗  ██║╚══██╔══╝
# ██████╔╝██████╔╝██║██╔██╗ ██║   ██║   
# ██╔═══╝ ██╔══██╗██║██║╚██╗██║   ██║   
# ██║     ██║  ██║██║██║ ╚████║   ██║   
# ╚═╝     ╚═╝  ╚═╝╚═╝╚═╝  ╚═══╝   ╚═╝   
##################################################################################################################
   // public function print($id)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_print')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $recipe = Recipe::findorFail($id);

   //    return view('recipes.print', compact('recipe'));
   // }


##################################################################################################################
# ██████╗ ██████╗ ██╗███╗   ██╗████████╗     █████╗ ██╗     ██╗     
# ██╔══██╗██╔══██╗██║████╗  ██║╚══██╔══╝    ██╔══██╗██║     ██║     
# ██████╔╝██████╔╝██║██╔██╗ ██║   ██║       ███████║██║     ██║     
# ██╔═══╝ ██╔══██╗██║██║╚██╗██║   ██║       ██╔══██║██║     ██║     
# ██║     ██║  ██║██║██║ ╚████║   ██║       ██║  ██║███████╗███████╗
# ╚═╝     ╚═╝  ╚═╝╚═╝╚═╝  ╚═══╝   ╚═╝       ╚═╝  ╚═╝╚══════╝╚══════╝
##################################################################################################################
   // public function printAll($category)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('recipe_print')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    if($category == "all"){
   //       $recipes = Recipe::orderBy('title', 'asc')->get();
   //    } else {
   //       $cCat = Category::where('name', $category)->pluck('id');
   //       $sCats = Category::where('parent_id', $cCat)->pluck('id');

   //       if($sCats->count() <= 0){
   //          $recipes = Recipe::where('category_id', $cCat)->orderBy('title', 'asc')->get();
   //       } else {
   //          $recipes = Recipe::whereIn('category_id', $sCats)->orderBy('title', 'asc')->get();
   //       }
   //    }

   //    return view('recipes.printAll', compact('recipes'));
   // }


##################################################################################################################
##################################################################################################################
# PRINT PDF
##################################################################################################################
##################################################################################################################
//    public function printPDF($id)
//     {
//       // // This  $data array will be passed to our PDF blade
//       // // $data = [
//       // //    'title' => 'First PDF for Medium',
//       // //    'heading' => 'Hello from 99Points.info',
//       // //    'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.'        
//       // // ];
//       // $recipe = Recipe::findOrFail($id);
//       // // dd($recipe);

//       // // Increase the view count since this is viewed from the frontend
//       // // DB::table('recipes')->where('id','=',$recipe->id)->increment('views',1);

//       // // $categories = Category::where('parent_id',1)->get();

//       // // return view('recipes.show', compact('recipe','categories'));
        
//       // // $pdf = PDF::loadView('recipes.printPDF', $data);
//       // $pdf = PDF::loadView('recipes.printPDF', $recipe);
//       // // dd($pdf);
//       // return $pdf->download('medium.pdf');



// $recipe = Recipe::findOrFail($id);
// // dd($recipe);
// $recipedata = ['recipe'=>$recipe];
// $pdf = PDF::loadView('recipes.print', array('recipedata'=>$recipedata));
// $pdf->setOptions(['isPhpEnabled' => true,'isRemoteEnabled' => true]);
// $filename = "generatepdf.pdf";
// // Save file to the directory
// // $pdf->save('generatepdf/'.$filename);
// //Download Pdf
// return $pdf->download('generatepdf.pdf');
// // Or return to view pdf
// //return view('pdfview');

//     }



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
      $recipe = Recipe::find($id);

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_publish', $recipe)) { abort(401, 'Unauthorized Access'); }
      }

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
      return redirect()->route('admin.recipes.trashed');
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
# ███████╗████████╗ ██████╗ ██████╗ ███████╗     ██████╗ ██████╗ ███╗   ███╗███╗   ███╗███████╗███╗   ██╗████████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝    ██╔════╝██╔═══██╗████╗ ████║████╗ ████║██╔════╝████╗  ██║╚══██╔══╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗      ██║     ██║   ██║██╔████╔██║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝      ██║     ██║   ██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗    ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝     ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   
##################################################################################################################
   // public function storeComment(CreateCommentRequest $request, $id)
   // {
   //    // Check if user has required permission
   //    if($this->enablePermissions) {
   //       if(!checkPerm('comment_add')) { abort(401, 'Unauthorized Access'); }
   //    }

   //    $recipe = Recipe::find($id);
   //       $comment = new Comment();
   //       $comment->user_id = Auth::user()->id;
   //       $comment->comment = $request->comment;
   //    $recipe->comments()->save($comment);

   //    Session::flash('success','Comment added succesfully.');
   //    // return redirect()->route('recipes.show', $recipe->id);
   //    return redirect()->back();
   // }


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

      return view('admin.recipes.trash', compact('recipe'));
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
      return redirect()->back();
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

      Session::flash('success', 'The recipe was successfully trashed!');
      // return redirect(Session::get('fromPage'));
      return redirect()->back();
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
      $recipe = Recipe::find($id);

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('recipe_publish', $recipe)) { abort(401, 'Unauthorized Access'); }
      }

         $recipe->published_at = NULL;
         // Delete this recipe's favorites
         DB::table('favorites')->where('favoriteable_id', '=', $recipe->id)->delete();
      $recipe->save();

      Session::flash ('success','The recipe was successfully unpublished.');
      return redirect()->back();
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


}
