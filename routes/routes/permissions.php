<?php 

Route::prefix('admin/permissions')->name('admin.permissions.')->group(function() {
   Route::get('{id}/delete',              'Admin\PermissionsController@delete')               ->name('delete');
   Route::get('create',                   'Admin\PermissionsController@create')               ->name('create');
   Route::post('store',                   'Admin\PermissionsController@store')                ->name('store');
   Route::get('{id}/show',                'Admin\PermissionsController@show')                 ->name('show');
   Route::get('{id?}',                    'Admin\PermissionsController@index')                ->name('index');
   Route::get('{id}/edit',                'Admin\PermissionsController@edit')                 ->name('edit');
   Route::put('{id}',                     'Admin\PermissionsController@update')               ->name('update');
   Route::delete('{id}/destroy',          'Admin\PermissionsController@destroy')              ->name('destroy');
});
