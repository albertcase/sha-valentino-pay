<?php
namespace CampaignBundle;

use Core\Controller;


class ApiController extends Controller {

    public function __construct() {

    	global $user;

        parent::__construct();

        
    }

    public function formAction() {

    	global $user;

    	$request = $this->request;
    	$fields = array(
			'name' => array('notnull', '120'),
			'cellphone' => array('cellphone', '121'),
			'address' => array('notnull', '122'),
		);
		$request->validation($fields);
		$DatabaseAPI = new \Lib\DatabaseAPI();
		$data = new \stdClass();
		$data->uid = $user->uid;
		$data->name = $request->request->get('name');
		$data->cellphone = $request->request->get('cellphone');
		$data->address = $request->request->get('address');

		if($DatabaseAPI->insertInfo($data)) {
			$data = array('status' => 1);
			$this->dataPrint($data);
		} else {
			$this->statusPrint('0', 'failed');
		}
    }

    public function orderAction() {

    	global $user;
    	if(!$user->uid) {
	        $this->statusPrint('100', 'access deny!');
        } 
    	$request = $this->request;
    	$fields = array(
			'sex' => array('notnull', '120'),
			'name' => array('notnull', '121'),
			'mobile' => array('cellphone', '122'),
			'email' => array('notnull', '123'),
			'province' => array('notnull', '124'),
			'city' => array('notnull', '125'),
			'address' => array('notnull', '126'),
		);
		$request->validation($fields);
		$DatabaseAPI = new \Lib\DatabaseAPI();
		$data = new \stdClass();
		$data->uid = $user->uid;
		$data->sex = $request->request->get('sex');
		$data->name = $request->request->get('name');
		$data->mobile = $request->request->get('mobile');
		$data->email = $request->request->get('email');
		$data->province = $request->request->get('province');
		$data->city = $request->request->get('city');
		$data->address = $request->request->get('address');
		$data->orderid = APPMCHID.date("YmdHis");
		$data->start = date("YmdHis");
		$data->expire = date("YmdHis", time() + 300);

		$redis = new \Lib\RedisAPI();
    	$quota = $redis->quotaload();
    	if ($quota >= 48) {
    		$this->statusPrint('5', '商品已经售罄');
    	}

    	//占位
    	$redis->quotaset($data->orderid);

		if($DatabaseAPI->insertOrder($data)) {
			$data = array('status' => 1);
			$this->dataPrint($data);
		} else {
			$this->statusPrint('0', 'failed');
		}
    }

    public function submitAction() {

    	global $user;
    	if(!$user->uid) {
	        $this->statusPrint('100', 'access deny!');
        } 
    	$request = $this->request;
    	$fields = array(
			'sex' => array('notnull', '120'),
			'name' => array('notnull', '121'),
			'mobile' => array('cellphone', '122'),
			'email' => array('notnull', '123')
		);
		$request->validation($fields);
		$DatabaseAPI = new \Lib\DatabaseAPI();
		$data = new \stdClass();
		$data->uid = $user->uid;
		$data->sex = $request->request->get('sex');
		$data->name = $request->request->get('name');
		$data->mobile = $request->request->get('mobile');
		$data->email = $request->request->get('email');

		if($DatabaseAPI->insertSubmit($data)) {
			$data = array('status' => 1);
			$this->dataPrint($data);
		} else {
			$this->statusPrint('0', 'failed');
		}
    }

    public function payAction() {
    	require_once VENDOR_ROOT."/lib/WxPay.Api.php";
		require_once VENDOR_ROOT."/lib/WxPay.JsApiPay.php";

		global $user;
		if(!$user->uid) {
	        $this->statusPrint('100', 'access deny!');
        } 
		//查询用户订单
		$databaseapi = new \Lib\DatabaseAPI();
		$rs = $databaseapi->loadOrderByUid($user->uid);
		if (!$rs) {
			$this->statusPrint('2', '查询无订单');
		}
		
		$redis = new \Lib\RedisAPI();
    	if (!$redis->quotacheck($rs->orderid)) {
    		$this->statusPrint('3', '订单已失效');
    	}

		$input = new \WxPayUnifiedOrder();
		$input->SetBody("VALENTINO手提包");
		$input->SetAttach("VALENTINO手提包");
		$input->SetOut_trade_no($rs->orderid);
		$input->SetTotal_fee("1");
		$input->SetTime_start($rs->start);
		$input->SetTime_expire($rs->expire);
		$input->SetGoods_tag("VALENTINO手提包");
		$input->SetNotify_url(BASE_URL."/notify");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($user->openid);
		$order = \WxPayApi::unifiedOrder($input);
		$tools = new \JsApiPay();
		$jsApiParameters = $tools->GetJsApiParameters($order);
		// //获取共享收货地址js函数参数
		// $editAddress = $tools->GetEditAddressParameters();
		print $jsApiParameters;
		exit;
	}

	public function quotaAction() {
		$redis = new \Lib\RedisAPI();
    	$rs = $redis->quotaload();
    	if ($rs >= 48) {
    		$status = 0;
    	} else {
    		$status = 1;
    	}
    	$this->dataPrint(array('status' => $status, 'msg' => $rs));
	}

	public function quotasetAction() {
		$redis = new \Lib\RedisAPI();
    	$rs = $redis->quotaset('132339700120161229144208');
    	$this->dataPrint(array('status' => 1, 'msg' => $rs));
	}

	public function quotasetallAction() {
		$redis = new \Lib\RedisAPI();
    	$rs = $redis->quotasetall('3');
    	$this->dataPrint(array('status' => 1, 'msg' => $rs));
	}

	public function flushAction() {
		$redis = new \Lib\RedisAPI();
    	$redis->flush();
    	//echo $redis->quotacheck(4);
    	exit;
	}

}
