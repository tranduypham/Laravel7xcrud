{{--  <pre>
    @php
        print_r($cart);
    @endphp
</pre>  --}}

@foreach ($cart as $product)
<div class="dropdown-item d-flex align-items-start" href="#">
    <div class="img" style="background-image: url({{ asset( $product["image"]) }});"></div>
    <div class="text pl-3">
        <h4>{{ $product["name"] }}</h4>
        <p class="mb-0"><a href="#" class="price">${{ $product["price"] }}</a><span class="quantity ml-3">Quantity:
                {{ $product["quantity"] }}</span></p>
    </div>
</div>
@endforeach
{{--  <div class="dropdown-item d-flex align-items-start" href="#">
    <div class="img" style="background-image: url(images/prod-2.jpg);"></div>
    <div class="text pl-3">
        <h4>Jim Beam Kentucky Straight</h4>
        <p class="mb-0"><a href="#" class="price">$30.89</a><span class="quantity ml-3">Quantity:
                02</span></p>
    </div>
</div>
<div class="dropdown-item d-flex align-items-start" href="#">
    <div class="img" style="background-image: url(images/prod-3.jpg);"></div>
    <div class="text pl-3">
        <h4>Citadelle</h4>
        <p class="mb-0"><a href="#" class="price">$22.50</a><span class="quantity ml-3">Quantity:
                01</span></p>
    </div>
</div>  --}}
<a class="dropdown-item text-center btn-link d-block w-100" href="{{ route("Liquid.cart.index") }}">
    View All
    <span class="ion-ios-arrow-round-forward"></span>
</a>
