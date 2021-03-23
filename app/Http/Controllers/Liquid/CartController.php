<?php

namespace App\Http\Controllers\Liquid;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductModel;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;


class CartController extends Controller
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
        // view()->share('totalPrice', $totalPrice);
    }
    public function index()
    {
        // dump("hellp");
        $subTotal = 0;
        $discount = 0;
        $cart = [];
        // dump("hellp");
        $allItems = $this->cart->getItems();
        // dump($allItems);
        foreach($allItems as $items){
            foreach($items as $item){
                $id = (int)$item["id"];
                if($id>0){
                    $product = ProductModel::findOrFail($id);
                    $cart[$product->id]["image"] = str_replace("public/","storage/",$product->product_image);
                    $cart[$product->id]["name"] = $product->product_name;
                    $cart[$product->id]["stock"] = $product->product_quantity;
                    $cart[$product->id]["single_price"] = $product->product_price;
                    $cart[$product->id]["total_price"] = (int)$product->product_price*(int)$item["quantity"];
                    $subTotal += $cart[$product->id]["total_price"];
                    $discount += (int)$product->product_price*(int)$item["quantity"]*(int)$product->sale/100;
                    $cart[$product->id]["quantity"] = (int)$item["quantity"];
                }else{
                    continue;
                }
            }
            // dump($cart);
        }
        // dump($cart);
        // dump($subTotal,$discount,$cart);
        return view("Liquid.site.cart",compact(["subTotal","discount","cart"]));
    }
    public function list()
    {
        $cart = [];
        $allItems = $this->cart->getItems();
        $i = 0;
        foreach ($allItems as $items) {
            foreach ($items as $item) {
                $id = (int)$item["id"];
                // dump($id);
                if ($id > 0) {
                    $product = ProductModel::findOrFail($id);
                    $cart[$i]["image"] = str_replace("public/", "storage/", $product->product_image);
                    $cart[$i]["name"] = $product->product_name;
                    $cart[$i]["price"] = $product->product_price;
                    $cart[$i]["quantity"] = sprintf("%02s",$item["quantity"]);//Format the output number
                    // https://en.wikipedia.org/wiki/Printf_format_string
                }
            }
            $i += 1;
            if ($i >= 3) {
                break;
            }
        }
        // dd($cart);
        return view("Liquid.partials.drop-down", compact("cart"))->render();
    }

    public function add_item(Request $request)
    {
        $bool = $this->cart->add($request->input("id"), $request->input("quantity"));
        if ($bool) {
            return response($this->total_item(), 200);
        } else {
            return response(0, 400);
        }
    }

    public function total_item()
    {
        return $this->cart->getTotalItem();
    }

    public function totalPrice(){
        $array = [];
        if(session()->has("array")){
            $array = session("array", []);
        }
        // return response($array,200);
        $subTotal = 0;
        $discount = 0;
        $allItems = $this->cart->getItems();
        if($allItems){
            foreach($allItems as $items){
                foreach($items as $item){
                    $id = $item["id"];
                    if($id>0&&in_array($id,$array)){
                        $product = ProductModel::findOrFail($id);
                        $subTotal += (int)$product->product_price*(int)$item["quantity"];
                        $discount += (int)$product->product_price*(int)$item["quantity"]*(int)$product->sale/100;
                    }
                }
            }
        }
        return ["subTotal"=>$subTotal,"discount"=>$discount];
    }

    public function update_item(Request $request)
    {
        $this->cart->update($request->input("id"),$request->input("quantity"));

        $subTotal = 0;
        $discount = 0;
        $cart = [];
        $allItems = $this->cart->getItems();
        foreach($allItems as $items){
            foreach($items as $item){
                $id = $item["id"];
                if($id>0){
                    $product = ProductModel::findOrFail($id);
                    $cart[$product->id]["image"] = str_replace("public/","storage/",$product->product_image);
                    $cart[$product->id]["name"] = $product->product_name;
                    $cart[$product->id]["stock"] = $product->product_quantity;
                    $cart[$product->id]["single_price"] = $product->product_price;
                    $cart[$product->id]["total_price"] = (int)$product->product_price*(int)$item["quantity"];
                    $subTotal += $cart[$product->id]["total_price"];
                    $discount += (int)$product->product_price*(int)$item["quantity"]*(int)$product->sale/100;
                    $cart[$product->id]["quantity"] = (int)$item["quantity"];
                }
            }
        }
        return view("Liquid.site.cart-table",compact(["subTotal","discount","cart"]))->render();
        // return response($this->cart->getItems(),200);
    }

    public function remove_item(Request $request)
    {
        $this->cart->remove($request->input("id"));
        return response("Success",200);
    }

    public function clear_cart()
    {
    }

    public function buynow($id){
        $buynow = (int)$id;
        $this->cart->add($id,1);
        $subTotal = 0;
        $discount = 0;
        $cart = [];
        $allItems = $this->cart->getItems();
        foreach($allItems as $items){
            foreach($items as $item){
                $id = $item["id"];
                if($id>0){
                    $product = ProductModel::findOrFail($id);
                    $cart[$product->id]["image"] = str_replace("public/","storage/",$product->product_image);
                    $cart[$product->id]["name"] = $product->product_name;
                    $cart[$product->id]["stock"] = $product->product_quantity;
                    $cart[$product->id]["single_price"] = $product->product_price;
                    $cart[$product->id]["total_price"] = (int)$product->product_price*(int)$item["quantity"];
                    $subTotal += $cart[$product->id]["total_price"];
                    $discount += (int)$product->product_price*(int)$item["quantity"]*(int)$product->sale/100;
                    $cart[$product->id]["quantity"] = (int)$item["quantity"];
                }
            }
        }
        return view("Liquid.site.cart",compact(["subTotal","discount","cart","buynow"]));
    }
}
