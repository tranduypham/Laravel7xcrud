<?php

namespace App\Http\Controllers\Liquid;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductModel;
use App\Models\Frontend\CartModel;
use App\Models\Liquid\ReplyModel;
use Illuminate\Http\Request;

class ContactController extends Controller
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
        // $totalPrice = 0;
        // $allItems = $this->cart->getItems();
        // foreach($allItems as $items){
        //     foreach($items as $item){
        //         $id = $item["id"];
        //         if($id>0){
        //             $totalPrice += (int)ProductModel::findOrFail($id)->product_price || 0;
        //         }
        //     }
        // }
        view()->share('totalItem', $totalItem);
        // view()->share('totalPrice', $totalPrice);
    }
    public function contact(){
        return view("Liquid.site.contact");
    }
    public function storeContact(Request $request){
        // dd($request->all());
        $request->validate([
            "email"=>"email|required",
            "message"=>"required"
        ]);

        $reply = new ReplyModel();
        $reply->name = $request->input("name")==null?"":$request->input("name");
        $reply->email = $request->input("email");
        $reply->subject = $request->input("subject")==null?"":$request->input("subject");
        $reply->message = $request->input("message");
        $reply->save();
        return redirect(route("Liquid.contact"))->with("status","Gửi tin nhắn thành công");
    }
}
