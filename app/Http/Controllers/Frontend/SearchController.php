<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
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
    public function search(Request $request){
        $search = $request->query("search");
        $sort = $request->query("sort","asc");
        $products = [];
        if($search){
            $products = DB::table('products')
                ->where("product_name",'like',"%$search%")
                ->where("product_status","1")
                ->orderBy("product_price",$sort)
                ->paginate(6);
        }
        return view("Frontend.site.search",compact(["products","sort","search"]));
    }
}
