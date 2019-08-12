<?php

Route::get('users/{user}/delete', 'Users\UsersController@delete')->name('users.delete');

// Allow admin to change user password
Route::get('users/{user}/changeUserPWD', 'Users\UsersController@changeUserPWD')->name('users.changeUserPWD');
Route::post('users/{user}/changeUserPWDPost', 'Users\UsersController@changeUserPWDPost')->name('users.changeUserPWDPost');
Route::resource('users', 'Users\UsersController');
