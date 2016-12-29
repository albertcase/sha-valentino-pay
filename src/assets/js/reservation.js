;(function(){

    var controller = function(){
    };
    //init
    controller.prototype.init = function(){
        var self = this;
        self.orderForm();


    };

    //fill the order information
    controller.prototype.orderForm = function(){
        var self = this;
        //init this page first
        self.initProvinceCity();
        Common.gotoPin(0);
        //submit the reservation
        $('#form-contact .btn-submit').on('touchstart', function(){
            if(self.validateForm()){
                console.log('通过前端验证，可以提交');
                //sex  name  mobile email province city address
                var sex = document.getElementById('input-title').value,
                    name = document.getElementById('input-name').value,
                    mobile = document.getElementById('input-mobile').value,
                    email = document.getElementById('input-mail').value;

                var orderInfo = {
                    sex:sex,
                    name:name,
                    mobile:mobile,
                    email:email
                };
                Api.reservation(orderInfo,function(data){
                    console.log(data);
                    //if(data.status==1){
                    //    //    提交成功，去订单确认页面
                    //    self.verifyOrder();
                    //}else if(data.status==5){
                    //    //库存已用完，跳转到已售罄页面
                    //    Common.gotoPin(0); /*同时修改按钮的值*/
                    //}else{
                    //    alert(data.msg);
                    //}
                })

            }
        });

    };


    controller.prototype.validateForm = function(){
        var self = this;
        var validate = true,
            inputTitle = document.getElementById('input-title'),
            inputName = document.getElementById('input-name'),
            inputMobile = document.getElementById('input-mobile'),
            inputMail = document.getElementById('input-mail'),
            inputCheck = $('#input-receive');

        if(!inputTitle.value || (inputTitle.value=="称谓") || (!inputName.value)){
            Common.errorMsg.add(inputTitle.parentElement,'请选择合适的称谓并填写姓名');
            validate = false;
        }else{
            Common.errorMsg.remove(inputTitle.parentElement);
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

