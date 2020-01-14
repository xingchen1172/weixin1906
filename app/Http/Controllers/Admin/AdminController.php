<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //后台首页
    public function index(){
        return  view('admin/index');
    }
    //后台首页拓展
    public function index_v1(){
        return view('admin/index_v1');
    }

}
