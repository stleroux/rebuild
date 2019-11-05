<?php

namespace App\Http\Controllers\Tests;

// use App\Http\Requests\TestRequest;
use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Tests\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Carbon\Carbon;
use DB;
use Route;
use Session;

class ExtraViewsController extends TestsController
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
         if(!checkPerm('test_browse')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      $archives = Test::with('user')->whereYear('created_at','=', $year)
         ->whereMonth('created_at','=', $month)
         ->where('published_at', '<=', Carbon::now())
         ->get();

      return view('tests.archives', compact('archives','archivesLinks'))->withYear($year)->withMonth($month);
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
   public function myFavorites(Request $request, $key=null)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('test_browse')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      if(Auth::check()) {
         $user = Auth::user();
         $tests = $user->favorite(Test::class)->sortBy('title');
      }

      return view('tests.myFavorites', compact('tests'));
   }

}