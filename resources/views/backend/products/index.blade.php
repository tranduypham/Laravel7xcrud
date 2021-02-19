@extends('backend.layouts.main')

@section('title', 'Hiển thị sản phẩm')
@section('appendjs')
<script>
    var reset = document.querySelector(".clear-filler");
    reset.addEventListener("click", function(e) {
        e.preventDefault();
        var search = document.querySelector(".search");
        var status = document.querySelector("#product_status");
        var sort = document.querySelector("#product_sort");
        var catagory_id = document.querySelector("#catagory_id");
        var btn = document.querySelector(".submit");
        search.value = "";
        status.value = "";
        sort.value = "";
        catagory_id.value = "";
        btn.click();
    });

</script>
<script>
    var sort = document.querySelector("#product_sort");
    sort.addEventListener("change", function(e) {
        e.preventDefault();
        var btn = document.querySelector(".submit");
        btn.click();
    });

    var catagory = document.querySelector("#catagory_id");
    catagory.addEventListener("change", function(e) {
        e.preventDefault();
        var btn = document.querySelector(".submit");
        btn.click();
    });

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
    var php_page = {{$page}};
    a.forEach(link => link.addEventListener("click", function(e) {
        e.preventDefault();
        var page = document.querySelector(".page-item.active > .page-link") || php_page;

        page = parseInt(page.innerText) || php_page;

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
@section('content')
<h1>Đây là Index</h1>

<form class="form-inline" method="get" action="{{ htmlspecialchars($_SERVER["REQUEST_URI"])}}" name="search_product">
    @php
    if(!isset($search)){
    $search = "";
    }
    if(!isset($product_sort)){
    $product_sort = "";
    }
    if(!isset($product_status)){
    $product_status = "";
    }
    @endphp
    <div class="form-group mb-2 col-md-5">
        <input type="text" class="form-control col-md-12 search" id="search" name="search_product_name" placeholder="Nhập thông tin tìm kiếm" value="{{$search}}">
    </div>
    <select class="form-control ml-2 mb-2" id="product_status" name="product_status">
        <option selected disabled>Lọc theo trạng thái</option>
        <option value="1" {{$product_status==1?"selected":""}}>Đang mở bán</option>
        <option value="2" {{$product_status==2?"selected":""}}>Chưa mở bán</option>
    </select>
    <select class="form-control ml-2 mb-2" id="catagory_id" name="catagory_id">
        <option selected disabled>Lọc theo danh mục</option>
        @foreach($catagory as $id => $catagory_name)
        <option value="{{$id}}" {{$product_catagory_id==$id?"selected":""}}>{{$catagory_name}}</option>
        @endforeach
    </select>
    <select class="form-control ml-2 mb-2" id="product_sort" name="product_sort">
        <option selected disabled>Sắp xếp</option>
        <option value="price_asc" {{$product_sort=="price_asc"?"selected":""}}>Giá tăng dần</option>
        <option value="price_desc" {{$product_sort=="price_desc"?"selected":""}}>Giá giảm dần</option>
        <option value="quantity_asc" {{$product_sort=="quantity_asc"?"selected":""}}>Tồn kho tăng dần</option>
        <option value="quantity_desc" {{$product_sort=="quantity_desc"?"selected":""}}>Tồn kho giảm dần</option>
    </select>
    <input type="hidden" name="page" class="page" value="1">

    <div class="form-group ml-3">
        <button type="submit" class="btn btn-primary mb-2 submit" name="search_submit" value="submit">Search</button>
        <div style="margin: 10px 5px;">
            <a href="#" class="clear-filler btn btn-info mb-2">Reset</a>
        </div>
    </div>

</form>

{{$products->onEachSide(2)->links()}}

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
    </div>
    <div style="padding : 20px 10px; margin: 20px 10px;">
        <a href="{{url("/backend/product/create")}}" class="btn btn-lg btn-success">Thêm sản phẩm </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-dark table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh đại diện</th>
                        <th>Miêu tả</th>
                        <th>Ngày xuất</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh đại diện</th>
                        <th>Miêu tả</th>
                        <th>Ngày xuất</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if(isset($products[0]->id) && !empty($products[0]->id))
                    @foreach($products as $product)
                    {{-- //$product ở đây thật ra ở dạng collection, loại này phức tạp hươn mản thương có trong php
                            //Cách truy cập vào collection này cũng không hề giống truy cập mảng hay obj thông thường
                            //Thực ra ta có thể truy cập trực tiếp vào mảng arrtributes bên trong cái collection này luôn
                            //Như là bên dưới đây --}}
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>
                            {{$product->product_name}}

                            @php
                            $status = "<p class='text-secondary'>Không rõ</p>";
                            $catagory = "";
                            if($product->product_status){
                                if($product->product_status==1){
                                    $status = "<p class='text-success '>Đã mở bán</p>";
                                }else{
                                    $status = "<p class='text-warning'>Chưa mở bán</p>";
                            }
                            if($product->catagory_id){
                                $catagory = "<p class='text-info font-weight-bold mt-2'>".$product->catagory_name."</p>";
                            }

                            }
                            @endphp
                            {!!$catagory!!}
                            {!!$status!!}

                        </td>
                        <td class="img-index">
                            @if($product->product_image)
                            <?php
                                //Thay thế public thanh storage, vi asset chỉ truy cập vào storage được thôi, còn file public kia không truy cập được
                                $product->product_image = str_replace("public/img","storage/img",$product->product_image);
                            ?>
                            <img src="{{asset("$product->product_image")}}" alt="ảnh đại diện">
                            @endif
                        </td>
                        <td>{!!$product->product_desc!!}</td>
                        <td>{{$product->product_publish}}</td>
                        <td>{{$product->product_quantity}}</td>
                        <td>{{$product->product_price}}đ</td>
                        <td class="button">
                            <a href="{{url("/backend/product/edit/$product->id")}}" class="btn btn-block btn-warning" style="margin:5px;">Sửa</a>
                            <a href="{{url("/backend/product/delete/$product->id")}}" class="btn btn-block btn-danger" style="margin:5px;">Xóa</a>
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
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                    </tr>
                    @endif

                </tbody>
            </table>

        </div>
        {{$products->onEachSide(2)->links()}}
    </div>
</div>
@endsection
