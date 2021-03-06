@extends('backend.layouts.main')

@section('title', 'Tạo sản phẩm mới')

@section('content')
<h1>Đây là create</h1>

<h2>Nhập thông tin sản phẩm</h2>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach

    </ul>
</div>
@endif
<form action="{{url("/backend/product/store")}}" method="post" name="product" enctype="multipart/form-data">
    @csrf
    <a class="text-primary" href="{{url("/backend/product/index")}}">Quay về trang chủ</a>
    <div class="form-group">
        <label for="product_name">Tên sản phẩm:</label>
        <input type="text" class="form-control" id="product_name" placeholder="Nhập tên" name="product_name" value="{{old('product_name',"")}}">
    </div>
    <div class="form-group">
        <label for="product_image">Hình ảnh sản phẩm:</label>
        <input type="file" class="form-control" id="product_image" placeholder="Nhập link" name="product_image">
    </div>
    <div class="form-group">
        <label for="product_publish">Thời gian mở bán:</label>
        <input type="text" class="form-control" id="product_publish" placeholder="Nhập thời gian" name="product_publish" value="{{old('product_publish',"")}}">
    </div>
    <div class="form-group">
        <label for="product_quantity">Số lượng :</label>
        <input type="number" class="form-control" id="product_quantity" placeholder="Nhập số lượng" name="product_quantity" value="{{old('product_quantity',"")}}">
    </div>
    <div class="form-group">
        <label for="product_price">Giá tiền :</label>
        <input type="text" class="form-control" id="product_price" placeholder="Nhập giá tiền" name="product_price" value="{{old('product_price',"")}}">
    </div>
    {{-- <div class="form-group">
        <label for="product_status">Trạng thái :</label>
        <input type="radio" id="product_status" name="product_status" value="1">Đạng mở bán
        <input type="radio" id="product_status" name="product_status" value="2">Tạm thời dừng bán
    </div> --}}
    <div class="form-group">
        <div class="form-check form-check-inline">
            <label class="form-check-label" for="product_status">Trạng thái :</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="product_status_1" name="product_status" value="1">
            <label class="form-check-label" for="product_status_1">Đang mở bán</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" id="product_status_2" name="product_status" value="2">
            <label class="form-check-label" for="product_status_2">Tạm thời dừng bán</label>
        </div>
    </div>
    <div class="form-group">
        <label class="form-check-label" for="catagory_id">Danh mục sản phẩm :</label>
        <select class="form-control" id="catagory_id" name="catagory_id">
            <option selected disabled>Hãy chọn danh mục sản phẩm</option>
            @foreach($catagory as $id => $catagory_name)
                <option value="{{$id}}">{{$catagory_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="product_desc">Miêu tả sản phẩm:</label>
        <textarea name="product_desc" class="form-control" id="product_desc" cols="30" rows="15">{{old('product_desc',"")}}</textarea>
    </div>
    <button type="submit" class="btn  btn-lg btn-info">Submit</button>
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

<script src="{{asset("be-asset/startbootstrap-sb-admin-2-gh-pages/js/tinymce/tinymce.min.js")}}"></script>
<script>
    tinymce.init({
        selector: '#product_desc'
    });

</script>

@endsection
