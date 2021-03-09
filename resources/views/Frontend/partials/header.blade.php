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
                <li><a href="{{route("indexCart")}}"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">tổng tiền: <span>$150.00</span></div>
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
                            <li><a href="{{route("indexCart")}}"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">tổng: <span>$150.00</span></div>
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
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <style>
                    .hero__categories__all{
                        display: block;
                    }
                    ul.up-hover{
                        margin: 0;
                        padding: 0;
                        display: block;
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
                        <ul style="display: none" class="up-hover">
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

                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" style="background: #7fad39">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>@yield('head')</h2>
                        <div class="breadcrumb__option">
                            <a href="{{route("homepage")}}">Home</a>
                            <span>@yield('head')</span>
                            <span class="search">@yield('head-search')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <script src="{{asset("fe-assets/")}}/js/jquery-3.3.1.min.js"></script>
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

                quantity = $("input[name='quantity']").val();
                path = path + "?quantity="+quantity;

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

