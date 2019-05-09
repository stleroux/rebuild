<?php

Route::get('users/{user}/delete', 'UsersController@delete')->name('users.delete');

// Allow admin to change user password
Route::get('users/{user}/changeUserPWD', 'UsersController@changeUserPWD')->name('users.changeUserPWD');
Route::post('users/{user}/changeUserPWDPost', 'UsersController@changeUserPWDPost')->name('users.changeUserPWDPost');
Route::resource('users', 'UsersController');
