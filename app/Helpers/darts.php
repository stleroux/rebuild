<?php

function zeroOneGameWinner($game) {

   // check if winner is part of a game
   if ($winner = DB::table('dart__scores')
      ->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
      ->where('dart__games.ind_players', '!=', 1)
      ->where('game_id', $game->id)
      ->where('remaining', 0)
      ->first())
   {

      if($winner->team_id) {
         return "Team " . $winner->team_id;
      } else {
         $user = App\Models\User::findOrFail($winner->user_id);
         return $user->first_name;
      }

   // 
   } elseif ($winner = DB::table('dart__scores')
      ->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
      ->where('dart__games.ind_players', 1)
      ->where('game_id', $game->id)
      ->where('remaining', 0)
      ->first())
   {
      return 'Practice';
   } else {
      return '';
   }
}


function zeroOneNextShot($game) {
   // No one has shot yet so get the first shooter
   if (!DB::table('dart__scores')->where('game_id', $game)->first()) {
      $first = DB::table('dart__players')
         ->where('game_id', $game)
         ->orderBy('shooting_order', 'asc')
         ->first();
      return $first->shooting_order;
      dd("HERE");
   } else {
      // game is already started, get the next shooter
      // First find out who shot last
      $last = DB::table('dart__scores')
         ->join('dart__players', 'dart__scores.user_id', '=', 'dart__players.user_id')
         ->where('dart__players.game_id', $game)
         ->where('dart__scores.game_id', $game)
         ->orderBy('dart__scores.id','desc')
         ->first();

      // Who's next to shoot
      // Get total players in the game
      $totalPlayers = DB::table('dart__players')
         ->where('game_id', $game)
         ->orderBy('shooting_order', 'asc')
         ->count();

      if($last->shooting_order == $totalPlayers){
         $i = 1;
         return $i;
      } else {
         $i = $last->shooting_order + 1;
         return $i;
      }
   }
}
