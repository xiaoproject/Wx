 <?php
 include '../WeChatApi.class.php';
 include '../WeChat.class.php';
$WeChat = new WeChat();
//获取access_token
$access_token = $WeChat -> GetAccessToken();
//获取删除菜单的api地址
$url = WeChatApi::getApiUrl('api_clear_menus');
$url .= $access_token;
//使用curl的get方式请求当前链接
$str = $WeChat -> CurlRequest( $url );
$json = json_decode($str);
//判断是否成功
if( $json -> errmsg == 'ok'){
	echo "Clear Menus Successfully\n";
}