;(function(){

    var louis = function(){

    };
    //init
    louis.prototype.init = function(){
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

        self.welcomePage();


    };
    //welcome page
    louis.prototype.welcomePage = function(){
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
        })

    };

    //update greeting card value
    louis.prototype.updateFormValue = function(toUser,letterContent,fromUser,isDisabled){
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

    //write card with words
    louis.prototype.writeCard = function(){
        var self = this;

        Common.gotoPin(1);

        var toUserEle = $('#input-name-1'),
            letterEle = $('#l-content'),
            fromUserEle = $('#input-name-2');

        var btnTextEle = $('.btn-postcard span');

        var i=0;
        //Form value
        var initFormVal = [
            {
                to:'路易十三的旧友新交',
                content:'再造100年，\n为你献上跨越世纪的祝福！',
                from:'路易十三'
            },
            {
                to:'您想发送给谁？',
                content:'写下您的祝福',
                from:'请签下您的名字'
            }
        ];

        //init form value first
        self.updateFormValue(initFormVal[i].to,initFormVal[i].content,initFormVal[i].from,true);

        //button
        var btnText = ['生成我的祝福','提交','分享'];
        btnTextEle[0].innerText = btnText[i];

        var firstStep = true,
            secondStep = false,
            thirdStep = false;

        //test
        //var firstStep = false,
        //    secondStep = false,
        //    thirdStep = true;

        //clean touser value
        var isCleanFirst = true;
        toUserEle.on('focus',function(){
            if(!isCleanFirst) return;
            if(secondStep){
                toUserEle.val('');
                isCleanFirst = false;
            }
        });

        //clean letterEle value
        var isCleanSecond = true;
        letterEle.on('focus',function(){
            if(!isCleanSecond) return;
            if(isCleanSecond){
                letterEle.val('');
                isCleanSecond = false;
            }
        });

        //clean fromuser value
        var isCleanThird = true;
        fromUserEle.on('focus',function(){
            if(!isCleanThird) return;
            if(secondStep){
                fromUserEle.val('');
                isCleanThird = false;
            }
        });


        letterEle.on('keydown',function(e){
            var curVal = letterEle.val();
            if(e.keyCode==13 || e.which==13){
                var a = curVal.split('\n');
                if(a.length>2){
                    return false;
                }
            }
        });

        //send product and words to backend
        $('.btn-postcard').on('touchstart',function(){
            if(firstStep){
                _hmt.push(['_trackEvent', 'buttons', 'click', '生成我的祝福']);
                firstStep = false;
                i=1;
                self.updateFormValue(initFormVal[i].to,initFormVal[i].content,initFormVal[i].from,false);
                btnTextEle[0].innerText = btnText[i];
                secondStep = true;
                return;
            };

            var toUserVal = toUserEle.val();
            var letterEleVal = letterEle.val();
            var fromuserVal = fromUserEle.val();


            if(secondStep){
                _hmt.push(['_trackEvent', 'buttons', 'click', '提交']);
            //    validation first,then submit api
                if(isCleanSecond || isCleanSecond || isCleanSecond){
                    Common.alertBox.add('好友的名字、祝福、落款缺一不可，请您补充完整');
                    return;
                };

                if(toUserVal && letterEleVal && fromuserVal){
                    //fromname  toname message
                    Api.saveCard({
                        message:letterEleVal,
                        toname:toUserVal,
                        fromname:fromuserVal

                    },function(data){
                        if(data.status==1){
                            secondStep = false;
                            thirdStep = true;

                            //disable the form
                            self.updateFormValue(toUserVal,letterEleVal,fromuserVal,false);
                            btnTextEle[0].innerText = btnText[2];

                            //    start to activate share
                            var cardId = data.msg;
                            weixinshare({
                                title1: '再造100年，为你献上跨世纪的祝福！',
                                title2: '再造100年，为你献上跨世纪的祝福！',
                                des: '点亮光感之轮',
                                link: window.location.origin+'/seasonalgreeting/card.html?cardid='+cardId,
                                img: 'http://louisxiii-cognac.samesamechina.com/seasonalgreeting/dist/images/share.jpg'
                            },function(){

                            });

                        }

                        if(data.status !==1){
                            Common.alertBox.add(data.msg);
                        }

                    });
                }else{
                    Common.alertBox.add('好友的名字、祝福、落款缺一不可，请您补充完整');
                }



                return;

            };

            if(thirdStep){
                _hmt.push(['_trackEvent', 'buttons', 'click', '分享']);
            //    show share tips
               $('#popup-share').addClass('show');


            }


        });



    };



    //dom ready
    $(document).ready(function(){

        var seasonGreeting = new louis();
        seasonGreeting.init();


    });


})();

