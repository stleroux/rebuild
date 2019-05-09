<?php

Route::group(['prefix' => 'recipes'], function()
{
   Route::get('unpublished/{key?}',       'Recipes\RecipesController@unpublished')          ->name('recipes.unpublished');
   Route::get('published/{key?}',         'Recipes\RecipesController@published')            ->name('recipes.published');
   Route::get('future/{key?}',            'Recipes\RecipesController@future')               ->name('recipes.future');
   Route::get('myRecipes/{key?}',         'Recipes\RecipesController@myRecipes')            ->name('recipes.myRecipes');
   Route::get('myPrivateRecipes/{key?}',  'Recipes\RecipesController@myPrivateRecipes')     ->name('recipes.myPrivateRecipes');
   Route::get('myFavorites/{key?}',       'Recipes\RecipesController@myFavorites')          ->name('recipes.myFavorites');
   Route::get('newRecipes/{key?}',        'Recipes\RecipesController@newRecipes')           ->name('recipes.newRecipes');
   Route::get('trashed/{key?}',           'Recipes\RecipesController@trashed')              ->name('recipes.trashed');
   // Route::get('bycat/{key}',              'Recipes\RecipesController@bycat')                ->name('recipes.bycat');

   Route::get('import',                   'Recipes\RecipesController@import')               ->name('recipes.import');
   Route::get('pdfview',                  'Recipes\RecipesController@pdfview')              ->name('recipes.pdfview');

   Route::get('create',                   'Recipes\RecipesController@create')               ->name('recipes.create');
   Route::post('store',                   'Recipes\RecipesController@store')                ->name('recipes.store');
   Route::get('{id}/show',                'Recipes\RecipesController@show')                 ->name('recipes.show');
   Route::get('{id}/view',                'Recipes\RecipesController@view')                 ->name('recipes.view');
   Route::get('{id}/trashedView',         'Recipes\RecipesController@trashedView')          ->name('recipes.trashedView');
   Route::get('{id}/edit',                'Recipes\RecipesController@edit')                 ->name('recipes.edit');
   
   
   Route::put('{id}',                     'Recipes\RecipesController@update')               ->name('recipes.update');
   // Route::delete('{id}',                  'Recipes\RecipesController@destroy')              ->name('recipes.destroy');

   Route::get('{id}/print',               'Recipes\RecipesController@print')                ->name('recipes.print');
   Route::get('print/{id}',               'Recipes\RecipesController@printAll')             ->name('recipes.printAll');
   Route::get('{id}/publish',             'Recipes\RecipesController@publish')              ->name('recipes.publish');
   Route::get('{id}/resetViews',          'Recipes\RecipesController@resetViews')           ->name('recipes.resetViews');
   Route::post('publishAll',              'Recipes\RecipesController@publishAll')           ->name('recipes.publishAll');
   Route::get('{id}/unpublish',           'Recipes\RecipesController@unpublish')            ->name('recipes.unpublish');
   Route::post('unpublishAll',            'Recipes\RecipesController@unpublishAll')         ->name('recipes.unpublishAll');

   Route::post('importExcel',             'Recipes\RecipesController@importExcel')          ->name('recipes.importExport');
   Route::get('downloadExcel/{type}',     'Recipes\RecipesController@downloadExcel')        ->name('recipes.downloadExcel');

   Route::get('{id}/restore',             'Recipes\RecipesController@restore')              ->name('recipes.restore');
   Route::post('restoreAll',              'Recipes\RecipesController@restoreAll')           ->name('recipes.restoreAll');
   Route::get('{id}/showTrashed',         'Recipes\RecipesController@showTrashed')          ->name('recipes.showTrashed');
   // Route::post('trashAll',                'Recipes\RecipesController@trashAll')             ->name('recipes.trashAll');
   // Route::delete('deleteTrashed/{id}',    'Recipes\RecipesController@deleteTrashed')        ->name('recipes.deleteTrashed');
   // Route::post('deleteAll',               'Recipes\RecipesController@deleteAll')            ->name('recipes.deleteAll');

   Route::get('{id}/trash',               'Recipes\RecipesController@trash')               ->name('recipes.trash');   
   Route::delete('{id}/trashDestroy',     'Recipes\RecipesController@trashDestroy')        ->name('recipes.trashDestroy');
   Route::post('trashAll',                'Recipes\RecipesController@trashAll')            ->name('recipes.trashAll');

   Route::get('{id}/delete',              'Recipes\RecipesController@delete')              ->name('recipes.delete');
   Route::delete('{id}/deleteDestroy',    'Recipes\RecipesController@deleteDestroy')       ->name('recipes.deleteDestroy');
   Route::post('deleteAll',               'Recipes\RecipesController@deleteAll')           ->name('recipes.deleteAll');

   Route::get('{id}/favoriteAdd',         'Recipes\RecipesController@favoriteAdd')         ->name('recipes.favoriteAdd');
   Route::get('{id}/favoriteRemove',      'Recipes\RecipesController@favoriteRemove')      ->name('recipes.favoriteRemove');
   Route::get('{id}/makePublic',          'Recipes\RecipesController@makePublic')          ->name('recipes.makePublic');
   Route::get('{id}/makePrivate',         'Recipes\RecipesController@makePrivate')         ->name('recipes.makePrivate');
   Route::get('{id}/duplicate',           'Recipes\RecipesController@duplicate')           ->name('recipes.duplicate');
   Route::post('{id}/storeComment',       'Recipes\RecipesController@storeComment')        ->name('recipes.storeComment');

   // Make sure this one stays last as it will catch everything else
   Route::get('archives/{year}/{month}',  'Recipes\RecipesController@archive')             ->name('recipes.archives');

   Route::get('{cat?}/{key?}',            'Recipes\RecipesController@index')               ->name('recipes.index');
});
