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
          "type":"click",
          "name":"联系我们",
          "key":"contact"
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