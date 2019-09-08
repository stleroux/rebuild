<?php 

Route::get('permissions/{permission}/delete', 'Admin\PermissionsController@delete')->name('permissions.delete');
Route::resource('permissions', 'Admin\PermissionsController');
