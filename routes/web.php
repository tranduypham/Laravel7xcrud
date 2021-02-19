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

Route::get('/', 'Backend\ProductController@index');
Route::get('/backend/product/index', 'Backend\ProductController@index');
Route::get('/backend/product/create', 'Backend\ProductController@create');
Route::get('/backend/product/edit/{id}', 'Backend\ProductController@edit');
Route::get('/backend/product/delete/{id}', 'Backend\ProductController@delete');
Route::get('/backend/product/delete/', 'Backend\ProductController@index');

// Lưu sản phẩm
Route::post('/backend/product/store','Backend\ProductController@store');

// Update sản phẩm
Route::post("/backend/product/update/{id}","Backend\ProductController@update");

//Xóa sản phẩm
Route::post('/backend/product/destroy/{id}',"Backend\ProductController@destroy");

// Catalog
Route::resource('product/catagory',Backend\CatagoryController::class);
Route::get('/backend/product/delete/{id}','Backend\CatagoryController@delete');

// Order
Route::resource('orders','OrderController');
Route::get('/backend/order/{id}/delete',"OrderController@delete");


