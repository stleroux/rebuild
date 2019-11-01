<?php

namespace App\Http\Controllers\Admin\Tests;

use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Tests\Test;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Auth;
use Carbon\Carbon;
use DB;
use Route;
use Session;

class ExtraViewsController extends Controller
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
   public function archive($year, $month)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('test_read')) { abort(401, 'Unauthorized Access'); }
      }

      $archives = Test::with('user')->whereYear('created_at','=', $year)
         ->whereMonth('created_at','=', $month)
         ->where('published_at', '<=', Carbon::now())
         ->get();

      return view('admin.tests.pages.archive', compact('archives','testlinks'))->withYear($year)->withMonth($month);
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('test_edit')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('tests')
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
         $tests = Test::with('user')->future()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
         return view('admin.tests.pages.future', compact('tests','letters'));
      }

      // No $key value is passed
      $tests = Test::with('user')->future()->get();
      return view('admin.tests.pages.future', compact('tests','letters'));
   }


##################################################################################################################
# ███╗   ███╗██╗   ██╗
# ████╗ ████║╚██╗ ██╔╝
# ██╔████╔██║ ╚████╔╝ 
# ██║╚██╔╝██║  ╚██╔╝  
# ██║ ╚═╝ ██║   ██║   
# ╚═╝     ╚═╝   ╚═╝   
// Display a listing of the resource that belong to a specific user.
##################################################################################################################
   public function myTests(Request $request, $key=null)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('test_browse')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('tests')
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
         $tests = Test::with('user')->myTests()
            ->where('title', 'like', $key . '%')
            ->get();
         return view('admin.tests.pages.myTests', compact('tests','letters'));
      }

      $tests = Test::with('user')->myTests()->get();
      return view('admin.tests.pages.myTests', compact('tests','letters'));
   }


##################################################################################################################
# ███╗   ██╗███████╗██╗    ██╗
# ████╗  ██║██╔════╝██║    ██║
# ██╔██╗ ██║█████╗  ██║ █╗ ██║
# ██║╚██╗██║██╔══╝  ██║███╗██║
# ██║ ╚████║███████╗╚███╔███╔╝
# ╚═╝  ╚═══╝╚══════╝ ╚══╝╚══╝ 
// Display a listing of the resource that were created since the user's last login.
##################################################################################################################
   public function newTests(Request $request, $key=null)
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('test_edit')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('tests')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         ->where('created_at', '>=' , Auth::user()->previous_login_date)
         ->orderBy('letter')
         ->get();

      $letters = [];
      foreach($alphas as $alpha) {
        $letters[] = $alpha->letter;
      }

      // If $key value is passed
      if ($key) {
         $tests = Test::with('user')->newTests()
            ->where('title', 'like', $key . '%')
            ->get();
         return view('admin.tests.pages.newTests', compact('tests','letters'));
      }

      $tests = Test::with('user')->newTests()->get();
      return view('admin.tests.pages.newTests', compact('tests','letters'));
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
      $test = Test::find($id);

      return view('admin.tests.print', compact('test'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('test_edit')) { abort(401, 'Unauthorized Access'); }
      }

      //$alphas = range('A', 'Z');
      $alphas = DB::table('tests')
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
         $tests = Test::with('user')->published()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
         return view('admin.tests.published', compact('tests','letters'));
      }

      // No $key value is passed
      $tests = Test::with('user')->published()->get();
      return view('admin.tests.published', compact('tests','letters'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('test_delete')) { abort(401, 'Unauthorized Access'); }
      }

      $test = Test::withTrashed()->findOrFail($id);

      return view('admin.tests.pages.showTrashed', compact('test'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('test_delete')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
      $alphas = DB::table('tests')
         ->select(DB::raw('DISTINCT LEFT(title, 1) as letter'))
         ->where('deleted_at','!=', Null)
         ->orderBy('letter')
         ->get();

      $letters = [];
      foreach($alphas as $alpha) {
        $letters[] = $alpha->letter;
      }

      $tests = Test::with('user')->onlyTrashed()->get();

      return view('admin.tests.pages.trashed', compact('tests','letters'));
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
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('test_edit')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());

      //$alphas = range('A', 'Z');
        $alphas = DB::table('tests')
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
         $tests = Test::with('user')->unpublished()
            ->where('title', 'like', $key . '%')
            ->orderBy('title', 'asc')
            ->get();
         return view('admin.tests.pages.unpublished', compact('tests','letters'));
      }

      // No $key value is passed
      $tests = Test::with('user')->unpublished()->get();
      return view('admin.tests.pages.unpublished', compact('tests','letters'));
   }


}
