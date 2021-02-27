@extends('backend.layouts.main')

@section('title', 'Chỉnh sửa đơn hàng')

@section('content')
    {{-- @php
        echo "<pre>";
            print_r($order);
        echo "</pre>";
        echo "<pre>";
            print_r($orderDetails);
        echo "</pre>";
    @endphp --}}
    <h1>Chỉnh sửa thông tin đơn hàng</h1>

    <h2>Thông tin đơn hàng</h2>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{-- End of Error check --}}

    <form action="{{route("orders.update",$order->id)}}" method="post" name="catagory" enctype="multipart/form-data">
        @csrf
        @method('put')
        <a class="text-primary" href="{{route("orders.index")}}">Quay về trang chủ</a>
        <div class="form-group">
            <label for="custumer_name">Tên khách hàng:</label>
            <input type="text" class="form-control" id="custumer_name" placeholder="Nhập tên khách hàng"
                name="custumer_name" value="{{$order->custumer_name}}">
        </div>
        <div class="form-group">
            <label for="custumer_email">Email:</label>
            <input type="email" class="form-control" id="custumer_email" placeholder="Nhập email khách hàng"
                name="custumer_email" value="{{$order->custumer_email}}">
        </div>
        <div class="form-group">
            <label for="custumer_phone">Số điện thoại :</label>
            <input type="text" class="form-control" id="custumer_phone" placeholder="Nhập sđt khách hàng"
                name="custumer_phone" value="{{$order->custumer_phone}}">
        </div>
        <div class="form-group">
            <label for="order_status">Trạng thái đơn hàng :</label>
            <div class="form-group mb-2">
                <select class="form-control mb-2" id="order_status" name="order_status">
                    <option selected disabled>--Status--</option>
                    @foreach($status as $order_status)
                        <option value="{{$order_status->id}}" {{$order->order_status==$order_status->id?"selected":""}}>{{$order_status->order_status}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="custumer_address">Địa chỉ khách hàng :</label>
            <textarea name="custumer_address" class="form-control" id="custumer_address" cols="30"
                rows="5">{{$order->custumer_address}}</textarea>
        </div>

        <div class="form-group mb-2">
            <label for="search_product">Thêm sản phẩm :</label>
            <select class="form-control ml-2 mb-2 js-example-basic-single" id="search_product" name="search_product">
                <option selected disabled value="-1">--Sản phẩm--</option>
            </select>
        </div>
        <a href="#" class="btn btn-success btn-lg addToCart">Thêm sản phẩm vào giọ</a>

        <div class="form-group">
            <label for="order_status">Danh sách sản phẩm :</label>
            <table class="table table-bordered table-dark table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng tiền</th>
                        <th>Hành động</th>
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
                        <th>Hành động</th>
                    </tr>
                </tfoot>
                <tbody class="list-cart-product">
                    @foreach($orderDetails as $key => $orderDetail)

                    <tr id="tr-{{$orderDetail->product_id}}">
                        <td class="product_id">
                            {{$orderDetail->product_id}}
                            <input type="hidden" name="product_id[]" value="{{$orderDetail->product_id}}">
                            <input type="hidden" name="detail_id[]" value="{{$orderDetail->id}}">
                        </td>
                        <td>{{$orderDetail->product_name}}</td>
                        @php
                        if($orderDetail->product_image){
                            $orderDetail->product_image = str_replace('public/','storage/',$orderDetail->product_image);
                        }
                        @endphp
                        <td><img src="{{asset($orderDetail->product_image)}}" alt="Anh"></td>
                        <td><input type="number" name="product_quantity[]" class="product_quantity" value="{{$orderDetail->quantity}}"></td>
                        <td class="price">{{$orderDetail->product_price}}</td>
                        <td class="total"></td>
                        <td class="button"><a href="#" class="btn btn-block btn-danger delete_product" style="margin:5px;">Xóa</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="font-weight: bold">Tổng tiền thanh toán: <strong id="payment-price">{{$order->total_price}}</strong>
            <input type="hidden" name="total_price" id="total_price">
        </div>

        <div class="form-group">
            <label for="order_note">Ghi chú :</label>
            <textarea name="order_note" class="form-control" id="order_note" rows="3">{{$order->order_note}}</textarea>
        </div>

        <button type="submit" class="btn  btn-lg btn-warning">Sửa</button>
        <a class="btn btn-lg btn-primary" href="{{route("catagory.index")}}">Quay về trang chủ</a>

    </form>

@endsection

@section('appendjs')
<link href="{{asset("/be-asset/startbootstrap-sb-admin-2-gh-pages/css/style.css")}}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js">
    '+data.product+'
</script>

<script>
    $(document).ready(function() {
        
        function updateCart(){
            //Đây là đoạn update table (updateCart)
            var sum = 0;

            $("input[name='product_quantity[]']").each(function(index,element){
                console.log("update");
                quantity = $(this).val();
                quantity = parseInt(quantity);
                price = $(this).closest("tr").find("td.price").text()
                price = parseInt(price);
                total = price*quantity;
                $(this).closest("tr").find(".total").text(total);
                sum+=total;
            })
            $("strong#payment-price").text(sum);
            $("input#total_price").val(sum);
        }
        updateCart();

        $("#search_product").select2({
            placeholder: "Chọn một sản phẩm"
            , ajax: {
                url: "{{route("apiGetProducts")}}"
                , type: 'POST'
                , dataType: 'json'
                , data: function(params) {
                    var query = {
                        product_name: params.term
                        , _token: "{{csrf_token()}}"
                    }
                    return query;
                },

                //Đối tượng trả về ở results là một chuỗi vs, mỗi phần tử gồm 2 phần là id và text, hai cái này bắt buộc phải có, không có không chạy được
                processResults: function(json) {
                    //console.log(json);
                    var results = [];
                    //Index ở đâu là thứ tự của product trong mảng trả về, không phải là id của product đâu
                    $.each(json, function(index, product) {
                        //console.log("index "+index+ " id :"+product.id+" value :"+ product.product_name);
                        results.push({
                            id: product.id
                            , text: product.product_name,
                            //Ngoài hai cái id vs text ra không truyển được thêm cái gì khác đâu
                        })
                    })
                    return {
                        //results: $.map(json,function(val,i){
                        //    return {id:i, text:val};
                        //})
                        results: results
                    }
                }
            }
        });

        function checkTr(id){
            var checkTr = $('tbody').find("#tr-"+id).length;
            if(checkTr==1)
                return false;
            else
                return true;
        }

        $("body").on("click",".product_quantity",function(e){
            e.preventDefault();
            $(this).select();
        })

        $("body").on("input",".product_quantity",function(e){
            e.preventDefault();
            var val = $(this).val();
            if(val<0){
                $(this).val(1);
            }
            updateCart();
        })

        $("body").on("change",".product_quantity",function(e){
            e.preventDefault();
            var id = $(this).closest("tr").find(".product_id").text();
            var input = $(this);
            var val = $(this).val();
            // console.log(id);
            var quantity;
            $.ajax({
                type: "POST",
                dataType: "JSON",
                data: {
                    _token: "{{csrf_token()}}"
                },
                delay:200,
                url: "/backend/order/api/getProductsQuantity/"+id
            }).done(function(data){
                if(val>=data){
                    alert("Het hang");
                    $(input).val(1);
                }
                if(val<=0){
                    var a = alert("Gia tri khong hop le");
                    $(input).val(1);
                }
                updateCart();
            });
        });

        $("body").on("click","a.delete_product",function(e){
            e.preventDefault();
            var is_delete = confirm("Ban co muon xoa san pham ?");
            if(is_delete){
                $(this).closest("tr").remove();
            }else{
                console.log("cancle");
            }
            updateCart();
        })

        $(".addToCart").on("click", function(e) {
            e.preventDefault();
            var id = $("#search_product").val();
            id = parseInt(id);
            //console.log();
            //Lấy được id rồi giờ muốn thêm vào bảng thì ta phải request thêm một lần nữa để lấy thông tin của sản phẩm tiếp
            var fetch = $.ajax({
                type: "post"
                , url: "/backend/order/api/getProducts/" + id
                , dataType: "json"
                , data: {
                    _token: "{{csrf_token()}}"
                }
            });
            fetch.done(function(data) {
                if(checkTr(data.id)){
                    //console.log(data);//Mặc dù ta set kiểu trả về là json, nhưng khi nhận kết quả, jquery đã là hộ ta công viện biến đổi json obj thành js obj rồi nên ta không cần phải quan tâm vấn đề này nữa
                    data.product_image = data.product_image.replace("public", "storage");
                    //console.log(data);//Mặc dù ta set kiểu trả về là json, nhưng khi nhận kết quả, jquery đã là hộ ta công viện biến đổi json obj thành js obj rồi nên ta không cần phải quan tâm vấn đề này nữa
                    var html = '<tr id="tr-'+data.id+'">'
                    +'<td class="product_id">'
                        +data.id
                        +'<input type="hidden" name="product_id[]" value="'+data.id+'">'
                    +'</td>'
                    +'<td>'+data.product_name+'</td>'
                    +'<td>'+"<img src='"+'{{asset("/")}}'+data.product_image+"' alt='Anh'>"+'</td>'
                    +'<td>'+'<input type="number" name="product_quantity[]" class="product_quantity" value="1">'+'</td>'//Số lượng
                    +'<td class="price">'+data.product_price+'</td>'
                    +'<td class="total"></td>'//Tổng tiền
                    +'<td class="button">'
                    +'<a href="#" class="btn btn-block btn-danger delete_product" style="margin:5px;">Xóa</a>'
                    +'</td>'
                    +'</tr>';

                    $("tbody.list-cart-product").append(html);

                    updateCart();
                }else{
                    alert("San pham da ton tai");
                }

            });


        });
    })
</script>
@endsection
