<?php 

Route::prefix('admin/permissions')->namespace('Admin')->name('admin.permissions.')->group(function() {
   Route::get('{id}/delete',              'PermissionsController@delete')               ->name('delete');
   Route::get('create',                   'PermissionsController@create')               ->name('create');
   Route::post('store',                   'PermissionsController@store')                ->name('store');
   Route::get('{id}/show',                'PermissionsController@show')                 ->name('show');
   Route::get('{id?}',                    'PermissionsController@index')                ->name('index');
   Route::get('{id}/edit',                'PermissionsController@edit')                 ->name('edit');
   Route::put('{id}',                     'PermissionsController@update')               ->name('update');
   Route::delete('{id}/destroy',          'PermissionsController@destroy')              ->name('destroy');
});
