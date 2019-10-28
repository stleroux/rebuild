<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Posts\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Carbon\Carbon;
use DB;
use File;
use Image;
use Log;
use Purifier;
use Session;
use Storage;
use URL;

class FunctionsController extends Controller
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
      $this->middleware('auth')->except('archives');
      $this->enablePermissions = false;
   }


##################################################################################################################
# ██╗███╗   ███╗ █████╗  ██████╗ ███████╗    ██████╗ ███████╗██╗     ███████╗████████╗███████╗
# ██║████╗ ████║██╔══██╗██╔════╝ ██╔════╝    ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝
# ██║██╔████╔██║███████║██║  ███╗█████╗      ██║  ██║█████╗  ██║     █████╗     ██║   █████╗  
# ██║██║╚██╔╝██║██╔══██║██║   ██║██╔══╝      ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝  
# ██║██║ ╚═╝ ██║██║  ██║╚██████╔╝███████╗    ██████╔╝███████╗███████╗███████╗   ██║   ███████╗
# ╚═╝╚═╝     ╚═╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝    ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝
##################################################################################################################
   public function deleteImage($id)
   {
      // Find the user
      $post = Post::find($id);

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('post_edit', $post)) { abort(401, 'Unauthorized Access'); }
      }

         // Delete the image from the system
         File::delete('_posts/' . $post->image);
         // Update database
         $post->image = NULL;
      $post->save();
      
      // Set flash data with success message
      Session::flash ('success', 'The post\'s image was successfully removed!');

      // Send the user back to the Show page
      return redirect()->route('admin.posts.edit', compact('post'));
   }


##################################################################################################################
# ██╗███╗   ███╗ █████╗  ██████╗ ███████╗    ██╗   ██╗██╗███████╗██╗    ██╗
# ██║████╗ ████║██╔══██╗██╔════╝ ██╔════╝    ██║   ██║██║██╔════╝██║    ██║
# ██║██╔████╔██║███████║██║  ███╗█████╗      ██║   ██║██║█████╗  ██║ █╗ ██║
# ██║██║╚██╔╝██║██╔══██║██║   ██║██╔══╝      ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║
# ██║██║ ╚═╝ ██║██║  ██║╚██████╔╝███████╗     ╚████╔╝ ██║███████╗╚███╔███╔╝
# ╚═╝╚═╝     ╚═╝╚═╝  ╚═╝ ╚═════╝ ╚══════╝      ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ 
##################################################################################################################
   public function viewImage($id)
   {
      $post = Post::find($id);

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('post_browse', $post)) { abort(401, 'Unauthorized Access'); }
      }

      return view('admin.posts.viewImage')->withPost($post);
   }


##################################################################################################################
# ██████╗ ██████╗ ██╗███╗   ██╗████████╗
# ██╔══██╗██╔══██╗██║████╗  ██║╚══██╔══╝
# ██████╔╝██████╔╝██║██╔██╗ ██║   ██║   
# ██╔═══╝ ██╔══██╗██║██║╚██╗██║   ██║   
# ██║     ██║  ██║██║██║ ╚████║   ██║   
# ╚═╝     ╚═╝  ╚═╝╚═╝╚═╝  ╚═══╝   ╚═╝   
##################################################################################################################
   public function printPost($id)
   {
      $post = Post::find($id);

      return view('admin.posts.print')->withPost($post);
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
      $post = Post::find($id);
      
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('post_edit')) { abort(401, 'Unauthorized Access'); }
      }

      $post->published_at = Carbon::now();
      if($post->deleted_at != Null) {
         $post->deleted_at = Null;
      }

      $post->save();

      Session::flash ('success','The post was successfully published.');
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
         if(!checkPerm('post_edit')) { abort(401, 'Unauthorized Access'); }
      }

      $checked = $request->input('checked');

      foreach ($checked as $item) {
         $post = Post::withTrashed()->find($item);
            $post->published_at = Carbon::now();
            $post->deleted_at = Null;
         $post->save();
      }

      Session::flash('success','The recipes were published successfully.');
      return redirect(Session::get('fromPage'));
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
         if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      }

      $post = Post::withTrashed()->findOrFail($id);

      // Check if user has required permission
      if(!checkPerm('post_edit', $post)) { abort(401, 'Unauthorized Access'); }

      $post->restore();

      Session::flash ('success','The post was successfully restored.');
      return redirect(Session::get('fromPage'));
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
         if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      }

      $checked = $request->input('checked');

      Post::withTrashed()->restore($checked);

      Session::flash('success','The posts have been restored successfully.');
      return redirect(Session::get('fromPage'));
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
      $post = Post::findOrFail($id);

      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('post_browse', $post)) { abort(401, 'Unauthorized Access'); }
      }

      return view('admin.posts.trash', compact('post'));
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
         if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      }

      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');

      Post::destroy($checked);

      Session::flash('success','The posts were trashed successfully.');
      return redirect(Session::get('fromPage'));
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
   public function trashDestroy($id, $page=null)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('post_browse', $post)) { abort(401, 'Unauthorized Access'); }
      }

      $post = Post::find($id);
         $post->published_at = null;
      $post->save();

      $post->delete();

      Session::flash('success', 'The post was successfully trashed!');
      return redirect(Session::get('fromPage'));
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
         if(!checkPerm('post_edit')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('pageName', 'unpublish');

     $post = Post::find($id);
       $post->published_at = NULL;
     $post->save();

     Session::flash ('success','The post was successfully unpublished.');
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
         if(!checkPerm('post_edit')) { abort(401, 'Unauthorized Access'); }
      }

      $validatedData = $request->validate([
         'checked' => 'required',
      ]);

     $checked = $request->input('checked');

     foreach ($checked as $item) {
      $post = Post::find($item);
         $post->published_at = Null;
       $post->save();
     }

     Session::flash('success','The posts were unpublished successfully.');
     return redirect()->back();
   }



}