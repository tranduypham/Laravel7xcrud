@extends('Liquid.layouts.main')

@section('title', 'products')
@section('image', 'images/bg_2.jpg')
@section('page-name', 'products')



@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row mb-4">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <h4 class="product-select">Select Types of Products</h4>
                            {{-- <select class="selectpicker" multiple>
                                @foreach ($catagories as $catagory)
                                    <option value="{{ $catagory->id }}">{{ $catagory->catagory_name }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                    </div>
                    <div class="table-products">
                        @include("Liquid.site.products-detail")
                    </div>
                    <style>
                        .block-27 nav ul li {
                            margin-left: 5px;
                            display: inline-block;
                            margin-bottom: 4px;
                            font-weight: 400;
                            border: 1px solid transparent !important;
                        }

                        .block-27 nav ul li a:hover {
                            color: #b7472a !important;
                            background-color: #ff340136;
                        }

                        .block-27 nav ul li a:focus {
                            color: #b7472a !important;
                            box-shadow: 0 0 0 0.2rem #b7462a46 !important;
                        }

                        .block-27 nav ul li.active span {
                            background-color: #cc411f !important;
                            color: white;
                            border: 1px solid transparent !important;
                        }

                        .page-link {
                            padding: 0;
                        }

                        .page-item:first-child .page-link {
                            margin-left: 0;
                            border-top-left-radius: 50%;
                            border-bottom-left-radius: 50%;
                        }

                        .page-item:last-child .page-link {
                            border-top-right-radius: 50%;
                            border-bottom-right-radius: 50%;
                        }

                    </style>
                </div>

                <div class="col-md-3">
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Product Types</h3>
                            <ul class="p-0">
                                @foreach ($catagories as $catagory)
                                    <li><a href="{{ route("Liquid.product.index.catagory",$catagory->id) }}" data-id="{{ $catagory->id }}">{{ $catagory->catagory_name }} <span
                                                class="fa fa-chevron-right"></span></a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3>Recent Blog</h3>
                        @foreach ($blogs as $blog)
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                                style="background-image: url({{ asset(str_replace("public/","storage/",$blog->thumbnail)) }});"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">{{ $blog->name }}</a></h3>
                                <div class="meta">
                                    @php
                                        $date = new DateTime($blog->created_at);
                                    @endphp
                                    <div><a href="#"><span class="fa fa-calendar"></span>{{ $date->format(" M. j,Y") }}</a></div>
                                    {{-- <div><a href="#"><span class="fa fa-comment"></span> 19</a></div> --}}
                                </div>
                            </div>
                        </div>
                        @endforeach
                        {{-- <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                                style="background-image: url({{ asset('liquorstore-master/') }}/images/image_2.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4"
                                style="background-image: url({{ asset('liquorstore-master/') }}/images/image_3.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div> --}}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('css')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            function fetch_data(next_page){
                $.ajax({
                    url:"{{{ route("Liquid.product.index.ajax") }}}"+"?page="+next_page,
                    type:"POST",
                    data:{_token:"{{ csrf_token() }}"},
                    success: function(data){
                        $(".table-products").html(data);
                    }
                });
            };

            $("body").on("click",".pagination a",function(event){
                // console.log($("div.table-products"));
                event.preventDefault();
                var current_page = $("li.active span.page-link").text();
                console.log(current_page);
                var next_page = $(this).attr("href").split("?page=")[1];
                console.log(next_page);
                fetch_data(next_page);
            });

            // $("select").on("change",function(event){
            //     event.preventDefault();
            //     text = "";
            //     setTimeout(function(){
            //         text = $(".filter-option-inner-inner").text();
            //         console.log(text);
            //         $.ajax({
            //             url: '{{ route("Liquid.product.index.catagory.multi") }}',
            //             data: {
            //                 catalog: text
            //             },
            //             success: function(data){
            //                 // console.log(data);
            //                 // $(".table-products").html(data);
            //             }
            //         });
            //     },100);
            // });
        });

        // THêm sản phẩm vạo giọ hàng
        $("body").on("click",".Add_to_cart",function(event){
            event.preventDefault();
            id = $(this).data("id");
            quantity = 1;
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
        });
    </script>
@endsection


