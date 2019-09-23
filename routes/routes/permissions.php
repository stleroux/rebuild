<?php 

// Route::get('permissions/{permission}/delete', 'Admin\PermissionsController@delete')->name('permissions.delete');
// Route::resource('permissions', 'Admin\PermissionsController');

Route::prefix('admin/permissions')->name('admin.permissions.')->group(function() {
   Route::get('{id}/delete',              'Admin\PermissionsController@delete')               ->name('delete');
   // Route::get('getSubs/{id}',             'Admin\PermissionsController@getSubs')              ->name('getSubs');
   Route::get('create',                   'Admin\PermissionsController@create')               ->name('create');
   Route::post('store',                   'Admin\PermissionsController@store')                ->name('store');
   // Route::post('saveModal',               'Admin\PermissionsController@saveModal')            ->name('saveModal');
   Route::get('{id}/show',                'Admin\PermissionsController@show')                 ->name('show');
   Route::get('{id?}',                    'Admin\PermissionsController@index')                ->name('index');
   Route::get('{id}/edit',                'Admin\PermissionsController@edit')                 ->name('edit');
   Route::put('{id}',                     'Admin\PermissionsController@update')               ->name('update');
   Route::delete('{id}/destroy',          'Admin\PermissionsController@destroy')              ->name('destroy');
});