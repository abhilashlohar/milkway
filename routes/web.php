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
Route::post('/sales_vouchers/filter', 'SalesVoucherController@filter')->name('sales_vouchers.filter');

Route::resource('users','UserController');
Route::resource('customers','CustomerController');
Route::resource('products','ProductController');
Route::resource('sales_vouchers','SalesVoucherController');