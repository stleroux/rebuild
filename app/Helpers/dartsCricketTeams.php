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