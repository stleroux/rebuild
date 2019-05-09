<?php 

Route::get('permissions/{permission}/delete', 'PermissionsController@delete')->name('permissions.delete');
Route::resource('permissions', 'PermissionsController');
