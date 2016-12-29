;(function(){

    var controller = function(){
    };
    //init
    controller.prototype.init = function(){
        var self = this;
        self.welcomePage();
    };
    //welcome page
    controller.prototype.welcomePage = function(){
        var self = this;
        Common.gotoPin(0);
        var mySwiper = new Swiper ('.swiper-container', {
            // Optional parameters
            loop: true,

            // If we need pagination
            pagination: '.swiper-pagination',

            // Navigation arrows
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',

            // And if we need scrollbar
            //scrollbar: '.swiper-scrollbar',
        });

        $('.btn-buy').on('touchstart',function(){
            //    select product
            //    product name, product price
            Api.quota(function(data){
                console.log(data);
                if(data.status==1){
                    //    有库存，去订单页面
                    Common.goOrderPage();
                }else{
                    //    没有库存，更改按钮描述
                    $('.btn-buy span').html('现已售罄');
                }
            });

        });

    };

    //dom ready
    $(document).ready(function(){

        var welcome = new controller();
        welcome.init();


    });


})();
