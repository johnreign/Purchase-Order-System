<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PurchaseOrderController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('list', 'PurchaseOrderController@index');
Route::get('list/create','PurchaseOrderController@create');
Route::post('list','PurchaseOrderController@store');
Route::get('list/{id}','PurchaseOrderController@show');
Route::get('list/edit/{id}','PurchaseOrderController@edit');
Route::patch('list/{id}','PurchaseOrderController@update');
Route::delete('list/{id}','PurchaseOrderController@destroy');


Route::get('items/search', 'ItemsController@search')->name('items.search');
