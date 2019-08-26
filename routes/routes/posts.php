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

   Route::get('newPosts/{key?}',                'PostsController@newPosts')            ->name('newPosts');
   Route::get('unpublished/{key?}',             'PostsController@unpublished')         ->name('unpublished');
   Route::get('trashed/{key?}',                 'PostsController@trashed')             ->name('trashed');
   Route::get('/{id}/show',                     'PostsController@show')                ->name('show');
   Route::get('/{id}/publish',                  'PostsController@publish')             ->name('publish');
   Route::post('/publishAll',                   'PostsController@publishAll')          ->name('publishAll');
   Route::get('/{id}/unpublish',                'PostsController@unpublish')           ->name('unpublish');
   Route::get('/create',                        'PostsController@create')              ->name('create');
   Route::post('/store',                        'PostsController@store')               ->name('store');
   Route::post('/unpublishAll',                 'PostsController@unpublishAll')        ->name('unpublishAll');
   Route::get('/{key?}',                        'PostsController@index')               ->name('index');
   Route::get('restore/{id}',                   'PostsController@restore')             ->name('restore');
   Route::post('restoreAll',                    'PostsController@restoreAll')          ->name('restoreAll');
   Route::get('showTrashed/{id}',               'PostsController@showTrashed')         ->name('showTrashed');
   Route::get('/{id}/edit',                     'PostsController@edit')                ->name('edit');
   Route::put('/{id}/update',                   'PostsController@update')              ->name('update');
   Route::get('/{id}/deleteImage',              'PostsController@deleteImage')         ->name('deleteImage');
   
   Route::get('/{id}/trash',                    'PostsController@trash')               ->name('trash');
   Route::delete('/trashDestroy/{id}/{page?}',  'PostsController@trashDestroy')        ->name('trashDestroy');
   Route::post('/trashAll',                     'PostsController@trashAll')            ->name('trashAll');

   Route::get('/{id}/delete',                   'PostsController@delete')              ->name('delete');
   Route::delete('/{id}/deleteDestroy',         'PostsController@deleteDestroy')       ->name('deleteDestroy');
   Route::post('/deleteAll',                    'PostsController@deleteAll')           ->name('deleteAll');
});
