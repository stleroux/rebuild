<?php

namespace App\Http\Controllers\Articles;

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

}