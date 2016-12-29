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
$routers['/ec/pay'] = array('CampaignBundle\Page', 'pay');
$routers['/ec/order'] = array('CampaignBundle\Page', 'order');
$routers['/notify'] = array('CampaignBundle\Page', 'notify');
$routers['/login'] = array('CampaignBundle\Page', 'login');
$routers['/api/order'] = array('CampaignBundle\Api', 'order');
$routers['/api/submit'] = array('CampaignBundle\Api', 'submit');
$routers['/api/pay'] = array('CampaignBundle\Api', 'pay');
$routers['/api/quota'] = array('CampaignBundle\Api', 'quota');
$routers['/api/quotaset'] = array('CampaignBundle\Api', 'quotaset');
$routers['/api/quotasetall'] = array('CampaignBundle\Api', 'quotasetall');
$routers['/api/flush'] = array('CampaignBundle\Api', 'flush');