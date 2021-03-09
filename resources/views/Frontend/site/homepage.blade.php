<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset("fe-assets/")}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset("fe-assets/")}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset("fe-assets/")}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset("fe-assets/")}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{asset("fe-assets/")}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset("fe-assets/")}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset("fe-assets/")}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset("fe-assets/")}}/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/logo.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="{{route("indexCart")}}"><i class="fa fa-shopping-bag"></i> <span>{{$totalProduct}}</span></a></li>
            </ul>
            <div class="header__cart__price">tổng tiền: <span>${{$totalPrice}}</span></div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> shop@book.com</li>
                <li>Miễn phí giao hàng cho đơn từ 99.000 VND</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> shop@book.com</li>
                                <li>Miễn phí giao hàng cho đơn từ 99.000 VND</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="header__logo">
                        <a href="./index.html"><img src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="{{route("indexCart")}}"><i class="fa fa-shopping-bag"></i> <span>{{$totalProduct}}</span></a></li>
                        </ul>
                        <div class="header__cart__price">tổng: <span>${{$totalPrice}}</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <style>
                    ul.up-hover{
                        padding: 0;
                    }
                    .hover{
                        width: 100%;
                        padding-left: 50px;
                        padding-bottom: 5px;
                        padding-top: 10px;
                        /* margin: 10px; */
                        /* float: left; */
                        transition: 0.2s;
                    }
                    .hover:hover{
                        background-color: #99ff004f;
                    }
                </style>
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Danh mục sản phẩm</span>
                        </div>
                        <ul class="up-hover">
                            @foreach($catagories as $key => $catagory)
                            <li class="hover"><a href="{{route("ProductCata",$catagory->id)}}">{{$catagory->catagory_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="{{route("search")}}">
                                <input type="text" placeholder="Bạn muốn tìm gì ?" name="search">
                                <button type="submit" class="site-btn">TÌM KIẾM</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>Hỗ trợ 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="https://cdn0.fahasa.com/media/magentothem/banner7/MCBooks-920x420.jpg">
                        <div class="hero__text">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">

                    {{-- <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="https://cdn0.fahasa.com/media/wysiwyg//Thang-6-2020/Coupon_310x210.jpg">
                            <h5><a href="#">Sách trong nước</a></h5>
                        </div>
                    </div> --}}

                    @foreach($catagories as $key => $catagory)
                        <div class="col-lg-3">
                            @php
                                if($catagory->catagory_image){
                                    $catagory->catagory_image = str_replace("public/","storage/",$catagory->catagory_image);
                                }
                            @endphp
                            <div class="categories__item set-bg" data-setbg="{{$catagory->catagory_image}}">
                                <h5><a href="{{route("ProductCata",$catagory->id)}}">{{$catagory->catagory_name}}</a></h5>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm nổi bật</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">Tất cả</li>
                            @foreach($catagories as $key => $catagory)
                            <li data-filter=".{{$catagory->catagory_slug}}">{{$catagory->catagory_name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>


            <div class="row featured__filter">
                @foreach($products as $product)
                    @foreach($product as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{$item->catagory_slug}}">
                        <div class="featured__item">
                            @php
                                if($item->product_image){
                                    $item->product_image = str_replace("public/","storage/",$item->product_image);
                                }
                            @endphp
                            <div class="featured__item__pic set-bg" data-setbg="{{$item->product_image}}">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="{{route("addToCart",$item->id)}}" data-price="{{$item->product_price}}" class="addCart"><i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="featured__item__text">
                                <h6><a href="{{route("product",$item->id)}}">{{$item->product_name}}</a></h6>
                                <h5>${{$item->product_price}}</h5>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    <!-- Featured Section End -->
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

@include('Frontend.partials.footer')

    <!-- Js Plugins -->
<script src="{{asset("fe-assets/")}}/js/jquery-3.3.1.min.js"></script>
<script src="{{asset("fe-assets/")}}/js/bootstrap.min.js"></script>
<script src="{{asset("fe-assets/")}}/js/jquery.nice-select.min.js"></script>
<script src="{{asset("fe-assets/")}}/js/jquery-ui.min.js"></script>
<script src="{{asset("fe-assets/")}}/js/jquery.slicknav.js"></script>
<script src="{{asset("fe-assets/")}}/js/mixitup.min.js"></script>
<script src="{{asset("fe-assets/")}}/js/owl.carousel.min.js"></script>
<script src="{{asset("fe-assets/")}}/js/main.js"></script>

</body>
<script>
    $(document).ready(function(){
        $(".header__cart .header__cart__price span").text("$"+"{{number_format((int)$totalPrice,2,',','.')}}");
        $(".header__cart ul li a span").text("{{$totalProduct}}");
        $(".humberger__menu__cart .header__cart__price span").text("$"+"{{number_format((int)$totalPrice,2,',','.')}}");
        $(".humberger__menu__cart ul li a span").text("{{$totalProduct}}");
        $(".addCart").on("click",function(e){
            e.preventDefault();
            var path = $(this).attr("href");
            var price = $(this).data("price");
            // quantity = $("input[name='quantity']").val();
            // path = path + "?quantity="+quantity;
            // console.log(path);
            $.get(path,{price:price},function(data){
                $(".cart-status").append("<i class='fa fa-check-circle'></i>");
                $(".cart-status").append(data.msg);
                $(".cart-status").css("animation", "moveUp 5s ease-in");
                $(".header__cart .header__cart__price span").text("$"+data.totalPrice);
                $(".header__cart ul li a span").text(data.totalProduct);
                $(".humberger__menu__cart .header__cart__price span").text("$"+data.totalPrice);
                $(".humberger__menu__cart ul li a span").text(data.totalProduct);
            });
            $(".cart-status").html("");
            $(".cart-status").css("animation", "");
        });
    });
</script>

</html>

