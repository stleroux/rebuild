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

// Route::get('download/{filename}', function($filename)
// {
//     $file = public_path('invoices') . '/' . $filename . '.pdf'; // or wherever you have stored your PDF files
//     return response()->download($file);
// });

Route::prefix('invoicer')->group(function() {

   Route::get('/',                                    'Invoicer\InvoicerController@index')               ->name('invoicer');
   Route::get('dashboard',                            'Invoicer\DashboardController@index')              ->name('invoicer.dashboard');

   Route::get('ledger',                               'Invoicer\LedgerController@index')                 ->name('invoicer.ledger');
   Route::get('ledger/paid',                          'Invoicer\LedgerController@paid')                  ->name('invoicer.ledger.paid');
   Route::get('ledger/invoiced',                      'Invoicer\LedgerController@invoiced')              ->name('invoicer.ledger.invoiced');
   Route::get('ledger/logged',                        'Invoicer\LedgerController@logged')                ->name('invoicer.ledger.logged');

   Route::get('invoices/{inv_id}/downloadInvoice',    'Invoicer\InvoicesController@downloadInvoice')     ->name('invoices.downloadInvoice');
   Route::get('invoices/{inv_id}/status_invoiced',    'Invoicer\InvoicesController@status_invoiced')     ->name('invoices.status_invoiced');
   Route::get('invoices/{inv_id}/status_paid',        'Invoicer\InvoicesController@status_paid')         ->name('invoices.status_paid');
   Route::get('invoices/status_invoiced_all',         'Invoicer\InvoicesController@status_invoiced_all') ->name('invoices.status_invoiced_all');
   Route::get('invoices/status_paid_all',             'Invoicer\InvoicesController@status_paid_all')     ->name('invoices.status_paid_all');
   Route::get('invoices/paid',                        'Invoicer\InvoicesController@paid')                ->name('invoices.paid');
   Route::get('invoices/invoiced',                    'Invoicer\InvoicesController@invoiced')            ->name('invoices.invoiced');
   Route::get('invoices/logged',                      'Invoicer\InvoicesController@logged')              ->name('invoices.logged');

   Route::get('invoices',                             'Invoicer\InvoicesController@index')               ->name('invoicer.invoices');
   Route::get('invoices/create/{id?}',                'Invoicer\InvoicesController@create')              ->name('invoicer.invoices.create');
   Route::post('invoices/store',                      'Invoicer\InvoicesController@store')               ->name('invoicer.invoices.store');
   Route::get('invoices/{id}',                        'Invoicer\InvoicesController@show')                ->name('invoicer.invoices.show');
   Route::get('invoices/{id}/edit',                   'Invoicer\InvoicesController@edit')                ->name('invoicer.invoices.edit');
   Route::put('invoices/{id}',                        'Invoicer\InvoicesController@update')              ->name('invoicer.invoices.update');
   Route::delete('invoices/{id}',                     'Invoicer\InvoicesController@destroy')             ->name('invoicer.invoices.destroy');

   Route::get('clients/search',                       'Invoicer\ClientsController@search')               ->name('invoicer.clients.search');
   Route::get('clients',                              'Invoicer\ClientsController@index')                ->name('invoicer.clients');
   Route::get('clients/create',                       'Invoicer\ClientsController@create')               ->name('invoicer.clients.create');
   Route::post('clients/store',                       'Invoicer\ClientsController@store')                ->name('invoicer.clients.store');
   Route::get('clients/{id}',                         'Invoicer\ClientsController@show')                 ->name('invoicer.clients.show');
   Route::get('clients/{id}/edit',                    'Invoicer\ClientsController@edit')                 ->name('invoicer.clients.edit');
   Route::put('clients/{id}',                         'Invoicer\ClientsController@update')               ->name('invoicer.clients.update');
   Route::delete('clients/{id}',                      'Invoicer\ClientsController@destroy')              ->name('invoicer.clients.destroy');

   Route::get('/invoiceItems/{inv_id}/create',        'Invoicer\InvoiceItemsController@create')          ->name('invoicer.invoiceItems.create');
   Route::resource('/invoiceItems',                   'Invoicer\InvoiceItemsController',                 ['except' => ['create','show']]);

   Route::get('products/search',                      'Invoicer\ProductsController@search')              ->name('invoicer.products.search');
   Route::get('products',                             'Invoicer\ProductsController@index')               ->name('invoicer.products');
   Route::get('products/create',                      'Invoicer\ProductsController@create')              ->name('invoicer.products.create');
   Route::post('products/store',                      'Invoicer\ProductsController@store')               ->name('invoicer.products.store');
   Route::get('products/{id}',                        'Invoicer\ProductsController@show')                ->name('invoicer.products.show');
   Route::get('products/{id}/edit',                   'Invoicer\ProductsController@edit')                ->name('invoicer.products.edit');
   Route::put('products/{id}',                        'Invoicer\ProductsController@update')              ->name('invoicer.products.update');
   Route::delete('products/{id}',                     'Invoicer\ProductsController@destroy')             ->name('invoicer.products.destroy');

});
