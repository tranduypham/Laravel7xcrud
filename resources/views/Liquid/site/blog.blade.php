@extends('Liquid.layouts.main')

@section('title', 'blog')
@section('image', 'images/bg_2.jpg')
@section('page-name', 'Blog')



@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-6 d-flex align-items-stretch ftco-animate">
                    <div class="blog-entry d-md-flex">
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
                </div>
            </div>
            <div class="row mt-5">
                <div class="col text-center">
                    <div class="block-27">
                        <ul>
                            <li><a href="#">&lt;</a></li>
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li><a href="#">&gt;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
