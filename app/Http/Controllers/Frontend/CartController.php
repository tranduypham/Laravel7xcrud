<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductModel;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    private $cart;
    private $totalPrice;
    private $totalProduct;
    public function __construct()
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
        // $this->totalProduct = $this->cart->getTotalQuantity();
        // $this->totalPrice = $this->cart->getAttributeTotal("price");
        // $this->totalPrice = number_format($this->totalPrice,2,'.','');
        $this->total();
        view()->share("catagories", $catagories);
        view()->share("totalProduct",$this->totalProduct);
        view()->share("totalPrice",$this->totalPrice);
    }

    public function add($id,Request $request){
        // $this->cart->clear();
        $quantity = $request->query("quantity",1);
        $price = $request->query("price",0);
        $this->cart->add($id,$quantity,[
            "price" => $price
        ]);
        $this->total();
        $msg = [
            "msg" => "Lưu đơn hàng thành công",
            "totalPrice" => $this->totalPrice,
            "totalProduct" => $this->totalProduct
        ];
        return response($msg,200);
    }

    public function total(){
        $this->totalProduct = $this->cart->getTotalQuantity();
        $this->totalPrice = $this->cart->getAttributeTotal("price");
        // $this->totalPrice = number_format($this->totalPrice,2,',','.');
    }

    public function index(){
        // dump($this->cart->getItems());
        $products = [];
        foreach($this->cart->getItems() as $id => $item){
            $products[$id]["quantity"] = $item[0]["quantity"];
            $model = ProductModel::findOrFail($id);
            $products[$id]["name"] = $model->product_name;
            $products[$id]["img"] = str_replace("public/","storage/",$model->product_image) ;
            $products[$id]["price"] = $item[0]["attributes"]["price"];

        }
        // dump($products);
        return view("Frontend.site.shopping-cart",compact(["products"]));
    }

    public function update(Request $request){
        $id = $request->query("id");
        $quantity = (int)$request->query("quantity");
        $price = $request->query("attribute");
        dump($price);
        dump($this->cart->update($id,$quantity,[
            "price" => $price
        ]));
        return response("success",200);
    }

    public function remove(Request $request){
        $id = $request->query("id");
        $price = $request->query("attribute");
        $this->cart->remove($id,[
            "price"=>$price
        ]);
        return response("success",200);
    }

    public function checkout(){
        $products = [];
        foreach($this->cart->getItems() as $id => $item){
            $products[$id]["quantity"] = $item[0]["quantity"];
            $model = ProductModel::findOrFail($id);
            $products[$id]["name"] = $model->product_name;
            $products[$id]["img"] = str_replace("public/","storage/",$model->product_image) ;
            $products[$id]["price"] = $item[0]["attributes"]["price"];

        }
        // dd($products);
        return view("Frontend.site.checkout",compact(['products']));
    }
}
