<?php

namespace App\Http\Controllers\Highchar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HighcharController extends Controller
{
    //首页
    public function index(){
        return view('highchar/index');
    }
}
