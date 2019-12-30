<?php

function cricketPlayers($gameID) {

   $players = DB::table('dart__players')
      ->join('users', 'dart__players.user_id', '=', 'users.id')
      ->where('game_id', $gameID)
      ->orderBy('dart__players.id', 'asc')
      ->get();

   return $players;
}