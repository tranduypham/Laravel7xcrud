@extends('backend.layouts.main')

@section('title', 'Sửa thông tin admin')

@section('content')
<h1>Admin {{$admin->name}}</h1>


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
@if(session()->has('error'))
<div class="alert alert-danger">
    {{session('error')}}
</div>
@endif

<a class="text-primary" href="{{route("admin.index")}}">Quay về trang chủ</a>
<form action="{{route("admin.update",$admin->id)}}" method="post" name="admin" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name">Tên :</label>
        <input type="text" class="form-control" id="name" placeholder="Nhập tên" name="name"
            value="{{$admin->name}}">
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email"
            value="{{$admin->email}}">
    </div>
    <div class="form-group">
        <label for="avatar">Ảnh đại diện :</label>
        <input type="file" class="form-control" id="avatar" name="avatar">
        @if($admin->avatar)
        @php
            $path = str_replace("public/","storage/",$admin->avatar);
        @endphp
        <img src="{{asset($path)}}" alt="avatar" width="500" srcset="">
        @endif
    </div>
    <div class="form-group">
        <label for="password">Mật khẩu mới :</label>
        <input type="password" class="form-control" id="password" placeholder="Nhập password" name="password">
    </div>
    <div class="form-group">
        <label for="confirm_password">Nhập lại mật khẩu mới :</label>
        <input type="password" class="form-control" id="confirm_password" placeholder="Nhập lại password" name="confirm_password">
    </div>
    <div class="form-group">
        <label for="desc">Ghi chú :</label>
        <textarea name="desc" class="form-control" id="desc" cols="30"
            rows="15">{{$admin->desc}}</textarea>
    </div>
    <button type="submit" class="btn  btn-lg btn-success">Update thông tin</button>
    <a class="btn btn-lg btn-primary" href="{{route("admin.index")}}">Quay về trang chủ</a>

</form>
@endsection

