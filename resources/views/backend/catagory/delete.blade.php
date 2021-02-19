@extends('backend.layouts.main')

@section('title', 'Xóa sản phẩm mới')

@section('content')
<h1>Đây là delete</h1>
@if(session('status'))
<div class="alert alert-danger" role="alert">
    {{session('status')}}
</div>
@endif
<form action="{{route("catagory.destroy",$catagory->id)}}" method="post" name="product">
    @csrf
    @method('delete')
    <div class="form-group">
        <label for="product_id">ID danh mụcmục:</label>
        <p id="product_id" name="product_id">{{$catagory->id}}</p>
    </div>
    <div class="form-group">
        <label for="product_name">Tên danh mụcmục:</label>
        <p id="product_name" name="product_name">{{$catagory->catagory_name}}</p>
    </div>
    <button type="submit" class="btn btn-lg btn-danger">Xác nhận xóa danh mục</button>
    <a class="btn btn-lg btn-primary" href="{{route("catagory.index")}}">Không xóa nữa</a>
</form>
@endsection
