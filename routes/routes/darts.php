<?php

Route::get('darts',                                      'Darts\DartsController@index')                              ->name('darts.index');

Route::get('darts/games/board',                          'Darts\DartsController@board')                              ->name('darts.games.board');

Route::get('darts/games/selectTeamsOrPlayers/{gameID}',  'Darts\GamesController@selectTeamsOrPlayers')               ->name('darts.games.selectTeamsOrPlayers');
Route::post('darts/games/storeTeamsOrPlayers',           'Darts\GamesController@storeTeamsOrPlayers')                ->name('darts.games.storeTeamsOrPlayers');

Route::get('darts/games/selectTeamPlayers/{game_ID}',    'Darts\GamesController@selectTeamPlayers')                  ->name('darts.games.selectTeamPlayers');
Route::post('darts/games/storeTeamPlayers',              'Darts\GamesController@storeTeamPlayers')                   ->name('darts.games.storeTeamPlayers');

Route::get('darts/games/selectPlayers/{game_ID}',        'Darts\GamesController@selectPlayers')                      ->name('darts.games.selectPlayers');
Route::post('darts/games/storePlayers',                  'Darts\GamesController@storePlayers')                       ->name('darts.games.storePlayers');

Route::get('darts/games/create/',                        'Darts\GamesController@create')                             ->name('darts.game.create');
Route::post('darts/games/',                              'Darts\GamesController@store')                              ->name('darts.games.store');
Route::get('darts/games/{id}/show',                      'Darts\GamesController@show')                               ->name('darts.games.show');
Route::get('darts/games/{key?}',                         'Darts\GamesController@index')                              ->name('darts.games.index');
Route::get('darts/games/{id}/edit',                      'Darts\GamesController@edit')                               ->name('darts.games.edit');
Route::put('darts/games/{id}',                           'Darts\GamesController@update')                             ->name('darts.games.update');
Route::delete('darts/games/{id}',                        'Darts\GamesController@destroy')                            ->name('darts.games.destroy');

Route::get('darts/01/teams/{id}',                        'Darts\ZeroOne\TeamsController@index')                      ->name('darts.01.teams.index');
Route::post('darts/01/teams/store',                      'Darts\ZeroOne\TeamsController@store')                      ->name('darts.01.teams.store');

Route::get('darts/01/players/{id}',                      'Darts\ZeroOne\PlayersController@index')                    ->name('darts.01.players.index');
Route::post('darts/01/players/store',                    'Darts\ZeroOne\PlayersController@store')                    ->name('darts.01.players.store');









Route::get('darts/cricket/teams/{id}',             'Darts\Cricket\TeamsController@index')            ->name('darts.cricket.teams.index');
Route::get('darts/cricket/teams/completed/{id}',   'Darts\Cricket\TeamsController@completed')        ->name('darts.cricket.teams.completed');
Route::post('darts/cricket/teams/store',           'Darts\Cricket\TeamsController@store')            ->name('darts.cricket.teams.store');

Route::get('darts/cricket/players/{id}',          'Darts\Cricket\PlayersController@index')         ->name('darts.cricket.players.index');
Route::get('darts/cricket/players/completed/{id}','Darts\Cricket\PlayersController@completed')     ->name('darts.cricket.players.completed');
Route::post('darts/cricket/players/store',        'Darts\Cricket\PlayersController@store')         ->name('darts.cricket.players.store');

