<?php

Route::post('/projects/{project}/image',              'Admin\Projects\ImageController@store')              ->name('projects.image.store');
Route::delete('/projects/{project}/image',            'Admin\Projects\ImageController@destroy')            ->name('projects.image.delete');

Route::post('/projects/{project}/material',           'Admin\Projects\MaterialController@store')            ->name('projects.material.store');
Route::delete('/projects/{project}/material',         'Admin\Projects\MaterialController@destroy')          ->name('projects.material.delete');

Route::post('/projects/{project}/finish',             'Admin\Projects\FinishController@store')              ->name('projects.finish.store');
Route::delete('/projects/{project}/finish',           'Admin\Projects\FinishController@destroy')            ->name('projects.finish.delete');

Route::post('projects/{project}/comment',             'Admin\Projects\CommentController@store')            ->name('projects.comment.store');


Route::namespace('Admin\Projects')->prefix('admin/projects/materials')->name('admin.projects.materials.')->group(function() {
   // Route::resource('materials', 'Admin\Projects\MaterialsController');
   Route::get('create',                   'MaterialsController@create')           ->name('create');
   Route::get('index',                    'MaterialsController@index')            ->name('index');
   Route::post('store',                   'MaterialsController@store')            ->name('store');
   Route::get('{project}/show',           'MaterialsController@show')             ->name('show');
   Route::get('{project}/edit',           'MaterialsController@edit')             ->name('edit');
   Route::put('{project}',                'MaterialsController@update')           ->name('update');
   Route::delete('{project}',             'MaterialsController@destroy')          ->name('destroy');
   Route::get('{material}/delete',        'MaterialsController@delete')           ->name('delete');
});

Route::namespace('Admin\Projects')->prefix('admin/projects/finishes')->name('admin.projects.finishes.')->group(function() {
   // Route::resource('finishes', 'FinishesController');
   Route::get('create',                   'FinishesController@create')           ->name('create');
   Route::get('index',                    'FinishesController@index')            ->name('index');
   Route::post('store',                   'FinishesController@store')            ->name('store');
   Route::get('{project}/show',           'FinishesController@show')             ->name('show');
   Route::get('{project}/edit',           'FinishesController@edit')             ->name('edit');
   Route::put('{project}',                'FinishesController@update')           ->name('update');
   Route::delete('{project}',             'FinishesController@destroy')          ->name('destroy');
   Route::get('{finish}/delete',          'FinishesController@delete')           ->name('delete');
});

Route::namespace('Admin\Projects')->prefix('admin/projects')->name('admin.projects.')->group(function() {
   Route::get('create',                   'ProjectsController@create')           ->name('create');
   Route::get('{filter?}',                'ProjectsController@index')            ->name('index');
   Route::post('store',                   'ProjectsController@store')            ->name('store');
   Route::get('{project}/show',           'ProjectsController@show')             ->name('show');
   Route::get('{project}/edit',           'ProjectsController@edit')             ->name('edit');
   Route::put('{project}',                'ProjectsController@update')           ->name('update');
   Route::delete('{project}',             'ProjectsController@destroy')          ->name('destroy');
   Route::get('{project}/delete',         'ProjectsController@delete')           ->name('delete');
});

Route::get('/projects/{project}/show',    'Projects\ProjectsController@show')                   ->name('projects.show');
Route::get('/projects/{filter?}',         'Projects\ProjectsController@index')                  ->name('projects.index');
