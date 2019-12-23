<?php

// Route::prefix('blog')->name('blog.')->group(function() {
//    Route::get('search',                 'BlogController@search')                 ->name('search');
//    Route::get('print/{id}',             'BlogController@print')                  ->name('print');
//    Route::get('viewImage/{id}',         'BlogController@viewImage')              ->name('viewImage');
//    Route::get('{year}/{month}',         'BlogController@archive')                ->name('archive');
//    Route::post('{id}/storeComment',     'BlogController@storeComment')           ->name('storeComment');
//    Route::get('{slug}',                 'BlogController@show')                   ->name('show')->where('slug', '[\w\d\-\_]+');
//    Route::get('',                       'BlogController@getIndex')               ->name('index');
// });

Route::namespace('Admin\Posts')->prefix('admin/posts')->name('admin.posts.')->group(function() {
   Route::get('newPosts/{key?}',                'ExtraViewsController@newPosts')            ->name('newPosts');
   Route::get('unpublished/{key?}',             'ExtraViewsController@unpublished')         ->name('unpublished');
   Route::get('futurePosts/{key?}',             'ExtraViewsController@futurePosts')         ->name('futurePosts');
   Route::get('trashed/{key?}',                 'ExtraViewsController@trashed')             ->name('trashed');
   Route::get('showTrashed/{id}',               'ExtraViewsController@showTrashed')         ->name('showTrashed');
// });

// Route::prefix('posts')->name('posts.')->group(function() {
   Route::get('/{id}/publish',                  'FunctionsController@publish')             ->name('publish');
   Route::post('/publishAll',                   'FunctionsController@publishAll')          ->name('publishAll');
   Route::get('/{id}/unpublish',                'FunctionsController@unpublish')           ->name('unpublish');
   Route::post('/unpublishAll',                 'FunctionsController@unpublishAll')        ->name('unpublishAll');
   Route::get('restore/{id}',                   'FunctionsController@restore')             ->name('restore');
   Route::post('restoreAll',                    'FunctionsController@restoreAll')          ->name('restoreAll');
   Route::get('showTrashed/{id}',               'FunctionsController@showTrashed')         ->name('showTrashed');
   Route::get('/{id}/deleteImage',              'FunctionsController@deleteImage')         ->name('deleteImage');
   
   Route::get('/{id}/trash',                    'FunctionsController@trash')               ->name('trash');
   Route::delete('/trashDestroy/{id}/{page?}',  'FunctionsController@trashDestroy')        ->name('trashDestroy');
   Route::post('/trashAll',                     'FunctionsController@trashAll')            ->name('trashAll');

   Route::get('/{id}/delete',                   'PostsController@delete')                  ->name('delete');
   Route::delete('/{id}/deleteDestroy',         'PostsController@deleteDestroy')           ->name('deleteDestroy');
   Route::post('/deleteAll',                    'PostsController@deleteAll')               ->name('deleteAll');
// });

// Route::prefix('posts')->name('posts.')->group(function() {
   Route::get('/{id}/show',                     'PostsController@show')                   ->name('show');
   Route::get('/create',                        'PostsController@create')                 ->name('create');
   Route::post('/store',                        'PostsController@store')                  ->name('store');
   Route::get('/{key?}',                        'PostsController@index')                  ->name('index');
   Route::get('/{id}/edit',                     'PostsController@edit')                   ->name('edit');
   Route::put('/{id}/update',                   'PostsController@update')                 ->name('update');
   Route::delete('{id}/destroy',                'PostsController@destroy')                ->name('destroy');
});