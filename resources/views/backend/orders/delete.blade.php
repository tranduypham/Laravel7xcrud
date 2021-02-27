@extends('backend.layouts.main')

@section('title', 'Xóa đơn hàng')

@section('content')
<h1>Thông tin đơn hàng id số {{$order->id}}</h1>
<form action="{{route('orders.destroy',$order->id)}}" method="post">
    @csrf
    @method("DELETE");
    <div class="form-group">
        <strong for="custumer_name">Tên khách hàng:</strong>
        <span>{{$order->custumer_name}}</span>
    </div>
    <div class="form-group">
        <strong for="custumer_email">Email:</strong>
        <span>{{$order->custumer_email}}</span>
    </div>
    <div class="form-group">
        <strong for="custumer_phone">Số điện thoại :</strong>
        <span>{{$order->custumer_phone}}</span>
    </div>

    <div class="form-group">
        <strong for="order_status">Trạng thái đơn hàng :</strong>
        <span>{{$_status[$order->order_status]}}</span>
    </div>
    <div class="form-group">
        <strong for="custumer_address">Địa chỉ khách hàng :</strong>
        <span>{{$order->custumer_address}}</span>
    </div>
    <div class="form-group">
        <strong for="order_status">Danh sách sản phẩm :</strong>
        <table class="table table-bordered table-dark table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Id sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Id sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Tổng tiền</th>
                </tr>
            </tfoot>
            <tbody class="list-cart-product">
                @foreach($orderDetails as $key => $orderDetail)

                <tr id="tr-{{$orderDetail->product_id}}">
                    <td class="product_id">
                        {{$orderDetail->product_id}}
                    </td>
                    <td>{{$orderDetail->product_name}}</td>
                    @php
                    if($orderDetail->product_image){
                        $orderDetail->product_image = str_replace('public/','storage/',$orderDetail->product_image);
                    }
                    @endphp
                    <td><img src="{{asset($orderDetail->product_image)}}" alt="Anh"></td>
                    <td name="product_quantity[]">{{$orderDetail->quantity}}</td>
                    <td class="price">{{$orderDetail->product_price}}</td>
                    <td class="total"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="font-weight: bold">Tổng tiền thanh toán: <strong id="payment-price">{{$order->total_price}}</strong>
    </div>
    <div class="form-group">
        <strong for="order_note">Ghi chú :</strong>
        <span>{{$order->order_note}}</span>
    </div>
    <button type="submit" class="btn  btn-lg btn-danger">Xóa đơn hàng</button>
    <a class="btn btn-lg btn-primary" href="{{route("orders.index")}}">Quay về trang chủ</a>
</form>
@endsection

@section('appendjs')
<link href="{{asset("/be-asset/startbootstrap-sb-admin-2-gh-pages/css/style.css")}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
    '+data.product+'
</script>
<script>
    $(document).ready(function(){

        function updateCart(){
            //Đây là đoạn update table (updateCart)
            var sum = 0;

            $("td[name='product_quantity[]']").each(function(index,element){
                console.log("update");
                quantity = $(this).text();
                quantity = parseInt(quantity);
                price = $(this).closest("tr").find("td.price").text()
                price = parseInt(price);
                total = price*quantity;
                $(this).closest("tr").find("td.total").text(total);
                sum+=total;
            })
            $("strong#payment-price").text(sum);
        }
        updateCart();
    })
</script>
@endsection
