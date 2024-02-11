
function showMsg(msg, callback ,icon, time){
	if (typeof time == 'undefined'){
		time = 2000;
	}

	if (typeof icon == 'undefined'){
		icon = {};
	}
	var loadT = layer.msg(msg, icon);
	setTimeout(function() {
		layer.close(loadT);
		if (typeof callback == 'function'){
			callback();
		}
	}, time);
}


layui.config({
    base: '{__STATIC__}/admin/layuiadmin/'
}).use(['layer','form','element','jquery','table','laydate','util'],function() {
///
$ = layui.$;
layer = layui.layer;
form = layui.form;
element = layui.element;
table = layui.table;
laydate = layui.laydate;
util = layui.util;


//监听table表单搜索
form.on('submit(table-sreach)', function (data) {
	var _id = $(this).data('id');
    if (data.field.times) {
        var searchDate = data.field.times.split(' - ');
        data.field.kstime = searchDate[0];
        data.field.jstime = searchDate[1];
    } else {
        data.field.kstime = '';
        data.field.jstime = '';
    }
    data.field.times = undefined;
    table.reload(_id,{where: data.field,page:{curr: 1}});
});


// 时间范围选择
laydate.render({
    elem: 'input[name="times"]',
    type: 'datetime',
    range: true,
    rangeLinked: true,
    trigger: 'click'
});


///
});

;!function (win) {
///
"use strict";
var doc = document,
Admin = function(){
    this.v = '1.0'; //版本号
};
//默认加载
Admin.prototype.init = function () {
};

//批量删除
Admin.prototype.batchDel = function(_url,_id) {
    var ids = [];
    if (isNaN(_id)) {
        var checkStatus = table.checkStatus(_id);
        checkStatus.data.forEach(function(n,i){
            ids.push(n.id);
        });
        var one = false;
    }else{
    	ids.push(_id);
    	var one = true;
    }

    if(ids.length == 0 ){
        layer.msg('请选择要删除的数据~!',{icon: 2,shift:6});
    }else{
        layer.confirm('确定要删除吗?', { title:'删除提示', btn: ['确定', '取消'],shade:0.001}, function(index) {
            $.post(_url, {'id':ids}, function(res) {
            	showMsg(res.msg, function(){
	        		if(res.code > -1){
	            		location.reload();
	           	 	}
	            },{icon: res.code > -1 ? 1 : 2,shift:res.code ? 0 : 6});
            },'json');
        }, function(index) {
            layer.close(index);
        });
    }
};

Admin.prototype.del = function(_this,_url,_id) {
    layer.confirm('确定要删除吗?', { title:'删除提示', btn: ['确定', '取消'],shade:0.001}, function(index) {
        $.post(_url, { 'id':_id }, function(res) {
            showMsg(res.msg, function(){
        		if(res.code > -1){
            		location.reload();
           	 	}
            },{icon: res.code > -1 ? 1 : 2,shift:res.code ? 0 : 6});
        },'json');
    }, function(index) {
        layer.close(index);
    });
};
//弹出层
Admin.prototype.open = function (title,url,w,h,full) {
    console.log(title,url,w,h,full);
    if (title == null || title == '') {
        var title = false;
    };
    if (w == null || w == '') {
        var w = ($(window).width()*0.9);
    };
    if (h == null || h == '') {
        var h = ($(window).height() - 50);
    };
    h = h-20;
    var open = layer.open({
        type: 2,
        area: [w+'px', h +'px'],
        fix: false, //不固定
        maxmin: true,
        shadeClose: false,
        maxmin: false,
        shade:0.2,
        title: title,
        content: url
    });
    if(full){
       layer.full(open);
    }
};
win.Admin = new Admin();
///
}(window);
