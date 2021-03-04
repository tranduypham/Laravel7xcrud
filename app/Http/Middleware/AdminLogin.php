<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // echo cookie("admin_login_remember");
        // die;
        // return $next($request);
        // $admin_login_remember = $request->cookie("admin_login_remember");
        // $session_admin_login = session("admin_login");
        // if($admin_login_remember){
        //     $adminCookie = DB::table('admin')->where("remember_token",$admin_login_remember)->first();
        //     if(isset($adminCookie->id)&&$adminCookie->id>0){
        //         // echo "cookie";
        //         // die;
        //         return $next($request);
        //     }
        // }
        // if(!$session_admin_login){
        //     // echo "no session";
        //     // die;
        //     return redirect(route("admin.login"));
        // }
        // // echo "?";
        // // die;
        // return $next($request);
        $cookieClient = Cookie::get("admin_login_remember");
        $sessionLogin = session("admin_login");
        if($cookieClient){
            $cookie = DB::table('admin')->where("email",$request->input("email"))->first();
            if($cookie==$cookieClient){
                return $next($request);
            }

        }
        if($sessionLogin){
            if(isset($sessionLogin["id"])&&$sessionLogin["id"]>0){
                return $next($request);
            }
            
        }
        return redirect(route("admin.login"));
    }
}
