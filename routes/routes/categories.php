<?php
use Illuminate\Support\Facades\Input;

Route::prefix('admin/categories')->name('admin.categories.')->group(function() {
   Route::get('{id}/delete',              'Admin\CategoriesController@delete')               ->name('delete');
   Route::get('getSubs/{id}',             'Admin\CategoriesController@getSubs')              ->name('getSubs');
   Route::get('create',                   'Admin\CategoriesController@create')               ->name('create');
   Route::post('store',                   'Admin\CategoriesController@store')                ->name('store');
   Route::post('saveModal',               'Admin\CategoriesController@saveModal')            ->name('saveModal');
   Route::get('{id}/show',                'Admin\CategoriesController@show')                 ->name('show');
   Route::get('{id?}',                    'Admin\CategoriesController@index')                ->name('index');
   Route::get('{id}/edit',                'Admin\CategoriesController@edit')                 ->name('edit');
   Route::put('{id}',                     'Admin\CategoriesController@update')               ->name('update');
   Route::delete('{id}/destroy',          'Admin\CategoriesController@destroy')              ->name('destroy');
});

Route::get('/ajax-subcat',function () {
   $cat_id = Input::get('cat_id');
   $subcategories = DB::table('categories')->where('parent_id','=',$cat_id)->orderBy('name')->pluck('name');
   return Response::json($subcategories);
});
