<?php

Route::group(['module' => 'Posts', 'middleware' => ['api'], 'namespace' => 'App\Modules\Posts\Controllers'], function() {

    Route::resource('posts', 'PostsController');

});
