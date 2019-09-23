<?php

// Route::group(['prefix'=>'articles'], function () {
Route::prefix('articles')->name('articles.')->group(function() {

   Route::get('newArticles/{key?}',       'Admin\Articles\ArticlesController@newArticles')      ->name('newArticles');
   // Route::get('published/{key?}',         'Admin\Articles\ArticlesController@published')        ->name('published');
   Route::get('unpublished/{key?}',       'Admin\Articles\ArticlesController@unpublished')      ->name('unpublished');
   Route::get('future/{key?}',            'Admin\Articles\ArticlesController@future')           ->name('future');
   Route::get('myArticles/{key?}',        'Admin\Articles\ArticlesController@myArticles')       ->name('myArticles');
   Route::get('showTrashed/{id}',         'Admin\Articles\ArticlesController@showTrashed')      ->name('showTrashed');

   Route::get('myFavorites',              'Admin\Articles\ArticlesController@myFavorites')      ->name('myFavorites');
   Route::get('trashed',                  'Admin\Articles\ArticlesController@trashed')          ->name('trashed');
   Route::get('create',                   'Admin\Articles\ArticlesController@create')           ->name('create');

   Route::get('{id}/addFavorite',         'Admin\Articles\ArticlesController@addFavorite')      ->name('addFavorite');
   Route::get('{id}/removeFavorite',      'Admin\Articles\ArticlesController@removeFavorite')   ->name('removeFavorite');
   Route::get('{id}/duplicate',           'Admin\Articles\ArticlesController@duplicate')        ->name('duplicate');
   Route::get('{id}/publish',             'Admin\Articles\ArticlesController@publish')          ->name('publish');
   Route::get('{id}/unpublish',           'Admin\Articles\ArticlesController@unpublish')        ->name('unpublish');
   Route::get('{id}/resetViews',          'Admin\Articles\ArticlesController@resetViews')       ->name('resetViews');
   Route::get('{id}/edit',                'Admin\Articles\ArticlesController@edit')             ->name('edit');
   Route::get('{id}/show',                'Admin\Articles\ArticlesController@show')             ->name('show');
   Route::get('/{key?}',                  'Admin\Articles\ArticlesController@index')            ->name('index');

   Route::get('print/{id}',               'Admin\Articles\ArticlesController@print')            ->name('print');
   Route::get('import',                   'Admin\Articles\ArticlesController@import')           ->name('import');
   Route::get('downloadExcel/{type}',     'Admin\Articles\ArticlesController@downloadExcel')    ->name('downloadExcel');
   Route::get('restore/{id}',             'Admin\Articles\ArticlesController@restore')          ->name('restore');
   Route::get('pdfview',                  'Admin\Articles\ArticlesController@pdfview')          ->name('pdfview');
   Route::get('archives/{year}/{month}',  'Admin\Articles\ArticlesController@archive')          ->name('archive');

   Route::put('update/{id}',              'Admin\Articles\ArticlesController@update')           ->name('update');

   Route::post('',                        'Admin\Articles\ArticlesController@store')            ->name('store');
   Route::post('{id}/storeComment',       'Admin\Articles\ArticlesController@storeComment')     ->name('storeComment');
   Route::post('trashAll',                'Admin\Articles\ArticlesController@trashAll')         ->name('trashAll');
   Route::post('deleteAll',               'Admin\Articles\ArticlesController@deleteAll')        ->name('deleteAll');
   Route::post('restoreAll',              'Admin\Articles\ArticlesController@restoreAll')       ->name('restoreAll');
   Route::post('importExcel',             'Admin\Articles\ArticlesController@importExcel')      ->name('importExport');
   Route::post('unpublishAll',            'Admin\Articles\ArticlesController@unpublishAll')     ->name('unpublishAll');
   Route::post('publishAll',              'Admin\Articles\ArticlesController@publishAll')       ->name('publishAll');

   Route::delete('{id}',                  'Admin\Articles\ArticlesController@destroy')          ->name('destroy');
   Route::delete('deleteTrashed/{id}',    'Admin\Articles\ArticlesController@deleteTrashed')    ->name('deleteTrashed');
});
// Route::get('articles/{key?}',                  'Admin\Articles\ArticlesController@index')            ->name('index');
