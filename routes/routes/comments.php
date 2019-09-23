<?php 

// Route::get('comments/{comment}/delete', 'CommentsController@delete')->name('comments.delete');
// Route::resource('comments', 'CommentsController');


Route::prefix('admin/comments')->name('admin.comments.')->group(function() {
   Route::get('{id}/delete',              'Admin\CommentsController@delete')               ->name('delete');
   // Route::get('getSubs/{id}',             'Admin\CommentsController@getSubs')              ->name('getSubs');
   Route::get('create',                   'Admin\CommentsController@create')               ->name('create');
   Route::post('store',                   'Admin\CommentsController@store')                ->name('store');
   // Route::post('saveModal',               'Admin\CommentsController@saveModal')            ->name('saveModal');
   Route::get('{id}/show',                'Admin\CommentsController@show')                 ->name('show');
   Route::get('{id?}',                    'Admin\CommentsController@index')                ->name('index');
   Route::get('{id}/edit',                'Admin\CommentsController@edit')                 ->name('edit');
   Route::put('{id}',                     'Admin\CommentsController@update')               ->name('update');
   Route::delete('{id}/destroy',          'Admin\CommentsController@destroy')              ->name('destroy');
});