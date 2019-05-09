<?php

Route::get('/stats', 'DashboardController@stats')->name('stats');
Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');
