<?php

Route::group(['module' => 'Invoicer', 'middleware' => ['api'], 'namespace' => 'App\Modules\Invoicer\Controllers'], function() {

    Route::resource('Invoicer', 'InvoicerController');

});
