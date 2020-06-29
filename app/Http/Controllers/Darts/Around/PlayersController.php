<?php

namespace App\Http\Controllers\Darts\Around;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\Darts\Game;
use App\Models\Darts\Score;
use App\Models\User;

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
   public function index($gameID)
   {
      $game = Game::find($gameID);
      // $players = zeroOnePlayers($gameID);
      // $nextShot = zeroOneNextShot($gameID);
      // $player = DB::table('dart__players')->where('game_id', $gameID)->where('shooting_order', $nextShot)->first();
      // $user = User::where('id', $player->user_id)->first();
      // $remainingScore = $game->type - zeroOnePlayerScore($gameID, $player->user_id)->sum('score');

      // // Check if any one of the players has won the game (remaining score = 0)
      // $gameOver = DB::table('dart__scores')->where('game_id', $gameID)->where('remaining', 0)->first();
      
      // foreach($players as $p){
      //    if ($gameOver){
      //       $gameDone = 1;
      //    } else {
      //       $gameDone = 0;
      //    }
      // }

      // return view('darts.01.players.index', compact('game','nextShot','players','player','user','remainingScore','gameDone'));
      
      $pies = collect([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,25]);
      $pies_1 = collect([1,2,3,4,5,6,7]);
      $pies_2 = collect([8,9,10,11,12,13,14]);
      $pies_3 = collect([15,16,17,18,19,20,25]);
      // dd($pies);
      $players = aroundPlayers($gameID);

      return view('darts.around.players.index', compact('game','pies', 'pies_1', 'pies_2', 'pies_3','players'));
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
      $this->validate($request, [
         'game_id' => 'required',
         'user_id' => 'required',
         'score' => 'required|integer|max:180',
         'remainingScore*' => 'required',
      ],
      [
         'user_id.required' => 'Please select a player.',
         'score.required' => 'Please enter a score.',
         'score.integer' => 'Score must be a number.',
         'score.max' => 'Score must be 180 or less.'
      ]);

      // Is the entered score less than 0?
      if($request->score < 0){
         Session::flash('dart-error','Invalid Score! You need to enter a score above 0. Please try again.');
         return redirect()->back();
      }

      // Is the entered score greater than 180?
      if($request->score > 180){
         Session::flash('dart-error','Invalid Score! Total score cannot exceed 180. Please try again.');
         return redirect()->back();
      }

      // Would the entered score leave 1 remaining which is not possible
      if($request->remainingScore - $request->score == 1){
         $score = new Score;
            $score->user_id = $request->user_id;
            $score->game_id = $request->game_id;
            $score->score = 0;
            $score->remaining = $request->remainingScore;
         $score->save();

         Session::flash('dart-error','This score cannot be registered as it would leave an impossibility to finish with a Double Out. A value of 0 will be added to the scoresheet.');
         return redirect()->back();
      }

      // 0 score entered
      if($request->score == 0){
         $score = new Score;
            $score->user_id = $request->user_id;
            $score->game_id = $request->game_id;
            $score->score = 0;
            $score->remaining = $request->remainingScore;
         $score->save();

         Session::flash('dart-error','A score value of 0 has been added to the scoresheet.');
         return redirect()->back();
      }

      // Is the entered score greater than the remaining score?
      if($request->score > $request->remainingScore){
         $score = new Score;
            $score->user_id = $request->user_id;
            $score->game_id = $request->game_id;
            $score->score = 0;
            $score->remaining = $request->remainingScore;
         $score->save();

         Session::flash('dart-error','The registered score is higher than the required score to finish. A value of 0 will be added to the scoresheet.');
         return redirect()->back();
      }

      // All checks passed, enter the score in the DB
      $score = new Score;
         $score->user_id = $request->user_id;
         $score->game_id = $request->game_id;
         $score->score = $request->score;
         $score->remaining = $request->remainingScore - $request->score;
      $score->save();

      // Change the game status to In Progress 
      $game = Game::find($request->game_id);
         $game->status = 'In Progress';
      $game->save();

      if(zeroOneGameWinner($game) == true) {
         $game = Game::find($request->game_id);
            $game->status = 'Completed';
         $game->save();
      }

      Session::flash('dart-success','The scoresheet has been updated.');
      return redirect()->back();
   }


##################################################################################################################
#  ██████╗ ██████╗ ███╗   ███╗██████╗ ██╗     ███████╗████████╗███████╗
# ██╔════╝██╔═══██╗████╗ ████║██╔══██╗██║     ██╔════╝╚══██╔══╝██╔════╝
# ██║     ██║   ██║██╔████╔██║██████╔╝██║     █████╗     ██║   █████╗  
# ██║     ██║   ██║██║╚██╔╝██║██╔═══╝ ██║     ██╔══╝     ██║   ██╔══╝  
# ╚██████╗╚██████╔╝██║ ╚═╝ ██║██║     ███████╗███████╗   ██║   ███████╗
#  ╚═════╝ ╚═════╝ ╚═╝     ╚═╝╚═╝     ╚══════╝╚══════╝   ╚═╝   ╚══════╝
##################################################################################################################
   public function completed($id)
   {
      // Change the game status to Completed
      $game = Game::find($id);
         $game->status = 'Completed';
      $game->save();

      Session::flash('dart-success','The game as been marked as completed.');
      return redirect()->route('darts.games.board');
   }
}
