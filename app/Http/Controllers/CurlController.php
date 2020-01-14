<?php


    $access_token = "29_2UlEP1FhYVMO3os3PoLXaKKtzeCgq99D4v95hThtPTRz2AB1RKSjdU9FKcE2WzjwdyywEXU0oGI12o_iKImT2QziJfgdNrw6vbvfpcacUw6VsOLfw7WEEsijb7kKtam9yFJU1CqKzKvtJuPFHFKcAFABZE";
    $url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type=image";

    //发送请求post
    $img = "D:\\phpstudy_pro/1.PNG";
    $img  = new \CURLFile($img);
    $postData['media'] = $img;
    $res = curlPost($url,$postData);
    var_dump($res);die;
    function curlPost($url,$postData){
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);//设置请求地址
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);//返回数据格式
        curl_setopt($curl,CURLOPT_POST,1);//设置以post发送
        curl_setopt($curl,CURLOPT_POSTFIELDS,$postData);//设置post发送的数据
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);//关闭HTTPS验证
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, false);//关闭https验证
        $output =curl_exec($curl);
        curl_close($curl);
        return $output;
    }

