<?php

Route::get('contact', 'ContactFormController@create');
Route::post('contact', 'ContactFormController@store');
