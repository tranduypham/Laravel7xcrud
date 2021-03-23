<?php

namespace App\Http\Controllers\Liquid;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
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
    }
    public function index(){
        $catagories = DB::table('catagory')->get();
        // Lấy danh sách review
        $reviews = DB::table('review')->take(5)->get();
        if (count($reviews) > 0) {
            foreach ($reviews as $review) {
                $review->avatar = str_replace("public/", "storage/", $review->avatar);
            }
        }
        return view("Liquid.site.about",compact(['catagories','reviews']));
    }
}
