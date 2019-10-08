<?php
Route::prefix('admin/settings')->name('admin.settings.')->group(function() {
   Route::put('updateAll',                'Admin\SettingsController@updateAll')            ->name('updateAll');
   Route::get('{id}/delete',              'Admin\SettingsController@delete')               ->name('delete');
   // Route::get('getSubs/{id}',             'Admin\SettingsController@getSubs')              ->name('getSubs');
   Route::get('create',                   'Admin\SettingsController@create')               ->name('create');
   Route::post('store',                   'Admin\SettingsController@store')                ->name('store');
   // Route::post('saveModal',               'Admin\SettingsController@saveModal')            ->name('saveModal');
   Route::get('{id}/show',                'Admin\SettingsController@show')                 ->name('show');
   Route::get('{id?}',                    'Admin\SettingsController@index')                ->name('index');
   Route::get('{id}/edit',                'Admin\SettingsController@edit')                 ->name('edit');
   Route::put('{id}',                     'Admin\SettingsController@update')               ->name('update');
   Route::delete('{id}/destroy',          'Admin\SettingsController@destroy')              ->name('destroy');
   
});
