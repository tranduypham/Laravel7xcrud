<?php

namespace App\Http\Controllers\Liquid;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
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
        $blogs = DB::table('blog')->paginate(6);
        return view("Liquid.site.blog",compact(['blogs']));
    }
    public function index_tag($tag){
        $blogs = DB::table('blog')->where("slug",'like',"%$tag%")->paginate(6);
        return view("Liquid.site.blog",compact(['blogs']));
    }
    public function index_name($name){
        $blogs = DB::table('blog')->where("name",'like',"%$name%")->paginate(6);
        return view("Liquid.site.blog",compact(['blogs']));
    }
    public function fetch(){
        $blogs = DB::table('blog')->paginate(6);
        return view("Liquid.site.blog-index-body",compact(['blogs']))->render();
    }
    public function show($id){
        $blog = DB::table('blog')->find($id);
        return view("Liquid.site.blog-single",compact(['blog']));
    }
}
