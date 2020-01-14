<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Wechat;
use App\Tools\Curl;
use App\Model\Media;

class MediaController extends Controller
{
    //素材添加
    public function add(){
        return view('media/add');
    }
    //
    public function add_do(request $request){
       //接值
        $data = $request->input();
       //文件上传
        $file = $request->file;
        $ext = $file->getClientOriginalExtension();
        $filename = md5(uniqid()).".".$ext;
        $path = $request->file->storeAs('images',$filename);
       //调节扣
       $access_token = Wechat::getaccess_token();
       $type = "image";
       $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=".$data['media_format'];
       $filePathObj = new \CURLFile(public_path()."/".$path);   //curl发送文件需要先通过CURKFile类
           // var_dump($filePath);die;
       $postData = ['media' => $filePathObj];
       $res = Curl::post($url,$postData);
       $res = json_decode($res,true);
       //入库
       if(isset($res['media_id'])){
        $media_id = $res['media_id'];  //微信返回的素材id
        Media::create([
             'media_name'=>$data['media_name'],
             'media_format'=>$data['media_format'],
             'media_type'=>$data['media_type'],
             'media_url'=>$path,
             'wechat_media_id'=>$media_id,
             'add_time'=>time(),
        ]);
    }
}
    //素材展示
    public function show(){
        return view('media/show');
    }
}
