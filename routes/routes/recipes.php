<?php

Route::group(['prefix' => 'recipes'], function()
{
   Route::get('future/{key?}',            'Admin\Recipes\ExtraViewsController@future')               ->name('recipes.future');
   Route::get('myFavorites/{key?}',       'Admin\Recipes\ExtraViewsController@myFavorites')          ->name('recipes.myFavorites');
   Route::get('myPrivateRecipes/{key?}',  'Admin\Recipes\ExtraViewsController@myPrivateRecipes')     ->name('recipes.myPrivateRecipes');
   Route::get('myRecipes/{key?}',         'Admin\Recipes\ExtraViewsController@myRecipes')            ->name('recipes.myRecipes');
   Route::get('newRecipes/{key?}',        'Admin\Recipes\ExtraViewsController@newRecipes')           ->name('recipes.newRecipes');
   Route::get('published/{key?}',         'Admin\Recipes\ExtraViewsController@published')            ->name('recipes.published');
   Route::get('trashed/{key?}',           'Admin\Recipes\ExtraViewsController@trashed')              ->name('recipes.trashed');
   Route::get('unpublished/{key?}',       'Admin\Recipes\ExtraViewsController@unpublished')          ->name('recipes.unpublished');
   // Route::get('trashedView/{id}',         'Admin\Recipes\ExtraViewsController@trashedView')          ->name('recipes.trashedView');

   // Route::get('bycat/{key}',              'Admin\Recipes\RecipesController@bycat')                ->name('recipes.bycat');
Route::get('{id}/printPDF',               'Admin\Recipes\FunctionsController@printPDF')            ->name('recipes.printPDF');


   Route::get('import',                   'Admin\Recipes\RecipesController@import')               ->name('recipes.import');
   Route::get('pdfview',                  'Admin\Recipes\RecipesController@pdfview')              ->name('recipes.pdfview');
   Route::post('importExcel',             'Admin\Recipes\RecipesController@importExcel')          ->name('recipes.importExport');
   Route::get('downloadExcel/{type}',     'Admin\Recipes\RecipesController@downloadExcel')        ->name('recipes.downloadExcel');

   Route::get('create',                   'Admin\Recipes\RecipesController@create')               ->name('recipes.create');
   Route::post('store',                   'Admin\Recipes\RecipesController@store')                ->name('recipes.store');
   Route::get('{id}/show',                'Admin\Recipes\RecipesController@show')                 ->name('recipes.show');
   Route::get('{id}/view',                'Admin\Recipes\RecipesController@view')                 ->name('recipes.view');
   Route::get('{id}/edit',                'Admin\Recipes\RecipesController@edit')                 ->name('recipes.edit');
   Route::put('{id}',                     'Admin\Recipes\RecipesController@update')               ->name('recipes.update');
   // Route::delete('{id}',                  'Admin\Recipes\RecipesController@destroy')              ->name('recipes.destroy');

   Route::get('{id}/print',               'Admin\Recipes\FunctionsController@print')                ->name('recipes.print');
   Route::get('print/{id}',               'Admin\Recipes\FunctionsController@printAll')             ->name('recipes.printAll');
   Route::get('{id}/publish',             'Admin\Recipes\FunctionsController@publish')              ->name('recipes.publish');
   Route::get('{id}/resetViews',          'Admin\Recipes\FunctionsController@resetViews')           ->name('recipes.resetViews');
   Route::post('publishAll',              'Admin\Recipes\FunctionsController@publishAll')           ->name('recipes.publishAll');
   Route::get('{id}/unpublish',           'Admin\Recipes\FunctionsController@unpublish')            ->name('recipes.unpublish');
   Route::post('unpublishAll',            'Admin\Recipes\FunctionsController@unpublishAll')         ->name('recipes.unpublishAll');



   Route::get('{id}/restore',             'Admin\Recipes\FunctionsController@restore')              ->name('recipes.restore');
   Route::post('restoreAll',              'Admin\Recipes\FunctionsController@restoreAll')           ->name('recipes.restoreAll');
   Route::get('{id}/showTrashed',         'Admin\Recipes\RecipesController@showTrashed')          ->name('recipes.showTrashed');
   // Route::post('trashAll',                'Admin\Recipes\RecipesController@trashAll')             ->name('recipes.trashAll');
   // Route::delete('deleteTrashed/{id}',    'Admin\Recipes\RecipesController@deleteTrashed')        ->name('recipes.deleteTrashed');
   // Route::post('deleteAll',               'Admin\Recipes\RecipesController@deleteAll')            ->name('recipes.deleteAll');

   Route::get('{id}/trash',               'Admin\Recipes\FunctionsController@trash')               ->name('recipes.trash');   
   Route::delete('{id}/trashDestroy',     'Admin\Recipes\FunctionsController@trashDestroy')        ->name('recipes.trashDestroy');
   Route::post('trashAll',                'Admin\Recipes\FunctionsController@trashAll')            ->name('recipes.trashAll');

   Route::get('{id}/delete',              'Admin\Recipes\RecipesController@delete')              ->name('recipes.delete');
   Route::delete('{id}/deleteDestroy',    'Admin\Recipes\RecipesController@deleteDestroy')       ->name('recipes.deleteDestroy');
   Route::post('deleteAll',               'Admin\Recipes\RecipesController@deleteAll')           ->name('recipes.deleteAll');

   Route::get('{id}/favoriteAdd',         'Admin\Recipes\FunctionsController@favoriteAdd')         ->name('recipes.favoriteAdd');
   Route::get('{id}/favoriteRemove',      'Admin\Recipes\FunctionsController@favoriteRemove')      ->name('recipes.favoriteRemove');
   Route::get('{id}/publicize',           'Admin\Recipes\FunctionsController@publicize')           ->name('recipes.publicize');
   Route::get('{id}/privatize',           'Admin\Recipes\FunctionsController@privatize')           ->name('recipes.privatize');
   Route::get('{id}/duplicate',           'Admin\Recipes\FunctionsController@duplicate')           ->name('recipes.duplicate');
   Route::post('{id}/storeComment',       'Admin\Recipes\FunctionsController@storeComment')        ->name('recipes.storeComment');

   // Make sure this one stays last as it will catch everything else
   Route::get('archives/{year}/{month}',  'Admin\Recipes\ExtraViewsController@archives')             ->name('recipes.archives');

   Route::get('{cat?}/{key?}',            'Admin\Recipes\RecipesController@index')               ->name('recipes.index');
});
