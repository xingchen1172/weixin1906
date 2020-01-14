<?php

namespace App\Http\Controllers\Wechat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Wechat;

class WechatController extends Controller
{
    public function index(){
        $status = ['刨尸狗','黑狐','陈老狗','陈小狗','柱子','夜魔大叔','大刚','灰','赤龙','夜枭','烛龙','大个','白狼王'];
        // $echostr = $_GET['echostr'];
        // echo $echostr;die;

        $xml = file_get_contents("php://input");
        //写文件里
        file_put_contents('wx.txt',"\n".$xml."\n",FILE_APPEND);

        $xmlobj = simplexml_load_string($xml);

        //回复消息
        //输出xml数据
        // $FromUserName = $xmlobj->FromUserName;
        // $ToUserName = $xmlobj->ToUserName;
        $Content = trim($xmlobj->Content);
        // $MsgType = $xmlobj->MsgType;

        if($xmlobj->MsgType == 'event' && $xmlobj->Event == 'subscribe'){
            
            $access_token = Wechat::getaccess_token();
            // dd($access_token);
            // echo $access_token;die;
            $data = Wechat::getUserinfoByOpenid($xmlobj->FromUserName);
            // dd($data);
            
            // var_dump($eventKey);die;

            Wechat::responseText($xmlobj,"谢谢".$data['nickname']."关注");
        }


        if($xmlobj->MsgType == 'text'){
            if($Content==1){
                $class = implode(',',$status);
                Wechat::responseText($xmlobj,$class);
            }elseif($Content==2){
                $array = array_rand($status,1);
                $mgs = $status[$array];
                Wechat::responseText($xmlobj,$mgs);
            }elseif(mb_strpos($Content,"天气") !== false){
                //回复天气
                $city = rtrim($Content,"天气");
                if(empty($city)){
                    $city = "北京";
                }
            
                $url = "http://api.k780.com:88/?app=weather.future&weaid=".$city."&&appkey=47862&sign=77e5cafd46151efd3e96cbad7ad704bf&format=json";
                $data = file_get_contents($url);
            
                $data = json_decode($data,true);
                $msg = "";
                foreach($data['result'] as $key=>$value){
                    $msg .= $value['days'] . " ".$value['week'] ." ".$value['citynm']."".$value['temperature']."\n";  
                }
                Wechat::responseText($xmlobj,$msg);
            }else{
                Wechat::responseText($xmlobj,$Content);
            }
        }
    
   }
  

   

}
