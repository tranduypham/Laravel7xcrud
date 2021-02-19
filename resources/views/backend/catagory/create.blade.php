@extends('backend.layouts.main')

@section('title', 'Tạo danh mục mới')

@section('content')
<h1>Đây là create</h1>

<h2>Nhập thông tin danh mục</h2>


@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach

    </ul>
</div>
@endif

<form action="{{route("catagory.store")}}" method="post" name="catagory" enctype="multipart/form-data">
    @csrf
    <a class="text-primary" href="{{route("catagory.index")}}">Quay về trang chủ</a>
    <div class="form-group">
        <label for="catagory_name">Tên danh mục:</label>
        <input type="text" class="form-control" id="catagory_name" placeholder="Nhập tên" name="catagory_name" value="{{old('catagory_name',"")}}">
    </div>
    <div class="form-group">
        <label for="catagory_image">Hình ảnh danh mục:</label>
        <input type="file" class="form-control" id="catagory_image" placeholder="Nhập link" name="catagory_image">
    </div>
    <div class="form-group">
        <label for="catagory_slug">Slug:</label>
        <input type="text" class="form-control" id="catagory_slug" placeholder="Nhập slug" name="catagory_slug" value="{{old('catagory_slug',"")}}">
    </div>
    <div class="form-group">
        <label for="catagory_desc">Miêu tả danh mục:</label>
        <textarea name="catagory_desc" class="form-control" id="catagory_desc" cols="30" rows="15">{{old('catagory_desc',"")}}</textarea>
    </div>
    <button type="submit" class="btn  btn-lg btn-info">Submit</button>
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

<script src="{{asset("be-asset/startbootstrap-sb-admin-2-gh-pages/js/tinymce/tinymce.min.js")}}"></script>
<script>
    tinymce.init({
        selector: '#catagory_desc'
    });

</script>

@endsection
