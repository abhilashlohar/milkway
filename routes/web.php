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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/report-filter', 'SalesVoucherController@reportFilter')->name('sales_vouchers.report_filter');
Route::get('/report', 'SalesVoucherController@report')->name('sales_vouchers.report');
Route::post('month_detail', 'SalesVoucherController@month_detail')->name('sales_vouchers.month_detail');

Route::resource('users','UserController');
Route::resource('customers','CustomerController');
Route::resource('products','ProductController');
Route::resource('sales_vouchers','SalesVoucherController');
Route::resource('payment_vouchers','PaymentVoucherController');