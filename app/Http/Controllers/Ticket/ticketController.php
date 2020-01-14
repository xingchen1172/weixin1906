<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\CurlController;
use App\Tools\Wechat;
use App\Tools\Curl;
use App\Model\Ticket;

class ticketController extends Controller
{
    //带参数的二维码添加
    public function add()
    {
        return  view('ticket/add');
    }
    //带参数的二维码添加方法
    public function add_do()
    {
        $channel_name = request()->input('channel_name');
        $channel_status = request()->input('channel_status');
        // echo $channel_status;
        // dd($channel_name);
        $access_token = Wechat::getaccess_token();
        // dd($access_token);
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$access_token;
        $postData = '{"expire_seconds": 2592000, "action_name": "QR_STR_SCENE", "action_info": {"scene": {"scene_str": "'.$channel_status.'"}}}';
        // dd($postData);
        $res = Curl::post($url,$postData);
        // dd($res);
        $res = json_decode($res,true);
        // dd($data);
        $ticket = $res['ticket'];
        // dd($ticket);
        //入库
        $res = Ticket::create([
            'channel_name' => $channel_name,
            'channel_status' =>$channel_status,
            'ticket' =>$ticket
        ]);
        if($res){
            echo "<script>alert('添加成功');location='/ticket/list'</script>";
        }else{
            echo "<script>alert('添加失败');location='/ticket/add'</script>";
        }
    }
    //展示
    public function list()
    {
        $data = Ticket::paginate(2);
        return view('ticket/list',['data'=>$data]);
    }
}
