<?php
namespace CampaignBundle;

use Core\Controller;


class ApiController extends Controller {

    public function __construct() {

    	global $user;

        parent::__construct();

        if(!$user->uid) {
	        $this->statusPrint('100', 'access deny!');
        } 
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
		$data->expire = date("YmdHis", time() + 600);

		if($DatabaseAPI->insertOrder($data)) {
			$data = array('status' => 1);
			$this->dataPrint($data);
		} else {
			$this->statusPrint('0', 'failed');
		}
    }

    public function submitAction() {

    	global $user;

    	$request = $this->request;
    	$fields = array(
			'sex' => array('notnull', '120'),
			'name' => array('notnull', '121'),
			'mobile' => array('cellphone', '122'),
			'province' => array('notnull', '123'),
			'city' => array('notnull', '124'),
			'store' => array('notnull', '125'),
			'month' => array('notnull', '126'),
			'day' => array('notnull', '127'),
			'time' => array('notnull', '128'),
		);
		$request->validation($fields);
		$DatabaseAPI = new \Lib\DatabaseAPI();
		$data = new \stdClass();
		$data->uid = $user->uid;
		$data->sex = $request->request->get('sex');
		$data->name = $request->request->get('name');
		$data->mobile = $request->request->get('mobile');
		$data->province = $request->request->get('province');
		$data->city = $request->request->get('city');
		$data->store = $request->request->get('store');
		$data->month = $request->request->get('month');
		$data->day = $request->request->get('day');
		$data->time = $request->request->get('time');

		if($DatabaseAPI->insertSubmit($data)) {
			$data = array('status' => 1);
			$this->dataPrint($data);
		} else {
			$this->statusPrint('0', 'failed');
		}
    }


}
