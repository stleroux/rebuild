<?php

// Route::group(['prefix'=>'articles'], function () {
Route::prefix('articles')->name('articles.')->group(function() {

   Route::get('newArticles/{key?}',       'Articles\ArticlesController@newArticles')      ->name('newArticles');
   // Route::get('published/{key?}',         'Articles\ArticlesController@published')        ->name('published');
   Route::get('unpublished/{key?}',       'Articles\ArticlesController@unpublished')      ->name('unpublished');
   Route::get('future/{key?}',            'Articles\ArticlesController@future')           ->name('future');
   Route::get('myArticles/{key?}',        'Articles\ArticlesController@myArticles')       ->name('myArticles');
   Route::get('showTrashed/{id}',         'Articles\ArticlesController@showTrashed')      ->name('showTrashed');

   Route::get('myFavorites',              'Articles\ArticlesController@myFavorites')      ->name('myFavorites');
   Route::get('trashed',                  'Articles\ArticlesController@trashed')          ->name('trashed');
   Route::get('create',                   'Articles\ArticlesController@create')           ->name('create');

   Route::get('{id}/addFavorite',         'Articles\ArticlesController@addFavorite')      ->name('addFavorite');
   Route::get('{id}/removeFavorite',      'Articles\ArticlesController@removeFavorite')   ->name('removeFavorite');
   Route::get('{id}/duplicate',           'Articles\ArticlesController@duplicate')        ->name('duplicate');
   Route::get('{id}/publish',             'Articles\ArticlesController@publish')          ->name('publish');
   Route::get('{id}/unpublish',           'Articles\ArticlesController@unpublish')        ->name('unpublish');
   Route::get('{id}/resetViews',          'Articles\ArticlesController@resetViews')       ->name('resetViews');
   Route::get('{id}/edit',                'Articles\ArticlesController@edit')             ->name('edit');
   Route::get('{id}/show',                'Articles\ArticlesController@show')             ->name('show');
   Route::get('/{key?}',                  'Articles\ArticlesController@index')            ->name('index');

   Route::get('print/{id}',               'Articles\ArticlesController@print')            ->name('print');
   Route::get('import',                   'Articles\ArticlesController@import')           ->name('import');
   Route::get('downloadExcel/{type}',     'Articles\ArticlesController@downloadExcel')    ->name('downloadExcel');
   Route::get('restore/{id}',             'Articles\ArticlesController@restore')          ->name('restore');
   Route::get('pdfview',                  'Articles\ArticlesController@pdfview')          ->name('pdfview');
   Route::get('archives/{year}/{month}',  'Articles\ArticlesController@archive')          ->name('archive');

   Route::put('update/{id}',              'Articles\ArticlesController@update')           ->name('update');

   Route::post('',                        'Articles\ArticlesController@store')            ->name('store');
   Route::post('{id}/storeComment',       'Articles\ArticlesController@storeComment')     ->name('storeComment');
   Route::post('trashAll',                'Articles\ArticlesController@trashAll')         ->name('trashAll');
   Route::post('deleteAll',               'Articles\ArticlesController@deleteAll')        ->name('deleteAll');
   Route::post('restoreAll',              'Articles\ArticlesController@restoreAll')       ->name('restoreAll');
   Route::post('importExcel',             'Articles\ArticlesController@importExcel')      ->name('importExport');
   Route::post('unpublishAll',            'Articles\ArticlesController@unpublishAll')     ->name('unpublishAll');
   Route::post('publishAll',              'Articles\ArticlesController@publishAll')       ->name('publishAll');

   Route::delete('{id}',                  'Articles\ArticlesController@destroy')          ->name('destroy');
   Route::delete('deleteTrashed/{id}',    'Articles\ArticlesController@deleteTrashed')    ->name('deleteTrashed');
});
// Route::get('articles/{key?}',                  'Articles\ArticlesController@index')            ->name('index');
