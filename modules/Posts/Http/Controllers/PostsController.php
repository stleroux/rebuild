<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use Modules\Posts\Entities\Post;
use Modules\Posts\Entities\Tag;

use App\Category;
use App\User;
use Auth;
use DB;
use File;
use Image;
use Purifier;
use Session;
use Storage;
use Log;
use URL;
use Carbon\Carbon;

use Modules\Posts\Http\Requests\CreatePostRequest;
use Modules\Posts\Http\Requests\UpdatePostRequest;

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

		return view('posts::create')
			->withCategories($cats)
			->withTags($tags);
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

		return view('posts::delete', compact('post'));
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
      Session::put('pageName', '');

		$this->validate($request, [
		   'checked' => 'required',
		]);

		$checked = $request->input('checked');

		Post::whereIn('id', $checked)->forceDelete();
		// Post::whereIn('id', $checked)->deleteDestroy();

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
		//Storage::delete($post->image_path);
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

		// find the categories
		$categories = Category::whereHas('module', function ($query) {
			$query->where('name', '=', 'posts');
		})->get();

		// Create an empty array to store the categories
		$cats = [];
		// Store the category values into the $cats array
		foreach ($categories as $category) {
			$cats[$category->id] = $category->name;
		}

		// find the associated tags
		$tags = Tag::all();
		// Create an empty array to store the tags
		$tags2 = [];
		foreach ($tags as $tag) {
			 $tags2[$tag->id] = $tag->name;
		}

		return view('posts::edit')
			->withPost($post)  
			->withCategories($cats)
			->withTags($tags2);
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
		//$modifiedBy = User::find($recipe->modified_by);
		//$lastViewedBy = User::find($recipe->last_viewed_by);

		//$createdBy = User::find($post->user_id);
		//$modifiedBy = User::find($post->modified_by);
		// return view ('posts::edit')->withPost($post);
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
		
		return view('posts::viewImage')->withPost($post);
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

		// Get list of posts by year and month
		$postlinks = DB::table('posts')
			->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) post_count'))
			->where('published_at', '<=', Carbon::now())
			//->where('created_at', '<=', Carbon::now()->subMonth(3))
			->groupBy('year')
			->groupBy('month')
			->orderBy('year', 'desc')
			->orderBy('month', 'desc')
			->get();
		// dd($postlinks);

		Session::put('pageName', 'index');

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
		
		return view('posts::index', compact('posts','letters', 'postlinks'));
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
		//     return view('errors.403');
		// }

		//$alphas = range('A', 'Z');
		$alphas = DB::table('posts')
			->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
			->where('created_at', '>=' , Auth::user()->last_login_date)
			//->where('user_id', '=', Auth::user()->id)
			// ->where('personal', '!=', 1)
			// ->where('published_at','=', null)
			->orderBy('letter')
			->get();
			// dd($alphas);

		$letters = [];
		foreach($alphas as $alpha) {
			$letters[] = $alpha->letter;
		}

		Session::put('pageName', 'newPosts');

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

		return view('posts::newPosts', compact('posts','letters'));
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

		return view('posts::print')->withPost($post);
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
		// Pass along the ROUTE value of the previous page
		//$ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();
		// Session::put('fullURL', \Request::fullUrl());

		$post = Post::find($id);

		$post->published_at = Carbon::now();
		if($post->deleted_at != Null) {
			$post->deleted_at = Null;
		}

		$post->save();

		Session::flash ('success','The post was successfully published.');

		return redirect()->route('posts.'. Session::get('pageName'));
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
		// $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

		//dd('TEST_DELETE');
		// $this->validate($request, [
		//    'checked' => 'required',
		// ]);
		//dd('TEST_DELETE');

		$checked = $request->input('checked');
		//dd($checked);

		// $article = Article::withTrashed()->findOrFail($checked);
		//Article::destroy($checked);
		//Article::whereIn('id', $checked)->publish();
		foreach ($checked as $item) {
			//dd($item);
			$post = Post::withTrashed()->find($item);
			//dd($article);
				$post->published_at = Carbon::now();
				$post->deleted_at = Null;
			$post->save();
		}

		Session::flash('success','The recipes were published successfully.');
		// return redirect()->route($ref);
		return redirect()->route('posts.'. Session::get('pageName'));
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

		//$article->deleted_at = NULL;
		//$article->save();
		$post->restore();

		Session::flash ('success','The post was successfully restored.');
		return redirect()->route('posts.trashed');
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

		// $this->validate($request, [
		//    'checked' => 'required',
		// ]);

		$checked = $request->input('checked');
		//dd($checked);

		Post::withTrashed()->restore($checked);

		Session::flash('success','The posts have been restored successfully.');
		// return redirect()->route($ref);
		return redirect()->route('posts.'. Session::get('pageName'));
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

		// Add 1 to views column
		DB::table('posts')->where('id','=',$post->id)->increment('views',1);

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

		return view ('posts::show')
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

		return view ('posts::showTrashed')
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
			$post->updated_by_id = Auth::user()->id;

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
		//$post->tags()->sync($request->tags, false);
		
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
			return redirect()->route('posts.show', $post->id);
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

		// Set the $page variable so we can come back to the calling page		
		// if (app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'posts.index') {
		// 	$page = 'index';
		// }elseif (app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'posts.unpublished') {
		// 	$page = 'unpublished';
		// }elseif (app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'posts.newPosts') {
		// 	$page = 'newPosts';
		// }

		// Session::put('pageName', 'trashed');

		return view('posts::trash', compact('post'));
		
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
		// dd($request);
		// Pass along the ROUTE value of the previous page
		// $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

		$this->validate($request, [
		   'checked' => 'required',
		]);

		$checked = $request->input('checked');
		//dd($checked);

		Post::destroy($checked);

		Session::flash('success','The posts were trashed successfully.');
		return redirect()->route('posts.'. Session::get('pageName'));
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
		
		// if ($page === 'newPost') {
		// 	return redirect()->route('posts.newPosts');
		// }elseif ($page === 'unpublished'){
		// 	return redirect()->route('posts.unpublished');
		// }
		// return redirect()->route('posts.index');
		return redirect()->route('posts.'. Session::get('pageName'));
		
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

		// Get list of posts by year and month
		$postlinks = DB::table('posts')
			->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) post_count'))
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
			$posts = Post::with('user','category')->onlyTrashed()->where('title', 'like', $key . '%')
				->orderBy('title', 'asc')
				->get();
		} else {
			$posts = Post::with('user','category')->onlyTrashed()->orderBy('id','desc')->get();
		}
		
		return view('posts::trashed', compact('posts','letters', 'postlinks'));


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

	  $post = Post::find($id);
		 $post->published_at = NULL;
		 // $article->favoriteArticles()->delete(); // Remove associated rows from article_user (favorites table)
		
		 // $favorites = DB::select('select * from post_user where post_id = '. $id, [1]);
		 // //dd ($favorites);
		 // foreach($favorites as $favorite) {
		 //    //dd($favorite);
		 //    $post->favorites()->detach($favorite);
		 // }
	  $post->save();

	  Session::flash ('success','The post was successfully unpublished.');
	  //return redirect()->route($ref);
	  // return redirect()->route('posts.show', $id);
	  // return redirect()->route('posts.index');
	  return redirect()->route('posts.'. Session::get('pageName'));
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

		// Get list of posts by year and month
		$postlinks = DB::table('posts')
			->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) post_count'))
			// ->where('published_at', '<=', Carbon::now())
			->whereNull('published_at')
			//->where('created_at', '<=', Carbon::now()->subMonth(3))
			->groupBy('year')
			->groupBy('month')
			->orderBy('year', 'desc')
			->orderBy('month', 'desc')
			->get();
		// dd($postlinks);

		Session::put('pageName', 'unpublished');

		// If $key value is passed
		if ($key) {
			$posts = Post::unpublished()
				->with('user','category')
				->where('title', 'like', $key . '%')
				->orderBy('title', 'asc')
				->get();

			// return view('posts::unpublished', compact('posts','letters', 'postlinks'));
		} else {

		// No $key value is passed
		$posts = Post::unpublished()
			->with('user','category')
			->orderBy('id','desc')
			->get();
		}

		return view('posts::unpublished', compact('posts','letters', 'postlinks'));
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
	  // $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();
	  //dd($ref);

	  // $this->validate($request, [
	  //    'checked' => 'required',
	  // ]);
		$validatedData = $request->validate([
			'checked' => 'required',
		]);

	  $checked = $request->input('checked');
	  //dd($checked);

	  foreach ($checked as $item) {
		 //dd($item);
		 // $post = Post::withTrashed()->find($item);
		$post = Post::find($item);
			$post->published_at = Null;

			// Delete related favorites
			// $favorites = DB::select('select * from post_user where post_id = '. $post->id, [1]);
			//    foreach($favorites as $favorite) {
			//       $post->favoriteposts()->detach($favorite);
			//    }
		 $post->save();
	  }

	  Session::flash('success','The posts were unpublished successfully.');
	  // return redirect()->route($ref);
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
			// $post->modified_by_id = Auth::user()->id;

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

		// Redirect to posts.show
		// if($request->page === 'unpublished'){
		// 	return redirect()->route('posts.unpublished');
		// }

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
	public function showUser($id)
	{
		$user = User::find($id);
		return view('posts::showUser')->withUser($user);
	}


}
