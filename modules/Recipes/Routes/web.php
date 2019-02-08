<?php

// Route::prefix('recipes')->name('recipes.')->group(function() {

//    Route::get('/{key?}',                        'RecipesController@index')               ->name('index');



//    Route::get('newPosts/{key?}',                'RecipesController@newPosts')            ->name('newPosts');
//    Route::get('unpublished/{key?}',             'RecipesController@unpublished')         ->name('unpublished');
//    Route::get('trashed/{key?}',                 'RecipesController@trashed')             ->name('trashed');
//    Route::get('/{id}/show',                     'RecipesController@show')                ->name('show');
//    Route::get('/{id}/publish',                  'RecipesController@publish')             ->name('publish');
//    Route::post('/publishAll',                   'RecipesController@publishAll')          ->name('publishAll');
//    Route::get('/{id}/unpublish',                'RecipesController@unpublish')           ->name('unpublish');
//    Route::get('/create',                        'RecipesController@create')              ->name('create');
//    Route::post('/store',                        'RecipesController@store')               ->name('store');
//    Route::post('/unpublishAll',                 'RecipesController@unpublishAll')        ->name('unpublishAll');
   
//    Route::get('restore/{id}',                   'RecipesController@restore')             ->name('restore');
//    Route::post('restoreAll',                    'RecipesController@restoreAll')          ->name('restoreAll');
//    Route::get('showTrashed/{id}',               'RecipesController@showTrashed')         ->name('showTrashed');
//    Route::get('/{id}/edit',                     'RecipesController@edit')                ->name('edit');
//    Route::put('/{id}/update',                   'RecipesController@update')              ->name('update');
//    Route::get('/{id}/deleteImage',              'RecipesController@deleteImage')         ->name('deleteImage');
   
//    Route::get('/{id}/trash',                    'RecipesController@trash')               ->name('trash');
//    Route::delete('/trashDestroy/{id}/{page?}',  'RecipesController@trashDestroy')        ->name('trashDestroy');
//    Route::post('/trashAll',                     'RecipesController@trashAll')            ->name('trashAll');

//    Route::get('/{id}/delete',                   'RecipesController@delete')              ->name('delete');
//    Route::delete('/{id}/deleteDestroy',         'RecipesController@deleteDestroy')       ->name('deleteDestroy');
//    Route::post('/deleteAll',                    'RecipesController@deleteAll')           ->name('deleteAll');
// });



// RECIPES
// Route::get('recipe/{id}',     ['uses'=>'RecipesController@show',           'as'=>'recipes.show']);

Route::group(['prefix' => 'recipes'], function()
{

   Route::get('unpublished/{key?}',       'RecipesController@unpublished')          ->name('recipes.unpublished');
   Route::get('published/{key?}',         'RecipesController@published')            ->name('recipes.published');
   Route::get('future/{key?}',            'RecipesController@future')               ->name('recipes.future');
   Route::get('myRecipes/{key?}',         'RecipesController@myRecipes')            ->name('recipes.myRecipes');
   Route::get('myFavorites/{key?}',       'RecipesController@myFavorites')          ->name('recipes.myFavorites');
   Route::get('newRecipes/{key?}',        'RecipesController@newRecipes')           ->name('recipes.newRecipes');
   Route::get('trashed/{key?}',           'RecipesController@trashed')              ->name('recipes.trashed');
   

   Route::get('import',                   'RecipesController@import')               ->name('recipes.import');
   Route::get('pdfview',                  'RecipesController@pdfview')              ->name('recipes.pdfview');

   Route::get('create',                   'RecipesController@create')               ->name('recipes.create');
   Route::post('store',                   'RecipesController@store')                ->name('recipes.store');
   Route::get('{id}/show',                'RecipesController@show')                 ->name('recipes.show');
   Route::get('{id?}',                    'RecipesController@index')                ->name('recipes.index');
   Route::get('{id}/edit',                'RecipesController@edit')                 ->name('recipes.edit');
   Route::put('{id}',                     'RecipesController@update')               ->name('recipes.update');
   Route::delete('{id}',                  'RecipesController@destroy')              ->name('recipes.destroy');

   Route::get('{id}/print',               'RecipesController@print')                ->name('recipes.print');
   Route::get('{id}/publish',             'RecipesController@publish')              ->name('recipes.publish');
   Route::get('{id}/resetViews',          'RecipesController@resetViews')           ->name('recipes.resetViews');
   Route::post('publishAll',              'RecipesController@publishAll')           ->name('recipes.publishAll');
   Route::get('{id}/unpublish',           'RecipesController@unpublish')            ->name('recipes.unpublish');
   Route::post('unpublishAll',            'RecipesController@unpublishAll')         ->name('recipes.unpublishAll');

   Route::post('importExcel',             'RecipesController@importExcel')          ->name('recipes.importExport');
   Route::get('downloadExcel/{type}',     'RecipesController@downloadExcel')        ->name('recipes.downloadExcel');

   Route::get('restore/{id}',             'RecipesController@restore')              ->name('recipes.restore');
   Route::post('restoreAll',              'RecipesController@restoreAll')           ->name('recipes.restoreAll');
   Route::get('showTrashed/{id}',         'RecipesController@showTrashed')          ->name('recipes.showTrashed');
   Route::post('trashAll',                'RecipesController@trashAll')             ->name('recipes.trashAll');
   Route::delete('deleteTrashed/{id}',    'RecipesController@deleteTrashed')        ->name('recipes.deleteTrashed');
   Route::post('deleteAll',               'RecipesController@deleteAll')            ->name('recipes.deleteAll');

   Route::get('{id}/addFavorite',         'RecipesController@addFavorite')          ->name('recipes.addFavorite');
   Route::get('{id}/removeFavorite',      'RecipesController@removeFavorite')       ->name('recipes.removeFavorite');
   Route::get('{id}/makePrivate',         'RecipesController@makePrivate')          ->name('recipes.makePrivate');
   Route::get('{id}/removePrivate',       'RecipesController@removePrivate')        ->name('recipes.removePrivate');
   Route::get('{id}/duplicate',           'RecipesController@duplicate')            ->name('recipes.duplicate');
   Route::post('{id}/storeComment',       'RecipesController@storeComment')         ->name('recipes.storeComment');
   Route::get('{year}/{month}',           'RecipesController@archive')              ->name('recipes.archive');
   
});