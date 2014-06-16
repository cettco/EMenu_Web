$(function(){
	/*搜索框*/
	$(document).on("click","#suggest_area_c4",function(){
		$("#suggest_area .filters").toggle();
	});
	/*置顶样式*/
	isTop();
	dothis();
});
function afterSearch(){
	var s_username = $("input[name='Suggest[username]']").val(),
		s_content = $("input[name='Suggest[content]']").val(),
		s_reg_time = $("input[name='Suggest[reg_time]']").val();
	if(s_username||s_content||s_reg_time){
		$("#suggest_area .filters").show();
	}
	dothis();
	isTop();
}
function isTop(){
	$(".is_top_hidden").each(function(){
		var _this = $(this);
		if(_this.val()==1){
			_this.parent().siblings(":first").html("<span style='color:#ff892a;font-weight:bold;'>"+_this.parent().siblings(":first").html()+"</span>").prepend("<i class='icon-arrow-up bigger-110 orange'></i>");
		}
	});
}
function dothis(){
	updateStatus(".isTopSwitch .ace-switch", ".isTopSwitch", "1", "0", "is_top");
}
function updateStatus(dom1, dom2, status1, status2, attribute){
	$(dom1).each(function(){
		if($(this).attr("data-status")==status1){
			$(this).attr("checked",true);
		}else{
			$(this).attr("checked",false);
		}
		$(dom2).show();
	}).click(function(){
		var _this = $(this),
		 	type = 'open',
		 	id = $(this).attr("data-id");
		_this.attr("disabled",true);
		if(_this.attr("checked")){	//开启
			type = 'open';
		}else{		//关闭
			type = 'close';
		}
		$.ajax({
			url:"setIsTop",
			type:"post",
			data:{"type":type,"id":id,"status1":status1,"status2":status2,"attribute":attribute},
			dataType:"text",
			success:function(d){
				if(!d){		//失败
					if(type=='open'){
						_this.attr("checked",false);
					}else{
						_this.attr("checked",true);
					}
					alert("操作失败");
				}else{
					var _targ = _this.parent().parent().siblings();
					_targ.eq(2).find("input").val(type=='open'?1:0);
					if(type=='open'){
						_targ.eq(0).html("<span style='color:#ff892a;font-weight:bold;'>"+_targ.eq(0).html()+"</span>").prepend("<i class='icon-arrow-up bigger-110 orange'></i>");
					}else{
						_targ.eq(0).html(_this.parent().parent().siblings().eq(0).find("span").html());
					}
				}
				_this.attr("disabled",false);
			}
		});
	});
}