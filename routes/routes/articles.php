<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// BACKEND ROUTES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// EXTRA VIEWS ROUTES
Route::prefix('admin/articles')->name('admin.articles.')->group(function() {

   Route::get('newArticles/{key?}',
      [
         'uses' => 'Admin\Articles\ExtraViewsController@newArticles',
         'as' => 'newArticles'
      ]);
   
   Route::get('unpublished/{key?}',
      [
         'uses' => 'Admin\Articles\ExtraViewsController@unpublished',
         'as' => 'unpublished'
      ]);

   Route::get('future/{key?}',
      [
         'uses' => 'Admin\Articles\ExtraViewsController@future',
         'as' => 'future'
      ]);

   Route::get('showTrashed/{id}',
      [
         'uses' => 'Admin\Articles\ExtraViewsController@showTrashed',
         'as' => 'showTrashed'
      ]);

   Route::get('trashed/{key?}',
      [
         'uses' => 'Admin\Articles\ExtraViewsController@trashed',
         'as' => 'trashed'
      ]);

   Route::get('archives/{year}/{month}',
      [
         'uses' => 'Admin\Articles\ExtraViewsController@archives',
         'as' => 'archives'
      ]);

   Route::get('myArticles/{key?}',
      [
         'uses' => 'Admin\Articles\ExtraViewsController@myArticles',
         'as' => 'myArticles'
      ]);
});

// FUNCTIONS ROUTES
Route::prefix('admin/articles')->name('admin.articles.')->group(function() {
   
   Route::get('{id}/addFavorite',
      [
         'uses' => 'Admin\Articles\FunctionsController@addFavorite',
         'as' => 'addFavorite'
      ]);

   Route::get('{id}/removeFavorite',
      [
         'uses' => 'Admin\Articles\FunctionsController@removeFavorite',
         'as' => 'removeFavorite'
      ]);

   Route::get('{id}/duplicate',
      [
         'uses' => 'Admin\Articles\FunctionsController@duplicate',
         'as' => 'duplicate'
      ]);

   Route::get('{id}/publish',
      [
         'uses' => 'Admin\Articles\FunctionsController@publish',
         'as' => 'publish'
      ]);

   Route::get('{id}/unpublish',
      [
         'uses' => 'Admin\Articles\FunctionsController@unpublish',
         'as' => 'unpublish'
      ]);

   Route::get('{id}/resetViews',
      [
         'uses' => 'Admin\Articles\FunctionsController@resetViews',
         'as' => 'resetViews'
      ]);

   Route::get('print/{id}',
      [
         'uses' => 'Admin\Articles\FunctionsController@print',
         'as' => 'print'
      ]);

   Route::get('import',
      [
         'uses' => 'Admin\Articles\FunctionsController@import',
         'as' => 'import'
      ]);

   Route::get('downloadExcel/{type}',
      [
         'uses' => 'Admin\Articles\FunctionsController@downloadExcel',
         'as' => 'downloadExcel'
      ]);

   Route::get('restore/{id}',
      [
         'uses' => 'Admin\Articles\FunctionsController@restore',
         'as' => 'restore'
      ]);

   Route::get('pdfview',
      [
         'uses' => 'Admin\Articles\FunctionsController@pdfview',
         'as' => 'pdfview'
      ]);

   Route::post('{id}/storeComment',
      [
         'uses' => 'Admin\Articles\FunctionsController@storeComment',
         'as' => 'storeComment'
      ]);

   Route::post('trashAll',
      [
         'uses' => 'Admin\Articles\FunctionsController@trashAll',
         'as' => 'trashAll'
      ]);

   Route::get('{id}/trash',
      [
         'uses' => 'Admin\Articles\FunctionsController@trash',
         'as' => 'trash'
      ]);

   Route::delete('{id}/trashDestroy',
      [
         'uses' => 'Admin\Articles\FunctionsController@trashDestroy',
         'as' => 'trashDestroy'
      ]);

   Route::post('deleteAll',
      [
         'uses' => 'Admin\Articles\FunctionsController@deleteAll',
         'as' => 'deleteAll'
      ]);

   Route::post('restoreAll',
      [
         'uses' => 'Admin\Articles\FunctionsController@restoreAll',
         'as' => 'restoreAll'
      ]);

   Route::post('importExcel',
      [
         'uses' => 'Admin\Articles\FunctionsController@importExcel',
         'as' => 'importExport'
      ]);

   Route::post('unpublishAll',
      [
         'uses' => 'Admin\Articles\FunctionsController@unpublishAll',
         'as' => 'unpublishAll'
      ]);

   Route::post('publishAll',
      [
         'uses' => 'Admin\Articles\FunctionsController@publishAll',
         'as' => 'publishAll'
      ]);

   // Route::delete('deleteTrashed/{id}',
   //    [
   //       'uses' => 'Admin\Articles\FunctionsController@deleteTrashed',
   //       'as' => 'deleteTrashed'
   //    ]);
});

// CRUD ROUTES
Route::prefix('admin/articles')->name('admin.articles.')->group(function() {
   
   Route::get('create',
      [
         'uses' => 'Admin\Articles\ArticlesController@create',
         'as' => 'create'
      ]);

   Route::post('',
      [
         'uses' => 'Admin\Articles\ArticlesController@store',
         'as' => 'store'
      ]);

   Route::get('{id}/edit',
      [
         'uses' => 'Admin\Articles\ArticlesController@edit',
         'as' => 'edit'
      ]);

   Route::put('{id}',
      [
         'uses' => 'Admin\Articles\ArticlesController@update',
         'as' => 'update'
      ]);

   Route::get('{id}/delete',
      [
         'uses' => 'Admin\Articles\ArticlesController@delete',
         'as' => 'delete'
      ]);

   Route::delete('{id}',
      [
         'uses' => 'Admin\Articles\ArticlesController@deleteDestroy',
         'as' => 'deleteDestroy'
      ]);

   Route::get('{id}/show',
      [
         'uses' => 'Admin\Articles\ArticlesController@show',
         'as' => 'show'
      ]);

   Route::get('{key?}',
      [
         'uses' => 'Admin\Articles\ArticlesController@index',
         'as' => 'index'
      ]);
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FRONTEND ROUTES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('articles')->name('articles.')->group(function() {
   
   Route::get('{id}/favoriteAdd',
      [
         'uses' => 'Articles\FunctionsController@favoriteAdd',
         'as' => 'favoriteAdd'
      ]);

   Route::get('{id}/favoriteRemove',
      [
         'uses' => 'Articles\FunctionsController@favoriteRemove',
         'as' => 'favoriteRemove'
      ]);

   Route::get('{id}/show',
      [
         'uses' => 'Articles\ArticlesController@show',
         'as' => 'show'
      ]);

   Route::get('myFavorites',
      [
         'uses' => 'Articles\ExtraViewsController@myFavorites',
         'as' => 'myFavorites'
      ]);

   Route::get('{key?}',
      [
         'uses' => 'Articles\ArticlesController@index',
         'as' => 'index'
      ]);

   Route::get('archives/{year}/{month}',
      [
         'uses' => 'Articles\ExtraViewsController@archives',
         'as' => 'archives'
      ]);

});
