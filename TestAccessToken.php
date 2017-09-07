<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/7
 * Time: 19:28
 */
include_once dirname(__FILE__) . '/Lib/WeChat.class.php';

$wechat = new WeChat();
echo $wechat->GetAccessToken();