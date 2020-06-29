<?php

function aroundPlayers($gameID) {

   $players = DB::table('dart__players')
      ->join('users', 'dart__players.user_id', '=', 'users.id')
      ->where('game_id', $gameID)
      ->orderBy('dart__players.id', 'asc')
      ->get();

   return $players;
}


// Individual games played
// function cricketPlayerIndividualGamesPlayedStat($player) {
//    $val = DB::table('dart__scores')
//       ->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
//       ->where('dart__games.status', 'Completed')
//       ->where('dart__games.ind_players', '!=', 1)
//       ->where('dart__games.type', 'cricket')
//       ->where('team_id', 0)
//       ->where('user_id', $player->id)
//       ->distinct('game_id')
//       ->count('game_id');

//    if($val == 0)
//    {
//       return '-';
//    }

//    return $val;
// }


// Individual games won
// function cricketPlayerIndividualGamesWonStat($player) {
//    $val = DB::table('dart__scores')
//       ->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
//       ->where('dart__games.status', 'Completed')
//       ->where('dart__games.ind_players', '!=', 1)
//       ->where('dart__games.type', 'cricket')
//       ->where('team_id', 0)
//       ->where('user_id', $player->id)
//       ->where('remaining', 0)
//       ->count('game_id');

//    if($val == 0)
//    {
//       return '-';
//    }

//    return $val;
// }


// Individual practice games
// function cricketPlayerIndividualPracticeStat($player) {
//    $val = DB::table('dart__scores')
//       ->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
//       ->where('dart__games.status', 'Completed')
//       ->where('dart__games.ind_players', 1)
//       ->where('dart__games.type', 'cricket')
//       ->where('user_id', $player->id)
//       ->where('remaining', 0)
//       ->count('game_id');

//    if($val == 0)
//    {
//       return '-';
//    }

//    return $val;
// }


// Individual games lost
// function cricketPlayerIndividualGamesLostStat($player) {
//    $val = (int)cricketPlayerIndividualGamesPlayedStat($player) - (int)cricketPlayerIndividualGamesWonStat($player);

//    if($val <= 0)
//    {
//       return '-';
//    }

//    return $val;
// }


// Individual win percentage
// function cricketPlayerIndividualGamesWinPercentageStat($player) {
//    if(cricketPlayerIndividualGamesWonStat($player) > 0 ){
//       $val = number_format((int)cricketPlayerIndividualGamesWonStat($player) / (int)cricketPlayerIndividualGamesPlayedStat($player) * 100, 1);

//       if($val <= 0)
//       {
//          return '-';
//       }

//       return $val . "%";
//    }
//    return '-';
// }