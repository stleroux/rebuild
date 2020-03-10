<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Articles\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Carbon\Carbon;
use DB;
use Route;
use Session;

class ExtraViewsController extends ArticlesController
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
		$this->enablePermissions = true;
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
			if(!checkPerm('article_read')) { abort(401, 'Unauthorized Access'); }
		}

		// Set the session to the current page route
		Session::put('fromPage', url()->full());

		$archives = Article::with('user')->whereYear('created_at','=', $year)
			->whereMonth('created_at','=', $month)
			->where('published_at', '<=', Carbon::now())
			->get();

		return view('admin.articles.pages.archives', compact('archives'))->withYear($year)->withMonth($month);
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
			if(!checkPerm('article_edit')) { abort(401, 'Unauthorized Access'); }
		}

		// Set the session to the current page route
		Session::put('fromPage', url()->full());

		//$alphas = range('A', 'Z');
		$alphas = DB::table('articles')
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
			$articles = Article::with('user')->future()
				->where('title', 'like', $key . '%')
				->orderBy('title', 'asc')
				->get();
			return view('admin.articles.pages.future', compact('articles','letters'));
		}

		// No $key value is passed
		$articles = Article::with('user')->future()->get();
		return view('admin.articles.pages.future', compact('articles','letters'));
	}


##################################################################################################################
# ███╗   ███╗██╗   ██╗
# ████╗ ████║╚██╗ ██╔╝
# ██╔████╔██║ ╚████╔╝ 
# ██║╚██╔╝██║  ╚██╔╝  
# ██║ ╚═╝ ██║   ██║   
# ╚═╝     ╚═╝   ╚═╝   
// Display a listing of the resource that belong to a specific user.
##################################################################################################################
	public function myArticles(Request $request, $key=null)
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('article_browse')) { abort(401, 'Unauthorized Access'); }
		}

		// Set the session to the current page route
		Session::put('fromPage', url()->full());

		//$alphas = range('A', 'Z');
		$alphas = DB::table('articles')
			->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
			->where('user_id', '=', Auth::user()->id)
			->where('deleted_at', '=', NULL)
			->orderBy('letter')
			->get();

		$letters = [];
		foreach($alphas as $alpha) {
		  $letters[] = $alpha->letter;
		}

		// If $key value is passed
		if ($key) {
			$articles = Article::with('user')->myArticles()
				->where('title', 'like', $key . '%')
				->get();
			return view('admin.articles.pages.myArticles', compact('articles','letters'));
		}

		$articles = Article::with('user')->myArticles()->get();
		return view('admin.articles.pages.myArticles', compact('articles','letters'));
	}


##################################################################################################################
# ███╗   ██╗███████╗██╗    ██╗
# ████╗  ██║██╔════╝██║    ██║
# ██╔██╗ ██║█████╗  ██║ █╗ ██║
# ██║╚██╗██║██╔══╝  ██║███╗██║
# ██║ ╚████║███████╗╚███╔███╔╝
# ╚═╝  ╚═══╝╚══════╝ ╚══╝╚══╝ 
// Display a listing of the resource that were created since the user's last login.
##################################################################################################################
	public function newArticles(Request $request, $key=null)
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('article_edit')) { abort(401, 'Unauthorized Access'); }
		}

		// Set the session to the current page route
		Session::put('fromPage', url()->full());

		//$alphas = range('A', 'Z');
		$alphas = DB::table('articles')
			->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
			->where('created_at', '>=' , Auth::user()->previous_login_date)
			->orderBy('letter')
			->get();

		$letters = [];
		foreach($alphas as $alpha) {
		  $letters[] = $alpha->letter;
		}

		// If $key value is passed
		if ($key) {
			$articles = Article::with('user')->newArticles()
				->where('title', 'like', $key . '%')
				->get();
			return view('admin.articles.pages.newArticles', compact('articles','letters'));
		}

		$articles = Article::with('user')->newArticles()->get();
		return view('admin.articles.pages.newArticles', compact('articles','letters'));
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
         if(!checkPerm('article_read')) { abort(401, 'Unauthorized Access'); }
      }

		$article = Article::find($id);

		return view('admin.articles.print', compact('article'));
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
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('article_edit')) { abort(401, 'Unauthorized Access'); }
		}

		// Set the session to the current page route
		Session::put('fromPage', url()->full());

		//$alphas = range('A', 'Z');
		$alphas = DB::table('articles')
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
			$articles = Article::with('user')->published()
				->where('title', 'like', $key . '%')
				->orderBy('title', 'asc')
				->get();
			return view('admin.articles.published', compact('articles','letters'));
		}

		// No $key value is passed
		$articles = Article::with('user')->published()->get();
		return view('admin.articles.published', compact('articles','letters'));
	}


##################################################################################################################
#
#
#
#
#
#
// Display a list of revisions for the specified model
##################################################################################################################







##################################################################################################################
# ███████╗██╗  ██╗ ██████╗ ██╗    ██╗ ████████╗██████╗  █████╗ ███████╗██╗  ██╗███████╗██████╗
# ██╔════╝██║  ██║██╔═══██╗██║    ██║ ╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██║  ██║██╔════╝██╔══██╗
# ███████╗███████║██║   ██║██║ █╗ ██║    ██║   ██████╔╝███████║███████╗███████║█████╗  ██║  ██║
# ╚════██║██╔══██║██║   ██║██║███╗██║    ██║   ██╔══██╗██╔══██║╚════██║██╔══██║██╔══╝  ██║  ██║
# ███████║██║  ██║╚██████╔╝╚███╔███╔╝    ██║   ██║  ██║██║  ██║███████║██║  ██║███████╗██████╔╝
# ╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚══╝╚══╝     ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝ 
// Display the specified resource
##################################################################################################################
	public function showTrashed($id)
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('article_delete')) { abort(401, 'Unauthorized Access'); }
		}

		$article = Article::withTrashed()->findOrFail($id);

		return view('admin.articles.pages.showTrashed', compact('article'));
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
	public function trashed(Request $request)
	{
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('article_delete')) { abort(401, 'Unauthorized Access'); }
		}

		// Set the session to the current page route
		Session::put('fromPage', url()->full());

		//$alphas = range('A', 'Z');
		$alphas = DB::table('articles')
			->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
			->where('deleted_at','!=', Null)
			->orderBy('letter')
			->get();

		$letters = [];
		foreach($alphas as $alpha) {
		  $letters[] = $alpha->letter;
		}

		$articles = Article::with('user')->onlyTrashed()->get();

		return view('admin.articles.pages.trashed', compact('articles','letters'));
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
			if(!checkPerm('article_edit')) { abort(401, 'Unauthorized Access'); }
		}

		// Set the session to the current page route
		Session::put('fromPage', url()->full());

		//$alphas = range('A', 'Z');
		  $alphas = DB::table('articles')
			->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
			->where('published_at','=', null)
			->where('deleted_at','=', null)
			->orderBy('letter')
			->get();

		$letters = [];
		foreach($alphas as $alpha) {
			$letters[] = $alpha->letter;
		}

		// If $key value is passed
		if ($key) {
			$articles = Article::with('user')->unpublished()
				->where('title', 'like', $key . '%')
				->orderBy('title', 'asc')
				->get();
			return view('admin.articles.pages.unpublished', compact('articles','letters'));
		}

		// No $key value is passed
		$articles = Article::with('user')->unpublished()->get();
		return view('admin.articles.pages.unpublished', compact('articles','letters'));
	}


}
