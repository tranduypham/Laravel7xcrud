@extends('backend.layouts.main')

@section('title', 'Thêm admin')

@section('content')
<h1>Tạo admin mới</h1>

<h2>Nhập thông tin admin</h2>


@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach

    </ul>
</div>
@endif

@if(session()->has('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<a class="text-primary" href="{{route("admin.index")}}">Quay về trang chủ</a>
<form action="{{route("admin.store")}}" method="post" name="admin" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Tên :</label>
        <input type="text" class="form-control" id="name" placeholder="Nhập tên" name="name"
            value="{{old('name',"")}}">
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="text" class="form-control" id="email" placeholder="Nhập email" name="email"
            value="{{old('email',"")}}">
    </div>
    <div class="form-group">
        <label for="avatar">Ảnh đại diện :</label>
        <input type="file" class="form-control" id="avatar" name="avatar">
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu :</label>
        <input type="password" class="form-control" id="password" placeholder="Nhập password" name="password"
            value="{{old('password',"")}}">
    </div>
    <div class="form-group">
        <label for="confirm_password">Nhập lại mật khẩu :</label>
        <input type="password" class="form-control" id="confirm_password" placeholder="Nhập lại password" name="confirm_password"
            value="{{old('confirm_password',"")}}">
    </div>
    <div class="form-group">
        <label for="desc">Ghi chú :</label>
        <textarea name="desc" class="form-control" id="desc" cols="30"
            rows="15">{{old('desc',"")}}</textarea>
    </div>
    <button type="submit" class="btn  btn-lg btn-info">Thêm admin </button>
    <a class="btn btn-lg btn-primary" href="{{route("admin.index")}}">Quay về trang chủ</a>

</form>
@endsection

