;(function(){

    var controller = function(){

    };
    //init
    controller.prototype.init = function(){
        var self = this;
        //    loading first
        var baseurl = 'dist/images/';
        //var imagesArray = [
        //    baseurl+'logo.png',
        //];
        //var i = 0;
        //new preLoader(imagesArray, {
        //    onProgress: function(){
        //        i++;
        //        var progress = parseInt(i/imagesArray.length*100);
        //        $('.preload .v-content').html('已加载'+progress+'%');
        //    },
        //    onComplete: function(){
        //        //
        //        //
        //        $('.preload').remove();
        //        $('.container').addClass('fade');
        //
        //
        //    }
        //});

        //self.welcomePage();
        self.orderForm();


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
            self.orderForm();
        });

    };



    //update greeting card value
    controller.prototype.updateFormValue = function(toUser,letterContent,fromUser,isDisabled){
        var self = this;
        var toUserEle = document.getElementById('input-name-1'),
            letterEle = document.getElementById('l-content'),
            fromUserEle = document.getElementById('input-name-2');
        //update form value and disabled status
        if(toUser==undefined || letterContent==undefined || fromUser==undefined){
            return;
        }
        //update the value
        toUserEle.value = toUser;
        letterEle.value = letterContent;
        fromUserEle.value = fromUser;

        //update the disable status
        toUserEle.disabled = isDisabled;
        letterEle.disabled = isDisabled;
        fromUserEle.disabled = isDisabled;
    };

    //fill the order information
    controller.prototype.orderForm = function(){
        Common.gotoPin(1);
    };



    //dom ready
    $(document).ready(function(){

        var valentino = new controller();
        valentino.init();


    });


})();

