/*All the api collection*/
Api = {
    //保存用户订单信息
    //sex  name  mobile email province city address
    order:function(obj,callback){
        Common.msgBox('loading...');
        //$.ajax({
        //    url:'/api/order',
        //    type:'POST',
        //    dataType:'json',
        //    data:obj,
        //    success:function(data){
        //        $('.ajaxpop').remove();
        //        return callback(data);
        //        //code=1    msg = 贺卡id
        //    }
        //});

        return callback({
            status:1,
            msg:'success'
        })


    },
    //预约到店
    //sex  name  mobile  province city store month day time
    reservation:function(obj,callback){
        Common.msgBox('获取信息中...');
        $.ajax({
            url:'/api/submit',
            type:'GET',
            dataType:'json',
            data:obj,
            success:function(data){
                $('.ajaxpop').remove();
                return callback(data);
            }
        });
    },



};