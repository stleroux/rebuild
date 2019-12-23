<?php 

// Route::get('comments/{comment}/delete', 'CommentsController@delete')->name('comments.delete');
// Route::resource('comments', 'CommentsController');


Route::namespace('Admin')->prefix('admin/comments')->name('admin.comments.')->group(function() {
   Route::get('{id}/delete',              'CommentsController@delete')               ->name('delete');
   // Route::get('getSubs/{id}',             'CommentsController@getSubs')              ->name('getSubs');
   Route::get('create',                   'CommentsController@create')               ->name('create');
   Route::post('store',                   'CommentsController@store')                ->name('store');
   // Route::post('saveModal',               'CommentsController@saveModal')            ->name('saveModal');
   Route::get('{id}/show',                'CommentsController@show')                 ->name('show');
   Route::get('{id?}',                    'CommentsController@index')                ->name('index');
   Route::get('{id}/edit',                'CommentsController@edit')                 ->name('edit');
   Route::put('{id}',                     'CommentsController@update')               ->name('update');
   Route::delete('{id}/destroy',          'CommentsController@destroy')              ->name('destroy');
});