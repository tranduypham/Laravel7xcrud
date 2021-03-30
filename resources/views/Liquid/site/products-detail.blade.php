<div class="row">
    {{-- Sale --}}
    {{-- <div class="col-md-4 d-flex">
        <div class="product ftco-animate">
            <div class="img d-flex align-items-center justify-content-center"
                style="background-image: url({{ asset('liquorstore-master/') }}/images/prod-1.jpg);">
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
                <span class="sale">Sale</span>
                <span class="category">Brandy</span>
                <h2>Bacardi 151</h2>
                <p class="mb-0"><span class="price price-sale">$69.00</span> <span
                        class="price">$49.00</span></p>
            </div>
        </div>
    </div> --}}
    {{-- Best seller --}}
    {{-- <div class="col-md-4 d-flex">
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
    </div> --}}
    {{-- New arrive --}}
    {{-- <div class="col-md-4 d-flex">
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
    </div> --}}
    @foreach ($products as $product)
        @php
            if ($product->product_image) {
                $product->product_image = str_replace('public/', 'storage/', $product->product_image);
            }
        @endphp
        <div class="col-md-4 d-flex">
            <div class="product ftco-animate">
                <div class="img d-flex align-items-center justify-content-center"
                    style="background-image: url({{ asset($product->product_image) }});">
                    <div class="desc">
                        <p class="meta-prod d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center Add_to_cart" data-id="{{ $product->id }}"><span
                                    class="flaticon-shopping-bag"></span></a>
                            {{--  <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="flaticon-heart"></span></a>  --}}
                            <a href="{{ route("Liquid.product.show",$product->id) }}" class="d-flex align-items-center justify-content-center"><span
                                    class="flaticon-visibility"></span></a>
                        </p>
                    </div>
                </div>
                <div class="text text-center">
                    @php
                        if((int)$product->sale>0){
                            echo '<span class="sale">Sale</span>';
                        }
                        else if(in_array((int)$product->id,$bestSeller)){
                            echo '<span class="seller">Best Seller</span>';
                        }else if(in_array((int)$product->id,$newArrived)){
                            echo '<span class="new">New Arrival</span>';
                        }
                    @endphp
                    <span class="category">{{ $product->catagory_name }}</span>
                    <h2>{{ $product->product_name }}</h2>

                    @php
                        if((int)$product->sale>0){
                            echo '<p class="mb-0"><span class="price price-sale">$'.number_format((((int)$product->product_price*(100+(int)$product->sale))/100), 2, '.', ' ')
                                .'</span> <span class="price">$'.$product->product_price.'</span></p>';
                        }else{
                            echo '<span class="price">$'.$product->product_price.'</span>';
                        }
                    @endphp
                </div>
            </div>
        </div>
    @endforeach

</div>
<div class="row mt-5">
    <div class="col text-center">
        <div class="block-27">
            <ul>
                {{ $products->onEachSide(2)->links() }}
            </ul>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        var contentWayPoint = function() {
            $('.blog-body .ftco-animate').each(function() {
                if (!$(this).hasClass('ftco-animated')) {
                    console.log("gau gau");
                    $(this).addClass('item-animate');
                    setTimeout(function() {
                        $('body .ftco-animate.item-animate').each(function(k) {
                            console.log("meo meo");
                            var el = $(this);
                            setTimeout(function() {

                                var effect = el.data('animate-effect');
                                if (effect === 'fadeIn') {
                                    el.addClass('fadeIn ftco-animated');
                                } else if (effect === 'fadeInLeft') {
                                    el.addClass('fadeInLeft ftco-animated');
                                } else if (effect === 'fadeInRight') {
                                    el.addClass('fadeInRight ftco-animated');
                                } else {
                                    el.addClass('fadeInUp ftco-animated');
                                }
                                el.removeClass('item-animate');

                            }, k * 50, 'easeInOutExpo');
                        });
                    }, 100);

                }
            });
        };
        contentWayPoint();
    });
</script>

