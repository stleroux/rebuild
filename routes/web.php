<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'SiteController@homepage')->name('home');
Route::get('/about', 'SiteController@about')->name('about');
Route::get('/terms', 'SiteController@terms')->name('terms');
Route::get('/privacy', 'SiteController@privacy')->name('privacy');

Route::view('/help', 'help.index');

foreach (File::allFiles(__DIR__ . '/routes') as $route_file) {
  require $route_file->getPathname();
}

// Route::get('modules/{module}/disableModule', 'ModulesController@disableModule')->name('modules.disableModule');
// Route::get('modules/{module}/enableModule', 'ModulesController@enableModule')->name('modules.enableModule');
// Route::get('modules/{module}/deleteModule', 'ModulesController@deleteModule')->name('modules.deleteModule');
// Route::post('modules/{module}/deleteModulePost', 'ModulesController@deleteModulePost')->name('modules.deleteModulePost');
// Route::get('modules/{module}/delete', 'ModulesController@delete')->name('modules.delete');
// Route::resource('modules', 'ModulesController');

Route::post('projects/{project}/addFinish', 'Projects\ProjectsController@addFinish')->name('projects.addFinish');
Route::post('projects/{project}/addImage', 'Projects\ProjectsController@addImage')->name('projects.addImage');
Route::post('projects/{project}/addMaterial', 'Projects\ProjectsController@addMaterial')->name('projects.addMaterial');
Route::delete('projects/{finish}/removeFinish', 'Projects\ProjectsController@removeFinish')->name('projects.removeFinish');
Route::delete('projects/{image}/removeImage', 'Projects\ProjectsController@removeImage')->name('projects.removeImage');
Route::delete('projects/{material}/removeMaterial', 'Projects\ProjectsController@removeMaterial')->name('projects.removeMaterial');
Route::get('projects/list', 'Projects\ProjectsController@list')->name('projects.list'); // Backend view

Route::get('projects/{finish}/deleteFinish', 'Projects\FinishesController@delete')->name('finishes.delete');
Route::resource('finishes', 'Projects\FinishesController');

Route::get('projects/{material}/deleteMaterial', 'Projects\MaterialsController@delete')->name('materials.delete');
Route::resource('materials', 'Projects\MaterialsController');



Route::get('/projects/{project}/delete',  'Projects\ProjectsController@delete')     ->name('projects.delete');
Route::get('/projects/create',            'Projects\ProjectsController@create')     ->name('projects.create');
Route::get('/projects/list',              'Projects\ProjectsController@list')       ->name('projects.list');
Route::post('/projects',                  'Projects\ProjectsController@store')      ->name('projects.store');
Route::get('/projects/{project}/show',    'Projects\ProjectsController@show')       ->name('projects.show');
Route::get('/projects/{project}/edit',    'Projects\ProjectsController@edit')       ->name('projects.edit');
Route::put('/projects/{project}',         'Projects\ProjectsController@update')     ->name('projects.update');
Route::delete('/projects/{project}',      'Projects\ProjectsController@destroy')    ->name('projects.delete');
Route::get('/projects/{filter?}',         'Projects\ProjectsController@index')      ->name('projects.index');
