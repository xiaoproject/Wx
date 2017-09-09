<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/9
 * Time: 21:05
 */

$url = urlencode('http://wx.dpxiao.com/userinfo/mine.php');

// 获取AppId
$appID = 'wx213f94ddb545635c';

$wx_access = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appID}&redirect_uri={$url}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect ";

echo $wx_access;