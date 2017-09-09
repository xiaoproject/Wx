 <?php
 include '../WeChatApi.class.php';
 include '../WeChat.class.php';
 $data = '{
     "button":[
     {	
          "type":"click",
          "name":"传智口号",
          "key":"itcast"
      },
     {	
          "type":"view",
          "name":"微商城",
          "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx213f94ddb545635c&redirect_uri=http%3A%2F%2Fwx.dpxiao.com%2Fuserinfo%2Fmine.php&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect"
      },

      {
           "name":"微官网",
           "sub_button":[
           {	
               "type":"view",
               "name":"传智播客中心",
               "url":"http://www.itcast.cn/"
            },
           
           {	
               "type":"view",
               "name":"黑马程序员中心",
               "url":"http://www.itheima.com/"
            }

           ]
       }]
 }';
 $WeChat = new WeChat();
 $access_token = $WeChat -> GetAccessToken();
 $url = WeChatApi::getApiUrl('api_create_menus');
 $url .= $access_token;
 $str = $WeChat -> CurlRequest( $url,$data );
 $json = json_decode($str);
 if( $json->errmsg == 'ok' ){
 	echo "Create Menus Successfully\n";
 }