/*All the api collection*/
Api = {
    //保存贺卡
    //fromname  toname message
//{"status":1,"msg":id}
    saveCard:function(obj,callback){
        Common.msgBox('loading...');
        $.ajax({
            url:'/ajax/api/card',
            type:'POST',
            dataType:'json',
            data:obj,
            success:function(data){
                $('.ajaxpop').remove();
                return callback(data);
                //code=1    msg = 贺卡id
            }
        });

        //return callback({
        //    status:1,
        //    msg:'2'
        //})


    },
    //查询贺卡
    //参数  id

    getLetter:function(obj,callback){
        Common.msgBox('获取信息中...');
        $.ajax({
            url:'/ajax/api/getcard',
            type:'GET',
            dataType:'json',
            data:obj,
            success:function(data){
                $('.ajaxpop').remove();
                return callback(data);
                //data:gift
                //gift=1抽过
                //gift = 0,没抽过
                //返回  code=1    msg =  {choose1 choose2 choose3 wish date}
            }
        });
    },



};