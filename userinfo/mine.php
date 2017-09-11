<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Title</title>

</head>
<body>
<?php

include_once '../Lib/WeChat.class.php';
include_once '../Lib/WeChatApi.class.php';
include_once '../DB.class.php';

$weChat = new WeChat();

//第2步：获取授权的code;
$code = $_GET['code'];

if (empty($code)) die();

// 获取用户Token
$data = $weChat->codeTransAccessInfo($code);
$web_access_token = $data['access_token'];
$openId = $data['openid']; //微信客户端的openid

// 获取用户消息
$userInfo = $weChat->getUserInfo($web_access_token, $openId);

var_dump($userInfo);

?>
hello world
</body>
</html>