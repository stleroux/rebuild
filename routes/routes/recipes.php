<?php

Route::group(['prefix' => 'recipes'], function()
{
   Route::get('future/{key?}',            'Recipes\ExtraViewsController@future')               ->name('recipes.future');
   Route::get('myFavorites/{key?}',       'Recipes\ExtraViewsController@myFavorites')          ->name('recipes.myFavorites');
   Route::get('myPrivateRecipes/{key?}',  'Recipes\ExtraViewsController@myPrivateRecipes')     ->name('recipes.myPrivateRecipes');
   Route::get('myRecipes/{key?}',         'Recipes\ExtraViewsController@myRecipes')            ->name('recipes.myRecipes');
   Route::get('newRecipes/{key?}',        'Recipes\ExtraViewsController@newRecipes')           ->name('recipes.newRecipes');
   Route::get('published/{key?}',         'Recipes\ExtraViewsController@published')            ->name('recipes.published');
   Route::get('trashed/{key?}',           'Recipes\ExtraViewsController@trashed')              ->name('recipes.trashed');
   Route::get('unpublished/{key?}',       'Recipes\ExtraViewsController@unpublished')          ->name('recipes.unpublished');
   // Route::get('trashedView/{id}',         'Recipes\ExtraViewsController@trashedView')          ->name('recipes.trashedView');

   // Route::get('bycat/{key}',              'Recipes\RecipesController@bycat')                ->name('recipes.bycat');

   Route::get('import',                   'Recipes\RecipesController@import')               ->name('recipes.import');
   Route::get('pdfview',                  'Recipes\RecipesController@pdfview')              ->name('recipes.pdfview');
   Route::post('importExcel',             'Recipes\RecipesController@importExcel')          ->name('recipes.importExport');
   Route::get('downloadExcel/{type}',     'Recipes\RecipesController@downloadExcel')        ->name('recipes.downloadExcel');

   Route::get('create',                   'Recipes\RecipesController@create')               ->name('recipes.create');
   Route::post('store',                   'Recipes\RecipesController@store')                ->name('recipes.store');
   Route::get('{id}/show',                'Recipes\RecipesController@show')                 ->name('recipes.show');
   Route::get('{id}/view',                'Recipes\RecipesController@view')                 ->name('recipes.view');
   Route::get('{id}/edit',                'Recipes\RecipesController@edit')                 ->name('recipes.edit');
   Route::put('{id}',                     'Recipes\RecipesController@update')               ->name('recipes.update');
   // Route::delete('{id}',                  'Recipes\RecipesController@destroy')              ->name('recipes.destroy');

   Route::get('{id}/print',               'Recipes\FunctionsController@print')                ->name('recipes.print');
   Route::get('print/{id}',               'Recipes\FunctionsController@printAll')             ->name('recipes.printAll');
   Route::get('{id}/publish',             'Recipes\FunctionsController@publish')              ->name('recipes.publish');
   Route::get('{id}/resetViews',          'Recipes\FunctionsController@resetViews')           ->name('recipes.resetViews');
   Route::post('publishAll',              'Recipes\FunctionsController@publishAll')           ->name('recipes.publishAll');
   Route::get('{id}/unpublish',           'Recipes\FunctionsController@unpublish')            ->name('recipes.unpublish');
   Route::post('unpublishAll',            'Recipes\FunctionsController@unpublishAll')         ->name('recipes.unpublishAll');



   Route::get('{id}/restore',             'Recipes\FunctionsController@restore')              ->name('recipes.restore');
   Route::post('restoreAll',              'Recipes\FunctionsController@restoreAll')           ->name('recipes.restoreAll');
   Route::get('{id}/showTrashed',         'Recipes\RecipesController@showTrashed')          ->name('recipes.showTrashed');
   // Route::post('trashAll',                'Recipes\RecipesController@trashAll')             ->name('recipes.trashAll');
   // Route::delete('deleteTrashed/{id}',    'Recipes\RecipesController@deleteTrashed')        ->name('recipes.deleteTrashed');
   // Route::post('deleteAll',               'Recipes\RecipesController@deleteAll')            ->name('recipes.deleteAll');

   Route::get('{id}/trash',               'Recipes\FunctionsController@trash')               ->name('recipes.trash');   
   Route::delete('{id}/trashDestroy',     'Recipes\FunctionsController@trashDestroy')        ->name('recipes.trashDestroy');
   Route::post('trashAll',                'Recipes\FunctionsController@trashAll')            ->name('recipes.trashAll');

   Route::get('{id}/delete',              'Recipes\RecipesController@delete')              ->name('recipes.delete');
   Route::delete('{id}/deleteDestroy',    'Recipes\RecipesController@deleteDestroy')       ->name('recipes.deleteDestroy');
   Route::post('deleteAll',               'Recipes\RecipesController@deleteAll')           ->name('recipes.deleteAll');

   Route::get('{id}/favoriteAdd',         'Recipes\FunctionsController@favoriteAdd')         ->name('recipes.favoriteAdd');
   Route::get('{id}/favoriteRemove',      'Recipes\FunctionsController@favoriteRemove')      ->name('recipes.favoriteRemove');
   Route::get('{id}/publicize',           'Recipes\FunctionsController@publicize')           ->name('recipes.publicize');
   Route::get('{id}/privatize',           'Recipes\FunctionsController@privatize')           ->name('recipes.privatize');
   Route::get('{id}/duplicate',           'Recipes\FunctionsController@duplicate')           ->name('recipes.duplicate');
   Route::post('{id}/storeComment',       'Recipes\FunctionsController@storeComment')        ->name('recipes.storeComment');

   // Make sure this one stays last as it will catch everything else
   Route::get('archives/{year}/{month}',  'Recipes\ExtraViewsController@archives')             ->name('recipes.archives');

   Route::get('{cat?}/{key?}',            'Recipes\RecipesController@index')               ->name('recipes.index');
});
