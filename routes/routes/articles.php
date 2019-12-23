<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// BACKEND ROUTES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// EXTRA VIEWS ROUTES
Route::namespace('Admin\Articles')->prefix('admin/articles')->name('admin.articles.')->group(function() {

	Route::get('newArticles/{key?}',			'ExtraViewsController@newArticles')		->name('newArticles');
	Route::get('unpublished/{key?}',			'ExtraViewsController@unpublished')		->name('unpublished');
	Route::get('future/{key?}',				'ExtraViewsController@future')			->name('future');
	Route::get('showTrashed/{id}',			'ExtraViewsController@showTrashed')		->name('showTrashed');
	Route::get('trashed/{key?}',				'ExtraViewsController@trashed')			->name('trashed');
	Route::get('archives/{year}/{month}', 	'ExtraViewsController@archives')			->name('archives');
	Route::get('myArticles/{key?}',			'ExtraViewsController@myArticles')		->name('myArticles');
});

// FUNCTIONS ROUTES
Route::namespace('Admin\Articles')->prefix('admin/articles')->name('admin.articles.')->group(function() {
	Route::get('{id}/addFavorite',			'FunctionsController@addFavorite')		->name('addFavorite');
	Route::get('{id}/removeFavorite',		'FunctionsController@removeFavorite')	->name('removeFavorite');
	Route::get('{id}/duplicate',				'FunctionsController@duplicate')			->name('duplicate');
	Route::get('{id}/publish',					'FunctionsController@publish')			->name('publish');
	Route::get('{id}/unpublish',				'FunctionsController@unpublish')			->name('unpublish');
	Route::get('{id}/resetViews',				'FunctionsController@resetViews')		->name('resetViews');
	Route::get('print/{id}',					'FunctionsController@print')				->name('print');
	Route::get('import',							'FunctionsController@import')				->name('import');
	Route::get('downloadExcel/{type}',		'FunctionsController@downloadExcel')	->name('downloadExcel');
	Route::get('restore/{id}',					'FunctionsController@restore')			->name('restore');
	Route::get('pdfview',						'FunctionsController@pdfview')			->name('pdfview');
	Route::post('{id}/storeComment',			'FunctionsController@storeComment')		->name('storeComment');
	Route::post('trashAll',						'FunctionsController@trashAll')			->name('trashAll');
	Route::get('{id}/trash',					'FunctionsController@trash')				->name('trash');
	Route::delete('{id}/trashDestroy',		'FunctionsController@trashDestroy')		->name('trashDestroy');
	Route::post('deleteAll',					'FunctionsController@deleteAll')			->name('deleteAll');
	Route::post('restoreAll',					'FunctionsController@restoreAll')		->name('restoreAll');
	Route::post('importExcel',					'FunctionsController@importExcel')		->name('importExport');
	Route::post('unpublishAll',				'FunctionsController@unpublishAll')		->name('unpublishAll');
	Route::post('publishAll',					'FunctionsController@publishAll')		->name('publishAll');
});

// CRUD ROUTES
Route::namespace('Admin\Articles')->prefix('admin/articles')->name('admin.articles.')->group(function() {
	Route::get('create',							'ArticlesController@create')				->name('create');
	Route::post('',								'ArticlesController@store')				->name('store');
	Route::get('{id}/edit',						'ArticlesController@edit')					->name('edit');
	Route::put('{id}',							'ArticlesController@update')				->name('update');
	Route::get('{id}/delete',					'ArticlesController@delete')				->name('delete');
	Route::delete('{id}',						'ArticlesController@deleteDestroy')		->name('deleteDestroy');
	Route::get('{id}/show',						'ArticlesController@show')					->name('show');
	Route::get('{key?}',							'ArticlesController@index')				->name('index');
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FRONTEND ROUTES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::namespace('Articles')->prefix('articles')->name('articles.')->group(function() {
	Route::get('{id}/favoriteAdd',			'FunctionsController@favoriteAdd')				->name('favoriteAdd');
	Route::get('{id}/favoriteRemove',		'FunctionsController@favoriteRemove')			->name('favoriteRemove');
	Route::get('{id}/show',						'ArticlesController@show')							->name('show');
	Route::get('myFavorites',					'ExtraViewsController@myFavorites')				->name('myFavorites');
	Route::get('{key?}',							'ArticlesController@index')						->name('index');
	Route::get('archives/{year}/{month}',	'ExtraViewsController@archives')					->name('archives');
});
