@extends('Liquid.layouts.main')

@section('title', 'products')
@section('image', 'images/bg_2.jpg')
@section('page-name', 'products')
@section('single','yes')

{{-- Cai title --}}
@section('product','single product')



@section('content')

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    {{-- <a href="{{ asset('liquorstore-master/') }}/images/prod-1.jpg" class="image-popup prod-img-bg"><img src="{{ asset('liquorstore-master/') }}/images/prod-1.jpg"
                            class="img-fluid" alt="Colorlib Template"></a> --}}
                    <a href="{{ asset($product->product_image) }}" class="image-popup prod-img-bg"><img src="{{ asset($product->product_image) }}"
                            class="img-fluid" alt="Colorlib Template"></a>
                </div>
                <style>
                    .ftco-animate img{
                        width: 100%;
                        height: auto;
                    }
                </style>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3>{{ $product->product_name }}</h3>
                    <div class="rating d-flex">
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2">5.0</a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                            <a href="#"><span class="fa fa-star"></span></a>
                        </p>
                        <p class="text-left mr-4">
                            <a href="#" class="mr-2" style="color: #000;">100 <span style="color: #bbb;">Rating</span></a>
                        </p>
                        <p class="text-left">
                            <a href="#" class="mr-2" style="color: #000;">{{ $SELL }} <span style="color: #bbb;">Sold</span></a>
                        </p>
                    </div>
                    <p class="price"><span>${{ number_format($product->product_price,2,".","") }}</span></p>
                    {{-- <p>A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a
                        paradisematic country, in which roasted parts of sentences fly into your mouth.</p>
                    <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would
                        have been rewritten a thousand times and everything that was left from its origin would be the word
                        "and" and the Little Blind Text should turn around and return to its own, safe country. But nothing
                        the copy said could convince her and so it didn’t take long until a few insidious Copy Writers
                        ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they
                        abused her for their.
                    </p> --}}
                    <p>{!! $product->product_desc !!}</p>
                    <div class="row mt-4">
                        <div class="input-group col-md-6 d-flex mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </span>
                            <input type="text" id="quantity" data-id="{{ $product->id }}" name="quantity" class="quantity form-control input-number"
                                value="1" min="1" max="{{ $product->product_quantity }}">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </span>
                        </div>
                        <div class="w-100"></div>
                        <div class="col-md-12">
                            <p style="color: #000;">{{ $product->product_quantity }} piece available</p>
                        </div>
                    </div>
                    <p><a href="{{ route("Liquid.cart.add") }}" class="btn btn-primary py-3 px-5 mr-2" id="Add_to_cart">Add to Cart</a>
                        <a href="{{ route("Liquid.buy.now",$product->id) }}" class="btn btn-primary py-3 px-5">Buy now</a>
                        </p>
                </div>
            </div>





            <div class="row mt-5">
                <div class="col-md-12 nav-link-wrap">
                    <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <a class="nav-link ftco-animate active mr-lg-1" id="v-pills-1-tab" data-toggle="pill"
                            href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Description</a>

                        {{-- <a class="nav-link ftco-animate mr-lg-1" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2"
                            role="tab" aria-controls="v-pills-2" aria-selected="false">Manufacturer</a> --}}

                        <a class="nav-link ftco-animate" id="v-pills-3-tab" data-toggle="pill" href="#v-pills-3" role="tab"
                            aria-controls="v-pills-3" aria-selected="false">Reviews</a>

                    </div>
                </div>
                <div class="col-md-12 tab-wrap">

                    <div class="tab-content bg-light" id="v-pills-tabContent">

                        <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="day-1-tab">
                            <div class="p-4">
                                <h3 class="mb-4">{{ $product->product_name }}</h3>
                                <p>{!! $product->product_desc !!}</p>
                            </div>
                        </div>

                        {{-- <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-day-2-tab">
                            <div class="p-4">
                                <h3 class="mb-4">Manufactured By Liquor Store</h3>
                                <p>On her way she met a copy. The copy warned the Little Blind Text, that where it came from
                                    it would have been rewritten a thousand times and everything that was left from its
                                    origin would be the word "and" and the Little Blind Text should turn around and return
                                    to its own, safe country. But nothing the copy said could convince her and so it didn’t
                                    take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and
                                    Parole and dragged her into their agency, where they abused her for their.</p>
                            </div>
                        </div> --}}
                        <div class="tab-pane fade" id="v-pills-3" role="tabpanel" aria-labelledby="v-pills-day-3-tab">
                            <div class="row p-4">
                                <div class="col-md-7">
                                    <h3 class="mb-4">23 Reviews</h3>
                                    <div class="review">
                                        <div class="user-img" style="background-image: url({{ asset('liquorstore-master/') }}/images/person_1.jpg)"></div>
                                        <div class="desc">
                                            <h4>
                                                <span class="text-left">Jacob Webb</span>
                                                <span class="text-right">25 April 2020</span>
                                            </h4>
                                            <p class="star">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                                <span class="text-right"><a href="#" class="reply"><i
                                                            class="icon-reply"></i></a></span>
                                            </p>
                                            <p>When she reached the first hills of the Italic Mountains, she had a last view
                                                back on the skyline of her hometown Bookmarksgrov</p>
                                        </div>
                                    </div>
                                    <div class="review">
                                        <div class="user-img" style="background-image: url({{ asset('liquorstore-master/') }}/images/person_2.jpg)"></div>
                                        <div class="desc">
                                            <h4>
                                                <span class="text-left">Jacob Webb</span>
                                                <span class="text-right">25 April 2020</span>
                                            </h4>
                                            <p class="star">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                                <span class="text-right"><a href="#" class="reply"><i
                                                            class="icon-reply"></i></a></span>
                                            </p>
                                            <p>When she reached the first hills of the Italic Mountains, she had a last view
                                                back on the skyline of her hometown Bookmarksgrov</p>
                                        </div>
                                    </div>
                                    @if (count($reviews)>0)
                                    @foreach ($reviews as $review)
                                    <div class="review">
                                        <div class="user-img" style="background-image: url({{ asset('liquorstore-master/') }}/images/person_3.jpg)"></div>
                                        <div class="desc">
                                            <h4>
                                                <span class="text-left">{{ $review->name }}</span>
                                                @php
                                                    $date = date_create($review->created_at);
                                                @endphp
                                                <span class="text-right">{{ date_format($date,'j F Y') }}</span>
                                            </h4>
                                            <p class="star">
                                                <span>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </span>
                                                <span class="text-right">
                                                    <a href="#" class="reply">
                                                        <i class="icon-reply"></i>
                                                    </a>
                                                </span>
                                            </p>
                                            <p>{{$review->content}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                {{-- <div class="col-md-4">
                                    <div class="rating-wrap">
                                        <h3 class="mb-4">Give a Review</h3>
                                        <p class="star">
                                            <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (98%)
                                            </span>
                                            <span>20 Reviews</span>
                                        </p>
                                        <p class="star">
                                            <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (85%)
                                            </span>
                                            <span>10 Reviews</span>
                                        </p>
                                        <p class="star">
                                            <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (98%)
                                            </span>
                                            <span>5 Reviews</span>
                                        </p>
                                        <p class="star">
                                            <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (98%)
                                            </span>
                                            <span>0 Reviews</span>
                                        </p>
                                        <p class="star">
                                            <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                (98%)
                                            </span>
                                            <span>0 Reviews</span>
                                        </p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $("button.quantity-left-minus").on("click",function(){
            val = $("input#quantity").val();
            val = parseInt(val);
            $("input#quantity").val((val-1)<=1?1:(val-1));
        });
        $("button.quantity-right-plus").on("click",function(){
            val = $("input#quantity").val();
            val = parseInt(val);
            max = $("input#quantity").attr("max");
            max = parseInt(max);
            console.log(max,val);
            $("input#quantity").val((val+1)>=max?(max-1):(val+1));
        });

        $("#Add_to_cart").on("click",function(event){
            event.preventDefault();
            var quantity = $("input#quantity").val();
            var id = $("input#quantity").data("id");

            console.log(quantity,id,price);
            $.ajax({
                url: "{{ route("Liquid.cart.add") }}",
                data:{
                    quantity: quantity,
                    id: id,
                },
                type: "GET",
                success: function(data){
                    $("small#total_item").text(data);
                    alert("Thêm sản phẩm vào giọ hàng thành công");
                },
                error: function(){
                    alert("Đã có lỗi xảy ra");
                }
            });
        })
    });
</script>
@endsection
