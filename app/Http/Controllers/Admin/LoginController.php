<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Login;

class LoginController extends Controller
{
    //后台登录首页
    public function index(){
        return view('login/index');
    }
    //登录方法
    public function save(){
        // echo "aaa";die;
        $post = request()->except('_token');
        // dd($post);
        $data = Login::first();
        // echo "<hr>";
        // dd($data);
        if($post['username'] !== $data['username']){
            echo "<script>alert('用户名错误');location='/login/index'</script>";
        }elseif($post['pwd']!==$data['pwd']){
            echo "<script>alert('密码错误');location='/login/index'</script>";
        }else{
            echo "<script>alert('登陆成功');location='/admin/index'</script>";
        }
    }
}
