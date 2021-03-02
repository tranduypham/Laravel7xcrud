@extends('backend.layouts.main')

@section('title', 'Thêm admin')

@section('content')
<h1>Xóa admin {{$admin->name}}</h1>


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

<form action="{{route("admin.destroy",$admin->id)}}" method="post" name="admin" enctype="multipart/form-data">
    @csrf
    @method('delete')
    <div class="form-group">
        <label for="name">Tên :</label>
        <strong>{{$admin->name}}</strong>
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <strong>{{$admin->email}}</strong>
    </div>
    <button type="submit" class="btn  btn-lg btn-info"> Xác nhân xóa admin </button>
    <a class="btn btn-lg btn-primary" href="{{route("admin.index")}}">Quay về trang chủ</a>

</form>
@endsection

