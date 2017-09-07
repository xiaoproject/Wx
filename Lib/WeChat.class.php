<?php
include_once dirname(__FILE__) . '/WeChatApi.class.php';

class WeChat
{
    //客户端的openId
    protected $fromUsername;
    //服务器的id
    protected $toUsername;
    //客户端上传的信息
    protected $keyword;
    //客户端上传的类型
    protected $sendType;
    //订阅类型或者菜单CLICK事件推送
    protected $Event;
    //菜单事件推送的EventKey
    protected $EventKey;
    //语音内容
    protected $Recognition;
    protected $lat;
    protected $lng;
    protected $time;

    public function CurlRequest($url, $data = null)
    {
        // 1. 生成浏览器
        $ch = curl_init();

        // 2. 设置浏览器
        // 为能够成功调用微信api所设，而且必须放在第1个设置项 ，安全上传
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        // 访问地址
        curl_setopt($ch, CURLOPT_URL, $url);
        // 希望请求成功后 XX以html文档流(html字符串的形式)返回
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 告诉微信当前curl禁用ssl当中的公用名,公用名只有两种值0表没有，1表示拥有，默认为1
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //告诉微信因为没有ssl所有不要进行认证的校验
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        //如果data不为null那么就使用post请求
        if (!empty($data)) { // post请求
            @curl_setopt($ch, CURLOPT_POST, true);
            @curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        // 3. 执行
        $str = curl_exec($ch);
        // 4. 关闭浏览器
        curl_close($ch);

        //把请求的数据进行返回
        return $str;
    }

    public function CurlPostJson($url, $data = null)
    {
        // 1. 生成浏览器
        $ch = curl_init();

        // 2. 设置浏览器
        // 为能够成功调用微信api所设，而且必须放在第1个设置项 ，安全上传
        curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
        // 访问地址
        curl_setopt($ch, CURLOPT_URL, $url);
        // 希望请求成功后 XX以html文档流(html字符串的形式)返回
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // 告诉微信当前curl禁用ssl当中的公用名,公用名只有两种值0表没有，1表示拥有，默认为1
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //告诉微信因为没有ssl所有不要进行认证的校验
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // 转换json
        $data = json_encode($data);
        // 获取长度
        $length = strlen($data);
        // 添加数据
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-type:application/json',
            'Content-length:' . $length
        ));

        @curl_setopt($ch, CURLOPT_POST, true);
        @curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        // 3. 执行
        $str = curl_exec($ch);
        // 4. 关闭浏览器
        curl_close($ch);
        //把请求的数据进行返回
        return $str;
    }


    /**
     * 获取Access_token
     */
    public function GetAccessToken()
    {
        // 获取url
        $url = WeChatApi::getApiUrl('api_access_token');
        // 使用get方法对Api进行请求
        $str = $this->CurlRequest($url);
        // 转换为json对象
        $json = json_decode($str);
        // 返回access_token
        return $json->access_token;
    }

    //自动回复(此方法必须覆盖)
    public function responseMsg()
    {
        $dataFromClient = empty($GLOBALS["HTTP_RAW_POST_DATA"]) ? file_get_contents('php://input') : $GLOBALS["HTTP_RAW_POST_DATA"];
        if (!empty($dataFromClient)) {
            $postObj = simplexml_load_string($dataFromClient, 'SimpleXMLElement', LIBXML_NOCDATA);
            $this->fromUsername = $postObj->FromUserName;
            $this->toUsername = $postObj->ToUserName;
            $this->keyword = trim($postObj->Content);
            $this->sendType = trim($postObj->MsgType);
            $this->Event = trim($postObj->MsgType) == 'event' ? $postObj->Event : '';
            $this->Recognition = trim($postObj->MsgType) == 'voice' ? $postObj->Recognition : '语音内容无法识别';
            $this->EventKey = $postObj->Event == 'CLICK' ? $postObj->EventKey : '';
            $this->lat = trim($postObj->MsgType) == 'location' ? $postObj->Location_X : '';
            $this->lng = trim($postObj->MsgType) == 'location' ? $postObj->Location_Y : '';
            $this->time = time();
        }
    }

    // 文本回复接口
    protected function reText($contentStr)
    {
        $resultStr = sprintf(WeChatApi::getMsgTpl('text'), $this->fromUsername, $this->toUsername, $this->time, 'text', $contentStr);
        echo $resultStr;
    }

    // 图片回复接口
    protected function reImage($MediaId)
    {
        $resultStr = sprintf(WeChatApi::getMsgTpl('image'), $this->fromUsername, $this->toUsername, $this->time, 'image', $MediaId);
        echo $resultStr;
    }

    // 音乐回复接口
    protected function reMusic($title, $desc, $url, $hqurl)
    {
        $resultStr = sprintf(WeChatApi::getMsgTpl('music'), $this->fromUsername, $this->toUsername, $this->time, 'music', $title, $desc, $url, $hqurl);
        echo $resultStr;
    }

    protected function reNews($items)
    {
        $count = count($items);
        $item = $this->createNewsItems($items);
        $resultStr = sprintf(WeChatApi::getMsgTpl('news'), $this->fromUsername, $this->toUsername, $this->time, 'news', $count, $item);
        echo $resultStr;
    }

    private function createNewsItems($items)
    {
        foreach ($items as $data) {
            $item .= "<item>
			<Title><![CDATA[{$data['Title']}]]></Title> 
			<Description><![CDATA[{$data['Desc']}]]></Description>
			<PicUrl><![CDATA[{$data['PicUrl']}]]></PicUrl>
			<Url><![CDATA[{$data['Url']}]]></Url>
			</item>";
        }
        return $item;
    }

    protected function reSubscribe($contentStr)
    {
        $this->reText($contentStr);
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if ($tmpStr == $signature) {
            return true;
        } else {
            return false;
        }
    }

    protected function CustomerReText($Text)
    {
        $access_token = $this->GetAccessToken();
        $fromUsername = $this->fromUsername;
        $url = WeChatApi::getApiUrl('api_customer_send');
        $url .= $access_token;
        $content = urlencode($Text);
        $data = array(
            "touser" => "{$fromUsername}",
            "msgtype" => "text",
            "text" => array(
                "content" => $content,
            ),
        );
        $data = json_encode($data);
        $data = urldecode($data);
        $this->CurlRequest($url, $data);
        exit();
    }

    protected function CustomerReImgText($ImgText)
    {
        $access_token = $this->GetAccessToken();
        $fromUsername = $this->fromUsername;
        $url = WeChatApi::getApiUrl('api_customer_send');
        $url .= $access_token;
        $set = array();
        foreach ($ImgText as $rs) {
            $content = null;
            $content = array(
                "title" => urlencode($rs['title']),
                "description" => urlencode($rs['desc']),
                "url" => $rs['url'],
                "picurl" => $rs['picurl'],
            );
            $set[] = $content;
        }
        $data = array(
            "touser" => "{$fromUsername}",
            "msgtype" => "news",
            "news" => array(
                "articles" => $set,
            ),
        );
        $data = json_encode($data);
        $data = urldecode($data);
        $this->CurlRequest($url, $data);
        exit();
    }

    public function codeTransAccessInfo($code = null)
    {
        if (isset($code)) {
            $url = WeChatApi::getApiUrl('api_get_access_info');
            $url .= $code;
            $str = $this->CurlRequest($url);
            $access_info = json_decode($str, true);
            return $access_info;
        } else {
            exit("Error:must TransCode.");
        }
    }

    public function SendMass($data)
    {
        $access_token = $this->GetAccessToken();
        $url = WeChatApi::getApiUrl('api_send_mass');
        $url .= $access_token;
        return $this->CurlRequest($url, $data);
    }

    public function vailAccessInfo($openId, $web_access_token)
    {
        $url = WeChatApi::getApiUrl('web_access_auth');
        $url .= "access_token={$web_access_token}&openid={$openId}";
        $str = $this->CurlRequest($url);
        $validInfo = json_decode($str, true);
        return $validInfo;
    }

    public function getUserInfo($web_access_token, $openId)
    {
        $url = WeChatApi::getApiUrl('api_get_userinfo');
        $url .= "access_token={$web_access_token}&openid={$openId}&lang=zh_CN";
        $str = $this->CurlRequest($url);
        $userInfo = json_decode($str, true);
        return $userInfo;
    }

    public function UploadMedia($media_data)
    {
        $access_token = $this->GetAccessToken();
        $url = WeChatApi::getApiUrl('api_upload_media');
        $url .= $access_token;
        $data['media'] = $media_data;
        return $this->CurlRequest($url, $data);
    }

    public function valid()
    {
        $echoStr = $_GET["echostr"];
        if ($this->checkSignature()) {
            echo $echoStr;
            exit;
        }
    }
}