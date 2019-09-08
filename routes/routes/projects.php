<?php

Route::post('/projects/{project}/image',              'Admin\Projects\ImageController@store')              ->name('projects.image.store');
Route::delete('/projects/{project}/image',            'Admin\Projects\ImageController@destroy')            ->name('projects.image.delete');

Route::post('/projects/{project}/material',           'Admin\Projects\MaterialController@store')            ->name('projects.material.store');
Route::delete('/projects/{project}/material',         'Admin\Projects\MaterialController@destroy')          ->name('projects.material.delete');

Route::post('/projects/{project}/finish',             'Admin\Projects\FinishController@store')              ->name('projects.finish.store');
Route::delete('/projects/{project}/finish',           'Admin\Projects\FinishController@destroy')            ->name('projects.finish.delete');

Route::post('projects/{project}/comment',             'Admin\Projects\CommentController@store')            ->name('projects.comment.store');


Route::get('projects/{finish}/deleteFinish',          'Admin\Projects\FinishesController@delete')           ->name('finishes.delete');
Route::resource('finishes', 'Admin\Projects\FinishesController');

Route::get('projects/{material}/deleteMaterial',      'Admin\Projects\MaterialsController@delete')          ->name('materials.delete');
Route::resource('materials', 'Admin\Projects\MaterialsController');


Route::get('/projects/create',                        'Admin\Projects\ProjectsController@create')           ->name('projects.create');
Route::get('/projects/list',                          'Admin\Projects\ProjectsController@list')             ->name('projects.list');
Route::post('/projects',                              'Admin\Projects\ProjectsController@store')            ->name('projects.store');
Route::get('/projects/{project}/show',                'Admin\Projects\ProjectsController@show')             ->name('projects.show');
Route::get('/projects/{project}/edit',                'Admin\Projects\ProjectsController@edit')             ->name('projects.edit');
Route::put('/projects/{project}',                     'Admin\Projects\ProjectsController@update')           ->name('projects.update');
Route::delete('/projects/{project}',                  'Admin\Projects\ProjectsController@destroy')          ->name('projects.destroy');
Route::get('/projects/{filter?}',                     'Admin\Projects\ProjectsController@index')            ->name('projects.index');
Route::get('/projects/{project}/delete',              'Admin\Projects\ProjectsController@delete')           ->name('projects.delete');
