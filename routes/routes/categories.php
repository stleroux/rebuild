<?php
use Illuminate\Support\Facades\Input;

Route::namespace('Admin')->prefix('admin/categories')->name('admin.categories.')->group(function() {
   Route::get('{id}/delete',              'CategoriesController@delete')               ->name('delete');
   Route::get('getSubs/{id}',             'CategoriesController@getSubs')              ->name('getSubs');
   Route::get('create',                   'CategoriesController@create')               ->name('create');
   Route::post('store',                   'CategoriesController@store')                ->name('store');
   Route::post('saveModal',               'CategoriesController@saveModal')            ->name('saveModal');
   Route::get('{id}/show',                'CategoriesController@show')                 ->name('show');
   Route::get('{id?}',                    'CategoriesController@index')                ->name('index');
   Route::get('{id}/edit',                'CategoriesController@edit')                 ->name('edit');
   Route::put('{id}',                     'CategoriesController@update')               ->name('update');
   Route::delete('{id}/destroy',          'CategoriesController@destroy')              ->name('destroy');
});

Route::get('/ajax-subcat',function () {
   $cat_id = Input::get('cat_id');
   $subcategories = DB::table('categories')->where('parent_id','=',$cat_id)->orderBy('name')->pluck('name');
   return Response::json($subcategories);
});
