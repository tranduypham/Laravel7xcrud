<?php

use Illuminate\Support\Facades\Route;
use App\Models\Backend\ProductModel;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
Route::get('/backend/setting', "Backend\SettingController@edit")->name("setting");
Route::post('/backend/setting', "Backend\SettingController@update")->name("setting.update");

//Admin
Route::resource('admin', Backend\AdminController::class);
Route::get('admin/{id}/delete', "Backend\AdminController@delete")->name("admin.delete");

//Login-logout
// Cách sử dụng cookie
// https://stackoverflow.com/questions/53737346/how-to-create-and-destroy-cookie-in-laravel-5-7
Route::get('backend/admin-login', "Backend\AdminLoginController@login")->name("admin.login");
Route::post('backend/admin-login', "Backend\AdminLoginController@auth")->name("admin.auth");
Route::get('backend/admin-logout', "Backend\AdminLoginController@logout")->name("admin.logout");
// ->middleware("backend_authenticate")

// Dashboard Thống kê
Route::get('dashboard', "Backend\DashboardController@index")->name("Dashboard");


// Homepage
Route::get("/", "Frontend\HomepageController@index")->name("homepage");
Route::get("/homepage/{id}/catagory", "Frontend\ProductCatagoryController@index")->name("ProductCata");
Route::get("/homepage/search", "Frontend\SearchController@search")->name("search");
Route::get("/homepage/{id}/product", "Frontend\ProductController@index")->name("product");
Route::get("/homepage/{id}/addCart", "Frontend\CartController@add")->name("addToCart");
Route::get("/homepage/Cart", "Frontend\CartController@index")->name("indexCart");
Route::get("/homepage/Cart/Update", "Frontend\CartController@update")->name("updateCart");
Route::get("/homepage/Cart/Remove", "Frontend\CartController@remove")->name("removeItem");
Route::get("/homepage/Cart/Clear", "Frontend\CartController@clear")->name("clearCart");
Route::get("/homepage/Checkout", "Frontend\CartController@checkout")->name("Checkout")->middleware("CheckOutIndex");
Route::post("/homepage/Payment", "Frontend\PaymentController@pay")->name("Payment")->middleware("CheckOutIndex");

// Upload và quản lý ảnh
// https://www.youtube.com/watch?v=iQZNabepPkQ
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'backend_authenticate']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


//Liquid backend
Route::get('/backend/liquid/reply', "Backend\ReplyController@index")->name("Liquid.reply.index");
Route::get('/backend/liquid/reply/rep', "Backend\ReplyController@reply")->name("Liquid.reply");
Route::get('/backend/liquid/reply/show/{id}', "Backend\ReplyController@show")->name("Liquid.reply.show");
Route::resource('/backend/Review', "Backend\ReviewController");
Route::get('/backend/Review/delete/{id}', "Backend\ReviewController@delete")->name("Review.delete");

Route::get('/backend/blog', "Backend\BlogController@index")->name("blog.index");
Route::post('backend/blog/store', "Backend\BlogController@store")->name("blog.store");
Route::get('backend/blog/create', "Backend\BlogController@create")->name("blog.create");
Route::get('backend/blog/show/{id}', "Backend\BlogController@show")->name("blog.show");
Route::get('backend/blog/edit/{id}', "Backend\BlogController@edit")->name("blog.edit");
Route::get('backend/blog/delete/{id}', "Backend\BlogController@delete")->name("blog.delete");
Route::get('backend/blog/destroy/{id}', "Backend\BlogController@destroy")->name("blog.destroy");
Route::post('backend/blog/update/{id}', "Backend\BlogController@update")->name("blog.update");

//Liquid
Route::get('liquid/contact', "Liquid\ContactController@contact")->name("Liquid.contact");
Route::post('liquid/contact', "Liquid\ContactController@storeContact")->name("Liquid.contact.post");
Route::get('liquid/products', "Liquid\ProductsController@index")->name("Liquid.product.index");
Route::get('liquid/products/{catagory}', "Liquid\ProductsController@index_catagory")->name("Liquid.product.index.catagory");
Route::get('liquid/products/catagory',"Liquid\ProductsController@index_catagory_multi")->name("Liquid.product.index.catagory.multi");
Route::post('liquid/products/fetch', "Liquid\ProductsController@fetch")->name("Liquid.product.index.ajax");
Route::get('liquid/products/{id}/detail', "Liquid\ProductsController@show")->name("Liquid.product.show");

Route::get("liquid/cart/index", "Liquid\CartController@index")->name("Liquid.cart.index");
Route::get("liquid/cart/list", "Liquid\CartController@list")->name("Liquid.cart.list");
Route::get("liquid/cart/add_item", "Liquid\CartController@add_item")->name("Liquid.cart.add");
Route::get("liquid/cart/update_item", "Liquid\CartController@update_item")->name("Liquid.cart.update");
Route::get("liquid/cart/remove_item", "Liquid\CartController@remove_item")->name("Liquid.cart.remove");
Route::get("liquid/cart/bill", "Liquid\CartController@totalPrice")->name("Liquid.cart.bill");
Route::get("liquid/buynow/{id}", "Liquid\CartController@buynow")->name("Liquid.buy.now");

Route::get("liquid/checkout/array", function (Request $request) {
    session(["array" => $request->input("array")]);
    // dd(CartModel::$array);
    return response(session("array"), 200);
})->name("Liquid.array");

Route::get("liquid/checkout", "Liquid\CheckoutController@index")->name("Liquid.checkout");
Route::post("liquid/checkout", "Liquid\CheckoutController@store")->name("Liquid.checkout.store");

Route::get("liquid", "Liquid\HomepageController@index")->name("Liquid.home");
Route::get("liquid/about", "Liquid\AboutController@index")->name("Liquid.about");

Route::get("liquid/blog","Liquid\BlogController@index")->name("Liquid.blog");
Route::get("liquid/blog/page","Liquid\BlogController@fetch")->name("Liquid.blog.ajax");
Route::get("liquid/blog/{id}","Liquid\BlogController@show")->name("Liquid.blog.single");
Route::get("liquid/blog/tag/{tag}","Liquid\BlogController@index_tag")->name("Liquid.blog.tag");
Route::get("liquid/blog/name/{name}","Liquid\BlogController@index_name")->name("Liquid.blog.name");

Route::get("destroy", function () {
    $cart = new CartModel();
    $cart->destroy();
    return redirect(route("Liquid.home"));
});
