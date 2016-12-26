;(function(){

    var weixinshare = function(obj,callback){
        wx.ready(function(){
            wx.showMenuItems({
                menuList: ["menuItem:share:appMessage","menuItem:share:timeline","menuItem:share:qq","menuItem:refresh","menuItem:favorite","menuItem:copyUrl","menuItem:originPage","menuItem:openWithQQBrowser","menuItem:openWithSafari"] // 要显示的菜单项，所有menu项见附录3
            });
            wx.onMenuShareAppMessage({
                title: obj.title1,
                desc: obj.des,
                link: obj.link,
                imgUrl: obj.img,
                type: '',
                dataUrl: '',
                success: function () {
                    //    success
                    _hmt.push(['_trackEvent', 'btn-weixin', 'share', 'success']);
                    callback();

                },
                cancel: function () {
                }
            });
            wx.onMenuShareTimeline({
                title: obj.title2,
                link: obj.link,
                imgUrl: obj.img,
                success: function () {
                    _hmt.push(['_trackEvent', 'btn-weixin', 'share', 'success']);
                    callback();
                },
                cancel: function () {

                }
            });


        })
    };

    if (typeof define === 'function' && define.amd){
        // we have an AMD loader.
        define(function(){
            return weixinshare;
        });
    }
    else {
        this.weixinshare = weixinshare;
    }

}).call(this);

$(document).ready(function(){
    weixinshare({
        title1: '再造100年，为你献上跨世纪的祝福！',
        title2: '再造100年，为你献上跨世纪的祝福！',
        des: '点亮光感之轮',
        link: window.location.href,
        img: 'http://louisxiii-cognac.samesamechina.com/seasonalgreeting/dist/images/share.jpg'
    },function(){

    });
});
