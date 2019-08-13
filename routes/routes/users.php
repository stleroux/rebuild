<?php

// Allow admin to change user password
// Route::get('users/{user}/changeUserPWD', 'Users\UsersController@changeUserPWD')->name('users.changeUserPWD');
// Route::post('users/{user}/changeUserPWDPost', 'Users\UsersController@changeUserPWDPost')->name('users.changeUserPWDPost');


Route::resource('resetPassword', 'Users\ResetPasswordController')->only(['edit','update']);
Route::resource('changePassword', 'Users\ChangePasswordController')->only(['edit','update']);
Route::get('users/addAllPermissions/{id}', 'Users\AddAllPermissionsController')->name('users.addAllPermissions');
Route::get('users/removeAllPermissions/{id}', 'Users\RemoveAllPermissionsController')->name('users.removeAllPermissions');
Route::get('users/{user}/delete', 'Users\UsersController@delete')->name('users.delete');
Route::resource('users', 'Users\UsersController');
