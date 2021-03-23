@extends('backend.layouts.main')

@section('title', 'Review')

@section('content')
<h1>Review</h1>

<h2>Nhập thông tin</h2>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach

    </ul>
</div>
@endif
<form action="{{route("Review.store")}}" method="post" name="product" enctype="multipart/form-data">
    @csrf
    <a class="text-primary" href="{{route("Review.index")}}">Quay về trang chủ</a>
    <div class="form-group">
        <label for="product_name">ID sản phẩm:</label>
        <input type="text" class="form-control" id="product_name" placeholder="Nhập id sản phẩm" name="product_id" value="{{old('product_id',"")}}">
    </div>
    <div class="form-group">
        <label for="product_name">Tên:</label>
        <input type="text" class="form-control" id="product_name" placeholder="Nhập tên" name="name" value="{{old('name',"")}}">
    </div>
    <div class="form-group">
        <label for="product_image">Hình ảnh:</label>
        <input type="file" class="form-control" id="product_image" placeholder="Nhập link" name="avatar">
    </div>
    <div class="form-group">
        <label for="product_publish">Nội dung:</label>
        <input type="text" class="form-control" id="product_publish" placeholder="Nhập thời gian" name="content" value="{{old('content',"")}}">
    </div>
    <div class="form-group">
        <label for="product_quantity">Rate :</label>
        <input type="number" class="form-control" id="product_quantity" placeholder="Nhập số lượng" name="rate" value="{{old('Rate',"")}}" min="1" max="5">
    </div>
    <button type="submit" class="btn  btn-lg btn-info">Submit</button>
    <a class="btn btn-lg btn-primary" href="{{url("/backend/product/index")}}">Quay về trang chủ</a>

</form>
@endsection

@section('appendjs')


@endsection
