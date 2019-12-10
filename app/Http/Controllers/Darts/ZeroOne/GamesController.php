<?php

namespace App\Http\Controllers\Darts\ZeroOne;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Session;
use App\Models\User;
use App\Models\Darts\Game;
use App\Models\Darts\Score;


class GamesController extends Controller
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
      $this->enablePermissions = true;
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
   public function index()
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('dart_browse')) { abort(401, 'Unauthorized Access'); }
      }

      return view('darts.index');
   }


##################################################################################################################
#  ██████╗██████╗ ███████╗ █████╗ ████████╗███████╗
# ██╔════╝██╔══██╗██╔════╝██╔══██╗╚══██╔══╝██╔════╝
# ██║     ██████╔╝█████╗  ███████║   ██║   █████╗  
# ██║     ██╔══██╗██╔══╝  ██╔══██║   ██║   ██╔══╝  
# ╚██████╗██║  ██║███████╗██║  ██║   ██║   ███████╗
#  ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
// Show the form for creating a new resource
##################################################################################################################
   public function create()
   {
      // Check if user has required permission
      if($this->enablePermissions) {
         if(!checkPerm('dart_add')) { abort(401, 'Unauthorized Access'); }
      }

      $users = User::where('id', '!=', 1)->orderby('username','asc')->get();
      return view('darts.games.create', compact('users'));
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// Store a newly created resource in storage
##################################################################################################################
   public function store(Request $request)
   {
      // validate the data
      $this->validate($request, [
         'type' => 'required',
      ]);

      $game = new Game;
         $game->type = $request->type;
         $game->status = 'New';
      $game->save();

      // Session::flash('success','The game has been created.');
      return redirect()->route('darts.games.selectTeamsOrPlayers', $game->id);
   }


##################################################################################################################
# ███████╗███████╗██╗     ███████╗ ██████╗████████╗
# ██╔════╝██╔════╝██║     ██╔════╝██╔════╝╚══██╔══╝
# ███████╗█████╗  ██║     █████╗  ██║        ██║   
# ╚════██║██╔══╝  ██║     ██╔══╝  ██║        ██║   
# ███████║███████╗███████╗███████╗╚██████╗   ██║   
# ╚══════╝╚══════╝╚══════╝╚══════╝ ╚═════╝   ╚═╝   
// Store a newly created resource in storage
##################################################################################################################
   public function selectTeamsOrPlayers($game_id)
   {
      $game = Game::find($game_id);
      return view('darts.games.selectTeamsOrPlayers', compact('game'));
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// Store a newly created resource in storage
##################################################################################################################
   public function storeTeamsOrPlayers(Request $request)
   {
      $game = Game::find($request->game_id);
         if($request->t_players) {
            $game->t1_players = $request->t_players;
            $game->t2_players = $request->t_players;
            $game->ind_players = null; 
         }
         if($request->ind_players){
            $game->t1_players = null;
            $game->t2_players = null;
            $game->ind_players = $request->ind_players; 
         }
      $game->save();

      // Session::flash('success','The game has been created 1111111.');
      if($request->t_players) {
         return redirect()->route('darts.games.selectTeamPlayers', $game->id);
      } else {
         return redirect()->route('darts.games.selectPlayers', $game->id);
      }
   }


##################################################################################################################
# ███████╗███████╗██╗     ███████╗ ██████╗████████╗
# ██╔════╝██╔════╝██║     ██╔════╝██╔════╝╚══██╔══╝
# ███████╗█████╗  ██║     █████╗  ██║        ██║   
# ╚════██║██╔══╝  ██║     ██╔══╝  ██║        ██║   
# ███████║███████╗███████╗███████╗╚██████╗   ██║   
# ╚══════╝╚══════╝╚══════╝╚══════╝ ╚═════╝   ╚═╝   
// Select players when team play is selected
##################################################################################################################
   public function selectTeamPlayers(Request $request, $game_id)
   {
      $game = Game::find($game_id);
      $players = User::where('id', '!=', 1)->orderby('username', 'asc')->get();
      return view('darts.games.selectTeamPlayers', compact('players','game'));
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// Save players when team play is selected
##################################################################################################################
   public function storeTeamPlayers(Request $request)
   {
      $game = Game::find($request->game_id);

      if (isset($request->team1players))
      {
         $shotOrder = 1;
         foreach($request->team1players as $player)
         {
            DB::insert('insert into dart__players (game_id, team_id, user_id, shooting_order) values (?, ?, ?, ?)', [$game->id, 1, $player, $shotOrder]);
            $shotOrder = $shotOrder + 2;
         }
      }

      if (isset($request->team2players))
      {
         $shotOrder = 2;
         foreach($request->team2players as $player)
         {
            DB::insert('insert into dart__players (game_id, team_id, user_id, shooting_order) values (?, ?, ?, ?)', [$game->id, 2, $player, $shotOrder]);
            $shotOrder = $shotOrder + 2;
         }
      }

      Session::flash('success','The game has been created.');
      return redirect()->route('darts.games.board');
   }


##################################################################################################################
# ███████╗███████╗██╗     ███████╗ ██████╗████████╗
# ██╔════╝██╔════╝██║     ██╔════╝██╔════╝╚══██╔══╝
# ███████╗█████╗  ██║     █████╗  ██║        ██║   
# ╚════██║██╔══╝  ██║     ██╔══╝  ██║        ██║   
# ███████║███████╗███████╗███████╗╚██████╗   ██║   
# ╚══════╝╚══════╝╚══════╝╚══════╝ ╚═════╝   ╚═╝   
// Select individual players when no team play is selected
##################################################################################################################
   public function selectPlayers($game_id)
   {
      $game = Game::find($game_id);
      $players = User::where('id', '!=', 1)->orderby('username', 'asc')->get();
      return view('darts.games.selectPlayers', compact('players','game'));
   }


##################################################################################################################
# ███████╗████████╗ ██████╗ ██████╗ ███████╗
# ██╔════╝╚══██╔══╝██╔═══██╗██╔══██╗██╔════╝
# ███████╗   ██║   ██║   ██║██████╔╝█████╗  
# ╚════██║   ██║   ██║   ██║██╔══██╗██╔══╝  
# ███████║   ██║   ╚██████╔╝██║  ██║███████╗
# ╚══════╝   ╚═╝    ╚═════╝ ╚═╝  ╚═╝╚══════╝
// Save individual players when no team play is selected
##################################################################################################################
   public function storePlayers(Request $request)
   {

      $game = Game::find($request->game_id);
      $shotOrder = 1;
      foreach($request->players as $player)
      {
         DB::insert('insert into dart__players (game_id, user_id, shooting_order) values (?, ?, ?)', [$request->game_id, $player, $shotOrder]);
         $shotOrder = $shotOrder + 1;
      }
      
      Session::flash('success','The game has been created.');
      return redirect()->route('darts.games.board');
   }


##################################################################################################################
# ██████╗ ███████╗███████╗████████╗██████╗  ██████╗ ██╗   ██╗
# ██╔══██╗██╔════╝██╔════╝╚══██╔══╝██╔══██╗██╔═══██╗╚██╗ ██╔╝
# ██║  ██║█████╗  ███████╗   ██║   ██████╔╝██║   ██║ ╚████╔╝ 
# ██║  ██║██╔══╝  ╚════██║   ██║   ██╔══██╗██║   ██║  ╚██╔╝  
# ██████╔╝███████╗███████║   ██║   ██║  ██║╚██████╔╝   ██║   
# ╚═════╝ ╚══════╝╚══════╝   ╚═╝   ╚═╝  ╚═╝ ╚═════╝    ╚═╝   
// Remove the specified resource from storage
// Used in the index page and trashAll action to soft delete multiple records
##################################################################################################################
   public function destroy($id)
   {
      // if(!checkACL('manager')) {
      //   return view('errors.403');
      // }

      // Delete related entries
      $users = DB::table('dart__players')->where('game_id', $id)->delete();
      $scores = DB::table('dart__scores')->where('game_id', $id)->delete();

      $game = Game::find($id);
      $game->delete();

      Session::flash('success', 'The game and related entries were successfully deleted!');
      return redirect()->route('darts.games.board');
   }
   
}
