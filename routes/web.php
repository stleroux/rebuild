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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

Route::get('/', 'SiteController@homepage')->name('home');
Route::get('/contact', 'SiteController@contact')->name('contact');
Route::get('/about', 'SiteController@about')->name('about');
Route::get('/terms', 'SiteController@terms')->name('terms');
Route::get('/privacy', 'SiteController@privacy')->name('privacy');
Route::get('/test', 'SiteController@test')->name('test');
Route::get('/stats', 'SiteController@stats')->name('stats');
Route::get('/dashboard', 'SiteController@dashboard')->name('dashboard');

// Route::get('/blog', 'SiteController@blog')->name('blog');

Route::get('comments/{comment}/delete', 'CommentsController@delete')->name('comments.delete');
Route::resource('comments', 'CommentsController');

Route::get('permissions/{permission}/delete', 'PermissionsController@delete')->name('permissions.delete');
Route::resource('permissions', 'PermissionsController');

Route::get('users/{user}/delete', 'UsersController@delete')->name('users.delete');

// Allo admin to change user password
Route::get('users/{user}/changeUserPWD', 'UsersController@changeUserPWD')->name('users.changeUserPWD');
Route::post('users/{user}/changeUserPWDPost', 'UsersController@changeUserPWDPost')->name('users.changeUserPWDPost');
Route::resource('users', 'UsersController');

Route::get('components/{module}/disableModule', 'ComponentsController@disableModule')->name('components.disableModule');
Route::get('components/{module}/enableModule', 'ComponentsController@enableModule')->name('components.enableModule');
Route::get('components/{module}/deleteModule', 'ComponentsController@deleteModule')->name('components.deleteModule');
Route::post('components/{module}/deleteModulePost', 'ComponentsController@deleteModulePost')->name('components.deleteModulePost');
Route::resource('components', 'ComponentsController');

Route::get('modules/{module}/delete', 'ModulesController@delete')->name('modules.delete');
Route::resource('modules', 'ModulesController');

Route::get('categories/{cat}/delete', 'CategoriesController@delete')->name('categories.delete');
Route::resource('categories', 'CategoriesController');

Route::resource('settings', 'SettingsController');
Route::get('settingsPlus', 'SettingsController@settingsPlus')->name('settings.plus');
Route::put('updatePlus', 'SettingsController@updatePlus')->name('settings.updatePlus');

// PROFILE
Route::get('profile/{id}/edit',          ['uses'=>'ProfileController@edit',      'as'=>'profile.edit']);
Route::put('profile/{id}',               ['uses'=>'ProfileController@update',    'as'=>'profile.update']);
Route::get('profile/{id}/resetPwd',      ['uses'=>'ProfileController@resetPwd',      'as'=>'profile.resetPwd']);
Route::post('profile/{id}/resetPwdPost', ['uses'=>'ProfileController@resetPwdPost',  'as'=>'profile.resetPwdPost']);
Route::get('profile/{id}/resetPreferences',  ['uses'=>'ProfileController@resetPreferences',  'as'=>'profile.resetPreferences']);
Route::get('profile/deleteImage/{id}',    ['uses'=>'ProfileController@deleteImage',    'as'=>'profile.deleteImage']);
Route::get('profile/{id}/show',               ['uses'=>'ProfileController@show',          'as'=>'profile.show']);







