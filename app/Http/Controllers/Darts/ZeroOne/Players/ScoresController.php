<?php

namespace App\Http\Controllers\Darts\ZeroOne\Players;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\Darts\Game;
use App\Models\Darts\Score;
use App\Models\User;

class ScoresController extends Controller
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

   public function index($gameID)
   {
      // dd($gameID);
      $game = Game::find($gameID);
      // dd($game);
      $players = zeroOnePlayers($gameID);
      // dd($players);
      $nextShot = zeroOneNextShot($gameID);
      // dd($nextShot);
      $player = DB::table('dart__players')->where('game_id', $gameID)->where('shooting_order', $nextShot)->first();
      // dd($player);
      $user = User::where('id', $player->user_id)->first();
      // dd($user->username);
      $remainingScore = $game->type - zeroOnePlayerScore($gameID, $player->user_id)->sum('score');
      // dd($remainingScore);

      // Check if any one of the players has won the game (remaining score = 0)
      $gameOver = DB::table('dart__scores')->where('game_id', $gameID)->where('remaining', 0)->first();
      
      foreach($players as $p){
         if ($gameOver){
            $gameDone = 1;
         } else {
            $gameDone = 0;
         }
      }

      return view('darts.01.scores.players.index', compact('game','nextShot','players','player','user','remainingScore','gameDone'));
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
      // dd($request);
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
         'score.max' => 'Score must be less than 181.'
      ]);

      // Is the entered score less than 0?
      if($request->score < 0){
         Session::flash('dart-error','Invalid Score! You need to enter a score above 0. Please try again.');
         // return redirect()->route('darts.01.scores.players.index', $request->game_id);
         return redirect()->back();
      }

      // Is the entered score greater than 180?
      if($request->score > 180){
         Session::flash('dart-error','Invalid Score! Total score cannot exceed 180. Please try again.');
         // return redirect()->route('darts.01.scores.players.index', $request->game_id);
         return redirect()->back();
      }

      // Would the entered score leave 1 remaining which is not possible
      if($request->remainingScore - $request->score == 1){
         $score = new Score;
            $score->user_id = $request->user_id;
            // $score->team_id = $request->team_id;
            $score->game_id = $request->game_id;
            $score->score = 0;
            $score->remaining = $request->remainingScore;
         $score->save();

         Session::flash('dart-error','This score cannot be registered as it would leave an impossibility to finish with a Double Out. A value of 0 will be added to the scoresheet.');
         // return redirect()->route('darts.01.scores.players.index', $request->game_id);
         return redirect()->back();
      }

      // Is the entered score greater than the remaining score?
      if($request->score > $request->remainingScore){
         $score = new Score;
            $score->user_id = $request->user_id;
            // $score->team_id = $request->team_id;
            $score->game_id = $request->game_id;
            $score->score = 0;
            $score->remaining = $request->remainingScore;
         $score->save();

         Session::flash('dart-error','The registered score is higher than the required score to finish. A value of 0 will be added to the scoresheet.');
         // return redirect()->route('darts.01.scores.players.index', $request->game_id);
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


      // Save entry to log file using built-in Monolog
      //Log::info(Auth::user()->username . " (" . Auth::user()->id . ") CREATED category (" . $category->id . ")\r\n", [$category = json_decode($category, true)]);

      Session::flash('dart-success','The scoresheet has been updated.');
      // return redirect()->route('darts.01.scores.players.index', $request->game_id);
      return redirect()->back();
   }



   public function edit($id)
   {
      //
   }


   public function update(Request $request, $id)
   {
      //
   }


   public function destroy($id)
   {
      //
   }



}
