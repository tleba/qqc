$(function(){
	$(".remove a, .close").click(function(event){
		event.stopPropagation();
		$(this).parents(".remove").hide();	
	})
	//滚动
	$(".nav-1").click(function(){
		$("body,html").animate({"scrollTop":$(".moration-div1").offset().top});	
	})
	$(".nav-2").click(function(){
		$("body,html").animate({"scrollTop":$(".moration-div2").offset().top});	
	})
	$(".nav-3").click(function(){
		$("body,html").animate({"scrollTop":$(".moration-div3").offset().top});	
	})
	$(".nav-4").click(function(){
		$("body,html").animate({"scrollTop":$(".moration-div3").offset().top});	
	})
	$(".nav-5").click(function(){
		$("body,html").animate({"scrollTop":$(".moration-div4").offset().top});	
	})
	//击毙年兽方法
	function nianshou(){
		var number = 4;//总次数
		var clickNumber = 0;//点击次数
		var sb = true;
		$("#nianshou li").click(function(){
			var index = $(this).index();
			clickNumber = clickNumber+1;//点击次数加一
			number = number-1;
			//console.log(clickNumber)
			console.log(number)
			if(number>0){
				if(clickNumber == 1){
					$(".remove-r2").show();
				}else if(clickNumber == 2){
					$(".remove-r2").show();
					$("#shanghai").text("2次伤害")
					$("#remaining").text("继续炸1次")
				}else if(clickNumber == 3){
					$(".remove-r1").show();
					$(this).find("div").find("img").removeClass("animate")
					clickNumber = 0;
					number = 0
				}
			}else{
				//判断是否有色币
				if(sb==true){
					alert("今天的一次免费鞭炮已用完，继续点击使用色币炸年兽！ ")
				}else{
					alert("色币不足请继续充值 ")
				}
			}
		})
	}
	//抢料方法
	function rob(number,state){
		
		//点我抢料
		$("#dwql").click(function(){
			number = number-1;
			console.log(number)
			if(number>0){
				if(state === true){//如果中了料
					$(".success").show()
				}else{//如果没有料
					$("#noLiao").show();
				}
			}else{
				$("#noNumber").show();
			}
		})
	}
	//兑换色币
	function duihuan(state){
		$("#dhsb").click(function(){
			if(state == true){
				$("#duihuan2").show();
			}else{
				$("#duiReeor").show();
			}
			
		})
	}
	//猜灯
	function denglong(state,number){
		$("#denglong li").click(function(){
			if(number>0){
				if(state == true){
					$("#cdOK").show();
					number = 0
				}else{
					$("#cderror").show();
					number = 0
				}
			}else{
				//没有次数了
				$("#cdfailure").show();
				
			}
		})
	}
	function dh(){
		$(".b2").click(function(){
			$("#dherror").show();
		})
	}
	function bless(){
		$("#blessing").click(function(){
			$(".remove-r4").show();
		})
	}
	//nianshou()
	//duihuan(false)
	//denglong(false,2);
	//dh();
	bless();
})