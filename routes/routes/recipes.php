<?php

Route::prefix('admin/recipes')->name('admin.recipes.')->group(function() {
   Route::get('future/{key?}',            'Admin\Recipes\ExtraViewsController@future')         ->name('future');
   Route::get('newRecipes/{key?}',        'Admin\Recipes\ExtraViewsController@newRecipes')     ->name('newRecipes');
   Route::get('unpublished/{key?}',       'Admin\Recipes\ExtraViewsController@unpublished')    ->name('unpublished');
   Route::get('trashed/{key?}',           'Admin\Recipes\ExtraViewsController@trashed')        ->name('trashed');
   Route::get('{id}/show',                'Admin\Recipes\RecipesController@show')              ->name('show');
   Route::get('{id}/trash',               'Admin\Recipes\FunctionsController@trash')           ->name('trash');
   Route::get('{id}/delete',              'Admin\Recipes\RecipesController@delete')            ->name('delete');
   Route::delete('{id}/deleteDestroy',    'Admin\Recipes\RecipesController@deleteDestroy')     ->name('deleteDestroy');
   Route::get('create',                   'Admin\Recipes\RecipesController@create')            ->name('create');
   Route::post('store',                   'Admin\Recipes\RecipesController@store')             ->name('store');
   Route::get('{id}/edit',                'Admin\Recipes\RecipesController@edit')              ->name('edit');
   Route::put('{id}',                     'Admin\Recipes\RecipesController@update')            ->name('update');
   Route::get('{id}/publish',             'Admin\Recipes\FunctionsController@publish')         ->name('publish');
   Route::get('{id}/resetViews',          'Admin\Recipes\FunctionsController@resetViews')      ->name('resetViews');
   Route::post('publishAll',              'Admin\Recipes\FunctionsController@publishAll')      ->name('publishAll');
   Route::get('{id}/unpublish',           'Admin\Recipes\FunctionsController@unpublish')       ->name('unpublish');
   Route::post('unpublishAll',            'Admin\Recipes\FunctionsController@unpublishAll')    ->name('unpublishAll');
   Route::get('{id}/restore',             'Admin\Recipes\FunctionsController@restore')         ->name('restore');
   Route::post('restoreAll',              'Admin\Recipes\FunctionsController@restoreAll')      ->name('restoreAll');
   Route::get('{id}/showTrashed',         'Admin\Recipes\RecipesController@showTrashed')       ->name('showTrashed');
   // Route::delete('{id}',                  'Admin\Recipes\RecipesController@destroy')              ->name('recipes.destroy');

   Route::get('{id}/trash',               'Admin\Recipes\FunctionsController@trash')           ->name('trash');
   Route::delete('{id}/trashDestroy',     'Admin\Recipes\FunctionsController@trashDestroy')    ->name('trashDestroy');
   Route::post('trashAll',                'Admin\Recipes\FunctionsController@trashAll')        ->name('trashAll');
   Route::post('deleteAll',               'Admin\Recipes\RecipesController@deleteAll')         ->name('deleteAll');
   Route::get('{id}/duplicate',           'Admin\Recipes\FunctionsController@duplicate')       ->name('duplicate');
   // Route::get('import',                   'Admin\Recipes\RecipesController@import')               ->name('recipes.import');
   // Route::get('pdfview',                  'Admin\Recipes\RecipesController@pdfview')              ->name('recipes.pdfview');
   // Route::post('importExcel',             'Admin\Recipes\RecipesController@importExcel')          ->name('recipes.importExport');
   // Route::get('downloadExcel/{type}',     'Admin\Recipes\RecipesController@downloadExcel')        ->name('recipes.downloadExcel');
   Route::get('{key?}',                   'Admin\Recipes\RecipesController@index')             ->name('index');
});

Route::prefix('recipes')->name('recipes.')->group(function() {
   
   Route::get('{id}/show/{byCatName?}',   'Recipes\RecipesController@show')                    ->name('show');
   Route::get('{id}/printPDF',            'Recipes\FunctionsController@printPDF')              ->name('printPDF');
   Route::get('{id}/print',               'Recipes\FunctionsController@print')                 ->name('print');
   Route::get('print/{id}',               'Recipes\FunctionsController@printAll')              ->name('printAll');
   Route::get('{id}/favoriteAdd',         'Recipes\FunctionsController@favoriteAdd')           ->name('favoriteAdd');
   Route::get('{id}/favoriteRemove',      'Recipes\FunctionsController@favoriteRemove')        ->name('favoriteRemove');
   Route::get('{id}/publicize',           'Recipes\FunctionsController@publicize')             ->name('publicize');
   Route::get('{id}/privatize',           'Recipes\FunctionsController@privatize')             ->name('privatize');
   Route::post('{id}/storeComment',       'Recipes\FunctionsController@storeComment')          ->name('storeComment');

   // Make sure this one stays last as it will catch everything else
   Route::get('archives/{year}/{month}',  'Admin\Recipes\ExtraViewsController@archives')       ->name('archives');

   Route::get('myFavoriteRecipes/{key?}', 'Recipes\RecipesController@myFavoriteRecipes')       ->name('myFavoriteRecipes');
   Route::get('myPrivateRecipes/{key?}',  'Recipes\RecipesController@myPrivateRecipes')        ->name('myPrivateRecipes');
   Route::get('myRecipes/{key?}',         'Recipes\RecipesController@myRecipes')               ->name('myRecipes');
   Route::get('{cat?}/{key?}',            'Recipes\RecipesController@index')                   ->name('index');
});
