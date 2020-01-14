<?php

namespace App\Http\Controllers\Mane;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Wechat;
use  App\Tools\Curl;

class ManeController extends Controller
{
    //菜单
    public function mane()
    {
        $access_token = Wechat::getaccess_token();
        // var_dump($access_token);die;
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;  
       
        $postData = [
            
                "button" => [
                [	
                     "type" => "click",
                     "name" => "投票",
                     "key" => "V1001_TODAY_MUSIC"
                ],
                 ]
            
        ];
        $postData = json_encode($postData,JSON_UNESCAPED_UNICODE);
        $post = Curl::post($url,$postData);
        $res = json_decode($post,true);
        var_dump($res);
    }
    //根据openid群发
    public function index_openid(){
        $access_token = Wechat::getaccess_token();
        $openid_list = [
            "oGdUGt9uVDi-2xmMC_axw47bNs5E",
            "oGdUGt-eQ7fOHGowyVmzkcLkSYnI"
        ]; 
        $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=".$access_token;


    }
    
}
