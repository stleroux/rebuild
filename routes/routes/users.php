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
Route::prefix('admin/users/changePassword')->name('admin.users.changePassword.')->group(function() {
   Route::get('{id}/edit',                 'Admin\Users\ChangePasswordController@edit')                 ->name('edit');
   Route::put('{id}',                      'Admin\Users\ChangePasswordController@update')               ->name('update');
});

Route::prefix('admin/users')->name('admin.users.')->group(function() {
   Route::get('addAllPermissions/{id}',    'Admin\Users\AddAllPermissionsController')          ->name('addAllPermissions');
   Route::get('removeAllPermissions/{id}', 'Admin\Users\RemoveAllPermissionsController')       ->name('removeAllPermissions');
   Route::get('{id}/delete',               'Admin\Users\UsersController@delete')               ->name('delete');
   Route::get('create',                    'Admin\Users\UsersController@create')               ->name('create');
   Route::post('store',                    'Admin\Users\UsersController@store')                ->name('store');
   Route::get('{id}/show',                 'Admin\Users\UsersController@show')                 ->name('show');
   Route::get('{id?}',                     'Admin\Users\UsersController@index')                ->name('index');
   Route::get('{id}/edit',                 'Admin\Users\UsersController@edit')                 ->name('edit');
   Route::put('{id}',                      'Admin\Users\UsersController@update')               ->name('update');
   Route::delete('{id}/destroy',           'Admin\Users\UsersController@destroy')              ->name('destroy');
});