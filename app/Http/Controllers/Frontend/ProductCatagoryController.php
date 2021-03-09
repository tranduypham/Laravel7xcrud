<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCatagoryController extends Controller
{
    //
    private $cart;
    private $discount = 10;
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
    public function index($id,Request $request){
        $sort = $request->query("sort","asc");
        // $list = $request->query("list","grid");
        $discount = $this->discount + 100;
        $products = DB::table('products')
                ->join("catagory", "products.catagory_id", "=", "catagory.id")
                ->select("products.id as id","product_price","product_image","product_name","catagory_id")
                ->where("catagory_id", $id)
                ->where("product_status",1)
                ->orderBy("product_price",$sort)
                ->paginate(5);
        $products_discount = DB::table('products')
                ->join("catagory", "products.catagory_id", "=", "catagory.id")
                ->select("products.id as id","product_image","product_name","product_price as discount_price")
                ->selectRaw("product_price * $discount /100 as origin_price")
                ->selectRaw("$this->discount as discount")
                ->where("catagory_id", $id)
                ->where("product_status",1)
                ->limit(10)->get();
        // dd($products_discount->count());
        return view("Frontend.site.shop-grid",compact(["products","products_discount","sort","id","discount"]));
    }
}
