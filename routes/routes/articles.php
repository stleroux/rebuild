<?php

// Route::group(['prefix'=>'articles'], function () {
Route::prefix('articles')->name('articles.')->group(function() {
   Route::get('myFavorites',              'Articles\ArticlesController@myFavorites')      ->name('myFavorites');
   Route::get('{id}/show',                'Admin\Articles\ArticlesController@show')       ->name('show');
   Route::get('/{key?}',                  'Articles\ArticlesController@index')            ->name('index');
});


Route::prefix('admin/articles')->name('admin.articles.')->group(function() {
   Route::get('myArticles/{key?}',        'Admin\Articles\ExtraViewsController@myArticles')       ->name('myArticles');
   Route::get('newArticles/{key?}',       'Admin\Articles\ExtraViewsController@newArticles')      ->name('newArticles');
   // Route::get('published/{key?}',         'Admin\Articles\ArticlesController@published')        ->name('published');
   Route::get('unpublished/{key?}',       'Admin\Articles\ExtraViewsController@unpublished')      ->name('unpublished');
   Route::get('future/{key?}',            'Admin\Articles\ExtraViewsController@future')           ->name('future');
   Route::get('showTrashed/{id}',         'Admin\Articles\ExtraViewsController@showTrashed')      ->name('showTrashed');
   Route::get('trashed/{id?}',            'Admin\Articles\ExtraViewsController@trashed')          ->name('trashed');
});


Route::prefix('admin/articles')->name('admin.articles.')->group(function() {
   Route::get('create',                   'Admin\Articles\ArticlesController@create')           ->name('create');

   Route::get('{id}/addFavorite',         'Admin\Articles\ArticlesController@addFavorite')      ->name('addFavorite');
   Route::get('{id}/removeFavorite',      'Admin\Articles\ArticlesController@removeFavorite')   ->name('removeFavorite');
   Route::get('{id}/duplicate',           'Admin\Articles\ArticlesController@duplicate')        ->name('duplicate');
   Route::get('{id}/publish',             'Admin\Articles\ArticlesController@publish')          ->name('publish');
   Route::get('{id}/unpublish',           'Admin\Articles\ArticlesController@unpublish')        ->name('unpublish');
   Route::get('{id}/resetViews',          'Admin\Articles\ArticlesController@resetViews')       ->name('resetViews');
   Route::get('{id}/edit',                'Admin\Articles\ArticlesController@edit')             ->name('edit');
   Route::put('update/{id}',              'Admin\Articles\ArticlesController@update')           ->name('update');
   Route::get('{id}/show',                'Admin\Articles\ArticlesController@show')             ->name('show');
   Route::get('/{key?}',                  'Admin\Articles\ArticlesController@index')            ->name('index');

   Route::get('print/{id}',               'Admin\Articles\ArticlesController@print')            ->name('print');
   Route::get('import',                   'Admin\Articles\ArticlesController@import')           ->name('import');
   Route::get('downloadExcel/{type}',     'Admin\Articles\ArticlesController@downloadExcel')    ->name('downloadExcel');
   Route::get('restore/{id}',             'Admin\Articles\ArticlesController@restore')          ->name('restore');
   Route::get('pdfview',                  'Admin\Articles\ArticlesController@pdfview')          ->name('pdfview');
   Route::get('archives/{year}/{month}',  'Admin\Articles\ArticlesController@archive')          ->name('archive');


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
