<?php
Route::namespace('Admin')->prefix('admin/settings')->name('admin.settings.')->group(function() {
   Route::put('updateAll',                'SettingsController@updateAll')            ->name('updateAll');
   Route::get('{id}/delete',              'SettingsController@delete')               ->name('delete');
   Route::get('create',                   'SettingsController@create')               ->name('create');
   Route::post('store',                   'SettingsController@store')                ->name('store');
   Route::get('{id}/show',                'SettingsController@show')                 ->name('show');
   Route::get('{id?}',                    'SettingsController@index')                ->name('index');
   Route::get('{id}/edit',                'SettingsController@edit')                 ->name('edit');
   Route::put('{id}',                     'SettingsController@update')               ->name('update');
   Route::delete('{id}/destroy',          'SettingsController@destroy')              ->name('destroy');
   
});
