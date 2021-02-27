@extends('backend.layouts.main')

@section('title', 'Danh sách đơn hàng')

@section('content')
<h1>Danh sách đơn hàng</h1>

<form class="form-inline" method="get" action="{{ htmlspecialchars($_SERVER["REQUEST_URI"])}}" name="search_order">
    @php
    if(!isset($search_order_name)){
    $search_order_name = "";
    }
    if(!isset($order_sort)){
    $order_sort = "";
    }
    // $_status = ["1"=>"Chờ xác nhận","2"=>"Đã xác nhận"];
    @endphp
    <div class="form-group mb-2 col-md-5">
        <input type="text" class="form-control col-md-12 search mb-2" id="search" name="search_order_name" placeholder="Nhập thông tin tìm kiếm" value="{{$search_order_name}}">
    </div>

    <div class="form-group mb-2">
        <select class="form-control ml-2 mb-2" id="search_order_status" name="search_order_status">
            <option selected disabled>--Status--</option>
            @foreach($status as $order_status)
                <option value="{{$order_status->id}}" {{$search_order_status==$order_status->id?"selected":""}}>{{$order_status->order_status}}</option>
            @endforeach
        </select>
    </div>
    <input type="hidden" name="page" class="page" value="1">

    <div class="form-group ml-3 mb-2">
        <button type="submit" class="btn btn-primary mb-2 submit" name="search_submit" value="submit">Search</button>
        <div style="margin: 10px 5px;">
            <a href="#" class="clear-filler btn btn-info mb-2">Reset</a>
        </div>
    </div>

</form>


@if(session()->has('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h6>
    </div>
    <div style="padding : 20px 10px; margin: 20px 10px;">
        <a href="{{route("orders.create")}}" class="btn btn-lg btn-success">Tạo đơn hàng mới</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            {{$orders->onEachSide(2)->links()}}
            <table class="table table-bordered table-dark table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Tổng số sản phẩm</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id đơn hàng</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Email</th>
                        <th>Tổng số sản phẩm</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot>
                {{-- Tạo mang chua trang thai đơn hàng --}}
                @php
                // $_status = ["1"=>"Chờ xác nhận","2"=>"Đã xác nhận"];
                $s = $status->toArray();
                $order_status = [];
                foreach ($s as $value) {
                    $order_status[$value->id] = $value->order_status;
                }
                @endphp
                <tbody>
                    @if(isset($orders[0]->id) && !empty($orders))
                    @foreach($orders as $order)
                    {{-- //$product ở đây thật ra ở dạng collection, loại này phức tạp hươn mản thương có trong php
                            //Cách truy cập vào collection này cũng không hề giống truy cập mảng hay obj thông thường
                            //Thực ra ta có thể truy cập trực tiếp vào mảng arrtributes bên trong cái collection này luôn
                            //Như là bên dưới đây --}}
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->custumer_name}}</td>
                        <td>{{$order->custumer_phone}}</td>
                        <td>{{$order->custumer_address}}</td>
                        <td>{{$order->custumer_email}}</td>
                        <td>{{$order->total_product}}</td>
                        <td>{{$order_status[$order->order_status]}}</td>
                        <td>{{$order->total_price}}</td>
                        <td class="button">
                            <a href="{{route("orders.show",$order->id)}}" class="btn btn-block btn-info" style="margin:5px;">Show</a>
                            <a href="{{route("orders.edit",$order->id)}}" class="btn btn-block btn-warning" style="margin:5px;">Sửa</a>
                            {{-- Mở form hỏi có muốn xóa hay không --}}
                            <a href="{{url("/backend/order/$order->id/delete")}}" class="btn btn-block btn-danger" style="margin:5px;">Xóa</a>
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
        {{$orders->onEachSide(2)->links()}}
    </div>
</div>
@endsection

@section('appendjs')
<script>
    var reset = document.querySelector(".clear-filler");
    reset.addEventListener("click", function(e) {
        e.preventDefault();
        var search = document.querySelector(".search");
        var status = document.querySelector("#search_order_status");
        var btn = document.querySelector(".submit");
        search.value = "";
        status.value = "";
        btn.click();
    });
</script>

<script>
    var sort = document.querySelector("select#search_order_status");
    console.log(sort);
    sort.addEventListener("change", function(e) {
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
