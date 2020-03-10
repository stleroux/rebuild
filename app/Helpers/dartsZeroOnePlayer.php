<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ██████╗  █████╗ ██████╗ ████████╗███████╗
// ██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
// ██║  ██║███████║██████╔╝   ██║   ███████╗
// ██║  ██║██╔══██║██╔══██╗   ██║   ╚════██║
// ██████╔╝██║  ██║██║  ██║   ██║   ███████║
// ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Individual games played
function zeroOnePlayerIndividualGamesPlayedStat($player) {
	$val = DB::table('dart__scores')
		->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
		->where('dart__games.status', 'Completed')
      ->where('dart__games.ind_players', '!=', 1)
      ->where('dart__games.type', '!=', 'cricket')
		->where('team_id', 0)
		->where('user_id', $player->id)
		->distinct('game_id')
		->count('game_id');

	if($val == 0)
	{
		return '-';
	}

	return $val;
}


// Individual games won
function zeroOnePlayerIndividualGamesWonStat($player) {
	$val = DB::table('dart__scores')
		->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
		->where('dart__games.status', 'Completed')
      ->where('dart__games.ind_players', '!=', 1)
      ->where('dart__games.type', '!=', 'cricket')
		->where('team_id', 0)
		->where('user_id', $player->id)
		->where('remaining', 0)
		->count('game_id');

	if($val == 0)
	{
		return '-';
	}

	return $val;
}


// Individual practice games
function zeroOnePlayerIndividualPracticeStat($player) {
	$val = DB::table('dart__scores')
		->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
		->where('dart__games.status', 'Completed')
      ->where('dart__games.ind_players', 1)
      ->where('dart__games.type', '!=', 'cricket')
		->where('user_id', $player->id)
		->where('remaining', 0)
		->count('game_id');

	if($val == 0)
	{
		return '-';
	}

	return $val;
}


// Individual games lost
function zeroOnePlayerIndividualGamesLostStat($player) {
	$val = (int)zeroOnePlayerIndividualGamesPlayedStat($player) - (int)zeroOnePlayerIndividualGamesWonStat($player);

	if($val <= 0)
	{
		return '-';
	}

	return $val;
}


// Individual win percentage
function zeroOnePlayerIndividualGamesWinPercentageStat($player) {
	if(zeroOnePlayerIndividualGamesWonStat($player) > 0 ){
		$val = number_format((int)zeroOnePlayerIndividualGamesWonStat($player) / (int)zeroOnePlayerIndividualGamesPlayedStat($player) * 100, 1);

		if($val <= 0)
		{
			return '-';
		}

		return $val . "%";
	}
	return '-';
}

// Best individual player score in an individual game
function zeroOnePlayerBestScoreIndividualStat($player) {
	$val = DB::table('dart__scores')
		->join('dart__games', 'dart__scores.game_id', 'dart__games.id')
      ->where('dart__games.ind_players', '!=', 1)
		->where('dart__games.status', 'Completed')
		->where('team_id', 0)
		->where('user_id', $player->id)
		->max('score');

	if($val == 0)
	{
		return '-';
	}

	return $val;
}


function zeroOnePlayerBestScore($player) {

	$val = DB::table('dart__scores')
		->where('game_id', $player->game_id)
		->where('team_id', $player->team_id)
		->where('user_id', $player->id)
		->max('score');

	if($val == 0)
	{
		return 'N/A';
	}

	return $val;
}


function zeroOnePlayerScoreAvg($player) {

	$scoreAvg = DB::table('dart__scores')
		->where('game_id', $player->game_id)
		->where('team_id', $player->team_id)
		->where('user_id', $player->id)
		->avg('score');

	return number_format($scoreAvg, 2);
}


function zeroOnePlayerDartAvg($player) {

	$scoreAvg = DB::table('dart__scores')
		->where('game_id', $player->game_id)
		->where('team_id', $player->team_id)
		->where('user_id', $player->id)
		->avg('score');

	return number_format($scoreAvg / 3, 2);
}


function zeroOnePlayers($gameID) {

	$players = DB::table('dart__players')
		->join('users', 'dart__players.user_id', '=', 'users.id')
		->where('game_id', $gameID)
		->orderBy('dart__players.id', 'asc')
		->get();

	return $players;
}


function zeroOnePlayerScore($gameID, $playerID) {
	$t = DB::table('dart__scores')
		->join('users', 'dart__scores.user_id', '=', 'users.id')
		->where('game_id', $gameID)
		->where('dart__scores.user_id', $playerID)
		->orderBy('dart__scores.id','desc')
		->get();

	return $t;
}
