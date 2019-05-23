<?php

Route::resource('settings', 'SettingsController');
// ->except('update');
Route::put('updateAll', 'SettingsController@updateAll')->name('settings.updateAll');
