<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ROSSO VALENTINO</title>
	<meta name="msapplication-tap-highlight" content="no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="x5-fullscreen" content="true">
	<meta name="full-screen" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="stylesheet" type="text/css" href="/src/dist/css/style.css" />
	<script type="text/javascript" src="http://valentinowechat.samesamechina.com/api/v1/js/60c4349e-c302-4313-9fa8-37a8ebd59853/wechat"></script>
	<script type="text/javascript" src="/src/assets/js/lib/zepto.min.js"></script>
	<script type="text/javascript" src="/src/assets/js/rem.js"></script>
	<script type="text/javascript" src="/src/assets/js/common.js"></script>
	<script type="text/javascript" src="/src/assets/js/wxshare.js"></script>
	<script type="text/javascript" src="/src/assets/js/api.js"></script>
	<script type="text/javascript" src="/src/assets/js/pay.js"></script>
    <script type="text/javascript">
	//调用微信JS api 支付
	function jsApiCall()
	{
		WeixinJSBridge.invoke(
			'getBrandWCPayRequest',
			<?php echo $jsApiParameters; ?>,
			function(res){
				WeixinJSBridge.log(res.err_msg);
				alert(res.err_code+res.err_desc+res.err_msg);
			}
		);
	}

	function callpay()
	{
		if (typeof WeixinJSBridge == "undefined"){
		    if( document.addEventListener ){
		        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
		    }else if (document.attachEvent){
		        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
		        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
		    }
		}else{
		    jsApiCall();
		}
	}
	</script>
</head>
<body>
    <div class="wrapper">
    	<div class="container animate">
    		<div class="pin pin-3 current">
    			<div class="logo">
    				<img src="/src/images/logo.jpg" alt=""/>
    			</div>
    			<h3 class="title">请完善收货信息</h3>
    			<div class="btn-back">返回修改</div>
    			<!-- 选中购买的商品信息-->
    			<div class="product-block">
    				<span class="product-img"><img src="/src/images/product-1.png" alt=""/></span>
    				<span class="product-name">红色SPIKE铆钉链条包</span>
    				<div class="num-price">
    					<span class="product-num">x1</span>
    					<span class="product-price">¥ 11,000</span>
    				</div>
    			</div>
    			<!-- 确认收货信息-->
    			<div class="order-block">
    				<div class="order-item order-item-name">
    					<label for="order-name">收货人</label>
    					<span class="name" id="order-name">kdkdk</span>
    				</div>
    				<div class="order-item order-item-phone">
    					<label for="order-phone">联系电话</label>
    					<span class="phone" id="order-phone">kdkdk</span>
    				</div>
    				<div class="order-item order-item-mail">
    					<label for="order-mail">电子邮箱</label>
    					<span class="mail" id="order-mail">kdkdk</span>
    				</div>
    				<div class="order-item order-item-address">
    					<label for="order-address">收货地址</label>
    					<span class="address" id="order-address">kdkdk</span>
    				</div>
    			</div>
    			<div class="btn btn-submit-order" onclick="callpay()"><span>确认付款</span></div>
    		</div>

    	</div>
    </div>
</body>
</html>