<?php

namespace App\Http\Middleware;

use App\Models\Frontend\CartModel;
use Closure;

class CheckOutIndex
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cart = new CartModel([
            // Can add unlimited number of item to cart
            'cartMaxItem'      => 0,

            // Set maximum quantity allowed per item to 99
            'itemMaxQuantity'  => 10,

            // Do not use cookie, cart data will lost when browser is closed
            'useCookie'        => false,
        ]);
        $totalPrice = $cart->getAttributeTotal("price");
        if((int)$totalPrice>0){
            return $next($request);
        }else{
            return redirect(route("indexCart"))->with("status","Trong giỏ không mặt hàng nào");
        }
    }
}
