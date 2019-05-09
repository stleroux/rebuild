<?php

Route::get('categories/{cat}/delete',             'CategoriesController@delete')               ->name('categories.delete');
Route::get('categories/getSubs/{id}',             'CategoriesController@getSubs')               ->name('categories.getSubs');
Route::get('categories/create',                   'CategoriesController@create')               ->name('categories.create');
Route::post('categories/store',                   'CategoriesController@store')                ->name('categories.store');
Route::post('categories/saveModal',               'CategoriesController@saveModal')            ->name('categories.saveModal');
Route::get('categories/{id}/show',                'CategoriesController@show')                 ->name('categories.show');
Route::get('categories/{id?}',                    'CategoriesController@index')                ->name('categories.index');
Route::get('categories/{id}/edit',                'CategoriesController@edit')                 ->name('categories.edit');
Route::put('categories/{id}',                     'CategoriesController@update')               ->name('categories.update');
Route::delete('categories/{id}/destroy',          'CategoriesController@destroy')              ->name('categories.destroy');
Route::get('/ajax-subcat',function () {
   $cat_id = Input::get('cat_id');
   $subcategories = DB::table('categories')->where('parent_id','=',$cat_id)->orderBy('name')->pluck('name');
   return Response::json($subcategories);
});
