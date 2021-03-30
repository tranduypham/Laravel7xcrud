<?php

namespace App\Http\Controllers\Liquid;

use App\Http\Controllers\Controller;
use App\Models\Backend\OrderDetailModel;
use App\Models\Backend\OrderModel;
use App\Models\Backend\ProductModel;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;

class CheckoutController extends Controller
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


    public function totalPrice(){
        $subTotal = 0;
        $discount = 0;
        $allItems = $this->cart->getItems();
        if($allItems){
            foreach($allItems as $items){
                foreach($items as $item){
                    $id = $item["id"];
                    if($id>0){
                        $product = ProductModel::findOrFail($id);
                        $subTotal += (int)$product->product_price*(int)$item["quantity"];
                        $discount += (int)$product->product_price*(int)$item["quantity"]*(int)$product->sale/100;
                    }
                }
            }
        }
        return ["subTotal"=>$subTotal,"discount"=>$discount];
    }

    public function index(){
        return view("Liquid.site.checkout");
    }

    public function store(Request $request){
        // dd(session("array"));
        $request->validate([
            "first_name"=>"required",
            "last_name"=>"required",
            "address"=>"required",
            "phone"=>"required|numeric",
            "email"=>"required|email",
            "payment-method"=>"required",
        ]);

        $order = new OrderModel();
        $order->custumer_name = $request->input("first_name")." ".$request->input("last_name");
        $order->custumer_email = $request->input("email");
        $order->custumer_phone = $request->input("phone");
        $order->custumer_address = $request->input("address"). " " . $request->input("address_opt","");
        $order->order_status = 0;
        $order->order_note = $request->input("note");
        $order->payment_method = $request->input("payment-method");
        $order->total_product = $this->cart->getTotalQuantity();
        $order->total_price = $this->totalPrice()["subTotal"];
        $order->save();

        $allItems = $this->cart->getItems();
        if($allItems){
            foreach($allItems as $items){
                foreach($items as $item){
                    $id = $item["id"];
                    if($id>0){
                        $product = ProductModel::findOrFail($id);
                        $orderDetail = new OrderDetailModel();
                        $orderDetail->product_id = $id;
                        $orderDetail->product_price = $product->product_price;
                        $orderDetail->quantity = $item["quantity"];
                        $orderDetail->order_id = $order->id;
                        $orderDetail->order_status = $order->order_status;
                        $orderDetail->save();
                    }
                }
            }
        }

        foreach(session("array") as $id){
            $this->cart->remove($id);
        }


        return redirect(route("Liquid.cart.index"))->with("status","Tạo đơn hàng thành công");
    }
}
