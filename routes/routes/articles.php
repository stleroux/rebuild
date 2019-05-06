<?php

Route::group(['prefix'=>'articles'], function () {

   Route::get('newArticles/{key?}',       'Articles\ArticlesController@newArticles')      ->name('articles.newArticles');
   // Route::get('published/{key?}',         'Articles\ArticlesController@published')        ->name('articles.published');
   Route::get('unpublished/{key?}',       'Articles\ArticlesController@unpublished')      ->name('articles.unpublished');
   Route::get('future/{key?}',            'Articles\ArticlesController@future')           ->name('articles.future');
   Route::get('myArticles/{key?}',        'Articles\ArticlesController@myArticles')       ->name('articles.myArticles');
   Route::get('showTrashed/{id}',         'Articles\ArticlesController@showTrashed')      ->name('articles.showTrashed');

   Route::get('myFavorites',              'Articles\ArticlesController@myFavorites')      ->name('articles.myFavorites');
   Route::get('trashed',                  'Articles\ArticlesController@trashed')          ->name('articles.trashed');
   Route::get('create',                   'Articles\ArticlesController@create')           ->name('articles.create');

   Route::get('{id}/addFavorite',         'Articles\ArticlesController@addFavorite')      ->name('articles.addFavorite');
   Route::get('{id}/removeFavorite',      'Articles\ArticlesController@removeFavorite')   ->name('articles.removeFavorite');
   Route::get('{id}/duplicate',           'Articles\ArticlesController@duplicate')        ->name('articles.duplicate');
   Route::get('{id}/publish',             'Articles\ArticlesController@publish')          ->name('articles.publish');
   Route::get('{id}/unpublish',           'Articles\ArticlesController@unpublish')        ->name('articles.unpublish');
   Route::get('{id}/resetViews',          'Articles\ArticlesController@resetViews')       ->name('articles.resetViews');
   Route::get('{id}/edit',                'Articles\ArticlesController@edit')             ->name('articles.edit');
   Route::get('{id}/show',                'Articles\ArticlesController@show')             ->name('articles.show');
   Route::get('/{key?}',                  'Articles\ArticlesController@index')            ->name('articles.index');

   Route::get('print/{id}',               'Articles\ArticlesController@print')            ->name('articles.print');
   Route::get('import',                   'Articles\ArticlesController@import')           ->name('articles.import');
   Route::get('downloadExcel/{type}',     'Articles\ArticlesController@downloadExcel')    ->name('articles.downloadExcel');
   Route::get('restore/{id}',             'Articles\ArticlesController@restore')          ->name('articles.restore');
   Route::get('pdfview',                  'Articles\ArticlesController@pdfview')          ->name('articles.pdfview');
   Route::get('archives/{year}/{month}',  'Articles\ArticlesController@archive')          ->name('articles.archive');

   Route::put('update/{id}',              'Articles\ArticlesController@update')           ->name('articles.update');

   Route::post('',                        'Articles\ArticlesController@store')            ->name('articles.store');
   Route::post('{id}/storeComment',       'Articles\ArticlesController@storeComment')     ->name('articles.storeComment');
   Route::post('trashAll',                'Articles\ArticlesController@trashAll')         ->name('articles.trashAll');
   Route::post('deleteAll',               'Articles\ArticlesController@deleteAll')        ->name('articles.deleteAll');
   Route::post('restoreAll',              'Articles\ArticlesController@restoreAll')       ->name('articles.restoreAll');
   Route::post('importExcel',             'Articles\ArticlesController@importExcel')      ->name('articles.importExport');
   Route::post('unpublishAll',            'Articles\ArticlesController@unpublishAll')     ->name('articles.unpublishAll');
   Route::post('publishAll',              'Articles\ArticlesController@publishAll')       ->name('articles.publishAll');

   Route::delete('{id}',                  'Articles\ArticlesController@destroy')          ->name('articles.destroy');
   Route::delete('deleteTrashed/{id}',    'Articles\ArticlesController@deleteTrashed')    ->name('articles.deleteTrashed');
});
// Route::get('articles/{key?}',                  'Articles\ArticlesController@index')            ->name('articles.index');
