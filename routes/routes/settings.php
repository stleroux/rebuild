<?php

Route::resource('settings', 'SettingsController')->except('update');
Route::put('update', 'SettingsController@update')->name('settings.update');
