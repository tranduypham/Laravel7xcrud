@extends('backend.layouts.main')

@section('title', 'Tạo blog mới')

@section('content')

    <h2>Nhập thông tin blog</h2>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>
        </div>
    @endif

    <form action="{{ route('blog.store') }}" method="post" name="blog" enctype="multipart/form-data">
    @csrf
    <a class="text-primary" href="{{ route("blog.index") }}">Quay về trang chủ</a>
    <div class="form-group">
        <label for="blog_name">Tiêu đề blog :</label>
        <input type="text" class="form-control" id="blog_name" placeholder="Nhập tên" name="blog_name"
            value="{{ old('blog_name', '') }}">
        @error('blog_name')
            <div class="text-dange">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="blog_image">Hình ảnh thumbnail :</label>
        <input type="file" class="form-control" id="blog_image" placeholder="Nhập link" name="blog_image">
        @error('blog_image')
            <div class="text-dange">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="blog_slug">Slug:</label>
        <input type="text" class="form-control" id="blog_slug" placeholder="Nhập slug" name="blog_slug"
            value="{{ old('blog_slug', '') }}">
        @error('blog_slug')
            <div class="text-dange">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="blog_intro">Lời tựa:</label>
        {{-- <input type="text" class="form-control" id="blog_slug" placeholder="Nhập slug" name="blog_intro"
            value="{{ old('blog_intro', '') }}"> --}}
        <textarea name="blog_intro" class="form-control" id="blog_intro" cols="30"
        rows="10">{!! old('blog_intro', '') !!}</textarea>
        @error('blog_slug')
            <div class="text-dange">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <label for="blog_desc">Miêu tả danh mục:</label>
        <textarea name="blog_desc" class="form-control editorjs" id="editorjs" cols="30"
            rows="30">{!! old('blog_desc', '') !!}</textarea>
    </div>
    <button type="submit" class="btn  btn-lg btn-info" id="btn-load">Submit</button>
    <a class="btn btn-lg btn-primary" href="{{ route("blog.index") }}">Quay về trang chủ</a>

    </form>
@endsection

@section('appendjs')
    <script src="{{ asset('be-asset/startbootstrap-sb-admin-2-gh-pages/js/tinymce/tinymce.min.js') }}"></script>
    <script>
        var editor_config = {
            path_absolute: "/",
            selector: '#editorjs',
            relative_urls: false,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar: ['undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify , outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview | insertfile image media template codesample | ltr rtl'],
            
            toolbar_sticky: true,
            file_picker_callback: function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName(
                    'body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);

    </script>

@endsection
