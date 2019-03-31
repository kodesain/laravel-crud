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

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::resource('categories', 'CategoriesController');
Route::resource('products', 'ProductsController');
Route::resource('payments', 'PaymentsController');
Route::resource('shipping', 'ShippingController');

Route::post('payments/show/{id}', 'PaymentsController@show')->name('payments.show');
Route::post('payments/show', 'PaymentsController@show')->name('payments.show');
Route::post('payments/save/{id}', 'PaymentsController@save')->name('payments.save');
Route::post('payments/save/', 'PaymentsController@save')->name('payments.save');
Route::post('payments/drop/{id}', 'PaymentsController@drop')->name('payments.drop');
Route::post('payments/drop', 'PaymentsController@drop')->name('payments.drop');

Route::post('shipping/show/{id}', 'ShippingController@show')->name('shipping.show');
Route::post('shipping/show', 'ShippingController@show')->name('shipping.show');
Route::post('shipping/save/{id}', 'ShippingController@save')->name('shipping.save');
Route::post('shipping/save/', 'ShippingController@save')->name('shipping.save');
Route::post('shipping/drop/{id}', 'ShippingController@drop')->name('shipping.drop');
Route::post('shipping/drop', 'ShippingController@drop')->name('shipping.drop');