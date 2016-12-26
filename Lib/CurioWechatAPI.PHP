<?php
namespace Lib;

use Core\Response;

class CurioWechatAPI {
	
	public function wechatAuthorize() {
    	$response = new Response();
    	$response->redirect(CURIO_AUTH_URL);  
  	}
}