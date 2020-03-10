<?php

namespace App\Http\Controllers\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Articles\Article;
use Carbon\Carbon;
use DB;
use Session;

class ArticlesController extends Controller
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
		$this->middleware('auth');
		$this->enablePermissions = false;
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
	if($this->enablePermissions) {
		if(!checkPerm('article_browse')) { abort(401, 'Unauthorized Access'); }
	}

	// Set the session to the current page route
	Session::put('fromPage', url()->full());
	 
	//$alphas = range('A', 'Z');
	$alphas = DB::table('articles')
		->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
		->where('published_at','<', Carbon::Now())
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
		return view('articles.index', compact('articles','letters'));
	 }

	// No $key value is passed
	$articles = Article::with('user')->published()->get();
	return view('articles.index', compact('articles','letters'));
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
		// Check if user has required permission
		if($this->enablePermissions) {
			if(!checkPerm('article_read')) { abort(401, 'Unauthorized Access'); }
		}

		$article = Article::findOrFail($id);

		// Add 1 to views column
		DB::table('articles')->where('id','=',$article->id)->increment('views',1);

		// get the title of the next article
		$nextTitle = Article::published()->where('title', '>', $article->title)->orderBy('title','desc')->min('title');

		if($nextTitle){
			$next = Article::published()->where('title', $nextTitle)->first();
			$next = $next->id;
		}

		// get the title of the previous article
		$previousTitle = Article::published()->where('title', '<', $article->title)->orderBy('title','asc')->max('title');

		if($previousTitle){
			$previous = Article::published()->where('title', $previousTitle)->first();
			$previous = $previous->id;
		}
		
		return view('articles.show', compact('article','next','previous'));
	}


}
