<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Post;
use App\Models\Tag;

use App\Models\Category;
use App\Models\User;
use Auth;
use DB;
use Carbon\Carbon;
use File;
use Image;
use Purifier;
use Session;
use Storage;
use Log;
use URL;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostsController extends Controller
{

##################################################################################################################
#  ██████╗ ██████╗ ███╗   ██╗███████╗████████╗██████╗ ██╗   ██╗ ██████╗████████╗
# ██╔════╝██╔═══██╗████╗  ██║██╔════╝╚══██╔══╝██╔══██╗██║   ██║██╔════╝╚══██╔══╝
# ██║     ██║   ██║██╔██╗ ██║███████╗   ██║   ██████╔╝██║   ██║██║        ██║   
# ██║     ██║   ██║██║╚██╗██║╚════██║   ██║   ██╔══██╗██║   ██║██║        ██║   
# ╚██████╗╚██████╔╝██║ ╚████║███████║   ██║   ██║  ██║╚██████╔╝╚██████╗   ██║   
#  ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝  ╚═════╝   ╚═╝   
##################################################################################################################
	public function __construct() {
		// only allow authenticated users to access these pages
		$this->middleware('auth');
      $this->enablePermissions = false;

		//Log::useFiles(storage_path().'/logs/posts.log');
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
		if(!checkPerm('post_create')) { abort(401, 'Unauthorized Access'); }

		// Get all categories related to Posts Category
		$cats = Category::where('name','posts')->first();
		$categories = Category::where('parent_id', $cats->id)->get();
		$tags = Tag::all();

		return view('posts.create', compact('categories','tags'));
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
		if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

		$post = Post::onlyTrashed()->findOrFail($id);

		Session::put('pageName', 'trashed');

		return view('posts.delete', compact('post'));
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
      Session::put('fromPage', '');

		$this->validate($request, [
		   'checked' => 'required',
		]);

		$checked = $request->input('checked');

		Post::whereIn('id', $checked)->forceDelete();

		Session::flash('delete','The posts were deleted successfully.');
		return redirect()->route('posts.trashed');
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
		if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

		$post = Post::withTrashed()->find($id);

		// remove any references to this post from the post_tag table
		$post->tags()->detach();

		// Delete the associated image if any
		File::delete('_posts/' . $post->image_path);

		$post->forceDelete();

		// Save entry to log file using built-in Monolog
		// Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED post (" . $post->id . ")\r\n", 
		// 	[json_decode($post, true)]
		// );

		Session::flash('success', 'The post was successfully deleted!');
		return redirect()->route('posts.trashed');
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
		// find the post in the db and save it to a variable
		$post = Post::find($id);

		// Check if user has required permission
		if(!checkPerm('post_edit', $post)) { abort(401, 'Unauthorized Access'); }

		// Get all categories related to Posts Category
		$cats = Category::where('name','posts')->first();
		$categories = Category::where('parent_id', $cats->id)->get();
		$tags = Tag::all();

		// find the associated tags
		$tags = Tag::all()->pluck('id','name');

		return view('posts.edit', compact('post','categories','tags'));
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

		// Delete the image from the system
		File::delete('_posts/' . $post->image);
		
		// Update database
		$post->image = NULL;
		$post->save();
		
		// Set flash data with success message
		Session::flash ('success', 'The post\'s image was successfully removed!');

		// Send the user back to the Show page
		return redirect()->route('posts.edit', compact('post'));
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
		
		return view('posts.viewImage')->withPost($post);
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
	public function index(Request $request, $key=null)
	{
		// Check if user has required permission
		if(!checkPerm('post_index')) { abort(401, 'Unauthorized Access'); }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());
      // Session::put('fromLocation', 'posts.index'); // Required for Alphabet listing
      // Session::put('fromLocation', 'index');

		//$alphas = range('A', 'Z');
		$alphas = DB::table('posts')
			->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
			->where('published_at','<', Carbon::Now())
			->where('deleted_at','=', Null)
			->orderBy('letter')
			->get();

		$letters = [];
		foreach($alphas as $alpha) {
		  $letters[] = $alpha->letter;
		}

		// If $key value is passed
		if ($key) {
			$posts = Post::published()
				->with('user','category')
				->where('title', 'like', $key . '%')
				->orderBy('title', 'asc')
				->get();
		} else {
			// No $key value is passed
			$posts = Post::published()
				->with('user','category')
				->orderBy('id','desc')
				->get();
		}
		
		return view('posts.index', compact('posts','letters'));
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
		// if(!checkACL('guest')) {
		//     return view('posts.errors.403');
		// }

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

		return view('posts.newPosts', compact('posts','letters'));
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

		// Save entry to log file using built-in Monolog
		//Log::info(Auth::user()->username . " (" . Auth::user()->id . ") PRINTED post (" . $post->id . ")\r\n", [json_decode($post, true)]);

		return view('posts.print')->withPost($post);
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

		$post->published_at = Carbon::now();
		if($post->deleted_at != Null) {
			$post->deleted_at = Null;
		}

		$post->save();

		Session::flash ('success','The post was successfully published.');
		// return redirect(Session::get('fromPage'));
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
		$checked = $request->input('checked');

		foreach ($checked as $item) {
			$post = Post::withTrashed()->find($item);
				$post->published_at = Carbon::now();
				$post->deleted_at = Null;
			$post->save();
		}

		Session::flash('success','The recipes were published successfully.');

		// return redirect()->route('posts.'. Session::get('pageName'));
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
		$post = Post::withTrashed()->findOrFail($id);

		$post->restore();

		Session::flash ('success','The post was successfully restored.');
		// return redirect()->route('posts.trashed');
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
		// dd($request);
		// Pass along the ROUTE value of the previous page
		// $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

		$checked = $request->input('checked');

		Post::withTrashed()->restore($checked);

		Session::flash('success','The posts have been restored successfully.');
		// return redirect()->route('posts.'. Session::get('pageName'));
		return redirect(Session::get('fromPage'));
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
		if(!checkPerm('post_show')) { abort(401, 'Unauthorized Access'); }

		$post = Post::find($id);

	  // Increase the view count if viewed from the frontend
     if (url()->previous() == url('/blog/')) {
         DB::table('posts')->where('id','=',$post->id)->increment('views',1);
     }

		// Get all categories related to Posts Category
		$cats = Category::where('name','posts')->first();
		$categories = Category::where('parent_id', $cats->id)->get();

		$tags = Tag::all();

		return view ('posts.show')
			->withPost($post)
			->withTags($tags)
			->withCategories($cats);
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
		if(!checkPerm('post_show')) { abort(401, 'Unauthorized Access'); }

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

		return view ('showTrashed')
			->withPost($post)
			->withTags($tags)
			->withCategories($cats);
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
	public function store(CreatePostRequest $request)
	{
		// save the data in the database
		$post = new Post;

			$post->title = $request->title;
			// $post->slug = $request->slug; // slug is handled in the model
			$post->category_id = $request->category_id;
			$post->body = $request->body;
			// $post->body = Purifier::clean($request->body);
			$post->user_id = Auth::user()->id;
			$post->modified_by_id = Auth::user()->id;

			// Save the image if there is one
			if ($request->hasFile('image')) {
				$image = $request->file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$location = public_path('_posts/' . $filename);
				Image::make($image)->resize(800, 400)->save($location);

				$post->image = $filename;
			}

		$post->save();

		// save the tags in the post_tag table
		// false required as default (otherwise override existing association)
		if (isset($request->tags))
		{
			 $post->tags()->sync($request->tags, false);
		} else {
			 $post->tags()->sync(array());
		}

		// Save entry to log file using built-in Monolog
		// Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED post (" . $post->id . ")\r\n", 
		// 	[json_decode($post, true)]
		// );

		// set a flash message to be displayed on screen
		Session::flash('success','The post was successfully saved!');
		// redirect to another page
		return redirect()->route('posts.index');
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
		if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

		$post = Post::findOrFail($id);

		return view('posts.trash', compact('post'));
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
		$this->validate($request, [
		   'checked' => 'required',
		]);

		$checked = $request->input('checked');

		Post::destroy($checked);

		Session::flash('success','The posts were trashed successfully.');
		// return redirect()->route('posts.'. Session::get('pageName'));
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
		if(!checkPerm('post_delete')) { abort(401, 'Unauthorized Access'); }

		$post = Post::find($id);
			$post->published_at = null;
		$post->save();

		$post->delete();

		// Save entry to log file using built-in Monolog
		// Log::info(Auth::user()->username . " (" . Auth::user()->id . ") DELETED post (" . $post->id . ")\r\n", 
		// 	[json_decode($post, true)]
		// );

		Session::flash('success', 'The post was successfully trashed!');
		// return redirect()->route('posts.'. Session::get('pageName'));
		// return redirect()->back();
		return redirect(Session::get('fromPage'));
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
		if(!checkPerm('post_index')) { abort(401, 'Unauthorized Access'); }

		//$alphas = range('A', 'Z');
		$alphas = DB::table('posts')
			->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
			//->where('published_at','<', Carbon::Now())
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
		
		return view('posts.trashed', compact('posts','letters'));
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
		// Set the variable so we can use a button in other pages to come back to this page
		Session::put('pageName', 'unpublish');

	  $post = Post::find($id);
		 $post->published_at = NULL;
	  $post->save();

	  Session::flash ('success','The post was successfully unpublished.');
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
		// Check if user has required permission
		if(!checkPerm('post_index')) { abort(401, 'Unauthorized Access'); }

		// Set the session to the current page route
		// Session::put('fromLocation', 'posts.unpublished'); // Required for Alphabet listing
      Session::put('fromPage', url()->full());

		//$alphas = range('A', 'Z');
		$alphas = DB::table('posts')
			->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
			->whereNull('published_at')
			//->where('published_at','<', Carbon::Now())
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

		return view('posts.unpublished', compact('posts','letters', 'postlinks'));
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
	  return redirect()->route('posts.'. Session::get('pageName'));
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
	public function update(UpdatePostRequest $request, $id)
	{
		// Get the post values from the database
		$post = Post::find($id);

			// Save the data to the database
			$post->title = $request->input('title');
			// $post->slug = $request->input('slug');
			$post->category_id = $request->input('category_id');
			// $post->body = Purifier::clean($request->input('body'));
			$post->body = $request->body;

			// Check if a new image was submitted
			if ($request->hasFile('image')) {
				//Add new photo
				$image = $request->file('image');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$location = public_path('_posts/' . $filename);
				Image::make($image)->resize(800, 400)->save($location);
				
				// get name of old image
				$oldImageName = $post->image;

				// Update database
				$post->image = $filename;

				// Delete old photo
				File::delete('_posts/' . $oldImageName);
			}

		$post->save();

		//save the tags in the databse
		// not adding 2nd param will delete all entries in array and replace them with new ones
		// check that there is something in the array and then save it else pass an empty array
		if (isset($request->tags))
		{
			 $post->tags()->sync($request->tags);
		} else {
			 $post->tags()->sync(array());
		}

		// Save entry to log file using built-in Monolog
		// Log::info(Auth::user()->username . " (" . Auth::user()->id . ") UPDATED post (" . $post->id . ")\r\n", 
		//    [json_decode($post, true)]
		// );

		// Set flash data with success message
		Session::flash ('success', 'This post was successfully updated!');
		// return redirect()->route('posts.index');
		return redirect()->route('posts.'. Session::get('pageName'));
	}


##################################################################################################################
# ██╗   ██╗███████╗███████╗██████╗     ███████╗██╗  ██╗ ██████╗ ██╗    ██╗
# ██║   ██║██╔════╝██╔════╝██╔══██╗    ██╔════╝██║  ██║██╔═══██╗██║    ██║
# ██║   ██║███████╗█████╗  ██████╔╝    ███████╗███████║██║   ██║██║ █╗ ██║
# ██║   ██║╚════██║██╔══╝  ██╔══██╗    ╚════██║██╔══██║██║   ██║██║███╗██║
# ╚██████╔╝███████║███████╗██║  ██║    ███████║██║  ██║╚██████╔╝╚███╔███╔╝
#  ╚═════╝ ╚══════╝╚══════╝╚═╝  ╚═╝    ╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚══╝╚══╝
##################################################################################################################
	// public function showUser($id)
	// {
	// 	$user = User::find($id);
	// 	return view('posts.showUser')->withUser($user);
	// }


}
