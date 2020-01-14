<?php

namespace App\Tools;

use Illuminate\Support\Facades\Cache;

class Wechat
{
        const appId = "wx862686ded89ed2cd";
        const appSerect = "5df895759d47f1ae4511f36ad8bbe960";
            
    public static  function responseText($xmlobj,$smg){
        echo "<xml>
            <ToUserName><![CDATA[".$xmlobj->FromUserName."]]></ToUserName>
            <FromUserName><![CDATA[".$xmlobj->ToUserName."]]></FromUserName>
            <CreateTime>".time()."</CreateTime>
            <MsgType><![CDATA[text]]></MsgType>
            <Content><![CDATA[".$smg."]]></Content>
        </xml>";die;
    }
    /**
     * 调用access_token
     */
    public static function getaccess_token(){
         //调用access_token接口
         $access_token = Cache::get('access_token');
         if(empty($access_token)){
             $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".Self::appId."&secret=".Self::appSerect;
            $data = file_get_contents($url);
            $data = json_decode($data,true);
            // dd($data);
            $access_token = $data['access_token'];

            Cache::put('access_token',$access_token,7200);//设置过期时间
         }
         //没有数据会添加到缓存
         return $access_token;
    }
    /**
     * 获取用户信息
     */
    public static function getUserinfoByOpenid($openid){
        $access_token = Self::getaccess_token();
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $data = file_get_contents($url);
        $data = json_decode($data,true);
        return $data;
    } 
    /*
        上传素材接口
    */
    public static function uploadmeida(){
        $access_token = Self::getaccess_token();
        $type = "image";
        $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=".$data['media_format'];
        $filePathObj = new \CURLFile(public_path()."/".$filePath);   //curl发送文件需要先通过CURKFile类
            // var_dump($filePath);die;
        $postData = ['media' => $filePathObj];
        $res = Curl::post($url,$postData);
        $res = json_decode($res,true);
    }     
}
