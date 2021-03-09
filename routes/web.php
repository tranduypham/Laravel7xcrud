<?php

use Illuminate\Support\Facades\Route;
use App\Models\Backend\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

Route::get('/backend', 'Backend\ProductController@index');
Route::get('/backend/product/index', 'Backend\ProductController@index');
Route::get('/backend/product/create', 'Backend\ProductController@create');
Route::get('/backend/product/edit/{id}', 'Backend\ProductController@edit');
Route::get('/backend/product/delete/{id}', 'Backend\ProductController@delete');
Route::get('/backend/product/delete/', 'Backend\ProductController@index');

// Lưu sản phẩm
Route::post('/backend/product/store', 'Backend\ProductController@store');

// Update sản phẩm
Route::post("/backend/product/update/{id}", "Backend\ProductController@update");

//Xóa sản phẩm
Route::post('/backend/product/destroy/{id}', "Backend\ProductController@destroy");

// Catalog
Route::resource('product/catagory', Backend\CatagoryController::class);
Route::get('/backend/product/delete/{id}', 'Backend\CatagoryController@delete');

// Order
Route::resource('orders', 'Backend\OrderController');
Route::get('/backend/order/{id}/delete', "Backend\OrderController@delete");
Route::post('/backend/order/api/getProducts', function (Request $request) {
    $input = $request->input('product_name', "");
    $output = DB::table('products')->where("product_name", 'like', "%$input%")->get();
    return response()->json($output, 200);
})->name("apiGetProducts");
Route::post('/backend/order/api/getProducts/{id}', function ($id) {
    $result = ProductModel::findOrFail($id);
    return response()->json($result, 200);
})->name("getProduct");
Route::post('/backend/order/api/getProductsQuantity/{id}', function ($id) {
    $result = ProductModel::findOrFail($id);
    return response()->json($result->product_quantity, 200);
})->name("getProductQuantity");

//setting
Route::get('/backend/setting',"Backend\SettingController@edit")->name("setting");
Route::post('/backend/setting',"Backend\SettingController@update")->name("setting.update");

//Admin
Route::resource('admin', Backend\AdminController::class);
Route::get('admin/{id}/delete',"Backend\AdminController@delete")->name("admin.delete");

//Login-logout
// Cách sử dụng cookie
// https://stackoverflow.com/questions/53737346/how-to-create-and-destroy-cookie-in-laravel-5-7
Route::get('backend/admin-login',"Backend\AdminLoginController@login")->name("admin.login");
Route::post('backend/admin-login',"Backend\AdminLoginController@auth")->name("admin.auth");
Route::get('backend/admin-logout',"Backend\AdminLoginController@logout")->name("admin.logout");
// ->middleware("backend_authenticate")

// Dashboard Thống kê
Route::get('dashboard',"Backend\DashboardController@index")->name("Dashboard");


// Homepage
Route::get("/","Frontend\HomepageController@index")->name("homepage");
Route::get("/homepage/{id}/catagory","Frontend\ProductCatagoryController@index")->name("ProductCata");
Route::get("/homepage/search","Frontend\SearchController@search")->name("search");
Route::get("/homepage/{id}/product","Frontend\ProductController@index")->name("product");
Route::get("/homepage/{id}/addCart","Frontend\CartController@add")->name("addToCart");
Route::get("/homepage/Cart","Frontend\CartController@index")->name("indexCart");
Route::get("/homepage/Cart/Update","Frontend\CartController@update")->name("updateCart");
Route::get("/homepage/Cart/Remove","Frontend\CartController@remove")->name("removeItem");
Route::get("/homepage/Cart/Clear","Frontend\CartController@clear")->name("clearCart");
Route::get("/homepage/Checkout","Frontend\CartController@checkout")->name("Checkout")->middleware("CheckOutIndex");
Route::post("/homepage/Payment","Frontend\PaymentController@pay")->name("Payment")->middleware("CheckOutIndex");
