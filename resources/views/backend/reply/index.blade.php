@extends('backend.layouts.main')

@section('title', 'Reply')

@section('content')
    <h1>Danh sách tin nhắn</h1>


    {{ $reply->onEachSide(2)->links() }}

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="card shrepow mb-4">
        <div class="card-hereper py-3">
            <h6 class="m-0 font-weight-bold text-primary">Reply</h6>
        </div>
        {{-- <div style="prepding : 20px 10px; margin: 20px 10px;">
        <a href="{{route("reply.create")}}" class="btn btn-lg btn-success">Thêm reply </a>
    </div> --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-dark table-hover" id="dataTable" width="100%" cellspacing="0">
                    <therep>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Tiêu đề</th>
                            <th>Tin nhắn</th>
                            <th>Hành động</th>
                        </tr>
                    </therep>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Email</th>
                            <th>Tiêu đề</th>
                            <th>Tin nhắn</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if (isset($reply[0]->id) && !empty($reply))
                            @foreach ($reply as $rep)
                                {{-- //$product ở đây thật ra ở dạng collection, loại này phức tạp hươn mản thương có trong php
                            //Cách truy cập vào collection này cũng không hề giống truy cập mảng hay obj thông thường
                            //Thực ra ta có thể truy cập trực tiếp vào mảng arrtributes bên trong cái collection này luôn
                            //Như là bên dưới đây --}}
                                <tr>
                                    <td>{{ $rep->id }}</td>
                                    <td>{{ $rep->email }}</td>
                                    <td>{{ $rep->subject }}</td>
                                    <td>{{ $rep->message }}</td>

                                    <td class="button">
                                        <a href="{{ route('Liquid.reply.show', $rep->id) }}"
                                            class="btn btn-block btn-warning reply" style="margin:5px;">Reply</a>
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
                            </tr>
                        @endif

                    </tbody>
                </table>

            </div>
            {{ $reply->onEachSide(2)->links() }}
        </div>
    </div>
    <div class="back-reply">
        <div class="reply-modal">
            <form action="{{ route('Liquid.reply') }}">
                <div>
                    <label>Tên :</label>
                    <span id="name"></span>
                </div>
                <div>
                    <label>Tin nhắn :</label>
                    <p id="message"></p>
                </div>
                <input type="hidden" name="id">
                <div>
                    <label>Trả lời :</label>
                    <textarea name="reply" id="reply" cols="30" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary reply"> Reply </button>
                <button class="btn btn-info cancle"> Cancle </button>
            </form>
        </div>
    </div>
    <style>
        .back-reply {
            position: fixed;
            background-color: rgba(0, 0, 0, 0.301);
            width: 100vw;
            height: 100vh;
            top: 0;
            left: 0;
            /* display: flex; */
            justify-content: center;
            /* flex-direction: column; */
            align-items: flex-start;
            opacity: 0;
            display: none;
            z-index: 99;
            transition: opacity 0.15s linear;
        }

        .reply-modal {
            margin-top: 5%;
            background-color: white;
            /* position: fixed !important;
                    top: 30px;
                    left: 50%; */
            display: inline-block;
            border-radius: 20px;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.336);
            padding: 20px;
            /* border: 1px solid black; */
            position: relative;
        }

        .reply-modal div {
            margin: 10px;
        }

        .reply-modal textarea {
            display: block;
        }

        .fade-in {
            display: flex;
            opacity: 1;
            animation: fadeIn 0.1s linear;
        }

        @keyframes fadeIn {
            0% {
                display: flex;
                opacity: 0;
            }

            100% {
                display: flex;
                opacity: 1;
            }
        }

    </style>
@endsection

@section('appendjs')
    <script>
        $(document).ready(function() {
            $("a.reply").on("click", function(e) {
                e.preventDefault();
                path = $(this).attr("href");
                $.get(path, function(data) {
                    console.log(data[0]);
                    name = data[0].name;
                    message = data[0].message;
                    id = data[0].id;
                    $("span#name").text(name);
                    $("p#message").text(message);
                    $("input[name='id']").val(id);
                    $(".back-reply").addClass("fade-in");
                });
            });

            $("button.cancle").on("click", function(e) {
                e.preventDefault();
                $(".back-reply").removeClass("fade-in");
            });

            $("button.reply").on("click", function(e) {
                text = $(this).closest("form").find("textarea").val();
                console.log(text);
                if(text==""){
                    e.preventDefault();
                }

            });
        });

    </script>
@endsection
