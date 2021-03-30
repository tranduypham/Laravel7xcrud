<div class="row d-flex">
    @foreach ($blogs as $blog)
        <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
            <div class="blog-entry d-md-flex">
                <a href="blog-single.html" class="block-20 img"
                    style="background-image: url('{{ asset(str_replace("public/","storage/",$blog->thumbnail)) }}');">
                </a>
                <div class="text p-4 bg-light">
                    <div class="meta">
                        @php
                            $day = new DateTime($blog->created_at);
                        @endphp
                        <p><span class="fa fa-calendar"></span> {{ $day->format("j F Y") }}</p>
                    </div>
                    <h3 class="heading mb-3"><a href="{{ route("Liquid.blog.single",$blog->id) }}">{{ $blog->name }}</a></h3>
                    <p>{{ $blog->intro }}
                    </p>
                    <a href="{{ route("Liquid.blog.single",$blog->id) }}" class="btn-custom">Continue <span class="fa fa-long-arrow-right"></span></a>

                </div>
            </div>
        </div>
    @endforeach
    {{-- <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
        <div class="blog-entry d-md-flex">
            <a href="blog-single.html" class="block-20 img"
                style="background-image: url('{{ asset('liquorstore-master/') }}/images/image_1.jpg');">
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
        <div class="blog-entry d-md-flex">
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
        <div class="blog-entry d-md-flex">
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
    </div>
    <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
        <div class="blog-entry d-md-flex">
            <a href="blog-single.html" class="block-20 img"
                style="background-image: url('{{ asset('liquorstore-master/') }}/images/image_5.jpg');">
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
        <div class="blog-entry d-md-flex">
            <a href="blog-single.html" class="block-20 img"
                style="background-image: url('{{ asset('liquorstore-master/') }}/images/image_6.jpg');">
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
<div class="row mt-5">
    <div class="col text-center">
        <div class="block-27">
            {{ $blogs->onEachSide(2)->links() }}
        </div>
    </div>
</div>

<style>
    div.blog-entry{
        height: 310px;
    }
    div.blog-entry .text>p{
        height: 86px;
        overflow: hidden;
        white-space: wrap;
        text-overflow: ellipsis;
        /* background-color: red; */
    }
    div.blog-entry .text>h3{
        height: 65px;
        display: flex;
        align-items: center;
    }
</style>
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
