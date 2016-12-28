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
        //self.validateForm();

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

    //fill the order information
    controller.prototype.orderForm = function(){
        var self = this;
        //init this page first
        self.initProvinceCity();
        Common.gotoPin(1);
        //submit the form
        $('#form-contact .btn-submit').on('touchstart', function(){
            if(self.validateForm()){
                console.log('通过前端验证，可以提交');

            }
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

    controller.prototype.validateForm = function(){
        var self = this;
        var validate = true,
            inputTitle = document.getElementById('input-title'),
            inputName = document.getElementById('input-name'),
            inputMobile = document.getElementById('input-mobile'),
            inputMail = document.getElementById('input-mail'),
            inputProvince = document.getElementById('input-province'),
            inputCity = document.getElementById('input-city'),
            inputDetailAddress = document.getElementById('input-address-details'),
            inputCheck = $('#input-receive');
        if(!inputTitle.value){
            Common.errorMsg.add(inputTitle.parentElement,'请选择合适的称谓');
            validate = false;
        }else{
            Common.errorMsg.remove(inputTitle.parentElement);
        };

        if(!inputName.value){
            Common.errorMsg.add(inputName.parentElement,'姓名不能为空');
            validate = false;
        }else{
            Common.errorMsg.remove(inputName.parentElement);
        };

        if(!inputMobile.value){
            Common.errorMsg.add(inputMobile.parentElement,'手机号码不能为空');
            validate = false;
        }else{
            var reg=/^1\d{10}$/;
            if(!(reg.test(inputMobile.value))){
                validate = false;
                Common.errorMsg.add(inputMobile.parentElement,'手机号格式错误，请重新输入');
            }else{
                Common.errorMsg.remove(inputMobile.parentElement);
            }
        }

        if(!inputMail.value){
            Common.errorMsg.add(inputMail.parentElement,'邮箱不能为空');
            validate = false;
        }else{
            var regMail=/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+(\.[a-zA-Z0-9_-]+)+$/;
            if(!(regMail.test(inputMail.value))){
                validate = false;
                Common.errorMsg.add(inputMail.parentElement,'邮箱格式错误，请重新输入');
            }else{
                Common.errorMsg.remove(inputMail.parentElement);
            }
        }

        if(!inputDetailAddress.value){
            Common.errorMsg.add(inputDetailAddress.parentElement,'请填入详细地址');
            validate = false;
        }else{
            Common.errorMsg.remove(inputDetailAddress.parentElement);
        };

        if(!inputProvince.value){
            Common.errorMsg.add(inputProvince.parentElement,'请选择省份');
            validate = false;
        }else{
            if(inputProvince.value=='省份'){
                Common.errorMsg.add(inputProvince.parentElement,'请选择省份');
                validate = false;
            }else{
                Common.errorMsg.remove(inputProvince.parentElement);
            }
        };

        if(!inputCity.value){
            Common.errorMsg.add(inputCity.parentElement,'请选择城市');
            validate = false;
        }else{
            Common.errorMsg.remove(inputCity.parentElement);
        };


        if(!inputCheck.is(':checked')){
            validate = false;
            Common.errorMsg.add(inputCheck[0].parentElement,'请接受隐私条款');
        }else{
            Common.errorMsg.remove(inputCheck[0].parentElement);
        }


        if(validate){
            return true;
        }
        return false;
    };

    //init province and city
    controller.prototype.initProvinceCity = function(){
        var self = this;
        var regionAll = region;
        var provinceEle = $('#input-province');
        var cityEle = $('#input-city');
        var provinceHtml = '';

        for(var i=0;i<regionAll.length;i++){
            provinceHtml = provinceHtml+'<option data-id="'+i+'" value="'+regionAll[i].name+'">'+regionAll[i].name+'</option>';
        }
        provinceEle.html(provinceHtml);
        cityEle.html('<option value="'+regionAll[0].sub[0]+'">'+regionAll[0].sub[0]+'</option>');

        provinceEle.on('change',function(){
            var e = document.getElementById("input-province");
            var curIndex = e.selectedIndex;
            var cityHtml = '';
            for(var j=0;j<regionAll[curIndex].sub.length;j++){
                cityHtml = cityHtml + '<option value="'+regionAll[curIndex].sub[j]+'">'+regionAll[curIndex].sub[j]+'</option>';
            }
            cityEle.html(cityHtml);
        });


    };



    //dom ready
    $(document).ready(function(){

        var valentino = new controller();
        valentino.init();


    });


})();

