<?php

Route::prefix('invoicer')->namespace('Invoicer')->name('invoicer.')->group(function() {

   Route::get('/',                                    'InvoicerController@index')               ->name('index');
   Route::get('dashboard',                            'DashboardController@index')              ->name('dashboard');

   Route::get('ledger',                               'LedgerController@index')                 ->name('ledger');
   Route::get('ledger/paid',                          'LedgerController@paid')                  ->name('ledger.paid');
   Route::get('ledger/invoiced',                      'LedgerController@invoiced')              ->name('ledger.invoiced');
   Route::get('ledger/logged',                        'LedgerController@logged')                ->name('ledger.logged');
});



Route::prefix('invoicer')->namespace('Invoicer')->name('invoices.')->group(function() {
   Route::get('invoices/{inv_id}/downloadInvoice',    'InvoicesController@downloadInvoice')     ->name('downloadInvoice');
   Route::get('invoices/{inv_id}/status_invoiced',    'InvoicesController@status_invoiced')     ->name('status_invoiced');
   Route::get('invoices/{inv_id}/status_paid',        'InvoicesController@status_paid')         ->name('status_paid');
   Route::get('invoices/status_invoiced_all',         'InvoicesController@status_invoiced_all') ->name('status_invoiced_all');
   Route::get('invoices/status_paid_all',             'InvoicesController@status_paid_all')     ->name('status_paid_all');
   Route::get('invoices/paid',                        'InvoicesController@paid')                ->name('paid');
   Route::get('invoices/invoiced',                    'InvoicesController@invoiced')            ->name('invoiced');
   Route::get('invoices/logged',                      'InvoicesController@logged')              ->name('logged');
});

Route::prefix('invoicer')->namespace('Invoicer')->name('invoicer.')->group(function() {
   Route::get('invoices',                             'InvoicesController@index')               ->name('invoices');
   Route::get('invoices/create/{id?}',                'InvoicesController@create')              ->name('invoices.create');
   Route::post('invoices/store',                      'InvoicesController@store')               ->name('invoices.store');
   Route::get('invoices/{id}',                        'InvoicesController@show')                ->name('invoices.show');
   Route::get('invoices/{id}/edit',                   'InvoicesController@edit')                ->name('invoices.edit');
   Route::put('invoices/{id}',                        'InvoicesController@update')              ->name('invoices.update');
   Route::delete('invoices/{id}',                     'InvoicesController@destroy')             ->name('invoices.destroy');
});


Route::prefix('invoicer')->namespace('Invoicer')->name('invoicer.clients.')->group(function() {
   Route::get('clients/search',                       'ClientsController@search')               ->name('search');
   Route::get('clients',                              'ClientsController@index')                ->name('index');
   Route::get('clients/create',                       'ClientsController@create')               ->name('create');
   Route::post('clients/store',                       'ClientsController@store')                ->name('store');
   Route::get('clients/{id}',                         'ClientsController@show')                 ->name('show');
   Route::get('clients/{id}/edit',                    'ClientsController@edit')                 ->name('edit');
   Route::put('clients/{id}',                         'ClientsController@update')               ->name('update');
   Route::delete('clients/{id}',                      'ClientsController@destroy')              ->name('destroy');
});


Route::prefix('invoicer')->namespace('Invoicer')->name('invoicer.')->group(function() {
   Route::get('/invoiceItems/{inv_id}/create',        'InvoiceItemsController@create')          ->name('invoiceItems.create');
   Route::resource('/invoiceItems',                   'InvoiceItemsController',                 ['except' => ['create','show']]);

   Route::get('products/search',                      'ProductsController@search')              ->name('products.search');
   Route::get('products',                             'ProductsController@index')               ->name('products');
   Route::get('products/create',                      'ProductsController@create')              ->name('products.create');
   Route::post('products/store',                      'ProductsController@store')               ->name('products.store');
   Route::get('products/{id}',                        'ProductsController@show')                ->name('products.show');
   Route::get('products/{id}/edit',                   'ProductsController@edit')                ->name('products.edit');
   Route::put('products/{id}',                        'ProductsController@update')              ->name('products.update');
   Route::delete('products/{id}',                     'ProductsController@destroy')             ->name('products.destroy');

});
