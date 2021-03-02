@extends('backend.layouts.main')

@section('title', 'Admin list')

@section('content')
<h1>Danh sách admin</h1>


{{$admin->onEachSide(2)->links()}}

@if(session('status'))
<div class="alert alert-success">
    {{session('status')}}
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Admin list</h6>
    </div>
    <div style="padding : 20px 10px; margin: 20px 10px;">
        <a href="{{route("admin.create")}}" class="btn btn-lg btn-success">Thêm admin </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-dark table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên admin</th>
                        <th>Avatar</th>
                        <th>Email</th>
                        <th>Miêu tả</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Tên admin</th>
                        <th>Avatar</th>
                        <th>Email</th>
                        <th>Miêu tả</th>
                        <th>Hành động</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if(isset($admin[0]->id) && !empty($admin))
                    @foreach($admin as $ad)
                    {{-- //$product ở đây thật ra ở dạng collection, loại này phức tạp hươn mản thương có trong php
                            //Cách truy cập vào collection này cũng không hề giống truy cập mảng hay obj thông thường
                            //Thực ra ta có thể truy cập trực tiếp vào mảng arrtributes bên trong cái collection này luôn
                            //Như là bên dưới đây --}}
                    <tr>
                        <td>{{$ad->id}}</td>
                        <td>{{$ad->name}}</td>
                        <td class="img-index">
                            @if($ad->avatar)
                            <?php
                                //Thay thế public thanh storage, vi asset chỉ truy cập vào storage được thôi, còn file public kia không truy cập được
                                $ad->avatar = str_replace("public/","storage/",$ad->avatar);
                            ?>
                            <img src="{{asset("$ad->avatar")}}" alt="ảnh đại diện">
                            @endif
                        </td>
                        <td>{{$ad->email}}</td>
                        <td>{{$ad->desc}}</td>

                        <td class="button">
                            <a href="{{route("admin.show",$ad->id)}}" class="btn btn-block btn-info" style="margin:5px;">Show</a>
                            <a href="{{route("admin.edit",$ad->id)}}" class="btn btn-block btn-warning" style="margin:5px;">Sửa</a>
                            {{-- Mở form hỏi có muốn xóa hay không --}}
                            <a href="{{route("admin.delete",$ad->id)}}" class="btn btn-block btn-danger" style="margin:5px;">Xóa</a>
                        </td>
                    </tr>
                    @endforeach


                    @else
                    <tr>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                        <td>Rỗng</td>
                    </tr>
                    @endif

                </tbody>
            </table>

        </div>
        {{$admin->onEachSide(2)->links()}}
    </div>
</div>
@endsection
