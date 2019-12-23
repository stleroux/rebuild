<?php

Route::get('darts',													'Darts\DartsController@index')										->name('darts.index');

Route::get('darts/games/board',									'Darts\DartsController@board')										->name('darts.games.board');

Route::get('darts/games/selectTeamsOrPlayers/{gameID}',	'Darts\ZeroOne\GamesController@selectTeamsOrPlayers')			->name('darts.games.selectTeamsOrPlayers');
Route::post('darts/games/storeTeamsOrPlayers',				'Darts\ZeroOne\GamesController@storeTeamsOrPlayers')			->name('darts.games.storeTeamsOrPlayers');

Route::get('darts/games/selectTeamPlayers/{game_ID}',		'Darts\ZeroOne\GamesController@selectTeamPlayers')				->name('darts.games.selectTeamPlayers');
Route::post('darts/games/storeTeamPlayers',					'Darts\ZeroOne\GamesController@storeTeamPlayers')				->name('darts.games.storeTeamPlayers');

Route::get('darts/games/selectPlayers/{game_ID}',			'Darts\ZeroOne\GamesController@selectPlayers')					->name('darts.games.selectPlayers');
Route::post('darts/games/storePlayers',						'Darts\ZeroOne\GamesController@storePlayers')					->name('darts.games.storePlayers');

Route::get('darts/games/create/',								'Darts\ZeroOne\GamesController@create')							->name('darts.game.create');
Route::post('darts/games/',										'Darts\ZeroOne\GamesController@store')								->name('darts.games.store');
Route::get('darts/games/{id}/show',								'Darts\ZeroOne\GamesController@show')								->name('darts.games.show');
Route::get('darts/games/{key?}',									'Darts\ZeroOne\GamesController@index')								->name('darts.games.index');
Route::get('darts/games/{id}/edit',								'Darts\ZeroOne\GamesController@edit')								->name('darts.games.edit');
Route::put('darts/games/{id}',									'Darts\ZeroOne\GamesController@update')							->name('darts.games.update');
Route::delete('darts/games/{id}',								'Darts\ZeroOne\GamesController@destroy')							->name('darts.games.destroy');

Route::get('darts/01/scores/teams/{id}',						'Darts\ZeroOne\TeamsController@index')		          			->name('darts.01.teams.index');
Route::post('darts/01/scores/teams/store',					'Darts\ZeroOne\TeamsController@store')			           		->name('darts.01.teams.store');

Route::get('darts/01/scores/players/{id}',					'Darts\ZeroOne\PlayersController@index')		               ->name('darts.01.players.index');
Route::post('darts/01/scores/players/store',					'Darts\ZeroOne\PlayersController@store')	      				->name('darts.01.players.store');









Route::get('darts/cricket/scores/teams/{id}',				'Darts\Cricket\TeamsController@cricketTeamIndex')		->name('darts.cricket.scores.teams.index');
Route::get('darts/cricket/scores/players/{id}',				'Darts\Cricket\PlayersController@etPlayerIndex')		->name('darts.cricket.scores.players.index');

