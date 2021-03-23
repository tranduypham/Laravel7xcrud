<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">Liquor <span>store</span></a>
        <div class="order-lg-last btn-group">
            <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="flaticon-shopping-bag"></span>
                {{--  @if ($totalItem>0)  --}}
                <div class="d-flex justify-content-center align-items-center"><small id="total_item">{{ $totalItem }}</small></div>
                {{--  @endif  --}}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                @php
                    $cart = [];
                @endphp
                @include("Liquid.partials.drop-down")
            </div>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a href="{{ route("Liquid.home") }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route("Liquid.about") }}" class="nav-link">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Products</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="{{ route("Liquid.product.index") }}">Products</a>
                        <a class="dropdown-item" href="#">Single Product</a>
                        <a class="dropdown-item" href="{{ route("Liquid.cart.index") }}">Cart</a>
                        <a class="dropdown-item" href="{{ route("Liquid.checkout") }}">Checkout</a>
                    </div>
                </li>
                <li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
                <li class="nav-item active"><a href="{{ route("Liquid.contact") }}" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

@section("partial-js")
<script>
    $(".btn-cart").on("click",function(event){
            $.ajax({
                url: "{{ route("Liquid.cart.list") }}",
                type: "GET",
                success: function(data){
                    $("div.dropdown-menu.dropdown-menu-right").html(data);
                }
            });
        });
</script>
@endsection
