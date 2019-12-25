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

class ExtraViewsController extends Controller
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
# ███╗   ██╗███████╗██╗    ██╗    ██████╗  ██████╗ ███████╗████████╗███████╗
# ████╗  ██║██╔════╝██║    ██║    ██╔══██╗██╔═══██╗██╔════╝╚══██╔══╝██╔════╝
# ██╔██╗ ██║█████╗  ██║ █╗ ██║    ██████╔╝██║   ██║███████╗   ██║   ███████╗
# ██║╚██╗██║██╔══╝  ██║███╗██║    ██╔═══╝ ██║   ██║╚════██║   ██║   ╚════██║
# ██║ ╚████║███████╗╚███╔███╔╝    ██║     ╚██████╔╝███████║   ██║   ███████║
# ╚═╝  ╚═══╝╚══════╝ ╚══╝╚══╝     ╚═╝      ╚═════╝ ╚══════╝   ╚═╝   ╚══════╝
// Display a listing of the resource that were created since the user's last login.
##################################################################################################################
   public function futurePosts(Request $request, $key=null)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('post_edit')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('posts')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         ->where('published_at', '>=' , Carbon::now())
         ->orderBy('letter')
         ->get();

      $letters = [];
      foreach($alphas as $alpha) {
         $letters[] = $alpha->letter;
      }

      // If $key value is passed
      if ($key) {
         $posts = Post::futurePosts()
            ->with('user','category')
            ->where('title', 'like', $key . '%')
            ->get();
      } else {
         $posts = Post::futurePosts()
            ->with('user','category')
            ->get();
      }

      return view('admin.posts.pages.futurePosts', compact('posts','letters'));
   }


##################################################################################################################
# ███╗   ██╗███████╗██╗    ██╗    ██████╗  ██████╗ ███████╗████████╗███████╗
# ████╗  ██║██╔════╝██║    ██║    ██╔══██╗██╔═══██╗██╔════╝╚══██╔══╝██╔════╝
# ██╔██╗ ██║█████╗  ██║ █╗ ██║    ██████╔╝██║   ██║███████╗   ██║   ███████╗
# ██║╚██╗██║██╔══╝  ██║███╗██║    ██╔═══╝ ██║   ██║╚════██║   ██║   ╚════██║
# ██║ ╚████║███████╗╚███╔███╔╝    ██║     ╚██████╔╝███████║   ██║   ███████║
# ╚═╝  ╚═══╝╚══════╝ ╚══╝╚══╝     ╚═╝      ╚═════╝ ╚══════╝   ╚═╝   ╚══════╝
// Display a listing of the resource that were created since the user's last login.
##################################################################################################################
   public function newPosts(Request $request, $key=null)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('post_edit')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('posts')
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
         $posts = Post::newPosts()
            ->with('user','category')
            ->where('title', 'like', $key . '%')
            ->get();
      } else {
         $posts = Post::newPosts()
            ->with('user','category')
            ->get();
      }

      return view('admin.posts.pages.newPosts', compact('posts','letters'));
   }


##################################################################################################################
# ███████╗██╗  ██╗ ██████╗ ██╗    ██╗    ████████╗██████╗  █████╗ ███████╗██╗  ██╗███████╗██████╗ 
# ██╔════╝██║  ██║██╔═══██╗██║    ██║    ╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██║  ██║██╔════╝██╔══██╗
# ███████╗███████║██║   ██║██║ █╗ ██║       ██║   ██████╔╝███████║███████╗███████║█████╗  ██║  ██║
# ╚════██║██╔══██║██║   ██║██║███╗██║       ██║   ██╔══██╗██╔══██║╚════██║██╔══██║██╔══╝  ██║  ██║
# ███████║██║  ██║╚██████╔╝╚███╔███╔╝       ██║   ██║  ██║██║  ██║███████║██║  ██║███████╗██████╔╝
# ╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚══╝╚══╝        ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝
##################################################################################################################
   public function showTrashed($id)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      }

      $post = Post::onlyTrashed()->find($id);

      // find all categories in the categories table and pass them to the view
      $categories = Category::whereHas('module', function ($query) {
         $query->where('name', 'like', 'posts');
      })->get();

      // Create an empty array to store the categories
      $cats = [];

      // Store the category values into the $cats array
      foreach ($categories as $category) {
         $cats[$category->id] = $category->name;
      }

      $tags = Tag::all();

      return view ('admin.posts.pages.showTrashed')
         ->withPost($post)
         ->withTags($tags)
         ->withCategories($cats);
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
         if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('posts')
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
         $posts = Post::with('user','category')->onlyTrashed()->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
      } else {
         $posts = Post::with('user','category')->onlyTrashed()->orderBy('id','desc')->get();
      }
      
      return view('admin.posts.pages.trashed', compact('posts','letters'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('post_edit')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('posts')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         ->whereNull('published_at')
         ->where('deleted_at','=', Null)
         ->orderBy('letter')
         ->get();

      $letters = [];
      foreach($alphas as $alpha) {
        $letters[] = $alpha->letter;
      }

      // If $key value is passed
      if ($key) {
         $posts = Post::unpublished()
            ->with('user','category')
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
      } else {
         // No $key value is passed
         $posts = Post::unpublished()
            ->with('user','category')
            ->orderBy('id','desc')
            ->get();
      }

      return view('admin.posts.pages.unpublished', compact('posts','letters', 'postlinks'));
   }



}