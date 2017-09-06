<?php
define("TOKEN", "weixin");
include dirname(__FILE__) . "/media.php";
include dirname(__FILE__) . "/Lib/WeChatApi.class.php";
include dirname(__FILE__) . "/Lib/WeChat.class.php";

class WxApi extends Wechat
{
    public function responseMsg()
    {
        parent::responseMsg();

        // return text
        if ($this->keyword == '文本') {
            $this->reText('this is return text');
            die();
        }

        // return image
        if ($this->keyword == '图片') {
            $this->reImage('wwIghrIMBFi1MKlngdObk5_kXR9XyFNVSytscZkyth4FzwcSnxZ_QBNnVCh5ubm9');
            die();
        }

        if ($this->sendType = 'location') {
            $lat = $this->lat; // 纬度
            $lng = $this->lng; // 经度
//            $this->reText('$lng:'.$lng);
//            die();

            // 获取地址
            $lbs_url = ThirdApi::getApiFromLBS($lat, $lng);
            $this->reText('$lbs_url:'.$lbs_url);
            die();

            // 使用curl的get方式获取json数据
            $jsonStr = $this->CurlRequest($lbs_url);

            // assoc: true 返回数组 默认返回对象
            $arr = json_decode($jsonStr, true);

            $formatted_address = $arr['status'];

            $this->reText('status:'.$formatted_address);
            die();
        }
    }

}

$WxApi = new WxApi();
$WxApi->valid();
$WxApi->responseMsg();