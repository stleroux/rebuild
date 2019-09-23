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

use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
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
#  █████╗ ██████╗ ██████╗     ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗
# ██╔══██╗██╔══██╗██╔══██╗    ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝
# ███████║██║  ██║██║  ██║    █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗  
# ██╔══██║██║  ██║██║  ██║    ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝  
# ██║  ██║██████╔╝██████╔╝    ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗
# ╚═╝  ╚═╝╚═════╝ ╚═════╝     ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝
##################################################################################################################
   public function addfavorite($id)
   {
      $user = Auth::user()->id;
      $article = Article::find($id);

      $article->favorites()->sync([$user], false);

      Session::flash ('success','The article was successfully added to your Favorites list!');
      return redirect()->back();
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
   public function archive($year, $month)
   {

      // Get list of articles by year and month
      $articlelinks = DB::table('articles')
         ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
         ->where('published_at', '<=', Carbon::now())
         ->groupBy('year')
         ->groupBy('month')
         ->orderBy('year', 'desc')
         ->orderBy('month', 'desc')
         ->get();

      $archives = Article::with('user')->whereYear('created_at','=', $year)
         ->whereMonth('created_at','=', $month)
         ->where('published_at', '<=', Carbon::now())
         ->get();

      return view('articles.archive', compact('archives','articlelinks'))->withYear($year)->withMonth($month);
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

      $categories = Category::where('parent_id',11)->get();

      return view('articles.create', compact('categories'));
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
      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');

      Article::whereIn('id', $checked)->forceDelete();

      Session::flash('success','The selected articles were deleted successfully.');
      return redirect()->back();
   }


##################################################################################################################
# ██████╗ ███████╗██╗     ███████╗████████╗███████╗    ████████╗██████╗  █████╗ ███████╗██╗  ██╗███████╗██████╗ 
# ██╔══██╗██╔════╝██║     ██╔════╝╚══██╔══╝██╔════╝    ╚══██╔══╝██╔══██╗██╔══██╗██╔════╝██║  ██║██╔════╝██╔══██╗
# ██║  ██║█████╗  ██║     █████╗     ██║   █████╗         ██║   ██████╔╝███████║███████╗███████║█████╗  ██║  ██║
# ██║  ██║██╔══╝  ██║     ██╔══╝     ██║   ██╔══╝         ██║   ██╔══██╗██╔══██║╚════██║██╔══██║██╔══╝  ██║  ██║
# ██████╔╝███████╗███████╗███████╗   ██║   ███████╗       ██║   ██║  ██║██║  ██║███████║██║  ██║███████╗██████╔╝
# ╚═════╝ ╚══════╝╚══════╝╚══════╝   ╚═╝   ╚══════╝       ╚═╝   ╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚══════╝╚═════╝ 
// Remove the specified resource from storage - individual record
##################################################################################################################
   public static function deleteTrashed($id)
   {
      $article = Article::withTrashed()->findorFail($id);

      $article->forceDelete();

      Session::flash ('success','The article was deleted successfully.');
      return redirect()->route('articles.trashed');
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
# ██████╗  ██████╗ ██╗    ██╗███╗   ██╗██╗      ██████╗  █████╗ ██████╗     ███████╗██╗  ██╗ ██████╗███████╗██╗     
# ██╔══██╗██╔═══██╗██║    ██║████╗  ██║██║     ██╔═══██╗██╔══██╗██╔══██╗    ██╔════╝╚██╗██╔╝██╔════╝██╔════╝██║     
# ██║  ██║██║   ██║██║ █╗ ██║██╔██╗ ██║██║     ██║   ██║███████║██║  ██║    █████╗   ╚███╔╝ ██║     █████╗  ██║     
# ██║  ██║██║   ██║██║███╗██║██║╚██╗██║██║     ██║   ██║██╔══██║██║  ██║    ██╔══╝   ██╔██╗ ██║     ██╔══╝  ██║     
# ██████╔╝╚██████╔╝╚███╔███╔╝██║ ╚████║███████╗╚██████╔╝██║  ██║██████╔╝    ███████╗██╔╝ ██╗╚██████╗███████╗███████╗
# ╚═════╝  ╚═════╝  ╚══╝╚══╝ ╚═╝  ╚═══╝╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚═════╝     ╚══════╝╚═╝  ╚═╝ ╚═════╝╚══════╝╚══════╝
##################################################################################################################
   public function downloadExcel($type)
   {
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.index') {
            $data = Article::published()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.newArticles') {
            $data = Article::newArticles()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.myArticles') {
            $data = Article::myArticles()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.unpublished') {
            $data = Article::unpublished()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.future') {
            $data = Article::future()->get()->toArray();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.trashed') {
            $data = Article::trashedCount()->get()->toArray();
      }


      return Excel::create('Articles_List', function($excel) use ($data) {
         $excel->sheet('mySheet', function($sheet) use ($data)
         {
            $sheet->fromArray($data);
         });
      })->download($type);
   }


##################################################################################################################
# ██████╗ ██╗   ██╗██████╗ ██╗     ██╗ ██████╗ █████╗ ████████╗███████╗
# ██╔══██╗██║   ██║██╔══██╗██║     ██║██╔════╝██╔══██╗╚══██╔══╝██╔════╝
# ██║  ██║██║   ██║██████╔╝██║     ██║██║     ███████║   ██║   █████╗  
# ██║  ██║██║   ██║██╔═══╝ ██║     ██║██║     ██╔══██║   ██║   ██╔══╝  
# ██████╔╝╚██████╔╝██║     ███████╗██║╚██████╗██║  ██║   ██║   ███████╗
# ╚═════╝  ╚═════╝ ╚═╝     ╚══════╝╚═╝ ╚═════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
// DUPLICATE :: Duplicate the specified resource in storage.
##################################################################################################################
   public function duplicate($id)
   {
      // Pass along the ROUTE value of the previous page
      $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

      $article = Article::find($id);
        $newArticle = $article->replicate();
        $newArticle->user_id = Auth::user()->id;
      $newArticle->save();

      Session::flash ('success','The article was duplicated successfully!');
      return redirect()->back();
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
      // Find the article to edit
      $article = Article::findOrFail($id);

      // find all categories in the categories table and pass them to the view
      $categories = Category::whereHas('module', function ($query) {
         $query->where('name', '=', 'articles');
      })->get();

      // Create an empty array to store the categories
      $cats = [];
      // Store the category values into the $cats array
      foreach ($categories as $category) {
         $cats[$category->id] = $category->name;
      }

      return view('articles.edit', compact('article'))->withCategories($cats);
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
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('backURL', Route::currentRouteName());

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
         $articles = Article::with('user','category')->future()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
         return view('articles.future', compact('articles','letters'));
      }

      // No $key value is passed
      $articles = Article::with('user','category')->future()->get();
      return view('articles.future', compact('articles','letters'));
   }


##################################################################################################################
# ██╗███╗   ███╗██████╗  ██████╗ ██████╗ ████████╗
# ██║████╗ ████║██╔══██╗██╔═══██╗██╔══██╗╚══██╔══╝
# ██║██╔████╔██║██████╔╝██║   ██║██████╔╝   ██║   
# ██║██║╚██╔╝██║██╔═══╝ ██║   ██║██╔══██╗   ██║   
# ██║██║ ╚═╝ ██║██║     ╚██████╔╝██║  ██║   ██║   
# ╚═╝╚═╝     ╚═╝╚═╝      ╚═════╝ ╚═╝  ╚═╝   ╚═╝   
// IMPORT :: Show the form for importing entries to storage.
##################################################################################################################
   public function import()
   {
      // Pass along the ROUTE value of the previous page
      $ref = app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName();

      return view('articles.import')->withRef($ref);
   }


##################################################################################################################
# ██╗███╗   ███╗██████╗  ██████╗ ██████╗ ████████╗    ███████╗██╗   ██╗███╗   ██╗ ██████╗████████╗██╗ ██████╗ ███╗   ██╗
# ██║████╗ ████║██╔══██╗██╔═══██╗██╔══██╗╚══██╔══╝    ██╔════╝██║   ██║████╗  ██║██╔════╝╚══██╔══╝██║██╔═══██╗████╗  ██║
# ██║██╔████╔██║██████╔╝██║   ██║██████╔╝   ██║       █████╗  ██║   ██║██╔██╗ ██║██║        ██║   ██║██║   ██║██╔██╗ ██║
# ██║██║╚██╔╝██║██╔═══╝ ██║   ██║██╔══██╗   ██║       ██╔══╝  ██║   ██║██║╚██╗██║██║        ██║   ██║██║   ██║██║╚██╗██║
# ██║██║ ╚═╝ ██║██║     ╚██████╔╝██║  ██║   ██║       ██║     ╚██████╔╝██║ ╚████║╚██████╗   ██║   ██║╚██████╔╝██║ ╚████║
# ╚═╝╚═╝     ╚═╝╚═╝      ╚═════╝ ╚═╝  ╚═╝   ╚═╝       ╚═╝      ╚═════╝ ╚═╝  ╚═══╝ ╚═════╝   ╚═╝   ╚═╝ ╚═════╝ ╚═╝  ╚═══╝
##################################################################################################################
   public function importExcel()
   {
      if(Input::hasFile('import_file')) {
            $path = Input::file('import_file')->getRealPath();
            $data = Excel::load($path, function($reader) {
         })->get();

         if(!empty($data) && $data->count()) {
            foreach ($data as $key => $value) {
               $insert[] = [
                  'user_id'            => $value->user_id,
                  'category_id'        => $value->category_id,
                  'title'              => $value->title,            
                  'description_eng'    => $value->description_eng,
                  'description_fre'    => $value->description_fre,
                  'views'              =>  0,
                  'deleted_at'         => $value->deleted_at,
                  'published_at'       => $value->published_at,
                  'created_at'         => $value->created_at,
                  'updated_at'         => $value->updated_at,
               ];
            }

            if(!empty($insert)) {
               DB::table('articles')->insert($insert);

               // Save entry to log file of failure
               //Log::warning(Auth::user()->username . " (" . Auth::user()->id . ") imported :: articles");

               Session::flash('success', $data->count() . ' articles imported successfully!');
               return redirect()->route('articles.index');
            }
         }
      }
      return back();
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
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('backURL', Route::currentRouteName());
      

      // Get list of articles by year and month
      $articlelinks = DB::table('articles')
         ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
         ->where('published_at', '<=', Carbon::now())
         ->groupBy('year')->groupBy('month')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();

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
         $articles = Article::with('user','category')->published()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
         return view('articles.index', compact('articles','letters', 'articlelinks'));
      }

      // No $key value is passed
      $articles = Article::with('user','category')->published()->get();
      return view('articles.index', compact('articles','letters', 'articlelinks'));
   }


##################################################################################################################
# ███╗   ███╗ █████╗ ██╗  ██╗███████╗    ██████╗ ██████╗ ██╗██╗   ██╗ █████╗ ████████╗███████╗
# ████╗ ████║██╔══██╗██║ ██╔╝██╔════╝    ██╔══██╗██╔══██╗██║██║   ██║██╔══██╗╚══██╔══╝██╔════╝
# ██╔████╔██║███████║█████╔╝ █████╗      ██████╔╝██████╔╝██║██║   ██║███████║   ██║   █████╗  
# ██║╚██╔╝██║██╔══██║██╔═██╗ ██╔══╝      ██╔═══╝ ██╔══██╗██║╚██╗ ██╔╝██╔══██║   ██║   ██╔══╝  
# ██║ ╚═╝ ██║██║  ██║██║  ██╗███████╗    ██║     ██║  ██║██║ ╚████╔╝ ██║  ██║   ██║   ███████╗
# ╚═╝     ╚═╝╚═╝  ╚═╝╚═╝  ╚═╝╚══════╝    ╚═╝     ╚═╝  ╚═╝╚═╝  ╚═══╝  ╚═╝  ╚═╝   ╚═╝   ╚══════╝
##################################################################################################################
   public function makeprivate($id)
   {
      $article = Article::find($id);
         $article->personal = 1;
      $article->save();

      Session::flash('success','The article was made private successfully');
      return redirect()->back();
   }


##################################################################################################################
# ███╗   ███╗██╗   ██╗     █████╗ ██████╗ ████████╗██╗ ██████╗██╗     ███████╗███████╗
# ████╗ ████║╚██╗ ██╔╝    ██╔══██╗██╔══██╗╚══██╔══╝██║██╔════╝██║     ██╔════╝██╔════╝
# ██╔████╔██║ ╚████╔╝     ███████║██████╔╝   ██║   ██║██║     ██║     █████╗  ███████╗
# ██║╚██╔╝██║  ╚██╔╝      ██╔══██║██╔══██╗   ██║   ██║██║     ██║     ██╔══╝  ╚════██║
# ██║ ╚═╝ ██║   ██║       ██║  ██║██║  ██║   ██║   ██║╚██████╗███████╗███████╗███████║
# ╚═╝     ╚═╝   ╚═╝       ╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝   ╚═╝ ╚═════╝╚══════╝╚══════╝╚══════╝
// Display a listing of the resource that belong to a specific user.
##################################################################################################################
   public function myArticles(Request $request, $key=null)
   {
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('backURL', Route::currentRouteName());

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
         $articles = Article::with('user','category')->myArticles()
            ->where('title', 'like', $key . '%')
            ->get();
         return view('articles.myArticles', compact('articles','letters'));
      }

      $articles = Article::with('user','category')->myArticles()->get();
      return view('articles.myArticles', compact('articles','letters'));
   }


##################################################################################################################
# ███╗   ███╗██╗   ██╗    ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗███████╗
# ████╗ ████║╚██╗ ██╔╝    ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝██╔════╝
# ██╔████╔██║ ╚████╔╝     █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗  ███████╗
# ██║╚██╔╝██║  ╚██╔╝      ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝  ╚════██║
# ██║ ╚═╝ ██║   ██║       ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗███████║
# ╚═╝     ╚═╝   ╚═╝       ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝╚══════╝
// MY FAVORITES :: Display a listing of the resource that have been favorited by a specific user.
##################################################################################################################
   public function myFavorites()
   {
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('backURL', Route::currentRouteName());

      // find the favorites
      $favs = DB::table('article_user')->where('user_id','=',Auth::user()->id)->get();

      // Create an empty array to store the recipes        
      $articles = [];

      // Store the recipe values into the $recipes array
      foreach ($favs as $fav)
      {
        $articles[$fav->id] = Article::with('user','category')->find($fav->article_id);
      }
      
      // Sort the recipes array by title
      $articles = array_values(array_sort($articles, function ($value) {
         return $value['title'];
      }));
      
      return view('articles.myFavorites', compact('articles'));
   }


##################################################################################################################
# ███╗   ██╗███████╗██╗    ██╗     █████╗ ██████╗ ████████╗██╗ ██████╗██╗     ███████╗███████╗
# ████╗  ██║██╔════╝██║    ██║    ██╔══██╗██╔══██╗╚══██╔══╝██║██╔════╝██║     ██╔════╝██╔════╝
# ██╔██╗ ██║█████╗  ██║ █╗ ██║    ███████║██████╔╝   ██║   ██║██║     ██║     █████╗  ███████╗
# ██║╚██╗██║██╔══╝  ██║███╗██║    ██╔══██║██╔══██╗   ██║   ██║██║     ██║     ██╔══╝  ╚════██║
# ██║ ╚████║███████╗╚███╔███╔╝    ██║  ██║██║  ██║   ██║   ██║╚██████╗███████╗███████╗███████║
# ╚═╝  ╚═══╝╚══════╝ ╚══╝╚══╝     ╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝   ╚═╝ ╚═════╝╚══════╝╚══════╝╚══════╝
// Display a listing of the resource that were created since the user's last login.
##################################################################################################################
   public function newArticles(Request $request, $key=null)
   {
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('backURL', Route::currentRouteName());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('articles')
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
         $articles = Article::with('user','category')->newArticles()
            ->where('title', 'like', $key . '%')
            ->get();
         return view('articles.newArticles', compact('articles','letters'));
      }

      $articles = Article::with('user','category')->newarticles()->get();
      return view('articles.newArticles', compact('articles','letters'));
   }


##################################################################################################################
# ██████╗ ██████╗ ███████╗    ██╗   ██╗██╗███████╗██╗    ██╗
# ██╔══██╗██╔══██╗██╔════╝    ██║   ██║██║██╔════╝██║    ██║
# ██████╔╝██║  ██║█████╗      ██║   ██║██║█████╗  ██║ █╗ ██║
# ██╔═══╝ ██║  ██║██╔══╝      ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║
# ██║     ██████╔╝██║          ╚████╔╝ ██║███████╗╚███╔███╔╝
# ╚═╝     ╚═════╝ ╚═╝           ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ 
// 
##################################################################################################################
   // public function exportPDF()
   // {
   //   // if(!checkACL('manager')) {
   //   //   return view('errors.403');
   //   // }

   //   $data = Article::get()->toArray();
   //   return Excel::create('Articles_List', function($excel) use ($data) {
   //     $excel->sheet('mySheet', function($sheet) use ($data)
   //     {
   //       $sheet->fromArray($data);
   //     });
   //   })->download("pdf");
   // }

   // public function downloadPDF()
   // {
   //   $pdf = PDF::loadView('backend.articles.pdfView');
   //   return $pdf->download('articles.pdf');
   // }

   public function pdfview(Request $request)
   {
      if(!checkACL('manager')) {
         return view('errors.403');
      }

      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.newArticles') {
            $data = Article::newArticles()->get();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.published') {
            $data = Article::published()->get();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.myArticles') {
            $data = Article::myArticles()->get();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.unpublished') {
            $data = Article::unpublished()->get();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.future') {
            $data = Article::future()->get();
      }
      if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'articles.trashed') {
            $data = Article::trashedCount()->get();
      }

      view()->share('articles',$data);

      if($request->has('download')){
         $pdf = PDF::loadView('articles.pdfDownload');
         //$pdf->setPaper('A4', 'landscape');
         return $pdf->download('articles.pdf');
      }

      return view('articles.pdfPreview');
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
      $article = Article::find($id);

      return view('articles.print')->withArticle($article);
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
      $article = Article::withTrashed()->find($id);
        $article->published_at = Carbon::now();
        $article->deleted_at = Null;
      $article->save();

      Session::flash ('success','The article was published successfully!');
      return redirect()->back();
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
         $articles = Article::with('user','category')->published()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
         return view('articles.published', compact('articles','letters'));
      }

      // No $key value is passed
      $articles = Article::with('user','category')->published()->get();
      return view('articles.published', compact('articles','letters'));
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
      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');

      foreach ($checked as $item) {
         $article = Article::withTrashed()->find($item);
            $article->published_at = Carbon::now();
            $article->deleted_at = Null;
         $article->save();
      }

      Session::flash('success','The selected articles were published successfully.');
      return redirect()->back();
   }


##################################################################################################################
# ██████╗ ███████╗███╗   ███╗ ██████╗ ██╗   ██╗███████╗    ███████╗ █████╗ ██╗   ██╗ ██████╗ ██████╗ ██╗████████╗███████╗
# ██╔══██╗██╔════╝████╗ ████║██╔═══██╗██║   ██║██╔════╝    ██╔════╝██╔══██╗██║   ██║██╔═══██╗██╔══██╗██║╚══██╔══╝██╔════╝
# ██████╔╝█████╗  ██╔████╔██║██║   ██║██║   ██║█████╗      █████╗  ███████║██║   ██║██║   ██║██████╔╝██║   ██║   █████╗  
# ██╔══██╗██╔══╝  ██║╚██╔╝██║██║   ██║╚██╗ ██╔╝██╔══╝      ██╔══╝  ██╔══██║╚██╗ ██╔╝██║   ██║██╔══██╗██║   ██║   ██╔══╝  
# ██║  ██║███████╗██║ ╚═╝ ██║╚██████╔╝ ╚████╔╝ ███████╗    ██║     ██║  ██║ ╚████╔╝ ╚██████╔╝██║  ██║██║   ██║   ███████╗
# ╚═╝  ╚═╝╚══════╝╚═╝     ╚═╝ ╚═════╝   ╚═══╝  ╚══════╝    ╚═╝     ╚═╝  ╚═╝  ╚═══╝   ╚═════╝ ╚═╝  ╚═╝╚═╝   ╚═╝   ╚══════╝
##################################################################################################################
   public function removefavorite($id)
   {
      $user = Auth::user()->id;
      $article = Article::find($id);

      $article->favorites()->detach($user);

      Session::flash ('success','The article was successfully removed to your Favorites list!');
      return redirect()->back();
   }


##################################################################################################################
# ██████╗ ███████╗███╗   ███╗ ██████╗ ██╗   ██╗███████╗    ██████╗ ██████╗ ██╗██╗   ██╗ █████╗ ████████╗███████╗
# ██╔══██╗██╔════╝████╗ ████║██╔═══██╗██║   ██║██╔════╝    ██╔══██╗██╔══██╗██║██║   ██║██╔══██╗╚══██╔══╝██╔════╝
# ██████╔╝█████╗  ██╔████╔██║██║   ██║██║   ██║█████╗      ██████╔╝██████╔╝██║██║   ██║███████║   ██║   █████╗  
# ██╔══██╗██╔══╝  ██║╚██╔╝██║██║   ██║╚██╗ ██╔╝██╔══╝      ██╔═══╝ ██╔══██╗██║╚██╗ ██╔╝██╔══██║   ██║   ██╔══╝  
# ██║  ██║███████╗██║ ╚═╝ ██║╚██████╔╝ ╚████╔╝ ███████╗    ██║     ██║  ██║██║ ╚████╔╝ ██║  ██║   ██║   ███████╗
# ╚═╝  ╚═╝╚══════╝╚═╝     ╚═╝ ╚═════╝   ╚═══╝  ╚══════╝    ╚═╝     ╚═╝  ╚═╝╚═╝  ╚═══╝  ╚═╝  ╚═╝   ╚═╝   ╚══════╝
##################################################################################################################
   public function removeprivate($id)
   {
      $article = Article::find($id);
         $article->personal = 0;
      $article->save();

      Session::flash('success','The article was removed from private successfully');
      return redirect()->back();
   }


##################################################################################################################
# ██████╗ ███████╗███████╗███████╗████████╗    ██╗   ██╗██╗███████╗██╗    ██╗███████╗
# ██╔══██╗██╔════╝██╔════╝██╔════╝╚══██╔══╝    ██║   ██║██║██╔════╝██║    ██║██╔════╝
# ██████╔╝█████╗  ███████╗█████╗     ██║       ██║   ██║██║█████╗  ██║ █╗ ██║███████╗
# ██╔══██╗██╔══╝  ╚════██║██╔══╝     ██║       ╚██╗ ██╔╝██║██╔══╝  ██║███╗██║╚════██║
# ██║  ██║███████╗███████║███████╗   ██║        ╚████╔╝ ██║███████╗╚███╔███╔╝███████║
# ╚═╝  ╚═╝╚══════╝╚══════╝╚══════╝   ╚═╝         ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝ ╚══════╝
// RESET VIEWS COUNT
##################################################################################################################
   public function resetViews($id)
   {
      $article = Article::find($id);
         $article->views = 0;
      $article->save();

      Session::flash('success','The article\'s views count was reset to 0.');
      return redirect()->back();
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
      $article = Article::withTrashed()->findOrFail($id);

      $article->restore();

      Session::flash ('success','The article was successfully restored.');
      return redirect()->route('articles.trashed');
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
      $checked = $request->input('checked');

      Article::whereIn('id', $checked)->restore();

      Session::flash('success','The selected articles were restored successfully.');
      return redirect()->route('articles.trashed');
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
      $articlelinks = DB::table('articles')
         ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
         ->where('published_at', '<=', Carbon::now())
         ->groupBy('year')
         ->groupBy('month')
         ->orderBy('year', 'desc')
         ->orderBy('month', 'desc')
         ->get();

      return view('articles.show', compact('article','articlelinks','next','previous'));
   }


##################################################################################################################
# ███████╗██╗  ██╗ ██████╗ ██╗    ██╗ TRASHED
# ██╔════╝██║  ██║██╔═══██╗██║    ██║
# ███████╗███████║██║   ██║██║ █╗ ██║
# ╚════██║██╔══██║██║   ██║██║███╗██║
# ███████║██║  ██║╚██████╔╝╚███╔███╔╝
# ╚══════╝╚═╝  ╚═╝ ╚═════╝  ╚══╝╚══╝ 
// Display the specified resource
##################################################################################################################
   public function showTrashed($id)
   {
      $article = Article::withTrashed()->findOrFail($id);

      return view('articles.showTrashed', compact('article'));
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
   public function store(CreateArticleRequest $request)
   {
      $article = new Article;
         $article->title             = $request->title;
         $article->category_id       = $request->category_id;
         $article->published_at      = $request->published_at;
         $article->description_eng   = $request->description_eng;
         $article->description_fre   = $request->description_fre;
         $article->user_id           = Auth::user()->id;
      $article->save();

      Session::flash('success','The article has been created successfully!');
      return redirect()->route('articles.index');
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗     ██████╗ ██████╗ ███╗   ███╗███╗   ███╗███████╗███╗   ██╗████████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝    ██╔════╝██╔═══██╗████╗ ████║████╗ ████║██╔════╝████╗  ██║╚══██╔══╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗      ██║     ██║   ██║██╔████╔██║██╔████╔██║█████╗  ██╔██╗ ██║   ██║   
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝      ██║     ██║   ██║██║╚██╔╝██║██║╚██╔╝██║██╔══╝  ██║╚██╗██║   ██║   
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗    ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║ ╚═╝ ██║███████╗██║ ╚████║   ██║   
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝     ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚═╝╚══════╝╚═╝  ╚═══╝   ╚═╝   
##################################################################################################################
   public function storeComment(CreateCommentRequest $request, $id)
   {
      $article = Article::find($id);

      $comment = new Comment();
         $comment->user_id = Auth::user()->id;
         $comment->comment = $request->comment;
      $article->comments()->save($comment);

      Session::flash('success', 'Comment added succesfully.');
      return redirect()->route('articles.show', $article->id);
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
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('backURL', Route::currentRouteName());

      $articles = Article::with('user','category')->onlyTrashed()->get();

      return view('articles.trashed', compact('articles'));
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

      foreach($checked as $article) {
         $article = Article::findOrFail($article);
         $article->published_at = Null;
         $article->save();
      }

      Article::destroy($checked);

      Session::flash('success','The selected articles were trashed successfully.');
      return redirect()->back();
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
      $article = Article::find($id);
         $article->published_at = NULL;
         $favorites = DB::select('select * from article_user where article_id = '. $id, [1]);

         foreach($favorites as $favorite) {
            $article->favorites()->detach($favorite);
         }

      $article->save();

      Session::flash ('success','The article was successfully unpublished');
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
      if(!checkACL('publisher')) {
         return view('errors.403');
      }

      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('backURL', Route::currentRouteName());

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
         $articles = Article::with('user','category')->unpublished()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
         return view('articles.unpublished', compact('articles','letters'));
      }

      // No $key value is passed
      $articles = Article::with('user','category')->unpublished()->get();
      return view('articles.unpublished', compact('articles','letters', 'backURL'));
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
      $this->validate($request, [
         'checked' => 'required',
      ]);

      $checked = $request->input('checked');

      foreach ($checked as $item) {
         $article = Article::withTrashed()->find($item);
            $article->published_at = Null;

            // Delete related favorites
            $favorites = DB::select('select * from article_user where article_id = '. $article->id, [1]);
               foreach($favorites as $favorite) {
                  $article->favorites()->detach($favorite);
               }

         $article->save();
      }
      

      Session::flash('success','The selected articles were unpublished successfully.');
      return redirect()->back();
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
   public function update(UpdateArticleRequest $request, $id)
   {
      
      $article = Article::findOrFail($id);
         $article->title             = $request->title;
         $article->category_id       = $request->category_id;
         $article->published_at      = $request->published_at;
         $article->description_eng   = $request->description_eng;
         $article->description_fre   = $request->description_fre;
      $article->save();
      
      Session::flash('success','The article has been updated successfully.');
      return redirect()->route('articles.show', $article);
   }


}
