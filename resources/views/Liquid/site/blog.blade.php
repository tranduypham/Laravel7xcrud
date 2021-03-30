@extends('Liquid.layouts.main')

@section('title', 'blog')
@section('image', 'images/bg_2.jpg')
@section('page-name', 'Blog')



@section('content')
    <section class="ftco-section">
        <div class="container blog-body">
            @include("Liquid.site.blog-index-body")
        </div>
    </section>
    <style>
        .block-27 nav ul.pagination{
            width: 100%;
            display: flex;
            justify-content: center;
            flex-wrap: nowrap;
        }
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
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            function fetch_data(next_page) {
                $.ajax({
                    url: "{{ route('Liquid.blog.ajax') }}" + "?page=" + next_page,
                    type: "GET",
                    success: function(data) {
                        $("div.blog-body").html(data);
                    }
                });
            };

            $("body").on("click", ".pagination a", function(event) {
                // console.log($("div.table-products"));
                event.preventDefault();
                var current_page = $("li.active span.page-link").text();
                console.log(current_page);
                var next_page = $(this).attr("href").split("?page=")[1];
                console.log(next_page);
                fetch_data(next_page);
            });
        });




    </script>

@endsection
