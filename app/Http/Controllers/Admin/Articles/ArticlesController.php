<?php

namespace App\Http\Controllers\Admin\Articles;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller; // Required for validation
use Illuminate\Support\Facades\Input;

use App\Models\Articles\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Auth;
use DB;
use Excel;
use Log;
use Route;
use Session;
use URL;

// use App\Http\Requests\CreateArticleRequest;
// use App\Http\Requests\UpdateArticleRequest;
use App\Http\Requests\CreateCommentRequest;

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
   public function __construct() {
      // only allow authenticated users to access these pages
      $this->middleware('auth');
      $this->enablePermissions = false;
      //Log::useFiles(storage_path().'/logs/articles.log');
      //Log::useFiles(storage_path().'/logs/audits.log');
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

      // Set the variable so we can use a button in other pages to come back to this page
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.index') {
         Session::put('backURL', 'articles.index');
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.newArticles') {
         Session::put('backURL', 'articles.newArticles');
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.myArticles') {
         Session::put('backURL', 'articles.myArticles');
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.myFavorites') {
         Session::put('backURL', 'articles.myFavorites');
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.unpublished') {
         Session::put('backURL', 'articles.unpublished');
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.future') {
         Session::put('backURL', 'articles.future');
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.trashed') {
         Session::put('backURL', 'articles.trashed');
      }

      // $categories = Category::where('parent_id',11)->get();
      // dd($categories);
      $article = New Article();

      // return view('admin.articles.create', compact('categories','article'));
      return view('admin.articles.create', compact('article'));
   }


##################################################################################################################
# ██████╗ ███████╗███████╗████████╗██████╗  ██████╗ ██╗   ██╗
# ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔══██╗██╔═══██╗╚██╗ ██╔╝
# ██║  ██║█████╗  ███████╗   ██║   ██████╔╝██║   ██║ ╚████╔╝ 
# ██║  ██║██╔══╝  ╚════██║   ██║   ██╔══██╗██║   ██║  ╚██╔╝  
# ██████╔╝███████╗███████║   ██║   ██║  ██║╚██████╔╝   ██║   
# ╚═════╝ ╚══════╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝    ╚═╝   
// Remove the specified resource from storage
// Used in the index page and trashAll action to soft delete multiple records
##################################################################################################################
   public function destroy($id)
   {
      $article = Article::findOrFail($id);
         $article->published_at = Null;
            // Delete related favorites
            $favorites = DB::select('select * from article_user where article_id = '. $id, [1]);
               foreach($favorites as $favorite) {
                  $article->favorites()->detach($favorite);
               }
         $article->save();
      $article->delete();

      Session::flash('success','The article was trashed successfully.');
      return redirect(Route( Session::get('backURL')));
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
   public function edit(Article $article, $id)
   {
      // Find the article to edit
      $article = Article::find($id);
      // dd($article);

      // // find all categories in the categories table and pass them to the view
      // // $categories = Category::whereHas('module', function ($query) {
      // //    $query->where('name', '=', 'articles');
      // // })->get();
      // $categories = Category::where('parent_id',0)->get();
      // // dd($categories);

      // // Create an empty array to store the categories
      // $cats = [];
      // // Store the category values into the $cats array
      // foreach ($categories as $category) {
      //    $cats[$category->id] = $category->name;
      // }

      // return view('admin.articles.edit', compact('article'))->withCategories($cats);
      return view('admin.articles.edit', compact('article'));
      // return 'TEST';
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
      // Set the session to the current page route
      Session::put('fromPage', url()->full());

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
         return view('admin.articles.index', compact('articles','letters', 'articlelinks'));
         // return view('admin.articles.index', compact('articles','letters'));
      }

      // No $key value is passed
      // $articles = Article::with('user','category')->published()->get();
      $articles = Article::with('user')->published()->get();
      return view('admin.articles.index', compact('articles','letters', 'articlelinks'));
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

      return view('admin.articles.show', compact('article','articlelinks','next','previous'));
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
   // public function store(CreateArticleRequest $request)
   public function store()
   {
      Article::create($this->validateRequest());
      // $article = new Article;
      //    $article->title             = $request->title;
      //    $article->category_id       = $request->category_id;
      //    $article->published_at      = $request->published_at;
      //    $article->description_eng   = $request->description_eng;
      //    $article->description_fre   = $request->description_fre;
      //    $article->user_id           = Auth::user()->id;
      // $article->save();

      Session::flash('success','The article has been created successfully!');
      return redirect()->route('admin.articles.index');
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
   // public function update(UpdateArticleRequest $request, $id)
   // public function update(Request $request)
   public function update(Article $article, $id)
   {
      $article = Article::findOrFail($id);
      $article->update($this->validateRequest());
      // dd($article);
      
      // $article = Article::findOrFail($id);
      //    $article->title             = $request->title;
      //    $article->category_id       = $request->category_id;
      //    $article->published_at      = $request->published_at;
      //    $article->description_eng   = $request->description_eng;
      //    $article->description_fre   = $request->description_fre;
      // $article->save();
      
      Session::flash('success','The article has been updated successfully.');
      // return redirect()->route('admin.articles.index');
      return redirect(Session::get('fromPage'));

   }


##################################################################################################################
#██╗   ██╗ █████╗ ██╗     ██╗██████╗  █████╗ ████████╗███████╗    ██████╗ ███████╗ ██████╗ ██╗   ██╗███████╗███████╗████████╗
#██║   ██║██╔══██╗██║     ██║██╔══██╗██╔══██╗╚══██╔══╝██╔════╝    ██╔══██╗██╔════╝██╔═══██╗██║   ██║██╔════╝██╔════╝╚══██╔══╝
#██║   ██║███████║██║     ██║██║  ██║███████║   ██║   █████╗      ██████╔╝█████╗  ██║   ██║██║   ██║█████╗  ███████╗   ██║   
#╚██╗ ██╔╝██╔══██║██║     ██║██║  ██║██╔══██║   ██║   ██╔══╝      ██╔══██╗██╔══╝  ██║▄▄ ██║██║   ██║██╔══╝  ╚════██║   ██║   
# ╚████╔╝ ██║  ██║███████╗██║██████╔╝██║  ██║   ██║   ███████╗    ██║  ██║███████╗╚██████╔╝╚██████╔╝███████╗███████║   ██║   
#  ╚═══╝  ╚═╝  ╚═╝╚══════╝╚═╝╚═════╝ ╚═╝  ╚═╝   ╚═╝   ╚══════╝    ╚═╝  ╚═╝╚══════╝ ╚══▀▀═╝  ╚═════╝ ╚══════╝╚══════╝   ╚═╝   
##################################################################################################################

    private function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'category' => 'required|min:0|not_in:0',
            'published_at' => '',
            'description_eng' => 'required',
            'description_fre' => '',
        ]);
    }


}
