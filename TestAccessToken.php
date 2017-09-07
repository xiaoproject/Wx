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
    public function sendAll()
    {
        $url = WeChatApi::getApiUrl('api_send_mass');
        $token = $this->GetAccessToken();
        $data = array('access_token' => $token);

        $json = $this->CurlPostJson($url, $data);
        return $json;

    }

}


$wechat = new TestAccessToken();
var_dump($wechat->sendAll());


//echo $wechat->GetAccessToken();