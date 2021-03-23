<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Backend\ReplyModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\ReplyEmail;
use Illuminate\Support\Facades\Mail;


class ReplyController extends Controller implements ShouldQueue
{
    //
    public function __construct()
    {
        $this->middleware("backend_authenticate");
    }
    public function index(){
        $reply = DB::table('reply')->where('status',0)->orderBy("created_at","asc")->paginate(20);
        return view("backend.reply.index",compact(['reply']));
    }

    public function show($id){
        $reply = DB::table('reply')
            ->where('id',$id)
            ->get();
        return response()->json($reply, 200);
    }

    public function reply(Request $request){
        // dd($request->all());
        $reply = ReplyModel::findOrFail($request->input("id"));

        $user = [];
        $user["name"] = $reply->name;
        $user["reply"] = $request->input("reply");

        // Guwir mail
        $mail = new ReplyEmail($user);
        Mail::to($reply->email)->send($mail);

        $reply->status = 1;
        $reply->save();
        
        return redirect(route("Liquid.reply.index"));
    }
}
