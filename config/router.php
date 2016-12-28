<?php

$routers = array();
$routers['/wechat/oauth2'] = array('WechatBundle\Wechat', 'oauth');
$routers['/wechat/callback'] = array('WechatBundle\Wechat', 'callback');
$routers['/wechat/curio/callback'] = array('WechatBundle\Curio', 'callback');
$routers['/wechat/curio/receive'] = array('WechatBundle\Curio', 'receiveUserInfo');
$routers['/wechat/ws/jssdk/config/webservice'] = array('WechatBundle\WebService', 'jssdkConfigWebService');
$routers['/wechat/ws/jssdk/config/js'] = array('WechatBundle\WebService', 'jssdkConfigJs');
$routers['/ajax/post'] = array('CampaignBundle\Api', 'form');
$routers['/'] = array('CampaignBundle\Page', 'index');
$routers['/clear'] = array('CampaignBundle\Page', 'clearCookie');
$routers['/pay'] = array('CampaignBundle\Page', 'pay');
$routers['/notify'] = array('CampaignBundle\Page', 'notify');
$routers['/api/order'] = array('CampaignBundle\Api', 'order');
$routers['/api/submit'] = array('CampaignBundle\Api', 'submit');