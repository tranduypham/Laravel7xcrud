@extends('backend.layouts.main')

@section('title', 'Sửa thông tin admin')

@section('content')
<h1>Admin {{$admin->name}}</h1>

<form action="#" method="post" name="admin">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="name">Tên :</label>
        <strong>{{$admin->name}}</strong>
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <strong>{{$admin->email}}</strong>
    </div>
    <div class="form-group">
        <label for="avatar" style="display:block;">Ảnh đại diện :</label>
        @if($admin->avatar)
        @php
            $path = str_replace("public/","storage/",$admin->avatar);
        @endphp
        <img src="{{asset($path)}}" alt="avatar" width="500" srcset="">
        @else
        <strong>Không có</strong>
        @endif
    </div>
    <div class="form-group">
        <label for="desc">Ghi chú :</label>
        <textarea name="desc" class="form-control" id="desc" cols="30"
            rows="15" disabled>{{$admin->desc}}</textarea>
    </div>
    <a class="btn btn-lg btn-primary" href="{{route("admin.index")}}">Quay về trang chủ</a>
</form>
@endsection

