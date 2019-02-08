<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('invoicer')->group(function() {

   Route::get('/',                                    'InvoicerController@index')               ->name('invoicer');
   Route::get('dashboard',                            'DashboardController@index')              ->name('invoicer.dashboard');

   Route::get('ledger',                               'LedgerController@index')                 ->name('invoicer.ledger');
   Route::get('ledger/paid',                          'LedgerController@paid')                  ->name('invoicer.ledger.paid');
   Route::get('ledger/invoiced',                      'LedgerController@invoiced')              ->name('invoicer.ledger.invoiced');
   Route::get('ledger/logged',                        'LedgerController@logged')                ->name('invoicer.ledger.logged');

   Route::get('invoices/{inv_id}/status_invoiced',    'InvoicesController@status_invoiced')     ->name('invoices.status_invoiced');
   Route::get('invoices/{inv_id}/status_paid',        'InvoicesController@status_paid')         ->name('invoices.status_paid');
   Route::get('invoices/status_invoiced_all',         'InvoicesController@status_invoiced_all') ->name('invoices.status_invoiced_all');
   Route::get('invoices/status_paid_all',             'InvoicesController@status_paid_all')     ->name('invoices.status_paid_all');
   Route::get('invoices/paid',                        'InvoicesController@paid')                ->name('invoices.paid');
   Route::get('invoices/invoiced',                    'InvoicesController@invoiced')            ->name('invoices.invoiced');
   Route::get('invoices/logged',                      'InvoicesController@logged')              ->name('invoices.logged');

   Route::get('invoices',                             'InvoicesController@index')               ->name('invoicer.invoices');
   Route::get('invoices/create',                      'InvoicesController@create')              ->name('invoicer.invoices.create');
   Route::post('invoices/store',                      'InvoicesController@store')               ->name('invoicer.invoices.store');
   Route::get('invoices/{id}',                        'InvoicesController@show')                ->name('invoicer.invoices.show');
   Route::get('invoices/{id}/edit',                   'InvoicesController@edit')                ->name('invoicer.invoices.edit');
   Route::put('invoices/{id}',                        'InvoicesController@update')              ->name('invoicer.invoices.update');
   Route::delete('invoices/{id}',                     'InvoicesController@destroy')             ->name('invoicer.invoices.destroy');

   Route::get('clients/search',                       'ClientsController@search')               ->name('invoicer.clients.search');
   Route::get('clients',                              'ClientsController@index')                ->name('invoicer.clients');
   Route::get('clients/create',                       'ClientsController@create')               ->name('invoicer.clients.create');
   Route::post('clients/store',                       'ClientsController@store')                ->name('invoicer.clients.store');
   Route::get('clients/{id}',                         'ClientsController@show')                 ->name('invoicer.clients.show');
   Route::get('clients/{id}/edit',                    'ClientsController@edit')                 ->name('invoicer.clients.edit');
   Route::put('clients/{id}',                         'ClientsController@update')               ->name('invoicer.clients.update');
   Route::delete('clients/{id}',                      'ClientsController@destroy')              ->name('invoicer.clients.destroy');

   Route::get('/invoiceItems/{inv_id}/create',        'InvoiceItemsController@create')          ->name('invoicer.invoiceItems.create');
   Route::resource('/invoiceItems',                   'InvoiceItemsController',                 ['except' => ['create','show']]);

   Route::get('products/search',                      'ProductsController@search')              ->name('invoicer.products.search');
   Route::get('products',                             'ProductsController@index')               ->name('invoicer.products');
   Route::get('products/create',                      'ProductsController@create')              ->name('invoicer.products.create');
   Route::post('products/store',                      'ProductsController@store')               ->name('invoicer.products.store');
   Route::get('products/{id}',                        'ProductsController@show')                ->name('invoicer.products.show');
   Route::get('products/{id}/edit',                   'ProductsController@edit')                ->name('invoicer.products.edit');
   Route::put('products/{id}',                        'ProductsController@update')              ->name('invoicer.products.update');
   Route::delete('products/{id}',                     'ProductsController@destroy')             ->name('invoicer.products.destroy');

});
