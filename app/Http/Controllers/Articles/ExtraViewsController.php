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

      // // Get list of articles by year and month
      // $articlelinks = DB::table('articles')
      //    ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) article_count'))
      //    ->where('published_at', '<=', Carbon::now())
      //    ->groupBy('year')
      //    ->groupBy('month')
      //    ->orderBy('year', 'desc')
      //    ->orderBy('month', 'desc')
      //    ->get();

      $archives = Article::with('user')->whereYear('created_at','=', $year)
         ->whereMonth('created_at','=', $month)
         ->where('published_at', '<=', Carbon::now())
         ->get();

      return view('articles.archive', compact('archives','articlelinks'))->withYear($year)->withMonth($month);
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