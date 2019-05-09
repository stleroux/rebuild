<?php
use Illuminate\Support\Facades\Input;
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


Route::get('tests/{test}/delete', 'TestsController@delete')->name('tests.delete');
Route::resource('tests', 'TestsController');
