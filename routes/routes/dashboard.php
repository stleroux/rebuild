<?php

Route::prefix('admin/')->name('admin.')->group(function() {
   Route::get('stats', 'Admin\DashboardController@stats')->name('stats');
   Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');
});
