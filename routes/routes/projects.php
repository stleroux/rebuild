<?php

Route::post('/projects/{project}/image',              'Admin\Projects\ImageController@store')              ->name('projects.image.store');
Route::delete('/projects/{project}/image',            'Admin\Projects\ImageController@destroy')            ->name('projects.image.delete');

Route::post('/projects/{project}/material',           'Admin\Projects\MaterialController@store')            ->name('projects.material.store');
Route::delete('/projects/{project}/material',         'Admin\Projects\MaterialController@destroy')          ->name('projects.material.delete');

Route::post('/projects/{project}/finish',             'Admin\Projects\FinishController@store')              ->name('projects.finish.store');
Route::delete('/projects/{project}/finish',           'Admin\Projects\FinishController@destroy')            ->name('projects.finish.delete');

Route::post('projects/{project}/comment',             'Admin\Projects\CommentController@store')            ->name('projects.comment.store');


Route::prefix('admin/projects/materials')->name('admin.projects.materials.')->group(function() {
   // Route::resource('materials', 'Admin\Projects\MaterialsController');
   Route::get('create',                   'Admin\Projects\MaterialsController@create')           ->name('create');
   Route::get('index',                    'Admin\Projects\MaterialsController@index')            ->name('index');
   Route::post('store',                   'Admin\Projects\MaterialsController@store')            ->name('store');
   Route::get('{project}/show',           'Admin\Projects\MaterialsController@show')             ->name('show');
   Route::get('{project}/edit',           'Admin\Projects\MaterialsController@edit')             ->name('edit');
   Route::put('{project}',                'Admin\Projects\MaterialsController@update')           ->name('update');
   Route::delete('{project}',             'Admin\Projects\MaterialsController@destroy')          ->name('destroy');
   Route::get('{material}/delete',        'Admin\Projects\MaterialsController@delete')           ->name('delete');
});

Route::prefix('admin/projects/finishes')->name('admin.projects.finishes.')->group(function() {
   // Route::resource('finishes', 'Admin\Projects\FinishesController');
   Route::get('create',                   'Admin\Projects\FinishesController@create')           ->name('create');
   Route::get('index',                    'Admin\Projects\FinishesController@index')            ->name('index');
   Route::post('store',                   'Admin\Projects\FinishesController@store')            ->name('store');
   Route::get('{project}/show',           'Admin\Projects\FinishesController@show')             ->name('show');
   Route::get('{project}/edit',           'Admin\Projects\FinishesController@edit')             ->name('edit');
   Route::put('{project}',                'Admin\Projects\FinishesController@update')           ->name('update');
   Route::delete('{project}',             'Admin\Projects\FinishesController@destroy')          ->name('destroy');
   Route::get('{finish}/delete',          'Admin\Projects\FinishesController@delete')           ->name('delete');
});

Route::prefix('admin/projects')->name('admin.projects.')->group(function() {
   Route::get('create',                   'Admin\Projects\ProjectsController@create')           ->name('create');
   Route::get('{filter?}',                'Admin\Projects\ProjectsController@index')            ->name('index');
   Route::post('store',                   'Admin\Projects\ProjectsController@store')            ->name('store');
   Route::get('{project}/show',           'Admin\Projects\ProjectsController@show')             ->name('show');
   Route::get('{project}/edit',           'Admin\Projects\ProjectsController@edit')             ->name('edit');
   Route::put('{project}',                'Admin\Projects\ProjectsController@update')           ->name('update');
   Route::delete('{project}',             'Admin\Projects\ProjectsController@destroy')          ->name('destroy');
   Route::get('{project}/delete',         'Admin\Projects\ProjectsController@delete')           ->name('delete');
});

Route::get('/projects/{project}/show',    'Projects\ProjectsController@show')                   ->name('projects.show');
Route::get('/projects/{filter?}',         'Projects\ProjectsController@index')                  ->name('projects.index');
