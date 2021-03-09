@extends('Frontend.layouts.main')

@section('title', 'Chi tiết sản phẩm')

@section('head', 'Chi tiết sản phẩm')

@section('content')
    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item discount-tag">
                            @php
                            if($product->product_image){
                                $product->product_image = str_replace("public/","storage/",$product->product_image);
                            }
                            @endphp
                            <img class="product__details__pic__item--large"
                                src="{{asset($product->product_image)}}" alt="Ảnh sản phẩm">
                                <?php
                                if($discount){
                                    ?>
                                    {{-- <span class="discount-tag"></span> --}}
                                    <style>
                                        .discount-tag{
                                            position: relative;
                                        }
                                        .discount-tag::after{
                                            content: "-10%";
                                            display: flex;
                                            justify-content: center;
                                            text-align: center;
                                            align-items: center;
                                            font-size: 2rem;
                                            background-color: #dd2222;
                                            color: white;
                                            /* width: 3.5rem; */
                                            padding: 1.5rem 0.6rem;
                                            /* height: 3.5rem; */
                                            font-family: cursive;
                                            /* line-height: 50px; */
                                            /* box-sizing: border-box; */
                                            border-radius: 50%;
                                            position: absolute;
                                            top: 20px;
                                            left: 20px;
                                        }
                                    </style>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$product->product_name}}</h3>

                        <div class="product__details__price">${{$product->product_price}}
                            <?php
                                if($discount){
                                    $price = $product->product_price * (int)$discount / 100;
                                    $price = number_format($price, 2, '.', '');
                                    ?>
                                    <span class="discount">${{$price}}</span>
                                    <style>
                                        span.discount{
                                            color: rgba(128, 128, 128, 0.529);
                                            text-decoration: line-through;
                                            margin-left: 1rem;
                                            font-size: 1.5rem;
                                        }
                                    </style>
                                    <?php
                                }
                            ?>
                        </div>
                        <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam
                            vehicula elementum sed sit amet dui. Sed porttitor lectus nibh. Vestibulum ac diam sit amet
                            quam vehicula elementum sed sit amet dui. Proin eget tortor risus.</p>

                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1" name="quantity">
                                </div>
                            </div>
                        </div>
                        <a href="{{route("addToCart",$product->id)}}" data-price="{{$product->product_price}}" class="addCart primary-btn">THÊM VÀO GIỎ HÀNG</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <p>{{$product->product_desc}}</p>
                                        {{-- <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                        ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                        elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                        porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                        nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                        Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                        porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                        sed sit amet dui. Proin eget tortor risus.</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-status"></div>
        <style>
            .cart-status i{
                color: green;
                margin-right: 20px;
            }
            .cart-status{
                background-color: white;
                line-height: 50px;
                border-radius: 10px;
                padding: 10px 100px 10px 20px;
                color: rgb(92, 92, 92);
                box-shadow: 5px 5px 20px #00000027,-5px 0px 30px #0000002e;
                position: fixed;
                bottom: 50px;
                left: 20px;
                font-size: 25px;
                opacity: 0;
            }
            @keyframes moveUp{
                0%{
                    bottom: 0;
                    opacity: 0.5;
                }
                10%{
                    bottom: 50px;
                    opacity: 1;
                }
                100%{
                    bottom: 50px;
                    opacity: 0;
                }
            }
        </style>
    </section>
    <!-- Product Details Section End -->
@endsection

@section('js')
{{-- <script>
    $(document).ready(function(){
        $("a.primary-btn").on("click",function(e){
            e.preventDefault();
            var path = $(this).attr("href");
            var price = $(this).data("price");
            quantity = $("input[name='quantity']").val();
            path = path + "?quantity="+quantity;
            // console.log(path);
            $.get(path,{price:price},function(data){
                $(".cart-status").append("<i class='fa fa-check-circle'></i>");
                $(".cart-status").append(data);
                $(".cart-status").css("animation", "moveUp 5s ease-in");
            });
            $(".cart-status").html("");
            $(".cart-status").css("animation", "");
        });
    });
</script> --}}
@endsection
