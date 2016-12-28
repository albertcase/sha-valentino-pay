<?php
namespace CampaignBundle;
require_once VENDOR_ROOT."/lib/WxPay.Api.php";
require_once VENDOR_ROOT."/lib/WxPay.JsApiPay.php";
use Core\Controller;

class PageController extends Controller {

	public function indexAction() {
		$RedisAPI = new \Lib\RedisAPI();
		$config = $RedisAPI->jssdkConfig($this->request->getUrl(TRUE));
		$this->render('index', array('config' => $config));
	}

	public function payAction() {
		global $user;
		$openid = $user->openid;
		$input = new \WxPayUnifiedOrder();
		$input->SetBody("VALENTINO手提包");
		$input->SetAttach("VALENTINO手提包");
		$input->SetOut_trade_no(\WxPayConfig::MCHID.date("YmdHis"));
		$input->SetTotal_fee("1");
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("VALENTINO手提包");
		$input->SetNotify_url("http://longines.samesamechina.com/notify");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openid);
		$order = \WxPayApi::unifiedOrder($input);
		$tools = new \JsApiPay();
		$jsApiParameters = $tools->GetJsApiParameters($order);
		//获取共享收货地址js函数参数
		$editAddress = $tools->GetEditAddressParameters();

		$this->render('pay', array('jsApiParameters' => $jsApiParameters, 'editAddress' => $editAddress));
	}

	public function notifyAction() {
		$data = $GLOBALS['HTTP_RAW_POST_DATA'];	
		$databaseapi = new \Lib\DatabaseAPI();
		$databaseapi->insertWxpayLog($data);
		exit;
	}

	public function clearCookieAction() {
		setcookie('_user', json_encode($user), time(), '/');
		$this->statusPrint('success');
	}
}