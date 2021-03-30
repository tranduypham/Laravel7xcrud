<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("backend_authenticate");
    }
    public function index(Request $request)
    {
        $blogs = DB::table('blog');
        $search_blog_name = $request->input('search_blog_name', "");
        if ($request->hasAny("search_blog_name")) {
            $blogs = $blogs->where("name", "like", "%$search_blog_name%");
        }
        $blogs = $blogs->paginate(10);
        return view("backend.Blog.index", compact(['blogs', 'search_blog_name']));
    }
    public function create()
    {
        return view("backend.Blog.create");
    }
    public function store(Request $request)
    {
        $request->validate([
            "blog_name" => "required",
            "blog_image" => 'required',
            "blog_desc" => 'required',
            "blog_intro" => 'required',
        ]);
        $state = DB::table('blog')->insert([
            'name' => $request->input("blog_name"),
            'thumbnail' => $request->file('blog_image')->store("public/img_blog_thumb"),
            'slug' => $request->input("blog_slug", ""),
            'content' => $request->input("blog_desc", ""),
            'intro' => $request->input("blog_intro"),
        ]);
        return redirect(route("blog.index"))->with("status", "Tạo thành công");
    }

    public function show($id)
    {
        $blog = DB::table('blog')->find($id);
        return view("backend.Blog.show", compact(['blog']))->render();
    }
    public function edit($id)
    {
        $blog = DB::table('blog')->find($id);
        return view("backend.Blog.edit", compact(['blog']));
    }
    public function update($id, Request $request)
    {
        $request->validate([
            "blog_name" => "required",
            "blog_desc" => 'required',
            "blog_intro" => 'required',
        ]);
        DB::table('blog')->where("id",$id)->update([
            'name' => $request->input("blog_name"),
            'slug' => $request->input("blog_slug"),
            'intro' => $request->input("blog_intro"),
            'content' => $request->input("blog_desc"),
        ]);
        if ($request->hasFile("blog_image")) {
            $blog = DB::table('blog')->find($id);
            $path = $blog->thumbnail;
            Storage::delete($path);
            DB::table('blog')->where("id",$id)->update([
                'thumbnail' => $request->file("blog_image")->store("public/img_blog_thumb"),
            ]);
        }
        return redirect(route("blog.index"))->with("status","Sửa thành công");
    }
    public function delete($id)
    {

        return redirect(route("blog.destroy",$id));
    }
    public function destroy($id)
    {
        $bool = DB::table('blog')->where("id",$id)->delete();
        if($bool){
            return redirect(route("blog.index"))->with("status","Xóa thành công");
        }
        return redirect(route("blog.index"))->with("status","Xóa không thành công");
    }
}
