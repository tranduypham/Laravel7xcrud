@extends('backend.layouts.main')

@section('title',"Blog")

@section('content')
<h1>Đây là Index</h1>

<form class="form-inline" method="get" action="{{ htmlspecialchars($_SERVER["REQUEST_URI"]) }}" name="search_product">
    @php
    if(!isset($search_blog_name)){
    $search_blog_name = "";
    }
    @endphp
    <div class="form-group mb-2 col-md-8">
        <input type="text" class="form-control col-md-12 search" id="search" name="search_blog_name" placeholder="Nhập thông tin tìm kiếm" value="{{$search_blog_name}}">
    </div>
    <input type="hidden" name="page" class="page" value="1">

    <div class="form-group ml-3">
        <button type="submit" class="btn btn-primary mb-2 submit" name="search_submit" value="submit">Search</button>
        <div style="margin: 10px 5px;">
            <a href="#" class="clear-filler btn btn-info mb-2">Reset</a>
        </div>
    </div>

</form>

{{$blogs->onEachSide(2)->links()}}

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách blog</h6>
    </div>
    <div style="padding : 20px 10px; margin: 20px 10px;">
        <a href="{{route("blog.create")}}" class="btn btn-lg btn-success">Thêm blog </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-dark table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên blog</th>
                        <th>Thumbnail</th>
                        <th>Slug</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Tên blog</th>
                        <th>Thumbnail</th>
                        <th>Slug</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if(isset($blogs[0]->id) && !empty($blogs))
                    @foreach($blogs as $blog)
                    {{-- //$product ở đây thật ra ở dạng collection, loại này phức tạp hươn mản thương có trong php
                            //Cách truy cập vào collection này cũng không hề giống truy cập mảng hay obj thông thường
                            //Thực ra ta có thể truy cập trực tiếp vào mảng arrtributes bên trong cái collection này luôn
                            //Như là bên dưới đây --}}
                    <tr>
                        <td>{{$blog->id}}</td>
                        <td>{{$blog->name}}</td>
                        <td class="img-index">
                            @if($blog->thumbnail)
                            <?php
                                //Thay thế public thanh storage, vi asset chỉ truy cập vào storage được thôi, còn file public kia không truy cập được
                                $blog->thumbnail = str_replace("public/img_blog","storage/img_blog",$blog->thumbnail);
                            ?>
                            <img src="{{asset("$blog->thumbnail")}}" alt="ảnh đại diện">
                            @endif
                        </td>
                        <td class="slug">{{$blog->slug}}</td>
                        <td class="button">
                            <a href="{{route("blog.show",$blog->id)}}" data-id="{{ $blog->id }}" id="show" class="btn btn-block btn-info" style="margin:5px;">Show</a>
                            <a href="{{route("blog.edit",$blog->id)}}" data-id="{{ $blog->id }}" class="btn btn-block btn-warning" style="margin:5px;">Sửa</a>
                            {{-- Mở form hỏi có muốn xóa hay không --}}
                            <a href="{{ route("blog.delete",$blog->id) }}" data-id="{{ $blog->id }}" class="btn btn-block btn-danger delete" style="margin:5px;">Xóa</a>
                        </td>
                    </tr>
                    @endforeach


                    @else
                    <tr>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                    </tr>
                    @endif

                </tbody>
            </table>

        </div>
        {{$blogs->onEachSide(2)->links()}}
    </div>
</div>
<style>
    tr td.slug{
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: wrap;
    }
</style>

<div class="show_modal">
    <div class="content">

    </div>
    <div class="cancle">&#x2715</div>
</div>



@endsection

@section('appendjs')
<script>
$(document).ready(function(){
    $("tbody").on("click","#show",function(event){
        event.preventDefault();
        $path = $(this).attr("href");
        $.ajax({
            url: $path,
            type: "GET",
            success: function(data){
                $(".show_modal").css("visibility","visible");
                $(".show_modal .content").html(data);
            }
        });
    });
    $(".show_modal").on("click",".cancle",function(){
        $(".show_modal").css("visibility","hidden");
        $(".show_modal .content").html("");
    });
    $("tbody").on("click",".delete",function(event){
        event.preventDefault();
        $confirm = confirm("Xác nhận xóa blog này ?");
        if($confirm){
            $path = $(this).attr("href");
            window.location.replace($path);
        }
    });
});
</script>
<script>
    var reset = document.querySelector(".clear-filler");
    reset.addEventListener("click", function(e) {
        e.preventDefault();
        var search = document.querySelector(".search");
        var btn = document.querySelector(".submit");
        search.value = "";
        btn.click();
    });

</script>
<script>
    // var sort = document.querySelector("#product_sort");
    // sort.addEventListener("change", function(e) {
    //     e.preventDefault();
    //     var btn = document.querySelector(".submit");
    //     btn.click();
    // });

</script>
@php
$page = isset($_GET['page'])?$_GET['page']:1;
@endphp
<script>
    //Sử lý việc nhấn vào nút phân trang khiễn trang reload lại và mất giá trị tìm kiếm
    //Ở controller sau mỗi lần submit tìm kiến, biến $search đã được giữ lại để lưu giá trị tìm kiếm
    //Bh mỗi lần ấn nút, ta sẽ chặn ko cho nút a chuyển hướng ngay, ta sẽ thực hiện thay đổi giá trị value của thẻ input hidden name = page(Chính là biến dùng để phân trang ) thành trang mà ta muốn chuyển
    //Sau đó vs biến search lưu giá trị mà ta đang tìm kiếm + value của biến page là trang mà ta muốn tới, ta click lại nút search một lần nữa
    //Tức lần này nó sẽ thực hiện tìm kiến giá trị $search tại trang là cái biến page kia đang có
    var a = document.querySelectorAll("a.page-link");

    a.forEach(link => link.addEventListener("click", function(e) {
        e.preventDefault();
        var page = document.querySelector(".page-item.active > .page-link") || {{$page}};

        page = parseInt(page.innerText) || {{$page}};

        var rel = link.getAttribute("rel");
        if (rel == "prev") {
            page -= 1;
        } else if (rel == "next") {
            page += 1;
        } else {
            var page = parseInt(link.innerText);
        }
        //let hidden  = document.querySelector("input[type='hidden'][name='page']");

        //Không hiểu vì lý do gì nhưng khi dùng selector là kiểu input[name='page'] thì không thể nào thay đổi value được
        let hidden = document.querySelector(".page");
        hidden.value = page;


        let btn = document.querySelector("button[name='search_submit']");
        console.log(hidden);
        btn.click();
    }));

</script>

@endsection
