<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Index trả về trang chủ
    public function index(){
        return view('backend.products.index');
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
