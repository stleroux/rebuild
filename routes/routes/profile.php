<?php

Route::namespace('Users')->prefix('users/')->name('users.changePassword.')->group(function() {
   Route::get('{id}/edit',                 'ResetPasswordController@edit')                 ->name('edit');
   Route::put('{id}',                      'ResetPasswordController@update')               ->name('update');
});

// Route::resource('resetPassword', 'Users\ResetPasswordController')->only(['edit','update']);

Route::get('profile/{id}/edit',              ['uses'=>'Users\ProfileController@edit',              'as'=>'profile.edit']);
Route::put('profile/{id}',                   ['uses'=>'Users\ProfileController@update',            'as'=>'profile.update']);
// Route::get('profile/{id}/resetPwd',          ['uses'=>'ProfileController@resetPwd',          'as'=>'profile.resetPwd']);
// Route::post('profile/{id}/resetPwdPost',     ['uses'=>'ProfileController@resetPwdPost',      'as'=>'profile.resetPwdPost']);
Route::get('profile/{id}/resetPreferences',  ['uses'=>'Users\ProfileController@resetPreferences',  'as'=>'profile.resetPreferences']);
Route::get('profile/deleteImage/{id}',       ['uses'=>'Users\ProfileController@deleteImage',       'as'=>'profile.deleteImage']);
Route::get('profile/{id}/show',              ['uses'=>'Users\ProfileController@show',              'as'=>'profile.show']);
