<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductModel as BackendProductModel;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    private $cart;
    public function __construct()
    {
        $this->share();
    }
    public function share()
    {
        $this->cart = new CartModel([
            // Can add unlimited number of item to cart
            'cartMaxItem'      => 0,

            // Set maximum quantity allowed per item to 99
            'itemMaxQuantity'  => 10,

            // Do not use cookie, cart data will lost when browser is closed
            'useCookie'        => false,
        ]);
        $catagories = DB::table('catagory')->get();
        $totalProduct = $this->cart->getTotalQuantity();
        $totalPrice = $this->cart->getAttributeTotal("price");
        view()->share("catagories", $catagories);
        view()->share("totalProduct",$totalProduct);
        view()->share("totalPrice",$totalPrice);
    }
    public function index(Request $request,$id){
        $discount = (int)$request->query("discount",0);
        // dump($request->query("discount",0));
        $product = BackendProductModel::findOrFail($id);

        return view("Frontend.site.shop-detail",compact(["discount","product"]));
    }
}
