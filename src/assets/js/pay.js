;(function(){

    var controller = function(){
    };
    //init
    controller.prototype.init = function(){
        var self = this;
        self.verifyOrder();
    };

    //确认订单
    controller.prototype.verifyOrder = function(obj){
        var self = this;
        Common.gotoPin(0);
        //var orderInfo = self.orderInfo;
        //$('#order-name').html(orderInfo.name);
        //$('#order-phone').html(orderInfo.mobile);
        //$('#order-mail').html(orderInfo.email);
        //$('#order-address').html(orderInfo.province+orderInfo.city+orderInfo.address);
        //
        ////确认订单，开始支付请求
        //$('.btn-submit-order').on('touchstart',function(){
        //
        //});

    };


    //dom ready
    $(document).ready(function(){

        var valentino = new controller();
        valentino.init();


    });


})();

