@extends('backend.layouts.main')

@section('title', 'edit sản phẩm')

@section('content')

<h1>Đây là edit</h1>
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<h2>Sửa thông tin sản phẩm</h2>
{{-- Nếu có bất kỳ một lỗi nào --}}
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>
            {{$error}}
        </li>
        @endforeach

    </ul>
</div>
@endif


<form action="{{url("/backend/product/update/$product->id")}}" method="post" name="product" enctype="multipart/form-data">
    @csrf
    <a class="text-primary" href="{{url("/backend/product/index")}}">Quay về trang chủ</a>
    <div class="form-group">
        <label for="product_name">Tên sản phẩm:</label>
        <input type="text" class="form-control" id="product_name" placeholder="Nhập tên" name="product_name" value="{{$product->product_name}}">
    </div>
    <div class="form-group">
        <label for="product_image">Hình ảnh sản phẩm:</label>
        <input type="file" class="form-control" id="product_image" placeholder="Nhập link" name="product_image">
        @if($product->product_image)
        <?php
        //Thay thế public thanh storage, vi asset chỉ truy cập vào storage được thôi, còn file public kia không truy cập được
        $product->product_image = str_replace("public/img","storage/img",$product->product_image);
        ?>
        <img src="{{asset("$product->product_image")}}" alt="ảnh đại diện">
        @endif
    </div>
    <div class="form-group">
        <label for="product_publish">Thời gian mở bán:</label>
        <input type="text" class="form-control" id="product_publish" placeholder="Nhập thời gian" name="product_publish" value="{{$product->product_publish}}">
    </div>
    <div class="form-group">
        <label for="product_quantity">Số lượng :</label>
        <input type="number" class="form-control" id="product_quantity" placeholder="Nhập số lượng" name="product_quantity" value="{{$product->product_quantity}}">
    </div>
    <div class="form-group">
        <label for="product_price">Giá tiền :</label>
        <input type="text" class="form-control" id="product_price" placeholder="Nhập giá tiền" name="product_price" value="{{$product->product_price}}">
    </div>
    @php
    $check1="";
    $check2="";
    if($product->product_status==1){
    $check1="checked";
    }
    if($product->product_status==2){
    $check2="checked";
    }
    @endphp
    <div class="form-group">
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="product_status">Trạng thái :</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="product_status_1" name="product_status" value="1" {{$check1}}>
            <label class="form-check-label" for="product_status_1">Đang mở bán</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="product_status_2" name="product_status" value="2" {{$check2}}>
            <label class="form-check-label" for="product_status_2">Tạm thời dừng bán</label>
        </div>
    </div>
    @php
        $product_catagory_id = $product->catagory_id;
    @endphp
    <div class="form-group">
        <label class="form-check-label" for="catagory_id">Danh mục sản phẩm :</label>
        <select class="form-control" id="catagory_id" name="catagory_id">
            <option selected disabled>Hãy chọn danh mục sản phẩm</option>
            @foreach($catagory as $id => $catagory_name)
            <option value="{{$id}}" {{$product_catagory_id==$id?"selected":""}}>{{$catagory_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="product_desc">Miêu tả sản phẩm:</label>
        <textarea name="product_desc" class="form-control" id="product_desc" cols="30" rows="10" name="product_desc">{{$product->product_desc}}</textarea>
    </div>
    <div>
        <label for="product_desc">Preview mô tả sản phẩm:</label>
        {!!$product->product_desc!!}
    </div>

    <button type="submit" class="btn btn-lg btn-danger">Submit</button>
    <a class="btn btn-lg btn-primary" href="{{url("/backend/product/index")}}">Quay về trang chủ</a>

</form>
@endsection
@section('appendjs')
<link href="{{asset("be-asset/startbootstrap-sb-admin-2-gh-pages")}}/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="{{asset("be-asset/startbootstrap-sb-admin-2-gh-pages")}}/js/bootstrap-datetimepicker.min.js"></script>

<script>
    $(function() {
        $('#product_publish').datetimepicker({
            format: "YYYY-MM-DD HH:mm:ss"
            , icons: {
                time: 'fa fa-clock'
                , date: 'fa fa-calendar'
                , up: 'fas fa-arrow-up'
                , down: 'fas fa-arrow-down'
                , previous: 'fas fa-chevron-left'
                , next: 'fas fa-chevron-right'
                , today: 'fas fa-calendar-check'
                , clear: 'far fa-trash-alt'
                , close: 'far fa-times-circle'
            }
        })
    });
    //Thật ra cái này có thể thay thế bằng type="datetime-local"

</script>

<script src="{{asset("be-asset/startbootstrap-sb-admin-2-gh-pages")}}/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#product_desc'
    });

</script>
@endsection
