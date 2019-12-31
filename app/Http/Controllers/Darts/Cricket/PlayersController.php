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
   
// <i class="fas fa-times-circle"></i>
// <i class="fas fa-plus-circle"></i>
// <i class="fas fa-minus-circle"></i>

   public function index($gameID)
   {
      $game = Game::find($gameID);
      $players = cricketPlayers($gameID);
      // dd($players);
      $twenty_1_count_plus = Score::where('user_id',2)->where('score',20)->where('game_id',$game->id)->count();
      $twenty_1_count_minus = Score::where('user_id',2)->where('score',-20)->where('game_id',$game->id)->count();
      $twenty_1_count = $twenty_1_count_plus - $twenty_1_count_minus;
      // $twenty_1_points = Score::where('user_id',2)->where('game_id',$game->id)->where('score',20)->sum('score')-60;
      $twenty_1_points = $twenty_1_count * 20 - 60;
      // dd($twenty_1_points);

      $twenty_2_count_plus = Score::where('user_id',3)->where('score',20)->where('game_id',$game->id)->count();
      $twenty_2_count_minus = Score::where('user_id',3)->where('score',-20)->where('game_id',$game->id)->count();
      $twenty_2_count = $twenty_2_count_plus - $twenty_2_count_minus;
      // $twenty_2_points = Score::where('user_id',3)->where('game_id',$game->id)->where('score',20)->sum('score')-60;
      $twenty_2_points = $twenty_2_count * 20 - 60;

      $nineteen_1_count_plus = Score::where('user_id',2)->where('score',19)->where('game_id',$game->id)->count();
      $nineteen_1_count_minus = Score::where('user_id',2)->where('score',-19)->where('game_id',$game->id)->count();
      $nineteen_1_count = $nineteen_1_count_plus - $nineteen_1_count_minus;
      // $nineteen_1_points = Score::where('user_id',2)->where('game_id',$game->id)->sum('score')-57;
      $nineteen_1_points = $nineteen_1_count * 19 - 57;

      $nineteen_2_count_plus = Score::where('user_id',3)->where('score',19)->where('game_id',$game->id)->count();
      $nineteen_2_count_minus = Score::where('user_id',3)->where('score',-19)->where('game_id',$game->id)->count();
      $nineteen_2_count = $nineteen_2_count_plus - $nineteen_2_count_minus;
      // $nineteen_2_points = Score::where('user_id',3)->where('game_id',$game->id)->sum('score')-57;
      $nineteen_2_points = $nineteen_2_count * 19 - 57;

      return view('darts.cricket.players.index', compact(
         'game','players',
         'twenty_1_count','twenty_1_points',
         'twenty_2_count','twenty_2_points',
         'nineteen_1_count','nineteen_1_points',
         'nineteen_2_count','nineteen_2_points'
      ));
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
