@extends('backend.layouts.main')

@section('title', 'Xóa sản phẩm mới')

@section('content')
<h1>Đây là delete</h1>
<form action="{{url("/backend/product/destroy/$product->id")}}" method="post" name="product">
    @csrf
    <style>
        p {
            font-size: 32px;
        }

    </style>
    <div class="form-group">
        <label for="product_id">ID sản phẩm:</label>
        <p id="product_id" name="product_id">{{$product->id}}</p>
    </div>
    <div class="form-group">
        <label for="product_name">Tên sản phẩm:</label>
        <p id="product_name" name="product_name">{{$product->product_name}}</p>
    </div>
    <button type="submit" class="btn btn-lg btn-danger">Xác nhận xóa sản phẩm</button>
    <a class="btn btn-lg btn-primary" href="{{url("/backend/product/index")}}">Không xóa nữa</a>
</form>
@endsection
