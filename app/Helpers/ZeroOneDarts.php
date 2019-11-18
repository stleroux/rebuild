<?php
 
// namespace App\Classes;

// class ZeroOneDarts {

//    function playerBestScore($player) {
//       //dd($player);
//       $val = DB::table('dartscores')
//          ->where('game_id', $player->dartgame_id)
//          ->where('team_id', $player->team_id)
//          ->where('user_id', $player->id)
//          ->max('score');

//       if($val == 0)
//       {
//          return 'N/A';
//       }

//       return $val;
//    }

// }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// ██████╗  █████╗ ██████╗ ████████╗███████╗
// ██╔══██╗██╔══██╗██╔══██╗╚══██╔══╝██╔════╝
// ██║  ██║███████║██████╔╝   ██║   ███████╗
// ██║  ██║██╔══██║██╔══██╗   ██║   ╚════██║
// ██████╔╝██║  ██║██║  ██║   ██║   ███████║
// ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝   ╚═╝   ╚══════╝
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function zeroOnePlayerBestScore($player) {
	//dd($player);
	$val = DB::table('dartscores')
		->where('game_id', $player->dartgame_id)
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

	$scoreAvg = DB::table('dartscores')
		->where('game_id', $player->dartgame_id)
		->where('team_id', $player->team_id)
		->where('user_id', $player->id)
		->avg('score');
	// dd($totaluserscore);
	return number_format($scoreAvg, 2);



	// $shots = DB::table('dartscores')
	// 	->where('game_id', $player->dartgame_id)
	// 	->where('team_id', $player->team_id)
	// 	->where('user_id', $player->id)
	// 	->count();
	
	// if($shots == 0)
	// {
	// 	return 'N/A';
	// }

	// $totaluserscore = DB::table('dartscores')
	// 	->where('game_id', $player->dartgame_id)
	// 	->where('team_id', $player->team_id)
	// 	->where('user_id', $player->id)
	// 	->sum('score');

	// $val = $totaluserscore / $shots;

	// return number_format($val, 2);
}


function zeroOnePlayerDartAvg($player) {
	$scoreAvg = DB::table('dartscores')
		->where('game_id', $player->dartgame_id)
		->where('team_id', $player->team_id)
		->where('user_id', $player->id)
		->avg('score');
	return number_format($scoreAvg / 3, 2);

	// $shots = DB::table('dartscores')
	// 	->where('game_id', $player->dartgame_id)
	// 	->where('team_id', $player->team_id)
	// 	->where('user_id', $player->id)
	// 	->count();

	// if($shots == 0) { return 'N/A'; }

	// $totaluserscore = DB::table('dartscores')
	// 	->where('game_id', $player->dartgame_id)
	// 	->where('team_id', $player->team_id)
	// 	->where('user_id', $player->id)
	// 	->sum('score');

	// $val = ($totaluserscore / $shots) / 3;

	// return number_format($val, 2);
}


function zeroOneTeamBestScore($game, $team) {
	$val = DB::table('dartscores')
		->join('dartgame_user', 'dartscores.user_id', '=', 'dartgame_user.user_id')
		->where('game_id', $game->id)
		->where('dartscores.team_id', $team)
		->max('score');

	if($val == 0) { return 'N/A'; }

	return $val;
}


function zeroOneTeamBestScoreBy($game, $team) {
	$v1 = DB::table('dartscores')
		->where('game_id', $game->id)
		->where('team_id', $team)
		->orderby('score','desc')
		->first();

	if(!$v1) { return 'N/A'; }

	$val = DB::table('Users')
		// ->join('profiles', 'users.id', '=', 'profiles.user_id')
		->where('users.id', '=', $v1->user_id)
		->first();

	return $val->first_name;
}

	
function zeroOneTeamScores($game, $team) {
	$t = DB::table('dartscores')
		->join('users', 'dartscores.user_id', '=', 'users.id')
		// ->join('profiles', 'dartscores.user_id', '=', 'profiles.user_id')
		->where('game_id', $game->id)
		->where('team_id', $team)
		->orderBy('dartscores.id','desc')
		->get();

	return $t;
}


function zeroOneTeamPlayers($game, $team) {
	$teamPlayers = DB::table('dartgame_user')
		->join('users', 'dartgame_user.user_id', '=', 'users.id')
		// ->join('profiles', 'dartgame_user.user_id', '=', 'profiles.user_id')
		->where('dartgame_id', $game->id)
		->where('team_id', $team)
		->orderBy('dartgame_user.id', 'asc')
		->get();

	return $teamPlayers;
}


function zeroOnePlayers($gameID) {
	$players = DB::table('dartgame_user')
		->join('users', 'dartgame_user.user_id', '=', 'users.id')
		// ->join('profiles', 'dartgame_user.user_id', '=', 'profiles.user_id')
		->where('dartgame_id', $gameID)
		->orderBy('dartgame_user.id', 'asc')
		->get();
	// dd($players);
	return $players;
}


// function zeroOneAllPlayers($game) {
// 	$allPlayers = DB::table('dartgame_user')
// 		->join('users', 'dartgame_user.user_id', '=', 'users.id')
// 		// ->join('profiles', 'dartgame_user.user_id', '=', 'profiles.user_id')
// 		->where('dartgame_id', $game->id)
// 		->orderBy('users.first_name', 'asc')
// 		->get();

// 	return $allPlayers;
// }


function zeroOneGameWinner($game) {
	if ($winner = DB::table('dartscores')
		->where('game_id', $game->id)
		->where('remaining', 0)
		->first())
	{

		if($winner->team_id) {
			// return 'Team : ' . $winner->team_id;
			return $winner->team_id;
		} else {
			$user = App\Models\User::findOrFail($winner->user_id);
			// return 'User : ' . $user->username;
			return $user->username;
		}

	}
}


function zeroOneLastShot($game) {
	
	$last = DB::table('dartscores')
		// ->join('users', 'dartscores.user_id', '=', 'users.id')
		->join('dartgame_user', 'dartscores.user_id', '=', 'dartgame_user.user_id')
		->where('game_id', $game)
		->latest('dartscores.id')
		->first();
		// dd($last);
	
	if($last){
	// 	// Return last player to shoot
		//echo "LAST : " . $last->user_id . "<br />";
		// dd($last->shooting_order);
		return $last->shooting_order;	 	
	}
	// return 1;
}


function zeroOneNextShot($game) {
	// dd($game);
	$totalPlayers = DB::table('dartgame_user')
		->where('dartgame_id', $game)
		->orderBy('shooting_order', 'asc')
		->count();
		// echo '<br />Total Players : ' . ($totalPlayers) . '<br />';

	// dd(zeroOneLastShot($game));
	if (zeroOneLastShot($game)) {
		//echo 'Last Shot : ' . zeroOneLastShot($game) . "<br />";
		$i = zeroOneLastShot($game) + 1;
		// dd($i);
		// $i = $i = zeroOneLastShot($game);
		// $i = $i + 1;

		// echo 'Next Shot :' . $i;
		
		if($i > $totalPlayers) {
			$i = 1;
			return $i;
		}

		return $i;

	}
	//  else {
	// 	// No one has shot yet, so set shooting order to 1
	// 	$i = 1;
	// 	// return "Next Shooter : " . $i;
	// 	return $i;
	// }
}


function zeroOnePlayerScore($gameID, $playerID) {
	// dd($game);
	// dd($player);
	$t = DB::table('dartscores')
		->join('users', 'dartscores.user_id', '=', 'users.id')
		// ->where('game_id', '=', $game->id)
		->where('game_id', $gameID)
		->where('dartscores.user_id', $playerID)
		->orderBy('dartscores.id','desc')
		->get();
	// dd($t);
	return $t;
}
