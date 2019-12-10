<?php

namespace App\Http\Controllers\Darts\ZeroOne;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\Darts\Game;
use App\Models\Darts\Score;
use App\Models\User;


class TeamsController extends Controller
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

   // public function index($gameID)
   // {
   //    $game = Game::find($gameID);
   //    // dd($game);
   //    // $players = zeroOneTeamPlayers($gameID);
   //    // dd ($players);

   //    // return view('darts.01.teams.index', compact('game', 'players'));
   //    return view('darts.01.teams.index', compact('game'));
   // }
   public function index($gameID, Request $request)
   {
      // dd($gameID);
      $game = Game::find($gameID);
      // dd($game);

      // dd($request->tID);
      // $teamID = 1;
      if(!$request->tID) {
         $tID = 1;
      }

      if($request->tID == 2){
         $tID = 1;
      }

      if($request->tID == 1){
         $tID = 2;
      }

      $players = zeroOneTeamPlayers($game, $request->tID);
      // dd($players);
      
      $nextShot = zeroOneNextShot($gameID);
      // dd($nextShot);

      $player = DB::table('dart__players')->where('game_id', $gameID)->where('shooting_order', $nextShot)->first();
      // dd($player);

      $user = User::where('id', $player->user_id)->first();
      // dd($user);

      $remainingScore = $game->type - zeroOneTeamScores($game, $tID)->sum('score');
      // dd($remainingScore);

      // Check if any one of the players has won the game (remaining score = 0)
      // dd($game->id);
      // dd($tID);
      $teamGameOver = DB::table('dart__scores')
         ->where('game_id', $game->id)
         // ->where('team_id', $tID)
         ->where('remaining', 0)
         ->first();
      // dd($teamGameOver);
      
      // foreach($players as $p){
         if (!$teamGameOver){
            $teamGameDone = 0;
            // dd("Game not over yet");
         } else {
            $teamGameDone = 1;
            // dd("Game over");
         }
      // }

      // foreach($players as $p){
      //    if ($teamGameOver){
      //       $teamGameDone = 1;
      //    } else {
      //       $teamGameDone = 0;
      //    }
      // }

      return view('darts.01.teams.index', compact('game','tID','nextShot','players','player','user','remainingScore','teamGameDone'));
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
      // if(!checkACL('manager')) {
      //   return view('errors.403');
      // }

      $this->validate($request, [
         'game_id' => 'required',
         'team_id' => 'required',
         'user_id' => 'required',
         'score1' => 'sometimes|required|integer|max:180',
         'score2' => 'sometimes|required|integer|max:180'
      ],
      [
         'user_id.required' => 'Please select a player.',
         'score1.required' => 'Please enter a score.',
         'score1.integer' => 'Score must be a number.',
         'score1.max' => 'Score must be less than 181.',
         'score2.required' => 'Please enter a score.',
         'score2.integer' => 'Score must be a number.',
         'score2.max' => 'Score must be less than 181.',
      ]);

// dd($request);

      // Determine which score box has data
      if($request->score1) {
         $whichScore = $request->score1;
      }else{
         $whichScore = $request->score2;
      }

      // Is the entered score less than 0?
      if($whichScore < 0){
         Session::flash('dart-error','Invalid Score! You need to enter a score above 0. Please try again.');
         // return redirect()->route('darts.01.scoers.teams.index', $request->game_id);
         return redirect()->back();
      }

      // Is the entered score greater than 180?
      if($whichScore > 180){
         Session::flash('dart-error','Invalid Score! Total score cannot exceed 180. Please try again.');
         // return redirect()->route('darts.01.teams.index', $request->game_id);
         return redirect()->back();
      }

      // Would the entered score leave 1 remaining which is not possible
      if($request->remainingScore - $whichScore == 1){
         $score = new Score;
            $score->user_id = $request->user_id;
            $score->team_id = $request->team_id;
            $score->game_id = $request->game_id;
            $score->score = 0;
            $score->remaining = $request->remainingScore;
         $score->save();

         Session::flash('dart-error','This score cannot be registered as it would leave an impossibility to finish with a Double Out. A value of 0 will be added to the scoresheet.');
         // return redirect()->route('darts.01.teams.index', $request->game_id);
         return redirect()->back();
      }

      // Is the entered score greater than the remaining score?
      if($whichScore > $request->remainingScore){
         $score = new Score;
            $score->user_id = $request->user_id;
            $score->team_id = $request->team_id;
            $score->game_id = $request->game_id;
            $score->score = 0;
            $score->remaining = $request->remainingScore;
         $score->save();

         Session::flash('dart-error','The registered score is higher than the required score to finish. A value of 0 will be added to the scoresheet.');
         // return redirect()->route('darts.01.teams.index', $request->game_id);
         return redirect()->back();
      }

      // All checks passed, enter the score in the DB
      $score = new Score;
         $score->user_id = $request->user_id;
         $score->team_id = $request->team_id;
         $score->game_id = $request->game_id;
         $score->score = $whichScore;
         $score->remaining = $request->remainingScore - $whichScore;
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
      // return redirect()->back();
      $gID = $request->game_id;
      // dd($gID);
      $tID = $request->team_id;
      // dd($tID);
      // return redirect()->route('darts.01.teams.index', $request->game_id);
      return redirect()->route('darts.01.teams.index', compact('gID', 'tID'));
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
