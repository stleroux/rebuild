<?php

// Allow admin to change user password
// Route::get('users/{user}/changeUserPWD', 'Users\UsersController@changeUserPWD')->name('users.changeUserPWD');
// Route::post('users/{user}/changeUserPWDPost', 'Users\UsersController@changeUserPWDPost')->name('users.changeUserPWDPost');

Route::resource('resetPassword', 'Users\ResetPasswordController')->only(['edit','update']);


// Route::get('users/{user}/delete', 'Users\UsersController@delete')->name('users.delete');




// Route::prefix('admin/users')->name('admin.users.')->group(function() {
//    Route::resource('users', 'Admin\Users\UsersController');
// });

// Route::resource('changePassword',       'Admin\Users\ChangePasswordController')->only(['edit','update']);
Route::namespace('Admin\Users')->prefix('admin/users/changePassword')->name('admin.users.changePassword.')->group(function() {
   Route::get('{id}/edit',                 'ChangePasswordController@edit')                 ->name('edit');
   Route::put('{id}',                      'ChangePasswordController@update')               ->name('update');
});

Route::namespace('Admin\Users')->prefix('admin/users')->name('admin.users.')->group(function() {
   Route::get('addAllPermissions/{id}',    'AddAllPermissionsController')          ->name('addAllPermissions');
   Route::get('removeAllPermissions/{id}', 'RemoveAllPermissionsController')       ->name('removeAllPermissions');
   Route::get('{id}/delete',               'UsersController@delete')               ->name('delete');
   Route::get('create',                    'UsersController@create')               ->name('create');
   Route::post('store',                    'UsersController@store')                ->name('store');
   Route::get('{id}/show',                 'UsersController@show')                 ->name('show');
   Route::get('{id}/edit',                 'UsersController@edit')                 ->name('edit');
   Route::put('{id}',                      'UsersController@update')               ->name('update');
   Route::delete('{id}/destroy',           'UsersController@destroy')              ->name('destroy');
   Route::get('{id?}',                     'UsersController@index')                ->name('index');
});