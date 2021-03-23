@extends('backend.layouts.main')

@section('title', 'Review')
@section('appendjs')
    <script>
        var reset = document.querySelector(".clear-filler");
        reset.addEventListener("click", function(e) {
            e.preventDefault();
            var search = document.querySelector(".search");

            var btn = document.querySelector(".submit");
            search.value = "";
            btn.click();
        });

    </script>
    @php
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    @endphp
    <script>
        //Sử lý việc nhấn vào nút phân trang khiễn trang reload lại và mất giá trị tìm kiếm
        //Ở controller sau mỗi lần submit tìm kiến, biến $search đã được giữ lại để lưu giá trị tìm kiếm
        //Bh mỗi lần ấn nút, ta sẽ chặn ko cho nút a chuyển hướng ngay, ta sẽ thực hiện thay đổi giá trị value của thẻ input hidden name = page(Chính là biến dùng để phân trang ) thành trang mà ta muốn chuyển
        //Sau đó vs biến search lưu giá trị mà ta đang tìm kiếm + value của biến page là trang mà ta muốn tới, ta click lại nút search một lần nữa
        //Tức lần này nó sẽ thực hiện tìm kiến giá trị $search tại trang là cái biến page kia đang có
        var a = document.querySelectorAll("a.page-link");
        var php_page = {{ $page }};
        a.forEach(link => link.addEventListener("click", function(e) {
            e.preventDefault();
            var page = document.querySelector(".page-item.active > .page-link") || php_page;

            page = parseInt(page.innerText) || php_page;

            var rel = link.getAttribute("rel");
            if (rel == "prev") {
                page -= 1;
            } else if (rel == "next") {
                page += 1;
            } else {
                var page = parseInt(link.innerText);
            }
            //let hidden  = document.querySelector("input[type='hidden'][name='page']");

            //Không hiểu vì lý do gì nhưng khi dùng selector là kiểu input[name='page'] thì không thể nào thay đổi value được
            let hidden = document.querySelector(".page");
            hidden.value = page;


            let btn = document.querySelector("button[name='search_submit']");
            console.log(hidden);
            btn.click();
        }));

    </script>

    <script>
        $(document).ready(function() {
            id = 0;
            $("#removeModal").on("show.bs.modal",function(event){
                var button = $(event.relatedTarget);
                console.log(button);
                id = button.data("id");
                var modal = $(this);
                link = modal.find("form").attr("action");
                modal.find("form").attr("action", link+ "/"+ id);
            });

            $("form").on("click","a.destroy",function(e){
                console.log($(this));
                // $(this).closest("form").find("input").val(id);
                $.ajax({
                    url : "/backend/Review/delete/"+id,
                    beforeSend: function(){
                        $("a.destroy").text("Deleting");
                    },
                    success: function(data){
                        console.log("success");
                        setTimeout(function(){
                            $("#removeModal").modal("show");
                            // $("table.table").DataTable().ajax.reload();
                            window.location.href = "/backend/Review"
                        },100);
                    }
                })
                // $(this).closest("form").submit();
            });
        });



    </script>
@endsection
@section('content')
    <h1>Review</h1>

    <form class="form-inline" method="get" action="{{ htmlspecialchars($_SERVER['REQUEST_URI']) }}" name="search_review">
        @php
            if (!isset($review_id)) {
                $review_id = '';
            }
        @endphp
        <div class="form-group mb-2 col-md-5">
            <input type="text" class="form-control col-md-12 search" id="search" name="search_review_name"
                placeholder="Nhập id sản phẩm" value="{{ $review_id }}">
        </div>
        <input type="hidden" name="page" class="page" value="1">
        <div class="form-group ml-3">
            <button type="submit" class="btn btn-primary mb-2 submit" name="search_submit" value="submit">Search</button>
            <div style="margin: 10px 5px;">
                <a href="#" class="clear-filler btn btn-info mb-2">Reset</a>
            </div>
        </div>

    </form>

    {{ $reviews->onEachSide(2)->links() }}

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách review</h6>
        </div>
        <div style="padding : 20px 10px; margin: 20px 10px;">
            <a href="{{ route('Review.create') }}" class="btn btn-lg btn-success">Tạo mới</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-dark table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tên</th>
                            <th>Ảnh đại diện</th>
                            <th>Nội dung</th>
                            <th>Ngày tạo</th>
                            <th>Rate</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Tên</th>
                            <th>Ảnh đại diện</th>
                            <th>Nội dung</th>
                            <th>Ngày tạo</th>
                            <th>Rate</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if (isset($reviews[0]->id) && !empty($reviews[0]->id))
                            @foreach ($reviews as $review)
                                {{-- //$review ở đây thật ra ở dạng collection, loại này phức tạp hươn mản thương có trong php
                            //Cách truy cập vào collection này cũng không hề giống truy cập mảng hay obj thông thường
                            //Thực ra ta có thể truy cập trực tiếp vào mảng arrtributes bên trong cái collection này luôn
                            //Như là bên dưới đây --}}
                                <tr>
                                    <td>{{ $review->id }}</td>
                                    <td>
                                        {{ $review->name }}

                                    </td>
                                    <td class="img-index">
                                        @if ($review->avatar)
                                            @php
                                                //Thay thế public thanh storage, vi asset chỉ truy cập vào
                                                //Thay thế public thanh storage, vi asset chỉ truy cập vào
                                                //Thay thế public thanh storage, vi asset chỉ truy cập vào
                                                // storage được thôi, còn file public kia không truy cập được
                                                $review->avatar = str_replace('public/img', 'storage/img', $review->avatar);
                                            @endphp
                                            <img src="{{ asset("$review->avatar") }}" alt="ảnh đại diện">
                                        @endif
                                    </td>
                                    <td>{!! $review->content !!}</td>
                                    <td>{{ $review->created_at }}</td>
                                    <td>{{ $review->rating }}</td>

                                    <td class="button">
                                        <button class="btn btn-block btn-danger Remove-btn" data-toggle="modal"
                                            data-target="#removeModal" data-id="{{ $review->id }}"
                                            style="margin:5px;">Xóa</button>
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
                            </tr>
                        @endif

                    </tbody>
                </table>

            </div>
            {{ $reviews->onEachSide(2)->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Xóa review này đi ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ url("/backend/Review") }}">

                        <a type="submit" class="btn btn-danger destroy">Save changes</a>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection
