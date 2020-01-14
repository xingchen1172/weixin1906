<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\News;
use App\Tools\Wechat;
use App\Http\Controllers\CurlController;
use App\Model\Ticket;

class IndexController extends Controller
{
    //添加首页
    public function index(){
        return view('ceshi/index/index');
    }
    //添加方法
    public function add_do(){
        $post = request()->except('_token');
        $res = News::create($post);
        // var_dump($res);die;
        if($res){
           echo  "<script>alert('添加成功');location='/index/list'</script>";
        }else{
           echo  "<script>alert('添加失败');location='/index/index'</script>";
        }
    }
    //展示
    public function list(){
        $title = request()->title;
        $zuozhe = request()->zuozhe;
        $where=[];
        if($title){
            $where[] = ['new_title','like',"%$title%"];
        }
        if($zuozhe){
            $where[] = ['new_zuozhe','like',"%$zuozhe%"];
        }
        $data = News::where($where)->paginate(3);
        //  dd($data);
        $query = request()->all();
        return view('ceshi/index/list',['data'=>$data,'query'=>$query]);
    }
    //删除
    public function del($new_id){
        $res = News::where('new_id',$new_id)->delete();
        if($res){
            echo  "<script>alert('删除成功');location='/index/list'</script>";
         }else{
            echo  "<script>alert('删除失败');location='/index/list'</script>";
         }
    }
    //修改
    public function upd($new_id){
        $data  = News::where('new_id',$new_id)->first();
        return view('ceshi/index/upd_do',['data'=>$data]);
    }
    //修改页面
    public function upd_do($new_id){
        $data = request()->all();
        unset($data['_token']);
        $where=['new_id'=>$new_id];
        $res=News::where($where)->update($data);
        if($res){
            echo "<script>alert('修改成功');location='/index/list'</script>";
        }else{
            echo "<script>alert('修改失败');location='/index/list'</script>";            
        }
    }
    //微信
    public function weixin(){
        // $echostr = $_GET['echostr'];
        // echo $echostr;die;
        $xml = file_get_contents("php://input");
        file_put_contents('weixin.txt',"\n".$xml."\n",FILE_APPEND);
        $xmlObj = simplexml_load_string($xml);
        

        if($xmlObj->MsgType == "event" && $xmlObj->Event == "subscribe"){
            // echo 123;
            $access_token = Wechat::getaccess_token();
            // echo $access_token;die;
            $data = Wechat::getUserinfoByOpenid($xmlObj->FromUserName);
            //    dd($data);
            //得到渠道标识
            // $eventKey = $xmlobj->EventKey;//截取字符串
            //  var_dump($data);die;

            $channel_status = $data['qr_scene_str'];
            // dd($data);
            //根据渠道标识,关注人数递增
            Ticket::where(['channel_status'=>$channel_status])->increment('num');

            // dd($res);

            $sex = $data['sex']==1?'先生':'女士';
        // echo $a;die;
            Wechat::responseText($xmlObj,"欢迎".$data['nickname'].$sex."关注");
        }
        //if($xmlObj->MsgType == 'event' && $xmlObj->Event == "unsubscribe"){
        //    $data = Wechat::getUserinfoByOpenid($xmlObj->FromUserName);
        //    // dd($data);
        //    $channel_status = $data['qr_scene_str'];
        //    Ticket::where(['channel_status'=>$channel_status])->decrement('num');
//
        //}
        $Content = trim($xmlObj->Content);

        if($xmlObj->MsgType == 'text'){
            if( $Content == "最新新闻"){
                $newText = News::orderBy('new_id','desc')->first();
                $msg = "最新新闻  :"."\n" . "标题是 :".$newText['new_title']."\n"."内容是 :".$newText['new_desc']."\n"."编辑作者 :".$newText['new_zuozhe'];
                // dd($msg);
                Wechat::responseText($xmlObj,$msg);
            }elseif(mb_strpos($Content,"新闻+") !== false){
                $news = ltrim($Content,"新闻+");
                // dd($news);
                if(empty($news)){
                    $news = "体育";
                }
                // dd($news);
                $sql = News::where('new_title','like',"%$news%")->get()->toArray();
                // dd($sql);
                $msg = "新闻标题 :".$sql[0]['new_title']."\n"."新闻内容 :".$sql[0]['new_desc']."\n"."编辑作者".$sql[0]['new_zuozhe'];
                Wechat::responseText($xmlObj,$msg);
            }

        }
    }


    //带参数的二维码
    public function ticket(){
        $access_token = Wechat::getaccess_token();
        $xml = file_get_contents("php://input");
        file_put_contents('weixin.txt',"\n".".$xml."."\n",FILE_APPEND);
        $xmlObj = simplexml_load_string($xml);
        //echo $access_token;die;
        // $url = "https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=".$access_token;
        //dd($url);
        //$postData = '{"expire_seconds": 604800, "action_name": "QR_STR_SCENE", "action_info": {"scene": {"scene_str": "test"}}}';
        // dd($postData);
        // $res = CurlController::curlPost($url,$postData);
        $data = Wechat::getUserinfoByOpenid($xmlObj->FromUserName);
        var_dump($data);die;
    }


}
