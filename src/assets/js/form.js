//redpacket
;(function(){
    'use strict';

    var controller = function(){

    };
    controller.prototype = {
        init:function(){

            var self = this;
            //bind all dom element
            self.submitForm();

        },

        formValidate:function(){
            var self = this;
            var validate = true,
                inputMobile = document.getElementById('input-mobile'),
                inputFirstName = document.getElementById('input-firstname'),
                inputLastName = document.getElementById('input-lastname'),
                inputMail = document.getElementById('input-mail'),
                inputAddress = document.getElementById('input-address'),
                inputCheck = $('#input-receive');
            if(!inputFirstName.value){
                Common.errorMsg.add(inputFirstName.parentElement,'名不能为空');
                validate = false;
            }else{
                Common.errorMsg.remove(inputFirstName.parentElement);
            };

            if(!inputLastName.value){
                Common.errorMsg.add(inputLastName.parentElement,'姓不能为空');
                validate = false;
            }else{
                Common.errorMsg.remove(inputLastName.parentElement);
            };

            if(!inputAddress.value){
                Common.errorMsg.add(inputAddress.parentElement,'地址不能为空');
                validate = false;
            }else{
                Common.errorMsg.remove(inputAddress.parentElement);
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

            if(!inputCheck.is(':checked')){
                validate = false;
                Common.errorMsg.add(inputCheck[0].parentElement,'请同意接受有关FURLA产品、服务、推广等消息');
            }else{
                Common.errorMsg.remove(inputCheck[0].parentElement);
            }


            if(validate){
                return true;
            }
            return false;
        },
        submitForm:function(){
            var self = this;

            /*
             * Submit the Form
             */
            var btnSubmit = $('.btn-submit');
            var enableSubmit = true;
            $('.input-box input').on('keyup',function(){
                self.formValidate();
            });

            btnSubmit.on('touchstart',function(){
                if(self.formValidate()){
                    if(!enableSubmit) return;
                    enableSubmit = false;
                    var inputMobileVal = document.getElementById('input-mobile').value,
                        inputFirstNameVal = document.getElementById('input-firstname').value,
                        inputLastNameVal = document.getElementById('input-lastname').value,
                        inputMailVal = document.getElementById('input-mail').value,
                        inputAddressVal = document.getElementById('input-address').value,
                        reginCode = document.getElementById('input-regioncode').value?document.getElementById('input-regioncode').value:'+86',
                        issend = $('#input-receive').is(':checked');
                    Api.submitInfo({
                        firstname:inputLastNameVal,
                        secondname:inputFirstNameVal,
                        mobile:inputMobileVal,
                        address:inputAddressVal,
                        email:inputMailVal,
                        issend:issend?1:0,
                        areanumber:reginCode
                    },function(data){
                        if(data.status==1){
                            console.log('提交成功');
                            $('#form-contact').remove();
                            $('.success-block').removeClass('hide');
                        }else{
                            Common.alertBox.add(data.msg);
                        }
                    });


                };
            });

            $('.btn-gohome').on('touchstart',function(){
                Common.goHomePage();
            });
        },


    };

    if (typeof define === 'function' && define.amd){
        // we have an AMD loader.
        define(function(){
            return controller;
        });
    }
    else {
        this.controller = controller;
    }


}).call(this);

$(document).ready(function(){
    var redpacket= new controller();
    redpacket.init();
});