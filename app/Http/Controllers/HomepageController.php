<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware("backend_authenticate");
    // }
    //
    public function index(){
        return view("welcome");
    }
}
