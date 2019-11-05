<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// BACKEND ROUTES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// EXTRA VIEWS ROUTES
Route::prefix('admin/tests')->name('admin.tests.')->group(function() {

   Route::get('newTests/{key?}',
      [
         'uses' => 'Admin\Tests\ExtraViewsController@newTests',
         'as' => 'newTests'
      ]);
   
   Route::get('unpublished/{key?}',
      [
         'uses' => 'Admin\Tests\ExtraViewsController@unpublished',
         'as' => 'unpublished'
      ]);

   Route::get('future/{key?}',
      [
         'uses' => 'Admin\Tests\ExtraViewsController@future',
         'as' => 'future'
      ]);

   Route::get('showTrashed/{id}',
      [
         'uses' => 'Admin\Tests\ExtraViewsController@showTrashed',
         'as' => 'showTrashed'
      ]);

   Route::get('trashed/{key?}',
      [
         'uses' => 'Admin\Tests\ExtraViewsController@trashed',
         'as' => 'trashed'
      ]);

   Route::get('archives/{year}/{month}',
      [
         'uses' => 'Admin\Tests\ExtraViewsController@archives',
         'as' => 'archives'
      ]);

   Route::get('myTests/{key?}',
      [
         'uses' => 'Admin\Tests\ExtraViewsController@myTests',
         'as' => 'myTests'
      ]);
});

// FUNCTIONS ROUTES
Route::prefix('admin/tests')->name('admin.tests.')->group(function() {
   
   Route::get('{id}/addFavorite',
      [
         'uses' => 'Admin\Tests\FunctionsController@addFavorite',
         'as' => 'addFavorite'
      ]);

   Route::get('{id}/removeFavorite',
      [
         'uses' => 'Admin\Tests\FunctionsController@removeFavorite',
         'as' => 'removeFavorite'
      ]);

   Route::get('{id}/duplicate',
      [
         'uses' => 'Admin\Tests\FunctionsController@duplicate',
         'as' => 'duplicate'
      ]);

   Route::get('{id}/publish',
      [
         'uses' => 'Admin\Tests\FunctionsController@publish',
         'as' => 'publish'
      ]);

   Route::get('{id}/unpublish',
      [
         'uses' => 'Admin\Tests\FunctionsController@unpublish',
         'as' => 'unpublish'
      ]);

   Route::get('{id}/resetViews',
      [
         'uses' => 'Admin\Tests\FunctionsController@resetViews',
         'as' => 'resetViews'
      ]);

   Route::get('print/{id}',
      [
         'uses' => 'Admin\Tests\FunctionsController@print',
         'as' => 'print'
      ]);

   Route::get('import',
      [
         'uses' => 'Admin\Tests\FunctionsController@import',
         'as' => 'import'
      ]);

   Route::get('downloadExcel/{type}',
      [
         'uses' => 'Admin\Tests\FunctionsController@downloadExcel',
         'as' => 'downloadExcel'
      ]);

   Route::get('restore/{id}',
      [
         'uses' => 'Admin\Tests\FunctionsController@restore',
         'as' => 'restore'
      ]);

   Route::get('pdfview',
      [
         'uses' => 'Admin\Tests\FunctionsController@pdfview',
         'as' => 'pdfview'
      ]);

   Route::post('{id}/storeComment',
      [
         'uses' => 'Admin\Tests\FunctionsController@storeComment',
         'as' => 'storeComment'
      ]);

   Route::post('trashAll',
      [
         'uses' => 'Admin\Tests\FunctionsController@trashAll',
         'as' => 'trashAll'
      ]);

   Route::get('{id}/trash',
      [
         'uses' => 'Admin\Tests\FunctionsController@trash',
         'as' => 'trash'
      ]);

   Route::delete('{id}/trashDestroy',
      [
         'uses' => 'Admin\Tests\FunctionsController@trashDestroy',
         'as' => 'trashDestroy'
      ]);

   Route::post('deleteAll',
      [
         'uses' => 'Admin\Tests\FunctionsController@deleteAll',
         'as' => 'deleteAll'
      ]);

   Route::post('restoreAll',
      [
         'uses' => 'Admin\Tests\FunctionsController@restoreAll',
         'as' => 'restoreAll'
      ]);

   Route::post('importExcel',
      [
         'uses' => 'Admin\Tests\FunctionsController@importExcel',
         'as' => 'importExport'
      ]);

   Route::post('unpublishAll',
      [
         'uses' => 'Admin\Tests\FunctionsController@unpublishAll',
         'as' => 'unpublishAll'
      ]);

   Route::post('publishAll',
      [
         'uses' => 'Admin\Tests\FunctionsController@publishAll',
         'as' => 'publishAll'
      ]);

   // Route::delete('deleteTrashed/{id}',
   //    [
   //       'uses' => 'Admin\Tests\FunctionsController@deleteTrashed',
   //       'as' => 'deleteTrashed'
   //    ]);
});

// CRUD ROUTES
Route::prefix('admin/tests')->name('admin.tests.')->group(function() {
   
   Route::get('create',
      [
         'uses' => 'Admin\Tests\TestsController@create',
         'as' => 'create'
      ]);

   Route::post('',
      [
         'uses' => 'Admin\Tests\TestsController@store',
         'as' => 'store'
      ]);

   Route::get('{id}/edit',
      [
         'uses' => 'Admin\Tests\TestsController@edit',
         'as' => 'edit'
      ]);

   Route::put('{id}',
      [
         'uses' => 'Admin\Tests\TestsController@update',
         'as' => 'update'
      ]);

   Route::delete('{id}',
      [
         'uses' => 'Admin\Tests\TestsController@destroy',
         'as' => 'destroy'
      ]);

   Route::get('{id}/show',
      [
         'uses' => 'Admin\Tests\TestsController@show',
         'as' => 'show'
      ]);

   Route::get('{key?}',
      [
         'uses' => 'Admin\Tests\TestsController@index',
         'as' => 'index'
      ]);
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FRONTEND ROUTES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::prefix('tests')->name('tests.')->group(function() {
   
   Route::get('{id}/favoriteAdd',
      [
         'uses' => 'Tests\FunctionsController@favoriteAdd',
         'as' => 'favoriteAdd'
      ]);

   Route::get('{id}/favoriteRemove',
      [
         'uses' => 'Tests\FunctionsController@favoriteRemove',
         'as' => 'favoriteRemove'
      ]);

   Route::get('myFavorites',
      [
         'uses' => 'Tests\ExtraViewsController@myFavorites',
         'as' => 'myFavorites'
      ]);

   Route::get('{id}/show',
      [
         'uses' => 'Tests\TestsController@show',
         'as' => 'show'
      ]);

   Route::get('{key?}',
      [
         'uses' => 'Tests\TestsController@index',
         'as' => 'index'
      ]);

   Route::get('archives/{year}/{month}',
      [
         'uses' => 'Tests\ExtraViewsController@archives',
         'as' => 'archives'
      ]);

});
