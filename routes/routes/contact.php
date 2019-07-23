<?php

Route::get('contact', 'ContactFormController@create')->name('contact');
Route::post('contact', 'ContactFormController@store');
