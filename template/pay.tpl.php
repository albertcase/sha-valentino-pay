<!DOCTYPE html>
<html>
<head lang="en">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>ROSSO VALENTINO</title>
	<meta name="msapplication-tap-highlight" content="no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="x5-fullscreen" content="true">
	<meta name="full-screen" content="yes">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="stylesheet" type="text/css" href="/src/dist/css/style.css" />
	<script type="text/javascript" src="http://valentinowechat.samesamechina.com/api/v1/js/60c4349e-c302-4313-9fa8-37a8ebd59853/wechat"></script>
	<script>
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?d7d1af7688a53ead0361f6fbfe4c00c8";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
	<script type="text/javascript" src="/src/dist/js/pay_all.min.js"></script>
	 <script type="text/javascript">
    	//调用微信JS api 支付
    	function jsApiCall()
    	{
    		WeixinJSBridge.invoke(
    			'getBrandWCPayRequest',
    			<?php echo $jsApiParameters; ?>,
    			function(res){
    				WeixinJSBridge.log(res.err_msg);
//    				alert(res.err_code+res.err_desc+res.err_msg);

					  if(res.err_msg == "get_brand_wcpay_request:ok" ) {
						Common.gotoPin(1);
					  }     // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
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
<body class="page-home">
<div class="wrapper">
	<div class="container animate">
		<div class="pin pin-3 current">
			<div class="logo">
				<img src="/src/images/logo.png" alt=""/>
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
					<span class="name" id="order-name"><?php print $info->name;?>&nbsp<?php print $info->sex;?></span>
				</div>
				<div class="order-item order-item-phone">
					<label for="order-phone">联系电话</label>
					<span class="phone" id="order-phone"><?php print $info->mobile;?></span>
				</div>
				<div class="order-item order-item-mail">
					<label for="order-mail">电子邮箱</label>
					<span class="mail" id="order-mail"><?php print $info->email;?></span>
				</div>
				<div class="order-item order-item-address">
					<label for="order-address">收货地址</label>
					<span class="address" id="order-address"><?php print $info->province;?> <?php print $info->city;?> <?php print $info->address;?></span>
				</div>
			</div>
			<div class="btn btn-submit-order" onclick="callpay()"><span>确认付款</span></div>
		</div>
		<div class="pin pin-2" id="pin-pay-success">
			<div class="v-content">
				<h3>订单成功: <span><?php print $info->orderid;?></span></h3>
				<p class="des">
					感谢您的购买<br>
					我们将尽快安排相关工作人员与您联络
				</p>
				<div class="btn hide"><span>探索ROSSO VALENTINO系列</span></div>
			</div>
		</div>

	</div>
</div>



</body>


</html>
