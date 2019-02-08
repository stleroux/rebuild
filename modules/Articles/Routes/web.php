<?php

Route::prefix('articles')->group(function() {
   Route::get('/{key?}',                              'ArticlesController@index')               ->name('articles');
   Route::get('/create',                              'ArticlesController@create')              ->name('articles.create');
   Route::post('/store',                              'ArticlesController@store')               ->name('articles.store');
   Route::get('/{id}/edit',                           'ArticlesController@edit')                ->name('articles.edit');
   Route::put('/{id}/update',                         'ArticlesController@update')              ->name('articles.update');
});
