<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// BACKEND ROUTES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// EXTRA VIEWS ROUTES
Route::prefix('admin/articles')->name('admin.articles.')->group(function() {
   Route::get('newArticles/{key?}',       'Admin\Articles\ExtraViewsController@newArticles')     ->name('newArticles');
   Route::get('unpublished/{key?}',       'Admin\Articles\ExtraViewsController@unpublished')     ->name('unpublished');
   Route::get('future/{key?}',            'Admin\Articles\ExtraViewsController@future')          ->name('future');
   Route::get('showTrashed/{id}',         'Admin\Articles\ExtraViewsController@showTrashed')     ->name('showTrashed');
   Route::get('trashed/{key?}',           'Admin\Articles\ExtraViewsController@trashed')         ->name('trashed');
   Route::get('archives/{year}/{month}',  'Admin\Articles\ExtraViewsController@archive')         ->name('archive');
   Route::get('myArticles/{key?}',        'Admin\Articles\ExtraViewsController@myArticles')      ->name('myArticles');
});

// FUNCTIONS ROUTES
Route::prefix('admin/articles')->name('admin.articles.')->group(function() {
   Route::get('{id}/addFavorite',         'Admin\Articles\FunctionsController@addFavorite')      ->name('addFavorite');
   Route::get('{id}/removeFavorite',      'Admin\Articles\FunctionsController@removeFavorite')   ->name('removeFavorite');
   Route::get('{id}/duplicate',           'Admin\Articles\FunctionsController@duplicate')        ->name('duplicate');
   Route::get('{id}/publish',             'Admin\Articles\FunctionsController@publish')          ->name('publish');
   Route::get('{id}/unpublish',           'Admin\Articles\FunctionsController@unpublish')        ->name('unpublish');
   Route::get('{id}/resetViews',          'Admin\Articles\FunctionsController@resetViews')       ->name('resetViews');
   Route::get('print/{id}',               'Admin\Articles\FunctionsController@print')            ->name('print');
   Route::get('import',                   'Admin\Articles\FunctionsController@import')           ->name('import');
   Route::get('downloadExcel/{type}',     'Admin\Articles\FunctionsController@downloadExcel')    ->name('downloadExcel');
   Route::get('restore/{id}',             'Admin\Articles\FunctionsController@restore')          ->name('restore');
   Route::get('pdfview',                  'Admin\Articles\FunctionsController@pdfview')          ->name('pdfview');
   Route::post('{id}/storeComment',       'Admin\Articles\FunctionsController@storeComment')     ->name('storeComment');
   Route::post('trashAll',                'Admin\Articles\FunctionsController@trashAll')         ->name('trashAll');
   Route::get('{id}/trash',               'Admin\Articles\FunctionsController@trash')            ->name('trash');
   Route::post('deleteAll',               'Admin\Articles\FunctionsController@deleteAll')        ->name('deleteAll');
   Route::post('restoreAll',              'Admin\Articles\FunctionsController@restoreAll')       ->name('restoreAll');
   Route::post('importExcel',             'Admin\Articles\FunctionsController@importExcel')      ->name('importExport');
   Route::post('unpublishAll',            'Admin\Articles\FunctionsController@unpublishAll')     ->name('unpublishAll');
   Route::post('publishAll',              'Admin\Articles\FunctionsController@publishAll')       ->name('publishAll');
   Route::delete('deleteTrashed/{id}',    'Admin\Articles\FunctionsController@deleteTrashed')    ->name('deleteTrashed');
});

// CRUD ROUTES
Route::prefix('admin/articles')->name('admin.articles.')->group(function() {
   Route::get('create',                   'Admin\Articles\ArticlesController@create')            ->name('create');
   Route::post('',                        'Admin\Articles\ArticlesController@store')             ->name('store');
   Route::get('{id}/edit',                'Admin\Articles\ArticlesController@edit')              ->name('edit');
   Route::put('{id}',                     'Admin\Articles\ArticlesController@update')            ->name('update');
   Route::delete('{id}',                  'Admin\Articles\ArticlesController@destroy')           ->name('destroy');
   Route::get('{id}/show',                'Admin\Articles\ArticlesController@show')              ->name('show');
   Route::get('{key?}',                   'Admin\Articles\ArticlesController@index')             ->name('index');
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FRONTEND ROUTES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('articles')->name('articles.')->group(function() {
   Route::get('{id}/favoriteAdd',         'Articles\FunctionsController@favoriteAdd')            ->name('favoriteAdd');
   Route::get('{id}/favoriteRemove',      'Articles\FunctionsController@favoriteRemove')         ->name('favoriteRemove');
   Route::get('{id}/show',                'Articles\ArticlesController@show')                    ->name('show');
   Route::get('myFavorites',              'Articles\ExtraViewsController@myFavorites')           ->name('myFavorites');
   Route::get('{key?}',                   'Articles\ArticlesController@index')                   ->name('index');
   Route::get('archives/{year}/{month}',  'Articles\ExtraViewsController@archive')               ->name('archive');
});
