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

Route::prefix('posts')->name('posts.')->group(function() {
   Route::get('newPosts/{key?}',                'Posts\ExtraViewsController@newPosts')            ->name('newPosts');
   Route::get('unpublished/{key?}',             'Posts\ExtraViewsController@unpublished')         ->name('unpublished');
   Route::get('trashed/{key?}',                 'Posts\ExtraViewsController@trashed')             ->name('trashed');
   Route::get('showTrashed/{id}',               'Posts\ExtraViewsController@showTrashed')         ->name('showTrashed');
});

Route::prefix('posts')->name('posts.')->group(function() {
   Route::get('/{id}/publish',                  'Posts\FunctionsController@publish')             ->name('publish');
   Route::post('/publishAll',                   'Posts\FunctionsController@publishAll')          ->name('publishAll');
   Route::get('/{id}/unpublish',                'Posts\FunctionsController@unpublish')           ->name('unpublish');
   Route::post('/unpublishAll',                 'Posts\FunctionsController@unpublishAll')        ->name('unpublishAll');
   Route::get('restore/{id}',                   'Posts\FunctionsController@restore')             ->name('restore');
   Route::post('restoreAll',                    'Posts\FunctionsController@restoreAll')          ->name('restoreAll');
   Route::get('showTrashed/{id}',               'Posts\FunctionsController@showTrashed')         ->name('showTrashed');
   Route::get('/{id}/deleteImage',              'Posts\FunctionsController@deleteImage')         ->name('deleteImage');
   
   Route::get('/{id}/trash',                    'Posts\FunctionsController@trash')               ->name('trash');
   Route::delete('/trashDestroy/{id}/{page?}',  'Posts\FunctionsController@trashDestroy')        ->name('trashDestroy');
   Route::post('/trashAll',                     'Posts\FunctionsController@trashAll')            ->name('trashAll');

   Route::get('/{id}/delete',                   'Posts\FunctionsController@delete')              ->name('delete');
   Route::delete('/{id}/deleteDestroy',         'Posts\FunctionsController@deleteDestroy')       ->name('deleteDestroy');
   Route::post('/deleteAll',                    'Posts\FunctionsController@deleteAll')           ->name('deleteAll');
});

Route::prefix('posts')->name('posts.')->group(function() {
   Route::get('/{id}/show',                     'Posts\PostsController@show')                ->name('show');
   Route::get('/create',                        'Posts\PostsController@create')              ->name('create');
   Route::post('/store',                        'Posts\PostsController@store')               ->name('store');
   Route::get('/{key?}',                        'Posts\PostsController@index')               ->name('index');
   Route::get('/{id}/edit',                     'Posts\PostsController@edit')                ->name('edit');
   Route::put('/{id}/update',                   'Posts\PostsController@update')              ->name('update');
});