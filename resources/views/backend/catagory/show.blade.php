@extends('backend.layouts.main');

@section('title', 'Info Show')
@section('content')
<div class="row">
    <div class="col-md-12 margin-tb">
        <h2>Show info catagory</h2>
        <div class="pull-right">
            <a href="{{route('catagory.index')}}" class="btn btn-primary">Quay về trang chủ</a>
        </div>
        <div class="info">
            <strong>Danh mục : {{$catagory->catagory_name}}</strong>
        </div>
        @if($catagory->catagory_image)
        <div>
            @php
            $catagory->catagory_image = str_replace("public/img_catagory","storage/img_catagory",$catagory->catagory_image);
            @endphp
            <img src="$catagory->catagory_image" alt="Avatar">
        </div>
        @endif
        <div class="info">
            <strong>Mô tả :</strong>
            <p>{!!$catagory->catagory_desc!!}</p>
        </div>
        <div class="info">
            <strong>Slug :</strong>
            <p>{{$catagory->catagory_slug}}</p>
        </div>
        <div class="info">
            <strong>Parent_id :</strong>
            <p>{{$catagory->catagory_parent_id}}</p>
        </div>
    </div>
</div>
@endsection
