<?php

namespace App\Http\Controllers\Liquid;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
{
    //
    private $cart;

    public function __construct()
    {
        $this->cart = new CartModel([
            // Can add unlimited number of item to cart
            'cartMaxItem'      => 0,

            // Set maximum quantity allowed per item to 99
            'itemMaxQuantity'  => 99,

            // Do not use cookie, cart data will lost when browser is closed
            'useCookie'        => false,
        ]);
        $totalItem = $this->cart->getTotalItem();
        view()->share('totalItem', $totalItem);

        // Lấy danh sách bán chạy
        $bestSellers = DB::table('orderdetail')->groupBy("product_id")->selectRaw("sum(quantity) as sum,product_id")->orderBy("sum", "desc")->take(3)->get();
        $best = [];
        foreach ($bestSellers as $bestSeller) {
            $best[] = $bestSeller->product_id;
        }
        // Lấy danh sách hàng mới về
        $newArriveds = DB::table('products')->orderBy("created_at", "asc")->take(2)->get();
        $new = [];
        foreach ($newArriveds as $newArrived) {
            $new[] = $newArrived->id;
        }
        view()->share('bestSeller', $best);
        view()->share('newArrived', $new);
    }
    public function index()
    {
        $catagories = DB::table('catagory')->get();
        $products = DB::table('products')->join("catagory", "products.catagory_id", "catagory.id")
            ->select("products.id as id", "catagory_name", "product_image", "product_price", "sale", "product_name")
            ->take(8)->get();
        // Lấy danh sách review
        $reviews = DB::table('review')->take(5)->get();
        if (count($reviews) > 0) {
            foreach ($reviews as $review) {
                $review->avatar = str_replace("public/", "storage/", $review->avatar);
            }
        }
        return view("Liquid.site.homepage", compact(['catagories', 'products','reviews']));
    }
}
