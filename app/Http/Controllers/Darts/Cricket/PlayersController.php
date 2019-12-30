<?php

namespace App\Http\Controllers\Darts\Cricket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\User;
use App\Models\Darts\Game;
use App\Models\Darts\Score;


class PlayersController extends Controller
{
##################################################################################################################
#  ██████╗ ██████╗ ███╗   ██╗███████╗████████╗██████╗ ██╗   ██╗ ██████╗████████╗
# ██╔════╝██╔═══██╗████╗  ██║██╔════╝╚══██╔══╝██╔══██╗██║   ██║██╔════╝╚══██╔══╝
# ██║     ██║   ██║██╔██╗ ██║███████╗   ██║   ██████╔╝██║   ██║██║        ██║   
# ██║     ██║   ██║██║╚██╗██║╚════██║   ██║   ██╔══██╗██║   ██║██║        ██║   
# ╚██████╗╚██████╔╝██║ ╚████║███████║   ██║   ██║  ██║╚██████╔╝╚██████╗   ██║   
#  ╚═════╝ ╚═════╝ ╚═╝  ╚═══╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝  ╚═════╝   ╚═╝   
##################################################################################################################
   // public function __construct()
   // {
   //    $this->middleware('auth');
   //    $this->enablePermissions = false;
   // }
   

   public function index($gameID)
   {
      $game = Game::find($gameID);
      $players = cricketPlayers($gameID);
      // dd($players);
      return view('darts.cricket.players.index', compact('game','players'));
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
##################################################################################################################
   public function store(Request $request)
   {
      // dd ($request);
      // dd($request->score);
      // dd($request->input('action'));
      // dd($request->input('user_id'));
      // dd($request->input('game_id'));

      // Determine which button was clicked
      // switch ($request->input('action')) {
      //    case 'twenty_1_plus':
      //       return "TWENTY_1_PLUS";
      //       // break;

      //    case 'twenty_1_minus':
      //       return "TWENTY_1_MINUS";
      //       // break;

      //    case 'twenty_2_plus':
      //       return "TWENTY_2_PLUS";
      //       // break;

      //    case 'twenty_2_minus':
      //       return "TWENTY_2_MINUS";
      //       // break;
      // }

      // All checks passed, enter the score in the DB
      $score = new Score;
         $score->user_id = $request->user_id;
         $score->game_id = $request->game_id;
         $score->score = $request->score;
         // $score->score = $request->input('action');
         // $score->remaining = $request->remainingScore - $request->score;
      // dd("HERE");
      $score->save();

      Session::flash('dart-success','The scoresheet has been updated.');
      return redirect()->back();
   }


}
