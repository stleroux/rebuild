<?php

namespace App\Http\Controllers\Tests;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Required for validation // use Illuminate\Routing\Controller;
use App\Models\Tests\Test;
use Carbon\Carbon;
use DB;
use Session;

class TestsController extends Controller
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
          if(!checkPerm('test_browse')) { abort(401, 'Unauthorized Access'); }
      }

      // Set the session to the current page route
      Session::put('fromPage', url()->full());
      
      //$alphas = range('A', 'Z');
      $alphas = DB::table('tests')
          ->select(DB::raw('DISTINCT LEFT(name, 1) as letter'))
          ->where('published_at','<', Carbon::Now())
          ->orderBy('letter')
          ->get();

      $letters = [];
      foreach($alphas as $alpha) {
          $letters[] = $alpha->letter;
      }

      // If $key value is passed
      if ($key) {
          $tests = Test::with('user')->published()
               ->where('name', 'like', $key . '%')
               ->orderBy('name', 'asc')
               ->get();
          return view('tests.index', compact('tests','letters','archivesLinks'));
      }

      // No $key value is passed
      $tests = Test::with('user')->published()->get();
      return view('tests.index', compact('tests','letters','archivesLinks'));
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
             if(!checkPerm('test_read')) { abort(401, 'Unauthorized Access'); }
         }

         $test = Test::findOrFail($id);

         // get previous test id
         $previous = Test::published()->where('id', '<', $test->id)->max('id');

         // get next article id
         $next = Test::published()->where('id', '>', $test->id)->min('id');

         // Add 1 to views column
         DB::table('tests')->where('id','=',$test->id)->increment('views',1);

         return view('tests.show', compact('test','archivesLinks','next','previous'));
    }


}
