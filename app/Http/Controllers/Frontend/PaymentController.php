<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\OrderDetailModel;
use App\Models\Backend\OrderModel;
use App\Models\Backend\ProductModel;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
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
        $this->totalProduct = $this->cart->getTotalQuantity();
        $this->totalPrice = $this->cart->getAttributeTotal("price");
        $this->totalPrice = number_format($this->totalPrice,2,'.','');
        // $this->total();
        view()->share("catagories", $catagories);
        view()->share("totalProduct",$this->totalProduct);
        view()->share("totalPrice",$this->totalPrice);
    }
    public function pay(Request $request){
        $request->validate([
            "FirstName" => "required",
            "LastName" => "required",
            "Address" => "required",
            "Phone" => "required|numeric",
            "Email" => "required|email",
        ]);
        $cart = $this->cart;
        $name = $request->input("FirstName").$request->input("LastName");
        $order = new OrderModel();
        $order->custumer_name = $name;
        $order->custumer_address = $request->input("Address");
        $order->custumer_phone = $request->input("Phone");
        $order->custumer_email = $request->input("Email");
        $order->order_note = $request->input("Note") || "";
        $order->order_status = 0;
        $order->total_price = $cart->getAttributeTotal("price");
        $order->total_product = $cart->getTotalQuantity();
        $order->save();

        $products = $cart->getItems();
        dump($products);
        foreach($products as $id=>$array){
            foreach($array as $product){
                $orderDetail = new OrderDetailModel();
                $orderDetail->product_id = $id;
                $findProduct = ProductModel::findOrFail($id);
                $orderDetail->product_price = $findProduct->product_price;
                $orderDetail->quantity = $product["quantity"];
                $findProduct->product_quantity = (int)$findProduct->product_quantity - (int)$product["quantity"];
                $findProduct->save();
                $orderDetail->order_id = $order->id;
                $orderDetail->order_status = $order->order_status;
                $orderDetail->save();
            }
        }
        dump($order->id);
        $cart->clear();
        session(["status"=>"tạo đơn hàng thành công"]);
        return view("Frontend.site.afterPay");
    }
}
