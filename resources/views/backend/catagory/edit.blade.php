@extends('backend.layouts.main')

@section('title', 'edit danh mục')

@section('appendjs')
    
@endsection
@section('content')

<h1>Đây là edit</h1>
@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<h2>Sửa thông tin danh mục</h2>
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

{{-- Method PUT/Patch --}}
<form action="{{route("catagory.update",$catagory->id)}}" method="post" name="product" enctype="multipart/form-data">
    @csrf
    @method('put')
    <a class="text-primary" href="{{route("catagory.index")}}">Quay về trang chủ</a>
    <div class="form-group">
        <label for="catagory_name">Tên danh mục:</label>
        <input type="text" class="form-control" id="catagory_name" placeholder="Nhập tên" name="catagory_name" value="{{$catagory->catagory_name}}">
    </div>
    <div class="form-group">
        <label for="catagory_image">Hình ảnh danh mục:</label>
        <input type="file" class="form-control" id="catagory_image" placeholder="Nhập link" name="catagory_image">
        @if($catagory->catagory_image)
        <?php
        //Thay thế public thanh storage, vi asset chỉ truy cập vào storage được thôi, còn file public kia không truy cập được
        $catagory->catagory_image = str_replace("public/img","storage/img",$catagory->catagory_image);
        ?>
        <img src="{{asset("$catagory->catagory_image")}}" alt="ảnh đại diện" class="img">
        @endif
    </div>
    <div class="form-group">
        <label for="catagory_slug">Slug:</label>
        <input type="text" class="form-control" id="catagory_slug" placeholder="Nhập slug" name="catagory_slug" value="{{$catagory->catagory_slug}}">
    </div>
    <div class="form-group">
        <label for="catagory_desc">Miêu tả sản phẩm:</label>
        <textarea name="catagory_desc" class="form-control" id="catagory_desc" cols="30" rows="15">{{$catagory->catagory_desc}}</textarea>
    </div>
    <div>
        <label for="catagory_desc">Preview mô tả sản phẩm:</label>
        {!!$catagory->catagory_desc!!}
    </div>

    <button type="submit" class="btn btn-lg btn-danger">Submit</button>
    <a class="btn btn-lg btn-primary" href="{{route("catagory.index")}}">Quay về trang chủ</a>

</form>
@endsection
@section('appendjs')
<link href="{{asset("be-asset/startbootstrap-sb-admin-2-gh-pages")}}/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>
<script src="{{asset("be-asset/startbootstrap-sb-admin-2-gh-pages")}}/js/bootstrap-datetimepicker.min.js"></script>

{{-- <script>
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

</script> --}}

<script src="{{asset("be-asset/startbootstrap-sb-admin-2-gh-pages")}}/js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#catagory_desc'
    });

</script>
@endsection
