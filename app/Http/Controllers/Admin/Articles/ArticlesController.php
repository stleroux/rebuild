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
      $article = New Article();
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
      return view('admin.articles.edit', compact('article'));
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
         return view('admin.articles.index', compact('articles','letters', 'articlelinks'));
      }

      // No $key value is passed
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
   public function store()
   {
      Article::create($this->validateRequest());

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
   public function update(Article $article, $id)
   {
      $article = Article::findOrFail($id);
      $article->update($this->validateRequest());
      
      Session::flash('success','The article has been updated successfully.');
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
