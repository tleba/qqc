$(document).ready(function(){
	var errorStr='<span class="tips error">';
	var okStr='<span class="tips right">';


	$("#username").blur(function(){
		$(this).parent().find(".tips").remove();
		if(this.value==""){
			var errorMsg="用户名不能为空";
			$(this).parent().append(errorStr+errorMsg+'</span>');
			$(this).css("border","1px solid red");
		}
		else{
			if(this.value==""){
				var errorMsg="注册用户名不可为空";
				$(this).parent().append(errorStr+errorMsg+'</span>');
				$(this).css("border","1px solid red");
			} else{
				var okMsg="一旦注册成功不能修改";
				$(this).parent().append(okStr+okMsg+'</span>');
				$(this).css("border","1px solid #ccc");
			}
			$.ajax({
				type:"post",
				url:base_url + "/ajax/check_username",
				data:{username: $("#username").val()},
				dataType:"json",
				cache:false,
				success:function(data)
				{
					//console.log(data.flag);
					$("#username").parent().find(".tips").remove();
					if(data.flag==false)
					{
						var errorMsg="已被注册";
						$("#username").parent().append('<span class="tips error">'+errorMsg+'</span>');
						$("#username").css("border","1px solid red");
					} else if(data.flag==true) {
						var okMsg="";
						$("#username").parent().append('<span class="tips right">'+okMsg+'</span>');
						$("#username").css("border","1px solid #ccc");
					}
				}
			});
		}
	}).keyup(function(){
		$(this).triggerHandler("blur");
	})

		var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
		$("#email").blur(function(){
		$(this).parent().find(".tips").remove();
		if(this.value==""){
			var errorMsg="邮箱不能为空";
			$(this).parent().append(errorStr+errorMsg+'</span>');
			$(this).css("border","1px solid red");
		}else if(!myreg.test(this.value)){
			var errorMsg="邮箱格式不正确";
			$(this).parent().append(errorStr+errorMsg+'</span>');
			$(this).css("border","1px solid red");
		}
		else{
			if(this.value==""){
				var errorMsg="邮箱不能为空";
				$(this).parent().append(errorStr+errorMsg+'</span>');
				$(this).css("border","1px solid red");
			} else{
				var okMsg="一旦注册成功不能修改";
				$(this).parent().append(okStr+okMsg+'</span>');
				$(this).css("border","1px solid #ccc");
			}
			$.ajax({
				type:"post",
				url:base_url + "/ajax/check_username",
				data:{email: $("#email").val()},
				dataType:"json",
				cache:false,
				success:function(data)
				{
					$("#email").parent().find(".tips").remove();
					if(data.flag==false)
					{
						var errorMsg="邮箱已被注册";
						$("#email").parent().append('<span class="tips error">'+errorMsg+'</span>');
						$("#email").css("border","1px solid red");
					} else if(data.flag==true) {
						var okMsg="";
						$("#email").parent().append('<span class="tips right">'+okMsg+'</span>');
						$("#email").css("border","1px solid #ccc");
					}
				}
			});
		}
	}).keyup(function(){
		$(this).triggerHandler("blur");
	})


	$("#psw").keyup(function(){
		$(this).parent().find(".tips").remove();
		if(this.value=="")
		{
			var errorMsg="密码不能为空";
			$(this).parent().append(errorStr+errorMsg+'</span>');
			$(this).css("border","1px solid red");
		}
		
		else if(this.value.length<6 || this.value.length>16 && /^[^A-Za-z0-9]{6,16}$/g.test(this.value))
		{
				///^[^A-Za-z0-9]{6,16}$/g
				var errorMsg="6-16位，由字母和数字组成";
				$(this).parent().append(errorStr+errorMsg+'</span>');
				$(this).css("border","1px solid red");
		}
		else
		{
			var okMsg="";
			$(this).parent().append(okStr+okMsg+'</span>');
			$(this).css("border","1px solid #ccc");
			if(this.value.length<6)
			{
				$(".qd").eq(0).addClass("selected").siblings().removeClass("selected");
			}
			else if(this.value.length>6 && this.value.length<10)
			{	
				$(".qd").eq(1).addClass("selected").siblings().removeClass("selected");
			}
			else if(this.value.length>10 && this.value.length<16)
			{
				$(".qd").eq(2).addClass("selected").siblings().removeClass("selected");
			}
		}
	}).blur(function(){
		$(this).triggerHandler("keyup");
	})

	$("#confirm_psw").keyup(function(){
		$(this).parent().find(".tips").remove();
		if(this.value=="")
		{
			var errorMsg="请再输入一次密码";
			$(this).parent().append(errorStr+errorMsg+'</span>');
			$(this).css("border","1px solid red");
		}
		else if(this.value!=$("#psw").val())
		{
			console.log($("#psw").val());
			var errorMsg="密码输入不一致";
			$(this).parent().append(errorStr+errorMsg+'</span>');
			$(this).css("border","1px solid red");
		}
		else
		{
			var okMsg="";
			$(this).parent().append(okStr+okMsg+'</span>');
			$(this).css("border","1px solid #ccc");
		}
	}).blur(function(){
		$(this).triggerHandler("keyup");
	});

	$("#guname").blur(function(){
			var val = $.trim($(this).val());
			if(val == '')
				return;
			$(this).parent().find(".tips").remove();
			$.ajax({
				type:"post",
				url:base_url + "/ajax/check_guname",
				data:{guname: val},
				dataType:"json",
				cache:false,
				async:false,
				success:function(data){
					if(data.flag==false){
						$("#guname").css("border","1px solid red").parent().append('<span class="tips error">'+data.msg+'</span>');
						$("#guname").val('');
						setTimeout(function(){
							$("#guname").parent().find(".tips").remove();
						},3000);
					}else{
						var okMsg="";
						$("#guname").css("border","1px solid #ccc").parent().append('<span class="tips right">'+okMsg+'</span>');
					}
				}
			});
		});	

	$("#yzm").keyup(function(){
		$(this).parent().find(".tips").remove();
		//console.log($(this).val());
		if($(this).val()!="chwf"){
			var errorMsg="验证码错误，点击图片刷新";
			$(this).parent().append(errorStr+errorMsg+'</span>');
			$(this).css("border","1px solid red");
		}
		else{
			var okMsg="";
			$(this).parent().append(okStr+okMsg+'</span>');
			$(this).css("border","1px solid #ccc");
		}
	}).blur(function(){
		$(this).triggerHandler("keyup");
	})


	$("[name=agree]:checkbox").click(function(){
		$("[name=agree]:checkbox").parent().find(".tips").remove();
		if(!this.checked)
		{
			var errorMsg="此为必选项";
			$("[name=agree]:checkbox").parent().append(errorStr+errorMsg+'</span>');
		}
		else
		{
			$(this).parent().find(".error").remove();
			$(this).attr("checked",true);
		}		
	});

	function checkAddress()
	{
		$("#province").parent().find(".tips").remove();
		var provID= $("#province")[0].selectedIndex;
		var cityID=$("#city")[0].selectedIndex;
		var zoneID=$("#zone")[0].selectedIndex;
		if(!(provID&&cityID&&zoneID))
		{
			$("#province").parent().append(errorStr+"请填写完整的地址信息"+"</span>");
		}
		else
		{
			$("#province").parent().append(okStr+'</span>');
		}

	}

	$("#sub-btn").click(function(){
		$("form :input").trigger("keyup");
		checkAddress();

		if($("[name=agree]:checkbox").attr("checked",false))
		{
			$("[name=agree]:checkbox").trigger("click");
		}
		var num=$("form .error").length;
		if(num>0)
		{
			return false;
		}
		alert("注册成功");
		window.location.href="index.html";
	});
});
