<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
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

    public function index()
    {
        // $products = DB::table('products')->limit(10)->get();
        $catagories = DB::table('catagory')->get();
        $products = [];
        foreach ($catagories as $catagory) {
            $dis_product = DB::table('products')
                ->join("catagory", "products.catagory_id", "=", "catagory.id")
                ->select("products.id as id","catagory.id as catagory_id","catagory_slug","catagory_name","product_price","product_image","product_name")
                ->where("catagory_id", $catagory->id)
                ->where("product_status",1)
                ->limit(5)->get()->toArray();
            array_push($products, $dis_product);
        }
        // dd($products);
        // die;
        return view("Frontend.site.homepage", compact("products"));
    }
}
