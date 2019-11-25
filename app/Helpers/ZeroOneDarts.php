<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ██████╗  █████╗ ██████╗ ████████╗███████╗
// ██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
// ██║  ██║███████║██████╔╝   ██║   ███████╗
// ██║  ██║██╔══██║██╔══██╗   ██║   ╚════██║
// ██████╔╝██║  ██║██║  ██║   ██║   ███████║
// ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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


function zeroOneTeamBestScore($game, $team) {

	$val = DB::table('dart__scores')
		->join('dart__players', 'dart__scores.user_id', '=', 'dart__players.user_id')
		->where('dart__scores.game_id', $game->id)
		->where('dart__scores.team_id', $team)
		->max('score');

	if($val == 0) { return 'N/A'; }

	return $val;
}


function zeroOneTeamBestScoreBy($game, $team) {

	$v1 = DB::table('dart__scores')
		->where('game_id', $game->id)
		->where('team_id', $team)
		->orderby('score','desc')
		->first();

	if(!$v1) { return 'N/A'; }

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
	// dd($t);

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


function zeroOnePlayers($gameID) {

	$players = DB::table('dart__players')
		->join('users', 'dart__players.user_id', '=', 'users.id')
		->where('game_id', $gameID)
		->orderBy('dart__players.id', 'asc')
		->get();

	return $players;
}


function zeroOneGameWinner($game) {

	if ($winner = DB::table('dart__scores')
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

	}
}


function zeroOneLastShot($game) {

	$last = DB::table('dart__scores')
		->join('dart__players', 'dart__scores.user_id', '=', 'dart__players.user_id')
		->where('dart__players.game_id', $game)
		->orderBy('dart__scores.id','desc')
		->first();
	
	if($last){
		return $last->shooting_order;
	}

}


function zeroOneNextShot($game) {

	$totalPlayers = DB::table('dart__players')
		->where('game_id', $game)
		->orderBy('shooting_order', 'asc')
		->count();

	if (zeroOneLastShot($game) == $totalPlayers) {
		$i = 1;
		return $i;
	} else {
		$i = zeroOneLastShot($game) + 1;
		return $i;
	}
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
