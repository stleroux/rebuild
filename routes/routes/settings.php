<?php
Route::prefix('admin/')->name('admin.')->group(function() {
   Route::resource('settings', 'Admin\SettingsController');
   // ->except('update');
   Route::put('updateAll', 'Admin\SettingsController@updateAll')->name('settings.updateAll');
});
