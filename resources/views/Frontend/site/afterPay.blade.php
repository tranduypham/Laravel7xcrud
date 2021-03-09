@extends('Frontend.layouts.main')

@section('title', '')

@section('head', 'Thanh toán')

@section('content')
<style>
    .header__cart{
        visibility: hidden;
    }
</style>
@if(session()->has("status"))
<div class="alert alert-success">
    {{session()->pull("status","thành công")}}
</div>
@endif

@endsection
