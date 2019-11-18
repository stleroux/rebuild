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

Route::prefix('admin/posts')->name('admin.posts.')->group(function() {
   Route::get('newPosts/{key?}',                'Admin\Posts\ExtraViewsController@newPosts')            ->name('newPosts');
   Route::get('unpublished/{key?}',             'Admin\Posts\ExtraViewsController@unpublished')         ->name('unpublished');
   Route::get('futurePosts/{key?}',             'Admin\Posts\ExtraViewsController@futurePosts')         ->name('futurePosts');
   Route::get('trashed/{key?}',                 'Admin\Posts\ExtraViewsController@trashed')             ->name('trashed');
   Route::get('showTrashed/{id}',               'Admin\Posts\ExtraViewsController@showTrashed')         ->name('showTrashed');
// });

// Route::prefix('posts')->name('posts.')->group(function() {
   Route::get('/{id}/publish',                  'Admin\Posts\FunctionsController@publish')             ->name('publish');
   Route::post('/publishAll',                   'Admin\Posts\FunctionsController@publishAll')          ->name('publishAll');
   Route::get('/{id}/unpublish',                'Admin\Posts\FunctionsController@unpublish')           ->name('unpublish');
   Route::post('/unpublishAll',                 'Admin\Posts\FunctionsController@unpublishAll')        ->name('unpublishAll');
   Route::get('restore/{id}',                   'Admin\Posts\FunctionsController@restore')             ->name('restore');
   Route::post('restoreAll',                    'Admin\Posts\FunctionsController@restoreAll')          ->name('restoreAll');
   Route::get('showTrashed/{id}',               'Admin\Posts\FunctionsController@showTrashed')         ->name('showTrashed');
   Route::get('/{id}/deleteImage',              'Admin\Posts\FunctionsController@deleteImage')         ->name('deleteImage');
   
   Route::get('/{id}/trash',                    'Admin\Posts\FunctionsController@trash')               ->name('trash');
   Route::delete('/trashDestroy/{id}/{page?}',  'Admin\Posts\FunctionsController@trashDestroy')        ->name('trashDestroy');
   Route::post('/trashAll',                     'Admin\Posts\FunctionsController@trashAll')            ->name('trashAll');

   Route::get('/{id}/delete',                   'Admin\Posts\PostsController@delete')              ->name('delete');
   Route::delete('/{id}/deleteDestroy',         'Admin\Posts\PostsController@deleteDestroy')       ->name('deleteDestroy');
   Route::post('/deleteAll',                    'Admin\Posts\PostsController@deleteAll')           ->name('deleteAll');
// });

// Route::prefix('posts')->name('posts.')->group(function() {
   Route::get('/{id}/show',                     'Admin\Posts\PostsController@show')                ->name('show');
   Route::get('/create',                        'Admin\Posts\PostsController@create')              ->name('create');
   Route::post('/store',                        'Admin\Posts\PostsController@store')               ->name('store');
   Route::get('/{key?}',                        'Admin\Posts\PostsController@index')               ->name('index');
   Route::get('/{id}/edit',                     'Admin\Posts\PostsController@edit')                ->name('edit');
   Route::put('/{id}/update',                   'Admin\Posts\PostsController@update')              ->name('update');
   Route::delete('{id}/destroy',                'Admin\Posts\PostsController@destroy')             ->name('destroy');
});