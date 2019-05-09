<?php

Route::get('profile/{id}/edit',              ['uses'=>'ProfileController@edit',              'as'=>'profile.edit']);
Route::put('profile/{id}',                   ['uses'=>'ProfileController@update',            'as'=>'profile.update']);
Route::get('profile/{id}/resetPwd',          ['uses'=>'ProfileController@resetPwd',          'as'=>'profile.resetPwd']);
Route::post('profile/{id}/resetPwdPost',     ['uses'=>'ProfileController@resetPwdPost',      'as'=>'profile.resetPwdPost']);
Route::get('profile/{id}/resetPreferences',  ['uses'=>'ProfileController@resetPreferences',  'as'=>'profile.resetPreferences']);
Route::get('profile/deleteImage/{id}',       ['uses'=>'ProfileController@deleteImage',       'as'=>'profile.deleteImage']);
Route::get('profile/{id}/show',              ['uses'=>'ProfileController@show',              'as'=>'profile.show']);
