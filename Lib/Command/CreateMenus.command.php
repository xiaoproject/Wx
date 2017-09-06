 <?php
 include '../WeChatApi.class.php';
 include '../WeChat.class.php';
 $data = '';
 $WeChat = new WeChat();
 $access_token = $WeChat -> GetAccessToken();
 $url = WeChatApi::getApiUrl('api_create_menus');
 $url .= $access_token;
 $str = $WeChat -> CurlRequest( $url,$data );
 $json = json_decode($str);
 if( $json->errmsg == 'ok' ){
 	echo "Create Menus Successfully\n";
 }