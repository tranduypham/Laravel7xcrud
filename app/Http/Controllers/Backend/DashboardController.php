<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware("backend_authenticate");
    }
    // Index trả về trang chủ
    public function index(){
        $countProduct = DB::table('products')->count();
        $countCatagories = DB::table('catagory')->count();
        $countOrder = DB::table('orders')->count();
        $countAdmin = DB::table('admin')->count();
        return view('backend.dashboard.home',compact(["countProduct","countCatagories","countOrder","countAdmin"]));
    }
    //end of Index

    // Create
    public function create(){
        return view("backend.products.create");
    }
    //end of Create

    // delete
    public function delete(){
        return view("backend.products.delete");
    }
    //end of Delete

    // Edit
    public function edit(){
        return view("backend.products.edit");
    }
    //end of Edit

}
