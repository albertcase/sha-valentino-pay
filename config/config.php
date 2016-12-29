<?php

define("BASE_URL", 'http://longines.samesamechina.com/');
define("TEMPLATE_ROOT", dirname(__FILE__) . '/../template');
define("VENDOR_ROOT", dirname(__FILE__) . '/../vendor');

//User
define("USER_STORAGE", 'SESSION');

//Wechat Vendor
define("WECHAT_VENDOR", 'default'); // default | curio

//Wechat config info
define("TOKEN", '?????');
define("APPID", 'wx4868f82730292835');
define("APPSECRET", 'b994d3233e85e53712189f21880b83e3');
define("APPMCHID", '1323397001');
define("APPKEY", '0e861438632e4359929e9dcc143acd47');
define("NOWTIME", date('Y-m-d H:i:s'));
define("AHEADTIME", '100');

define("NONCESTR", '?????');

//Redis config info
define("REDIS_HOST", '127.0.0.1');
define("REDIS_PORT", '6379');

//Database config info
define("DBHOST", '127.0.0.1');
define("DBUSER", 'root');
define("DBPASS", '1qazxsw2');
define("DBNAME", 'pay_test');

//Wechat Authorize
define("CALLBACK", 'wechat/callback');
define("SCOPE", 'snsapi_base');

//Wechat Authorize Page
define("AUTHORIZE_URL", '[
	"/ec/order",
	"/ec/pay"
]');

//Account Access
define("OAUTH_ACCESS", '{
	"xxxx": "samesamechina.com" 
}');
define("JSSDK_ACCESS", '{
	"xxxx": "samesamechina.com"
}');

define("ENCRYPT_KEY", '29FB77CB8E94B358');
define("ENCRYPT_IV", '6E4CAB2EAAF32E90');

define("WECHAT_TOKEN_PREFIX", 'wechat:token:');







