<?php 

Route::get('comments/{comment}/delete', 'CommentsController@delete')->name('comments.delete');
Route::resource('comments', 'CommentsController');
