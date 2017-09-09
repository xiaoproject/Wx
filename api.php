<?php
define("TOKEN", "weixin");
include dirname(__FILE__) . "/media.php";
include dirname(__FILE__) . "/Lib/WeChatApi.class.php";
include dirname(__FILE__) . "/Lib/WeChat.class.php";
include dirname(__FILE__) . "/Lib/ThirdApi.class.php";
include dirname(__FILE__) . "/DB.class.php";

class WxApi extends Wechat
{
    public function responseMsg()
    {
        parent::responseMsg();

        if ($this->keyword == '你好' || $this->keyword == '您好') {
            $this->CustomerReText('亲， 有什么可以帮助您吗？');
            $this->reText();
            die();
        }

        if ($this->keyword == '美女') {
            $data = $this->getNews('girl');
            $this->CustomerReImgText($data);
            die();
        }


    }

}

$WxApi = new WxApi();
// 通过验证之后，需要把这个关闭
// $WxApi->valid();
$WxApi->responseMsg();