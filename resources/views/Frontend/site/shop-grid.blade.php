@extends('Frontend.layouts.main')

@section('title', 'Danh mục')

@section('head', 'Danh mục')

@section('content')
    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>SÁCH GIẢM GIÁ</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">

                                @foreach($products_discount as $product_discount)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            @php
                                            if($product_discount->product_image){
                                                $product_discount->product_image = str_replace("public/","storage/",$product_discount->product_image);
                                            }
                                            @endphp
                                            data-setbg="{{asset($product_discount->product_image)}}">
                                            <div class="product__discount__percent">-{{$product_discount->discount}}%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="{{route("addToCart",$product_discount->id)}}" data-price="{{$product_discount->discount_price}}" class="addCart"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span class="product__item__text">
                                                <h6>
                                                    <a href="{{route("product",$product_discount->id)}}?discount={{$discount}}">{{$product_discount->product_name}}</a>
                                                </h6>
                                            </span>
                                            @php
                                                $product_discount->origin_price = number_format($product_discount->origin_price, 2, '.', '');
                                            @endphp
                                            <div class="product__item__price">${{$product_discount->discount_price}} <span>${{$product_discount->origin_price}}</span></div>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-6 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select class="sort">
                                        <option value="asc" {{$sort=="asc"?"selected":""}}>Giá tăng dần</option>
                                        <option value="desc" {{$sort=="desc"?"selected":""}}>Giá giảm dần</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-lg-6 col-md-7">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="GET" id="form">
                        <input type="hidden" name="page" value="1">
                        <input type="hidden" name="sort" value="asc">
                        {{-- <input type="hidden" name="list" value="grid"> --}}
                        <div class="row products">
                            @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    @php
                                    if($product->product_image){
                                        $product->product_image = str_replace("public/","storage/",$product->product_image);
                                    }
                                    @endphp
                                    <div class="product__item__pic set-bg" data-setbg="{{asset($product->product_image)}}">
                                        <ul class="product__item__pic__hover">
                                            <li><a href="{{route("addToCart",$product->id)}}" data-price="{{$product->product_price}}" data-price="{{$product->product_price}}" class="addCart"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="{{route("product",$product->id)}}">{{$product->product_name}}</a></h6>
                                        <h5>${{$product->product_price}}</h5>
                                    </div>
                                </div>
                                <div class="button">
                                    <a href="{{route("addToCart",$product->id)}}" data-price="{{$product->product_price}}" class="addCart">Add to cart</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{$products->links()}}

                    </form>
                    <style>
                        ul.pagination{
                            margin-top: 50px;
                        }
                        ul.pagination li a,ul.pagination li span{
                            display: flex;
                            flex-direction: row;
                            justify-content: center;
                            align-items: center;
                            box-sizing: border-box;
                            width: 40px;
                            height: 40px;
                            border: 1px solid #b2b2b2;
                            font-size: 14px;
                            color: #b2b2b2;
                            font-weight: 700;
                            margin-right: 16px;
                            -webkit-transition: all, 0.3s;
                            -moz-transition: all, 0.3s;
                            -ms-transition: all, 0.3s;
                            -o-transition: all, 0.3s;
                            transition: all, 0.3s;
                        }

                        ul.pagination li a:hover{
                            background: #7fad39;
                            border-color: #7fad39;
                            color: #ffffff;
                        }

                        .page-item.active .page-link{
                            background-color: #7fad39 !important;
                            border-color: #7fad39 !important;
                            color: #ffffff !important;
                        }

                        ul.pagination li:last-child a{
                            margin-right: 0;
                        }
                        .product__item{
                            transition: 1s ease-out;
                        }
                        div.list{
                            display: flex;
                            justify-content: space-around;
                            /* align-items: center; */
                            flex: 0.6;
                            margin: 20px 0;
                            transition: 1s ease-in-out;
                        }
                        .list-hover{
                            display: none;
                        }
                        .list-img{
                            width: 50%;
                            display: inline-block;
                            margin: auto;
                        }
                        .button a{
                            margin: 55px 0;
                            padding: 20px 30px;
                            border: 1.5px solid #7fad39 !important;
                            color: #7fad39 !important;
                            font-family: Arial, sans-serif;
                            font-weight: bold;
                            letter-spacing: 3px;
                            font-size: 1rem;
                            border-radius: 35px;
                            position: absolute;
                            right: 0;
                            top: 30%;
                            display: none;
                            transform: translate(-50%,-50%);
                            transition: 0.5s;
                        }
                        .button a:hover{
                            background: #7fad39;
                            color: white !important;
                        }
                        .hover{
                            display: flex;
                            justify-content: flex-start;
                            align-content: center;

                        }
                        .hover:hover{
                            background-color: #99ff0035
                        }
                        .text{
                            display: inline-block;
                            margin: auto;

                        }
                        .text h6 a{
                            font-size: 1rem;
                            letter-spacing: 5px;
                        }
                        .text h5{
                            font-size: 1.5rem;
                            letter-spacing: 3px;
                        }
                    </style>
                </div>
            </div>
        </div>
    </section>
    <button class="scroll">
    </button>
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
    <!-- Product Section End -->

@endsection

@section('js')

<script>
    $(document).ready(function(){

        var sort = $("select.sort");
        var input_sort = $("input[name='sort']");
        var input_page = $("input[name='page']");
        var input_list = $("input[name='list']");
        var current_page = parseInt($("li.active .page-link").text());
        // localStorage.setItem("list","grid");
        $(sort).on("change",function(e){
            e.preventDefault();
            val = $(this).val();
            $(input_sort).val(val);
            $(input_page).val(1);
            $("#form").submit();
        });

        $(".page-link").on("click",function(e){
            // localStorage.setItem("scroll",1000);
            e.preventDefault();
            $(".page-item.active").removeClass("active");
            $(this).closest(".page-item").addClass("active");
            val = $(sort).val();
            $(input_sort).val(val);
            if($(this).attr("aria-label") == "Next »"){
                current_page+=1;
            }else if($(this).attr("aria-label") == "« Previous"){
                current_page-=1;
            }else{
                current_page = $(this).text();
            }
            $(input_page).val(current_page);
            $("#form").submit();
        });

        $("span.icon_ul").on("click",function(e){
            localStorage.setItem("list","list");
            $(input_list).val("list");
            $("div.products>div").addClass("col-lg-12 col-md-12 col-sm-12 hover");
            // $("div.products>div .set-bg").addClass("list");
            $("div.products>div .product__item").addClass("list");
            $("div.products>div .set-bg").addClass("list-img");
            $("div.products>div .product__item__text").addClass("text");
            $(".button a").css("display","block");
            $("div.products>div .product__item__pic__hover").addClass("list-hover");

        });
        $("span.icon_grid-2x2").on("click",function(e){
            localStorage.setItem("list","grid");
            $(input_list).val("grid");
            $("div.products>div").removeClass("col-lg-12 col-md-12 col-sm-12 hover");
            $("div.products>div .product__item").removeClass("list");
            $("div.products>div .set-bg").removeClass("list-img");
            $("div.products>div .product__item__text").removeClass("text");
            $(".button a").css("display","none");
            $("div.products>div .product__item__pic__hover").removeClass("list-hover");
        });

    });
</script>
<script>
    $(document).ready(function(){
        is_list = localStorage.getItem("list");
        if(is_list == "list"){
            $("span.icon_ul").click();
        }else{
            $("span.icon_grid-2x2").click();
        }
        // cart = $(".addCart");
        // console.log(cart);
    });
</script>
@endsection
