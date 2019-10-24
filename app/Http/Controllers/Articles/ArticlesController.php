<?php

namespace App\Http\Controllers\Articles;

use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use App\Http\Controllers\Controller; // Required for validation
// use Illuminate\Support\Facades\Input;

use App\Models\Articles\Article;
// use App\Models\Category;
// use App\Models\Comment;
// use App\Models\User;
use Carbon\Carbon;
// use Auth;
use DB;
// use Excel;
// use Log;
use Route;
use Session;
// use URL;

// use App\Http\Requests\CreateArticleRequest;
// use App\Http\Requests\UpdateArticleRequest;
// use App\Http\Requests\CreateCommentRequest;

class ArticlesController extends Controller
{

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
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('backURL', Route::currentRouteName());
      

      // Get list of articles by year and month
      // $articlelinks = DB::table('articles')
      //    ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
      //    ->where('published_at', '<=', Carbon::now())
      //    ->groupBy('year')->groupBy('month')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

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
         // $articles = Article::with('user','category')->published()
         $articles = Article::with('user')->published()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
         return view('articles.index', compact('articles','letters', 'articlelinks'));
         // return view('articles.index', compact('articles','letters'));
      }

      // No $key value is passed
      // $articles = Article::with('user','category')->published()->get();
      $articles = Article::with('user')->published()->get();
      return view('articles.index', compact('articles','letters', 'articlelinks'));
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
      $article = Article::findOrFail($id);

      // get previous article id
      $previous = Article::published()->where('id', '<', $article->id)->max('id');

      // get next article id
      $next = Article::published()->where('id', '>', $article->id)->min('id');

      // Add 1 to views column
      DB::table('articles')->where('id','=',$article->id)->increment('views',1);

      // Get list of articles by year and month
      // $articlelinks = DB::table('articles')
      //    ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
      //    ->where('published_at', '<=', Carbon::now())
      //    ->groupBy('year')
      //    ->groupBy('month')
      //    ->orderBy('year', 'desc')
      //    ->orderBy('month', 'desc')
      //    ->get();

      return view('articles.show', compact('article','articlelinks','next','previous'));
   }


}