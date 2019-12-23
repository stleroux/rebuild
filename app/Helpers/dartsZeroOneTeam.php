<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ██████╗  █████╗ ██████╗ ████████╗███████╗
// ██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
// ██║  ██║███████║██████╔╝   ██║   ███████╗
// ██║  ██║██╔══██║██╔══██╗   ██║   ╚════██║
// ██████╔╝██║  ██║██║  ██║   ██║   ███████║
// ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Team games played
function zeroOneTeamGamesPlayedStat($player) {
   $val = DB::table('dart__scores')
      ->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
      ->where('dart__games.status', 'Completed')
      ->where('dart__scores.team_id', '!=', 0)
      ->where('dart__scores.user_id', $player->id)
      ->distinct('dart__scores.game_id')
      ->count('dart__scores.game_id');

   if($val == 0) {
      return '-';
   }

   return $val;
}


// Team games closed by user
function zeroOneTeamGamesClosedStat($player) {
   
   $val = DB::table('dart__scores')
      ->where('team_id', '!=' , 0)
      ->where('user_id', $player->id)
      ->where('remaining', 0)
      ->count();
   
   if($val == 0) {
      return '-';
   }

   return $val;
}


// Team games won
function zeroOneTeamGamesWonStat($player) {
   
   // get count of team games won by current user
   $winners = DB::table('dart__scores')
      ->where('team_id', '!=' , 0)
      ->where('user_id', $player->id)
      ->where('remaining', 0)
      ->count();

   $teamGames = DB::table('dart__players')
      ->join('dart__games', 'dart__players.game_id', 'dart__games.id')
      ->where('ind_players', 0)
      ->groupBy('game_id')
      ->get('game_id')
      ->toArray();

   // get teammates of current user
   $tmates = DB::table('dart__scores')
      ->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
      ->where('dart__games.status', 'Completed')
      ->join('dart__players', 'dart__scores.game_id', 'dart__players.game_id')
      ->where('dart__players.user_id', '!=', $player->id)
      ->where('dart__scores.team_id', '!=', 0)
      ->groupBy('dart__scores.game_id')
      ->get();

   if(!$winners) {
      return '-';
   }

   return $winners;
}


//// Team games lost
function zeroOneTeamGamesLostStat($player) {
   $val = (int)zeroOneTeamGamesPlayedStat($player) - (int)zeroOneTeamGamesWonStat($player);

   if($val == 0)
   {
      return '';
   }

   return $val;
}


// Best individual player score in a team game
function zeroOneTeamBestScoreStat($player) {
   $val = DB::table('dart__scores')
      ->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
      ->where('dart__games.status', 'Completed')
      ->where('team_id', '!=', 0)
      ->where('user_id', $player->id)
      ->max('score');

   if($val == 0)
   {
      return '';
   }

   return $val;
}


function zeroOneTeamBestScore($game, $team) {

   $val = DB::table('dart__scores')
      ->join('dart__players', 'dart__scores.user_id', '=', 'dart__players.user_id')
      ->where('dart__scores.game_id', $game->id)
      ->where('dart__scores.team_id', $team)
      ->max('score');

   if($val == 0) {
      return 'N/A';
   }

   return $val;
}


function zeroOneTeamBestScoreBy($game, $team) {

   $v1 = DB::table('dart__scores')
      ->where('game_id', $game->id)
      ->where('team_id', $team)
      ->orderby('score','desc')
      ->first();

   if(!$v1) {
      return 'N/A';
   }

   $val = DB::table('users')
      ->where('users.id', '=', $v1->user_id)
      ->first();

   return $val->first_name;
}

   
function zeroOneTeamScores($game, $team) {

   $t = DB::table('dart__scores')
      ->join('users', 'dart__scores.user_id', '=', 'users.id')
      ->where('game_id', $game->id)
      ->where('team_id', $team)
      ->orderBy('dart__scores.id','desc')
      ->get();

   return $t;
}


function zeroOneTeamPlayers($game, $team) {

   $teamPlayers = DB::table('dart__players')
      ->join('users', 'dart__players.user_id', '=', 'users.id')
      ->where('game_id', $game->id)
      ->where('team_id', $team)
      ->orderBy('dart__players.id', 'asc')
      ->get();

   return $teamPlayers;
}
