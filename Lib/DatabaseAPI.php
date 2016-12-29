<?php
namespace Lib;
/**
 * DatabaseAPI class
 */
class DatabaseAPI {

	private $db;

	private function connect() {
		$connect = new \mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
		$this->db = $connect;
		$this->db->query('SET NAMES UTF8');
		return $this->db;
	}
	/**
	 * Create user in database
	 */
	public function insertUser($userinfo){
		$nowtime = NOWTIME;
		$sql = "INSERT INTO `user` SET `openid` = ?, `created` = ?, `updated` = ?"; 
		$res = $this->connect()->prepare($sql); 
		$res->bind_param("sss", $userinfo->openid, $nowtime, $nowtime);
		if($res->execute()) 
			return $this->findUserByOpenid($userinfo->openid);
		else 
			return FALSE;
	}

	public function updateUser($data) {

	}

	/**
	 * Create user in database
	 */
	public function findUserByOpenid($openid){
		$sql = "SELECT `uid`, `openid` FROM `user` WHERE `openid` = ?"; 
		$res = $this->connect()->prepare($sql);
		$res->bind_param("s", $openid);
		$res->execute();
		$res->bind_result($uid, $openid);
		if($res->fetch()) {
			$user = new \stdClass();
			$user->uid = $uid;
			$user->openid = $openid;
			return $user;
		}
		return NULL;
	}

	/**
	 * 
	 */
	public function saveInfo($data){
		if($this->findInfoByUid($data->uid)) {
			$this->updateInfo($data);
		} else {
			$this->insertInfo($data);
		}
	} 

	/**
	 * 
	 */
	public function insertInfo($data){
		$nowtime = NOWTIME;
		$sql = "INSERT INTO `info` SET `uid` = ?, `name` = ?, `cellphone` = ?, `address` = ?, `created` = ?, `updated` = ?"; 
		$res = $this->connect()->prepare($sql); 
		$res->bind_param("ssssss", $data->uid, $data->name, $data->cellphone, $data->address, $nowtime, $nowtime);
		if($res->execute()) 
			return $res->insert_id;
		else 
			return FALSE;
	}

	/**
	 * 
	 */
	public function updateInfo($data){
		$nowtime = NOWTIME;
		$sql = "UPDATE `info` SET `name` = ?, `cellphone` = ?, `address` = ?, `updated` = ? WHERE `uid` = ?"; 
		$res = $this->connect()->prepare($sql); 
		$res->bind_param("sssss", $data->name, $data->cellphone, $data->address, $nowtime, $data->uid);
		if($res->execute()) 
			return $this->findInfoByUid($data->uid);
		else 
			return FALSE;
	}

	/**
	 * Create user in database
	 */
	public function findInfoByUid($uid){
		$sql = "SELECT `id`, `name`, `cellphone`, `address` FROM `info` WHERE `uid` = ?"; 
		$res = $this->connect()->prepare($sql);
		$res->bind_param("s", $uid);
		$res->execute();
		$res->bind_result($id, $name, $cellphone, $address);
		if($res->fetch()) {
			$info = new \stdClass();
			$info->id = $id;
			$info->name = $name;
			$info->cellphone = $cellphone;
			$info->$address = $address;
			return $info;
		}
		return NULL;
	}

	/**
	 * 
	 */
	public function insertWxpayLog($data, $xml){
		$sql = "INSERT INTO `wxpay_log` SET `data` = ?, `appid` = ?, `attach` = ?, `bank_type` = ?, `cash_fee` = ?,
			`fee_type` = ?, `is_subscribe` = ?, `mch_id` = ?, `nonce_str` = ?, `openid` = ?, `out_trade_no` = ?,
			`result_code` = ?, `return_code` = ?, `sign` = ?, `time_end` = ?, `total_fee` = ?, `trade_type` = ?,
			`transaction_id` = ?"; 
		$res = $this->connect()->prepare($sql); 
		$res->bind_param("ssssssssssssssssss", $data, $xml->appid, $xml->attach, $xml->bank_type, $xml->cash_fee,
				$xml->fee_type, $xml->is_subscribe, $xml->mch_id, $xml->nonce_str, $xml->openid, $xml->out_trade_no,
				$xml->result_code, $xml->return_code, $xml->sign, $xml->time_end, $xml->total_fee, $xml->trade_type,
				$xml->transaction_id);
		if($res->execute()) 
			return $res->insert_id;
		else 
			return FALSE;
	}

	/**
	 * 
	 */
	public function insertOrder($data){
		$nowtime = NOWTIME;
		$sql = "INSERT INTO `order` SET `uid` = ?, `sex` = ?, `name` = ?, `mobile` = ?, `email` = ?, `province` = ?, `city` = ?, `address` = ?, `orderid` = ?, `start` = ?, `expire` = ?"; 
		$res = $this->connect()->prepare($sql); 
		$res->bind_param("sssssssssss", $data->uid, $data->sex, $data->name, $data->mobile, $data->email, $data->province, $data->city, $data->address, $data->orderid, $data->start, $data->expire);
		if($res->execute()) 
			return $res->insert_id;
		else 
			return FALSE;
	}

	/**
	 * 
	 */
	public function insertSubmit($data){
		$nowtime = NOWTIME;
		$sql = "INSERT INTO `submit` SET `uid` = ?, `sex` = ?, `name` = ?, `mobile` = ?, `province` = ?, `city` = ?, `store` = ?, `month` = ?, `day` = ?, `time` = ?"; 
		$res = $this->connect()->prepare($sql); 
		$res->bind_param("ssssssssss", $data->uid, $data->sex, $data->name, $data->mobile, $data->province, $data->city, $data->store, $data->month, $data->day, $data->time);
		if($res->execute()) 
			return $res->insert_id;
		else 
			return FALSE;
	}

	public function loadOrderByUid($uid) {
		$sql = "SELECT `orderid`, `start`, `expire`, `sex`, `name`, `mobile`, `email`, `province`, `city`, `address` FROM `order` WHERE `uid` = ? and `status` = 0 order by id desc limit 1"; 
		$res = $this->connect()->prepare($sql);
		$res->bind_param("s", $uid);
		$res->execute();
		$res->bind_result($orderid, $start, $expire, $sex, $name, $mobile, $email, $province, $city, $address);
		if($res->fetch()) {
			$data = new \stdClass();
			$data->orderid = $orderid;
			$data->start = $start;
			$data->expire = $expire;
			$data->sex = $sex;
			$data->name = $name;
			$data->mobile = $mobile;
			$data->email = $email;
			$data->province = $province;
			$data->city = $city;
			$data->address = $address;
			return $data;
		}
		return NULL;
	}

	public function checkStatus($orderid) {
		$sql = "SELECT `status` FROM `order` WHERE `orderid`=?";
		$res = $this->connect()->prepare($sql);
		$res->bind_param("s", $orderid);
		$res->execute();
		$res->bind_result($status);
		if($res->fetch()) {
			if($status==0){
				return TRUE;
			}
			return FALSE;
		}
		return FALSE;
	}

	public function updateStatus($orderid) {
		$sql = "UPDATE `order` SET `status`=1 WHERE `orderid`=?";
		$res = $this->connect()->prepare($sql);
		$res->bind_param("s", $orderid);
		if($res->execute()) 
			return TRUE;
		else 
			return FALSE;
	}

}
