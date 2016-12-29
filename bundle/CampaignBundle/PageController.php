<?php
namespace CampaignBundle;

use Core\Controller;

class PageController extends Controller {

	public function indexAction() {
		$RedisAPI = new \Lib\RedisAPI();
		$config = $RedisAPI->jssdkConfig($this->request->getUrl(TRUE));
		$this->render('index', array('config' => $config));
	}

	public function loginAction() {
    	$request = $this->request;
    	$openid = $request->query->get('openid') ? $request->query->get('openid') : "test";
    	$userAPI = new \Lib\UserAPI();
		$user = $userAPI->userLogin($openid);
		if(!$user) {
			$userAPI->userRegister($openid);
		}
		$this->statusPrint('200', 'Login as user:'. $openid);
    }

    public function orderAction() {
    	$this->render('order');
    }

	public function payAction() {
    	global $user;

		require_once VENDOR_ROOT."/lib/WxPay.Api.php";
		require_once VENDOR_ROOT."/lib/WxPay.JsApiPay.php";
		//查询用户订单
		$databaseapi = new \Lib\DatabaseAPI();
		$rs = $databaseapi->loadOrderByUid($user->uid);
		if (!$rs) {
			//$this->statusPrint('2', '查询无订单');
			$this->redirect("/");
			exit;
		}
		
		$redis = new \Lib\RedisAPI();
    	if (!$redis->quotacheck($rs->orderid)) {
    		//$this->statusPrint('3', '订单已失效');
    		$this->redirect("/");
			exit;
    	}

		$input = new \WxPayUnifiedOrder();
		$input->SetBody("红色SPIKE铆钉链条包");
		$input->SetAttach("红色SPIKE铆钉链条包");
		$input->SetOut_trade_no($rs->orderid);
		$input->SetTotal_fee("1");
		$input->SetTime_start($rs->start);
		$input->SetTime_expire($rs->expire);
		$input->SetGoods_tag("红色SPIKE铆钉链条包");
		$input->SetNotify_url(BASE_URL."/notify");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($user->openid);
		$order = \WxPayApi::unifiedOrder($input);
		$tools = new \JsApiPay();
		$jsApiParameters = $tools->GetJsApiParameters($order);
		$this->render('pay', array('jsApiParameters' => $jsApiParameters, 'info' => $rs));
	}

	public function notifyAction() {
		$data = $GLOBALS['HTTP_RAW_POST_DATA'];
		$xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);

		$databaseapi = new \Lib\DatabaseAPI();
		$databaseapi->insertWxpayLog($xml);
		if ($xml->return_code == 'SUCCESS' && $xml->result_code == 'SUCCESS') {
			if ($databaseapi->checkStatus($xml->out_trade_no)) {
				$databaseapi->updateStatus($xml->out_trade_no);
				$redis = new \Lib\RedisAPI();
    			$redis->quotasetall($xml->out_trade_no);
			}
		}
		exit;
	}

	public function clearCookieAction() {
		setcookie('_user', json_encode($user), time(), '/');
		$this->statusPrint('success');
	}
}