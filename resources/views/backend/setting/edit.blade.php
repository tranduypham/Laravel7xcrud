@extends('backend.layouts.main')
@section('title', 'Cấu hình')

@section('content')
<h1>Cấu hình cho trang web</h1>

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        <li>
            @foreach($errors->all() as $error)
            {{$error}}
            @endforeach
        </li>
    </ul>
</div>
@endif

@if(session()->has('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif

<form action="{{route("setting.update")}}" enctype="multipart/form-data" method="POST">
@csrf
<div class="form-group">
    <label for="site_name">Tên trang web :</label>
    <input type="text" class="form-control" name="site_name" value="{{isset($setup["site_name"])?$setup["site_name"]:""}}">
</div>
<div class="form-group">
    <label for="logo">Ảnh logo :</label>
    <input type="file" class="form-control" name="logo" value="">
    @if(isset($setup["logo"])&&$setup["logo"])
    @php
        $setup["logo"] = str_replace("public/","storage/",$setup["logo"]);
    @endphp
    <img src="{{asset($setup["logo"])}}" alt="Ảnh logo" height="300">
    @endif
</div>
<div class="form-group">
    <label for="meta_title">Meta title :</label>
    <input type="text" class="form-control" name="meta_title" value="{{isset($setup["meta_title"])?$setup["meta_title"]:""}}">
</div>
<div class="form-group">
    <label for="meta_desc">Meta describe  :</label>
    <input type="text" class="form-control" name="meta_desc" value="{{isset($setup["meta_desc"])?$setup["meta_desc"]:""}}">
</div>
<div class="form-group">
    <label for="meta_key">Meta keyword  :</label>
    <input type="text" class="form-control" name="meta_key" value="{{isset($setup["meta_key"])?$setup["meta_key"]:""}}">
</div>
<button class="btn btn-primary">Lưu cấu hình</button>
</form>

@endsection

@section('appendjs')

@endsection
