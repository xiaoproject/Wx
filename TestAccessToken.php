<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/7
 * Time: 19:28
 */
include_once dirname(__FILE__) . '/Lib/WeChat.class.php';

class TestAccessToken extends WeChat
{
    public function send()
    {
        $data = '{
           "touser":[
            "oGZlvw6Ypt__9HwdT6Sl5Vgh3_gQ",
            "oGZlvw3Nvl4FTrUjgiwxowXKe_HU",
            "oGZlvww4QEf4mxY4C7WScZv2EzjM"
           ],
           "msgtype":"text"，
            "text": { "content": "hello !! is me"}
        }';
        return $this->sendMess($data);

    }

}


$wechat = new TestAccessToken();

var_dump($wechat->send())
//echo $wechat->GetAccessToken();