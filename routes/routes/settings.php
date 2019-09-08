<?php

Route::resource('settings', 'Admin\SettingsController');
// ->except('update');
Route::put('updateAll', 'Admin\SettingsController@updateAll')->name('settings.updateAll');
