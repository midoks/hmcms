
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
}).use(['layer','form','element','table','laydate','util'],function() {
///
var layer = layui.layer;
var form = layui.form;
var element = layui.element;
var table = layui.table;
var laydate = layui.laydate;
var util = layui.util;

// 时间范围选择
laydate.render({
    elem: 'input[name="times"]',
    type: 'date',
    range: true,
    trigger: 'click'
});

///
});