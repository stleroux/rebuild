<?php

Route::group(['module' => 'Posts', 'middleware' => ['web'], 'namespace' => 'App\Modules\Posts\Controllers'], function() {

    Route::resource('posts', 'PostsController');

});
