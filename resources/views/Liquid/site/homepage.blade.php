@extends('Liquid.layouts.main')

@section('title', 'home')
@section('image', 'images/bg_2.jpg')
@section('page-name', 'home')
@section('homepage', 'yes')
@section('intro', 'yes')



@section('content')
    {{-- Lich su --}}
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center"
                    style="background-image: url({{ asset('liquorstore-master/') }}/images/about.jpg);">
                </div>
                <div class="col-md-6 wrap-about pl-md-5 ftco-animate py-5">
                    <div class="heading-section">
                        <span class="subheading">Since 1905</span>
                        <h2 class="mb-4">Desire Meets A New Taste</h2>

                        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It
                            is a paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                        <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it
                            would have been rewritten a thousand times and everything that was left from its origin would be
                            the word "and" and the Little Blind Text should turn around and return to its own, safe country.
                        </p>
                        <p class="year">
                            <strong class="number" data-number="115">0</strong>
                            <span>Years of Experience In Business</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    {{-- Danh muc --}}
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                @foreach ($catagories as $catagory)
                    @php
                        $catagory->catagory_image = str_replace('public/', 'storage/', $catagory->catagory_image);
                    @endphp
                    <div class="col-lg-2 col-md-4 ">
                        <div class="sort w-100 text-center ftco-animate">
                            <div class="img" style="background-image: url({{ asset($catagory->catagory_image) }});"></div>
                            <h3>{{ $catagory->catagory_name }}</h3>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url({{ asset('liquorstore-master/') }}/images/kind-2.jpg);"></div>
                        <h3>Gin</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url({{ asset('liquorstore-master/') }}/images/kind-3.jpg);"></div>
                        <h3>Rum</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url({{ asset('liquorstore-master/') }}/images/kind-4.jpg);"></div>
                        <h3>Tequila</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url({{ asset('liquorstore-master/') }}/images/kind-5.jpg);"></div>
                        <h3>Vodka</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center ftco-animate">
                        <div class="img" style="background-image: url({{ asset('liquorstore-master/') }}/images/kind-6.jpg);"></div>
                        <h3>Whiskey</h3>
                    </div>
                </div> --}}

            </div>
        </div>
    </section>
    {{-- San pham noi bat --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Our Delightful offerings</span>
                    <h2>Tastefully Yours</h2>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                    @php
                        $product->product_image = str_replace('public/', 'storage/', $product->product_image);
                    @endphp
                    <div class="col-md-3 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center"
                                style="background-image: url({{ asset($product->product_image) }});">
                                <div class="desc">
                                    <p class="meta-prod d-flex">
                                        <a href="#" class="d-flex align-items-center justify-content-center Add_to_cart"
                                            data-id="{{ $product->id }}"><span class="flaticon-shopping-bag"></span></a>
                                        {{-- <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-heart"></span></a> --}}
                                        <a href="{{ route('Liquid.product.show', $product->id) }}"
                                            class="d-flex align-items-center justify-content-center"><span
                                                class="flaticon-visibility"></span></a>
                                    </p>
                                </div>
                            </div>
                            <div class="text text-center">
                                @php
                                    if ((int) $product->sale > 0) {
                                        echo '<span class="sale">Sale</span>';
                                    } elseif (in_array((int) $product->id, $bestSeller)) {
                                        echo '<span class="seller">Best Seller</span>';
                                    } elseif (in_array((int) $product->id, $newArrived)) {
                                        echo '<span class="new">New Arrival</span>';
                                    }
                                @endphp
                                <span class="category">{{ $product->catagory_name }}</span>
                                <h2>{{ $product->product_name }}</h2>

                                @php
                                    if ((int) $product->sale > 0) {
                                        echo '<p class="mb-0"><span class="price price-sale">$' . number_format(((int) $product->product_price * (100 + (int) $product->sale)) / 100, 2, '.', ' ') . '</span> <span class="price">$' . $product->product_price . '</span></p>';
                                    } else {
                                        echo '<span class="price">$' . $product->product_price . '</span>';
                                    }
                                @endphp
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="col-md-3 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center"
                            style="background-image: url({{ asset('liquorstore-master/') }}/images/prod-2.jpg);">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-shopping-bag"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-heart"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-visibility"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <span class="seller">Best Seller</span>
                            <span class="category">Gin</span>
                            <h2>Jim Beam Kentucky Straight</h2>
                            <span class="price">$69.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center"
                            style="background-image: url({{ asset('liquorstore-master/') }}/images/prod-3.jpg);">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-shopping-bag"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-heart"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-visibility"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <span class="new">New Arrival</span>
                            <span class="category">Rum</span>
                            <h2>Citadelle</h2>
                            <span class="price">$69.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center"
                            style="background-image: url({{ asset('liquorstore-master/') }}/images/prod-4.jpg);">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-shopping-bag"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-heart"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-visibility"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <span class="category">Rum</span>
                            <h2>The Glenlivet</h2>
                            <span class="price">$69.00</span>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center"
                            style="background-image: url({{ asset('liquorstore-master/') }}/images/prod-5.jpg);">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-shopping-bag"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-heart"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-visibility"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <span class="category">Whiskey</span>
                            <h2>Black Label</h2>
                            <span class="price">$69.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center"
                            style="background-image: url({{ asset('liquorstore-master/') }}/images/prod-6.jpg);">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-shopping-bag"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-heart"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-visibility"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <span class="category">Tequila</span>
                            <h2>Macallan</h2>
                            <span class="price">$69.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center"
                            style="background-image: url({{ asset('liquorstore-master/') }}/images/prod-7.jpg);">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-shopping-bag"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-heart"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-visibility"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <span class="category">Vodka</span>
                            <h2>Old Monk</h2>
                            <span class="price">$69.00</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="product ftco-animate">
                        <div class="img d-flex align-items-center justify-content-center"
                            style="background-image: url({{ asset('liquorstore-master/') }}/images/prod-8.jpg);">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-shopping-bag"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-heart"></span></a>
                                    <a href="#" class="d-flex align-items-center justify-content-center"><span
                                            class="flaticon-visibility"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <span class="category">Whiskey</span>
                            <h2>Jameson Irish Whiskey</h2>
                            <span class="price">$69.00</span>
                        </div>
                    </div>
                </div> --}}


            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <a href="{{ route('Liquid.product.index') }}" class="btn btn-primary d-block">View All Products <span
                            class="fa fa-long-arrow-right"></span></a>
                </div>
            </div>
        </div>
    </section>
    {{-- Nhan xet --}}
    <section class="ftco-section testimony-section img"
        style="background-image: url({{ asset('liquorstore-master/') }}/images/bg_4.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
                    <span class="subheading">Testimonial</span>
                    <h2 class="mb-3">Happy Clients</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">

                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-quote-left"></div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
                                        and Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img"
                                            style="background-image: url({{ asset('liquorstore-master/') }}/images/person_1.jpg)">
                                        </div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-quote-left"></div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
                                        and Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img"
                                            style="background-image: url({{ asset('liquorstore-master/') }}/images/person_2.jpg)">
                                        </div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-quote-left"></div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
                                        and Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img"
                                            style="background-image: url({{ asset('liquorstore-master/') }}/images/person_3.jpg)">
                                        </div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap py-4">
                                <div class="icon d-flex align-items-center justify-content-center"><span
                                        class="fa fa-quote-left"></div>
                                <div class="text">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia
                                        and Consonantia, there live the blind texts.</p>
                                    <div class="d-flex align-items-center">
                                        <div class="user-img"
                                            style="background-image: url({{ asset('liquorstore-master/') }}/images/person_1.jpg)">
                                        </div>
                                        <div class="pl-3">
                                            <p class="name">Roger Scott</p>
                                            <span class="position">Marketing Manager</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @foreach ($reviews as $review)
                            @php
                                $review->avatar = str_replace('public/', 'storage/', $review->avatar);
                            @endphp
                            <div class="item">
                                <div class="testimony-wrap py-4">
                                    <div class="icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-quote-left"></div>
                                    <div class="text">
                                        <p class="mb-4">{{ $review->content }}.</p>
                                        <div class="d-flex align-items-center">
                                            <div class="user-img"
                                                style="background-image: url({{ asset($review->avatar) }})">
                                            </div>
                                            <div class="pl-3">
                                                <p class="name">{{ $review->name }}</p>
                                                <span class="position">Marketing Manager</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .item .text>p {
            height: 80px;
            /* white-space: nowrap; */
            text-overflow: ellipsis;
            overflow: hidden;
        }

    </style>
    {{-- blog --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <span class="subheading">Blog</span>
                    <h2>Recent Blog</h2>
                </div>
            </div>
            <div class="row d-flex">
                @foreach ($blogs as $blog)
                <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
                    <div class="blog-entry d-flex">
                        <a href="blog-single.html" class="block-20 img"
                            style="background-image: url('{{ asset(str_replace("public/","storage/",$blog->thumbnail)) }}');">
                        </a>
                        <div class="text p-4 bg-light">
                            <div class="meta">
                                @php
                                    $date = new DateTime($blog->created_at);
                                @endphp
                                <p><span class="fa fa-calendar"></span> {{ $date->format("j F Y") }}</p>
                            </div>
                            <h3 class="heading mb-3"><a href="#">{{ $blog->name }}</a></h3>
                            <p>{{ $blog->intro }}
                            </p>
                            <a href="{{ route("Liquid.blog.single",$blog->id) }}" class="btn-custom">Continue <span class="fa fa-long-arrow-right"></span></a>

                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
                    <div class="blog-entry d-flex">
                        <a href="blog-single.html" class="block-20 img"
                            style="background-image: url('{{ asset('liquorstore-master/') }}/images/image_2.jpg');">
                        </a>
                        <div class="text p-4 bg-light">
                            <div class="meta">
                                <p><span class="fa fa-calendar"></span> 23 April 2020</p>
                            </div>
                            <h3 class="heading mb-3"><a href="#">The Recipe from a Winemaker’s Restaurent</a></h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                            </p>
                            <a href="#" class="btn-custom">Continue <span class="fa fa-long-arrow-right"></span></a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
                    <div class="blog-entry d-flex">
                        <a href="blog-single.html" class="block-20 img"
                            style="background-image: url('{{ asset('liquorstore-master/') }}/images/image_3.jpg');">
                        </a>
                        <div class="text p-4 bg-light">
                            <div class="meta">
                                <p><span class="fa fa-calendar"></span> 23 April 2020</p>
                            </div>
                            <h3 class="heading mb-3"><a href="#">The Recipe from a Winemaker’s Restaurent</a></h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                            </p>
                            <a href="#" class="btn-custom">Continue <span class="fa fa-long-arrow-right"></span></a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
                    <div class="blog-entry d-flex">
                        <a href="blog-single.html" class="block-20 img"
                            style="background-image: url('{{ asset('liquorstore-master/') }}/images/image_4.jpg');">
                        </a>
                        <div class="text p-4 bg-light">
                            <div class="meta">
                                <p><span class="fa fa-calendar"></span> 23 April 2020</p>
                            </div>
                            <h3 class="heading mb-3"><a href="#">The Recipe from a Winemaker’s Restaurent</a></h3>
                            <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.
                            </p>
                            <a href="#" class="btn-custom">Continue <span class="fa fa-long-arrow-right"></span></a>

                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
@endsection

@section('css')
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // THêm sản phẩm vạo giọ hàng
            $("body").on("click", ".Add_to_cart", function(event) {
                event.preventDefault();
                id = $(this).data("id");
                quantity = 1;
                $.ajax({
                    url: "{{ route('Liquid.cart.add') }}",
                    data: {
                        quantity: quantity,
                        id: id,
                    },
                    type: "GET",
                    success: function(data) {
                        $("small#total_item").text(data);
                        alert("Thêm sản phẩm vào giọ hàng thành công");
                    },
                    error: function() {
                        alert("Đã có lỗi xảy ra");
                    }
                });
            });
        });

    </script>
@endsection
