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
          return view('articles.index', compact('articles','letters','archivesLinks'));
      }

      // No $key value is passed
      $articles = Article::with('user')->published()->get();
      return view('articles.index', compact('articles','letters','archivesLinks'));
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

         // get previous article id
         $previous = Article::published()->where('id', '<', $article->id)->max('id');

         // get next article id
         $next = Article::published()->where('id', '>', $article->id)->min('id');

         // Add 1 to views column
         DB::table('articles')->where('id','=',$article->id)->increment('views',1);

         return view('articles.show', compact('article','archivesLinks','next','previous'));
    }


}
