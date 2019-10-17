<?php

namespace App\Http\Controllers\Admin\Articles;

use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Articles\Article;
// use App\Models\Tag;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Carbon\Carbon;
use DB;
// use File;
// use Image;
// use Log;
// use Purifier;
use Route;
use Session;
// use Storage;
// use URL;

class ExtraViewsController extends Controller
{

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
         return view('admin.articles.pages.future', compact('articles','letters'));
      }

      // No $key value is passed
      $articles = Article::with('user','category')->future()->get();
      return view('admin.articles.pages.future', compact('articles','letters'));
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
         return view('admin.articles.pages.myArticles', compact('articles','letters'));
      }

      $articles = Article::with('user','category')->myArticles()->get();
      return view('admin.articles.pages.myArticles', compact('articles','letters'));
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
         return view('admin.articles.pages.newArticles', compact('articles','letters'));
      }

      $articles = Article::with('user','category')->newarticles()->get();
      return view('admin.articles.pages.newArticles', compact('articles','letters'));
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
      // Set the variable so we can use a button in other pages to come back to this page
      Session::put('backURL', Route::currentRouteName());

      $articles = Article::with('user','category')->onlyTrashed()->get();

      return view('admin.articles.pages.trashed', compact('articles'));
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
         return view('admin.articles.pages.unpublished', compact('articles','letters'));
      }

      // No $key value is passed
      $articles = Article::with('user','category')->unpublished()->get();
      return view('admin.articles.pages.unpublished', compact('articles','letters', 'backURL'));
   }


}
