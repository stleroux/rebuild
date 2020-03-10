<?php

function cricketTeamsPlayers($gameID, $teamID) {

   $players = DB::table('dart__players')
      ->join('users', 'dart__players.user_id', '=', 'users.id')
      ->where('game_id', $gameID)
      ->where('team_id', $teamID)
      ->orderBy('dart__players.id', 'asc')
      ->get();

   return $players;
}

// Team games played
function cricketTeamGamesPlayedStat($player) {
   $val = DB::table('dart__scores')
      ->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
      ->where('dart__games.status', 'Completed')
      ->where('dart__games.type', 'cricket')
      ->where('dart__scores.team_id', '!=', 0)
      ->where('dart__scores.user_id', $player->id)
      ->distinct('dart__scores.game_id')
      ->count('dart__scores.game_id');

   if($val == 0) {
      return '-';
   }

   return $val;
}
