<section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('liquorstore-master/') }}/images/bg_2.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-center">
            <div class="col-md-9 ftco-animate mb-5 text-center">
                <p class="breadcrumbs mb-0"><span class="mr-2"><a href="{{ route("Liquid.home") }}">Home <i
                                class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Products <i
                                class="fa fa-chevron-right"></i></a></span> <span>@yield('product') <i
                            class="fa fa-chevron-right"></i></span></p>
                <h2 class="mb-0 bread">Products Single</h2>
            </div>
        </div>
    </div>
</section>
