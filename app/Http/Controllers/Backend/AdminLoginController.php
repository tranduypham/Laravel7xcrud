<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminLoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("backend_authenticate")->except(["login","auth"]);
    }
    public function login(){
        $session_admin_login = session('admin_login', false);//Tạo ra biên session vs gia trị default là false
        // var_dump($session_admin_login["id"]);
        // die;
        if($session_admin_login && isset($session_admin_login["id"])&& $session_admin_login["id"]>0){
            return redirect("/backend");
        }
        return view("backend.login.login");
        // dd(session("admin_login"));
        // return view("backend.login.login");
    }
    public function auth(Request $request){
        $request->validate([
            "email"=>"required",
            "password"=>"required"
        ]);

        // dd($request->all());
        $email = $request->input("email");
        $password = $request->input("password");
        $remember = $request->input("remember","");

        $admin = DB::table('admin')->where("email",$email)->first();
        if(!$admin){
            return redirect(route("admin.login"))->with("status","Email is not exist");
            // $request->session()->flash("status","Username is not exist");
            // return redirect(route("admin.login"));
        }
        
        if(isset($admin->id)&&$admin->id>0&&Hash::check($password, $admin->password)){
            $adminLogin = [
                "id"=>$admin->id,
                "name"=>$admin->name,
                "email"=>$admin->email,
                "password"=>$admin->password,
                "avatar"=>$admin->avatar,
                "desc"=>$admin->desc
            ];
            session(["admin_login"=>$adminLogin]);//De xac nhan da dang nhap//Set gia trị cho session
            // session("admin_login",$adminLogin);//SAI Cai nay viet sai

            // Chuc nang rememberme
            if($remember=="on"){
                $minute = 3600*30;
                $cookieValue = Hash::make($admin->id.$admin->email.$admin->password);
                DB::table('admin')->where("id",$admin->id)->update(["remember_token"=>$cookieValue]);
                // $cookie = cookie("admin_login_remember",$cookieValue,$minute);
                Cookie::queue(Cookie::make("admin_login_remember",$cookieValue,$minute));
            }

            // Quay ve trang chu
            // return redirect("/")->cookie($cookie);//cookies tạo ra phải được gắn vào cái return này thì mới được gửi về cho người dùng
            return redirect("/backend");
        }else{
            return redirect(route("admin.login"))->with("status","Wrong Username or Password");
        }
    }
    public function logout(Request $request){
        // Xoa cookie di (neu co)
        // cookie("admin_login_remember","",-3600);
        Cookie::queue(Cookie::forget("admin_login_remember"));
        // Cookie::forget("admin_login_remember");
        // Xoa session di
        $request->session()->forget(["admin_login"]);
        $request->session()->flush();
        return redirect(route("admin.login"));
    }
}
