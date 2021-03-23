<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\AdminModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware("backend_authenticate");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = DB::table('admin')->paginate(5);
        return view("backend.admin.index",compact("admin"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("backend.admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admin',
            'avatar' => 'required',
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6|same:password',
            'desc' => 'required',
        ]);
        $admin = new AdminModel();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->desc = $request->input("desc", "");
        $admin->password = Hash::make($request->input('password', "1")); //Băm mật khẩu ra rồi lưu vào db
        $admin->avatar = $request->file('avatar')->store('public/admin_img');

        $admin->save();
        return redirect(route("admin.create"))->with('status', "Tạo tài khoản admin thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $admin = AdminModel::findOrFail($id);
        return view("backend.admin.show", compact(['admin']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admin = AdminModel::findOrFail($id);
        return view("backend.admin.edit", compact(['admin']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        print_r($request->all());
        // die;/
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required_unless:confirm_password,""|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required_unless:password,""|same:password',
            'desc' => 'required',
        ]);

        $admin = AdminModel::findOrFail($id);
        if(strlen($request->input('password'))>0&&strlen($request->input('password'))<6){
            return redirect(route("admin.edit",$id))->with("error","Password must has at least 6 character");
        }
        $email = $request->input('email');
        if($email<>$admin->email){
            $mail_exist = AdminModel::where("email",$email)->count();
            if($mail_exist>=1){
                return redirect(route("admin.edit",$id))->with("error","Email address is alredy exist");
            }
        }
        if($request->hasFile("avatar")){
            Storage::delete($admin->avatar);
            $admin->avatar = $request->file("avatar")->store("public/admin_img");
        }
        if($request->hasAny("password")){
            $admin->password = Hash::make($request->input('password'));
        }
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->desc = $request->input('desc');
        $admin->save();
        // Cập nhật lên session
        $admin = DB::table('admin')->where("email",$email)->first();
        $adminLogin = [
            "id"=>$admin->id,
            "name"=>$admin->name,
            "email"=>$admin->email,
            "password"=>$admin->password,
            "avatar"=>$admin->avatar,
            "desc"=>$admin->desc
        ];
        session(["admin_login"=>$adminLogin]);
        return redirect(route("admin.edit",$id))->with("status", "Sửa thông tin thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = AdminModel::findOrFail($id);
        $admin->delete();
        return redirect(route("admin.index"))->with("status","Xóa admin thành công");
    }

    public function delete($id){
        $admin = AdminModel::findOrFail($id);
        return view("backend.admin.delete", compact(['admin']));
    }
}
