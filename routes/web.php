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

Auth::routes();

Route::get('/', 'ProductController@index')->name('home');

Route::get('coffee/{name}/{id}', 'ProductController@show')->name('product.show');

// Favorite or unfavorite a product
Route::get('favorite/{id}', 'ProductController@favorite')->name('product.favorite')->middleware('auth');
Route::get('unfavorite/{id}', 'ProductController@unfavorite')->name('product.unfavorite')->middleware('auth');
// Order a product
Route::post('product/order', 'OrderController@order')->name('product.order');
// Cancel the order
Route::get('product/order/cancel/{id}', 'OrderController@cancel')->name('product.order.cancel');

// Admin Routes
// Product Management
Route::get('admin/products/create', 'Admin\ProductController@create')->name('admin.products.create')->middleware('admin');
Route::post('admin/products/create', 'Admin\ProductController@store')->name('admin.products.store')->middleware('admin');
// View all the orders
Route::get('admin/orders', 'OrderController@index')->name('admin.orders')->middleware('admin');
// Change the order status
Route::get('admin/order/{id}/status', 'OrderController@changeStatus')->name('admin.order.status')->middleware('admin');
