<?php

use Illuminate\Support\Facades\Route;

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
    $vista="home";
    return view('home.index')->with("vista",$vista);
});

Route::get('orders/mensaje', 'App\Http\Controllers\OrdersController@mensaje');
Route::get('orders/', 'App\Http\Controllers\OrdersController@index');
Route::match(['get', 'post'], 'orders/store','App\Http\Controllers\OrdersController@store');
Route::get('orders/show/{id}','App\Http\Controllers\OrdersController@show');
Route::match(['get', 'post'], 'orders/thankey/{id}','App\Http\Controllers\OrdersController@thankey');
Route::match(['get', 'post'], 'orders/getSession/{id}','App\Http\Controllers\OrdersController@getSession');
Route::match(['get', 'post'],'orders/list','App\Http\Controllers\OrdersController@listOrders');
Route::match(['get', 'post'], 'articles/autocomplete','App\Http\Controllers\ArticlesController@autocomplete');
