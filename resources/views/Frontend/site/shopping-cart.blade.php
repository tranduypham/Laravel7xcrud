@extends('Frontend.layouts.main')

@section('title', 'Giỏ hàng')

@section('head', 'Giở hàng')

@section('content')
    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $id => $product)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{asset($product["img"])}}" width="100" alt="">
                                        <h5>{{$product["name"]}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        $ <span>{{$product["price"]}}</span>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="text" data-id="{{$id}}" data-price="{{$product["price"]}}" value="{{$product["quantity"]}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        $110.00
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <span class="icon_close" data-id="{{$id}}" data-price="{{$product["price"]}}"></span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if(session()->has("status"))
            <div class="text-danger">
                {{session("status")}}
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{route("homepage")}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="{{route("clearCart")}}" class="primary-btn cart-btn cart-btn-right">
                            CLEAR CART</a>
                    </div>
                </div>
                <style>
                    .shoping__cart__btns{
                        /* margin-top: 50px; */
                    }
                    .shoping__cart__btns a{
                        /* font-size: 18px; */
                        /* margin-top: 20px; */
                    }
                    .shoping__cart__btns a:hover{
                        background-color: rgb(127, 173, 57);
                        box-shadow: 2px 2px 10px rgba(128, 128, 128, 0.378),-2px 0 10px rgba(128, 128, 128, 0.474);
                        color: white;
                        transition: 0.3s;
                    }
                    .header__cart{
                        visibility: hidden;
                    }
                </style>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            <li>Subtotal <span class="subtotal">$454.98</span></li>
                            <li>Total <span class="total">$454.98</span></li>
                        </ul>
                        <a href="{{route("Checkout")}}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->
@endsection

@section('js')
<script>
    $(document).ready(function(){
        function Upadate(){
            var totalPrice = 0;
            $(".shoping__cart__total").each(function(){
                var tr = $(this).closest("tr");
                var quantity = $(tr).find(".shoping__cart__quantity input").val();
                var price = $(tr).find(".shoping__cart__price span").text();
                quantity = parseInt(quantity);
                price = parseInt(price);
                $(this).text("$"+(quantity*price)+".00");
                totalPrice += quantity*price;
            });
            $(".shoping__checkout .subtotal").text("$"+totalPrice);
            $(".shoping__checkout .total").text("$"+totalPrice);
        }
        Upadate();

        $(".pro-qty").on("click",function(e){
            console.log("hello");
            val = $(this).closest(".pro-qty").find("input").val();
            console.log(val);
            var id = $(this).closest(".pro-qty").find("input").data("id");
            console.log(id);
            var quantity = $(this).closest(".pro-qty").find("input").val();
            console.log(quantity);
            var attribute = $(this).closest(".pro-qty").find("input").data("price");
            console.log(quantity);
            $.get("{{route("updateCart")}}",{id:id ,quantity:quantity, attribute:attribute },function(data){
                Upadate();
            });
        });

        $("span.icon_close").on("click",function(e){
            var id = $(this).data("id");
            var price = $(this).data("price");
            var tr = $(this).closest("tr");
            $.get("{{route("removeItem")}}",{id:id ,attribute:price },function(data){
                // location.reload();
                $(tr).remove();
                Upadate();
            });
        });
    })
</script>
@endsection
