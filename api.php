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
        if ($this->keyword == 'text') {
            $this->reText('this is return text');
            die();
        }

        // return image
        if ($this->keyword == 'image') {
            $this->reImage('wwIghrIMBFi1MKlngdObk5_kXR9XyFNVSytscZkyth4FzwcSnxZ_QBNnVCh5ubm9');
            die();
        }
    }

}

$WxApi = new WxApi();
$WxApi->valid();
$WxApi->responseMsg();