<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新春活动 - High爆新春</title>
<link rel="stylesheet" type="text/css" href="css/demo.css?t=8"/>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
</head>

<body>
<div class="moration">
<div class="silde-nav">
        <span class="first nav-1"></span>     
        <span class="nav-2"></span>
        <span class="nav-3"></span>
        <span class="nav-4"></span>
        <span class="nav-5"></span>
</div>
    <img src="images/banner-1.jpg" alt="" title="" />
</div>
<!-- 第一屏 -->
<div class="min1200 moration-div1">
	<div class="width1300">
		<div class="ambo-div1">
            <span class="first nav-1"></span>     
            <span class="nav-2"></span>
            <span class="nav-3"></span>
            <span class="nav-4"></span>
            <span class="nav-5"></span>
        </div>
		<div class="ambo800">
        	<p>活动期间，网站每日派发一定数量的饺子制作材料，登录青青草账号后即可开始抢料做饺子，包好的饺子均可免费兑色币使用，集齐5个饺子就是大富豪年VIP，20个饺子起升级终身福布斯！
每个用户日均均有三次抢料的机会哦！赶紧制作出属于你的饺子破五穷欢欢喜喜过大年！</p>
			<div class="am-div1">
            	<ul id="dumpling_name">
                	<li>日均派发</li>
                </ul>
            	<ul id="dumpling_num">
                	<li>剩余数量</li>
                </ul>
            </div>
            <div class="am-div1 am-div2">
            	<ul>
                	<li>饺子名称</li>
                	<li>饺子制作材料</li>
                	<li>说明</li>
                </ul>
                <ul>
                	<li>白菜肉饺子</li>
                	<li>饺子皮、白菜、肉、调味料</li>
                	<li>每集齐该4样材料均可包出一个饺子</li>
                </ul>
            </div>
            <div class="am-div1 am-div3">
            	<ul>
                	<li>饺子数量</li>
                	<li>新春包饺子破穷</li>
                	<li>兑换色币数量</li>
                </ul>
            	<ul>
                	<li>1个</li>
                	<li>一饺破“智穷”</li>
                	<li>8个色币</li>
                </ul>
            	<ul>
                	<li>2个</li>
                	<li>二饺破“智穷”“学穷”</li>
                	<li>18个色币</li>
                </ul>
            	<ul>
                	<li>3个</li>
                	<li>三饺破“智穷”“学穷”“文穷”</li>
                	<li>58个色币</li>
                </ul>
            	<ul>
                	<li>4个</li>
                	<li>四饺破“智穷”“学穷”“文穷”“命穷”</li>
                	<li>88个色币</li>
                </ul>
            	<ul>
                	<li>5个</li>
                	<li>五饺破“智穷”“学穷”“文穷”“命穷”“交穷”</li>
                	<li>888个色币</li>
                </ul>
            </div>
            <div class="am-div4">
            	<ul>
                	<li id="dwql"><span></span></li>
                	<li id="dhsb"><span></span></li>
                </ul>
            </div>
            <div class="am-input">
            	<div class="am-indut-1">
            	饺子皮<input type="text" id="dumplings_1"/>个，白菜<input type="text"  id="dumplings_2"/>个，肉<input type="text"  id="dumplings_3"/>个，调味料<input type="text"  id="dumplings_4"/>个
                </div>
                <div class="am-indut-2">
                	制作出<input type="text" id="dumplings"/>个饺子
                    <input type="button" id="make_dumplings" value="" />
                </div>
            </div>
            <div class="am-nx">
            	<p>同一个IP地址下每个用户每日仅有三次拿料机会，抢完当日派发为止；</p>
            	<p>制作达到1个数量饺子开始即可点击兑换色币！兑换完毕，还可重新开启新一轮抢料制作饺子；</p>
            </div>
        </div>
    </div>
</div>
<script "text/javascript">
{literal}
$(function(){
	var dumpurl = '/qhd/newyear/dumplings.php';
	get_info(dumpurl);
	get_user_materials(dumpurl);
	$('#dwql').click(function(){
		$.post(dumpurl,{'a':'make_materials'},function(d){
			if(d && d.code == 0){
				get_info(dumpurl);
				get_user_materials(dumpurl);
				$(".success").show().find('strong').html(d.name)
			}else{
				if(d.code == -1 || d.code ==-6 || d.code== -7){
					alert(d.msg);
				}else if(d.code == -2){
					window.location.href='/login';
					alert(d.msg);
				}else{
					if(d.code == -3){
						$("#noNumber").show();
					}else{
						$("#noLiao").show();
					}
				}
			}
		},'json');
	});
	$('#make_dumplings').click(function(){
		make_dumplings(dumpurl);
	});
	$("#dhsb").click(function(){
		make_dumplings(dumpurl);
		$.post(dumpurl,{'a':'change'},function(d){
			if(d.code == -1){
				alert(d.msg);
			}else if(d.code == -2){
				window.location.href='/login';
				alert(d.msg);
			}else{
				if(d && d.code == 0){
					get_user_materials(dumpurl);
					make_dumplings(dumpurl);
				}
				$("#duihuan2").show().find('strong').html(d.sebi_count+'色币');
			}
		},'json');
	});
});
function make_dumplings(dumpurl){
	$.post(dumpurl,{'a':'make_dumplings'},function(d){
		if(d.code == -1){
			alert(d.msg);	
		}else if(d.code == -2){
			alert(d.msg);
			window.location.href='/login';
		}else{
			if(d && d.code == 0){
				$('#dumplings').val(d.dumplings_num);
			}
		}
	},'json');
}
function get_info(dumpurl){
	$.post(dumpurl,{'a':'info'},function(d){
		var namefra = document.createDocumentFragment();
		var tli = $('<li />');
		tli.html('日均派发');
		namefra.append(tli[0]);
		$.each(d.name,function(i,n){
			var li = $('<li />');
			li.html(n);
			namefra.append(li[0]);
		});
		$('#dumpling_name').html(namefra);
		var  numfra = document.createDocumentFragment();
		var nli = $('<li />');
		nli.html('剩余数量');
		numfra.append(nli[0]);
		$.each(d.num,function(i,n){
			var li = $('<li />');
			li.html(n);
			numfra.append(li[0]);
		});
		$('#dumpling_num').html(numfra);
	},'json');
}
function get_user_materials(dumpurl){
	$.post(dumpurl,{'a':'get_user_materials'},function(d){
		if(d && d.code == 0 && d.user_materials){
			$('#dumplings_1').val(d.user_materials[1]);
			$('#dumplings_2').val(d.user_materials[2]);
			$('#dumplings_3').val(d.user_materials[3]);
			$('#dumplings_4').val(d.user_materials[4]);
		}
	},'json');
}
{/literal}
</script>
<!-- 第一屏 -->
<!-- 第二屏 -->
<div class="min1200 moration-div2">
	<div class="width1300">
    	<!-- 正文 -->
        <div class="width870 letter-main">
            <div class="letter">
                <ul>
                    <li><img src="images/bb1.png"></li>
                    <li><img src="images/bb2.png"></li>
                    <li><img src="images/bb3.png"></li>
                    <li><img src="images/bb4.png"></li>
                    <li><img src="images/bb5.png"></li>
                </ul>
                <ol id="nianshou">
                	<li>
                        <img src="images/zhuangbei01_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                	<li>
                        <img src="images/zhuangbei02_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                	<li>
                        <img src="images/zhuangbei03_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                    <li>
                        <img src="images/zhuangbei04_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                    <li>
                        <img src="images/zhuangbei05_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                    <li>
                        <img src="images/zhuangbei06_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                    <li>
                        <img src="images/zhuangbei07_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                    <li>
                        <img src="images/zhuangbei08_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                    <li>
                        <img src="images/zhuangbei09_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                    <li>
                        <img src="images/zhuangbei10_03.png">
                        <div class="nianshou">
                            <img src="images/nianshou.png" class="animate">
                        </div>
                    </li>
                </ol>
            </div>
            <div class="letter-bt">
            	<p>现已击毙年兽<input type="text" id="beast_die" readonly/>个</p>
                <span class="b1">
                    <input class="" type="button" id="cj" value="点击兑换" />
                </span>
                <div class="show">
                	{foreach key=k item=v from=$beast_zhuangbei}
                    <p val="{$k}">{$v}</p>
                    {/foreach}
                </div>
                <input type="hidden" id="zb_index"/>
                <input class="b2" type="button" value="" id="beast_change"/>
            </div>
        </div>
<script "text/javascript">
{literal}
$(function(){
	var beastUrl = '/qhd/newyear/beast.php';
	get_beast_info(beastUrl);
	$(".b1").click(function(){
        $(".show").show();
    });
    $(".show p").click(function(){
        var index = $(this).index();
        var text = $(this).text();
        $('#zb_index').val($(this).attr('val'));
        $("#cj").val(text)
        $(".show").hide();
    });
	$('#beast_change').click(function(){
		$.post(beastUrl,{'a':'change','zb_index':$.trim($('#zb_index').val())},function(d){
			if(d && d.code == 0){
				$("#dherror").show();
			}else{
				alert(d.msg);
			}
		},'json');
	});
	$('#nianshou li').click(function(){
		var index = $(this).index() + 1;
		$.post(beastUrl,{'a':'fried','index':index},function(d){
			if(d){
				if(d.code < 0){
					if(d.code == -2){
						window.location.href='/login';
					}	
					alert(d.msg);
				}else{
					if(d.code == 1){
						if(d.shanghai_count < 3){
							$(".remove-r2").show();
							$("#shanghai").text(d.shanghai);
							$("#remaining").text(d.remaining);
						}else{
							$(".remove-r1").show();
							get_beast_info(beastUrl);
						}
					}else{
						$(".remove-r2").show();
						$("#shanghai").text(d.shanghai);
						$("#remaining").text(d.remaining);
						alert(d.msg);
					}
				}
			}
		},'json');
	});
});
function get_beast_info(beastUrl){
	$.post(beastUrl,{'a':'info'},function(d){
		if(d && d.code == 0){
			var count = 0;
			$.each(d.data,function(i,j){
				if(j == 3){
					count++;
					i = i-1;
					$($('#nianshou li')[i]).find("div").find("img").removeClass("animate");
				}
			});
			$('#beast_die').val(count);
		}
	},'json');
}
{/literal}
</script>
        <!-- 正文 -->
    	<!-- 左侧 -->
       <!-- 点我抢料-->
        <div class="tulation remove success stairs-t1" style="display:none;">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <p>今日成功抢到</p>
            <strong></strong>
        </div>

        <div class="crump-left remove tulation3 stairs-t2" style="display:none;" id="noLiao">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <p style="margin-left: 0; padding-left: 0">今天的材料已被抢完</p>
            <strong>明天继续哦！</strong>
        </div>
        <div class="crump-left remove tulation4 stairs-t2" id="noNumber">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <p>您今天三次免费机会已经用完</p>
            <strong>明天继续哦！</strong>
        </div>

         <!--兑换色币  -->
        <div class="tulation remove tulation2 stairs-t1" style="display:none;" id="duihuan2">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <p>今日兑换到</p>
            <strong>50色币</strong>
        </div>

         <div class="crump-left remove tulation3 stairs-t2" style="display:none;" id="duiReeor">
            <a href="javascript:;"></a>
            <input type="button" value="去做饺子"/>
            <p>非常抱歉兑换失败</p>
            <strong>赶紧开工制作你的饺子去</strong>
        </div>
    	<!-- 年兽 -->
        <div class="tulation remove remove-r1 stairs-t1" style="display: none;">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <p>成功击毙</p>
            <strong>年兽一个</strong>
            <p>继续加油</p>
        </div>

        <div class="tulation remove remove-r2 stairs-t1" style="display: none;">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <p>炸年兽成功造成</p>
            <strong id="shanghai">1次伤害</strong>
            <p id="remaining">继续炸2次</p>
            <p>击毙此年兽</p>
        </div>
        <!--猜灯-->
        <!--恭喜你-->
         <div class="tulation remove remove-r5 stairs-t3" style="display:none" id="cdOK">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <div id="success">
            <p>今日成功抢到</p>
            <strong>年兽一个</strong>
            <p>联系客服兑换</p>
            </div>
        </div>


        <div class="tulation remove remove-r6 stairs-t3 tulation1" id="cderror">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <p style="margin-top:5px;">没猜到哦</p>
            <p style="margin-top:5px;">明天继续</p>
            <p style="margin-top:5px;">再接再厉</p>
        </div>

         <div class="tulation remove remove-r5 stairs-t3" style="display:none" id="dherror">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <p style="margin-top: 180px">兑换装备成功</p>
        </div>

        <!--很遗憾-->
        <div class="tulation remove tulation5 stairs-t3 tulation2" id="cdfailure" style="display:none">
            <a href="javascript:;"></a>
            <input type="button" value="确定" class="close"/>
            <p>您今天的一次免费猜灯机会已经用完</p>
            <strong>明天继续哦</strong>
        </div>

        <!--留言板-->
        <div class="crump-div1 remove remove-r4 stairs-t2">
            <a href="javascript:;"></a>
            <ul id="blessing_newyear">
            </ul>
            <div>
                <p><input type="text" class="zf" placeholder="输入您的新年祝福" maxlength="10" id="blcontext"/></p>
                <p>
                    <input type="text" class="qq" placeholder="输入赠礼联系QQ" maxlength="10" id="blqq" style="width: 130px;">
                    <input type="button" value="留言" id="bless"/>
                </p>
            </div>
        </div>
    	<!-- 右侧 --> 
    </div>
</div>
<script "text/javascript">
{literal}
$(function(){
	var blessUrl = '/qhd/newyear/bless.php';
	$(".remove a, .close").click(function(event){
		event.stopPropagation();
		$(this).parents(".remove").hide();	
	});
	$("#blessing").click(function(){
		$(".remove-r4").show();
	});
	$.post(blessUrl,{'a':'info'},function(d){
		if(d && d.code == 0){
			var html = '';
			$.each(d.bless,function(i,j){
				html += '<li><span>'+j.context+'</span><span>'+j.uname+'</span><span>'+j.atime+'</span></li>';
			});
			$('#blessing_newyear').html(html);
		}
	},'json');
	$('#bless').click(function(){
		var qq = $.trim($('#blqq').val());
		var context = $.trim($('#blcontext').val());
		if(qq == ''){
			alert('请填写联系QQ');
			return;
		}
		if(context == ''){
			alert('请填写新年祝福');
			return;
		}
		$.post(blessUrl,{'a':'bless','qq':qq,'context':context},function(d){
			if(d){
				alert(d.msg);
				if(d.code == 0){
					$(".crump-div1").hide();
				}else if(d.code == -2){
					window.location.href = '/login';
				}
			}
		},'json');
	});
});
{/literal}
</script>
<!-- 第二屏 -->
<!-- 第三屏 -->
<div class="min1200 moration-div3">
	<div class="width870 key">
    	<a class="s1" href="http://kb88dc16.com/" target="_blank"></a>
        <ul id="denglong">
        	<li style="cursor:pointer;"><img src="images/denglong.png"></li>
        	<li style="cursor:pointer;"><img src="images/denglong.png"></li>
        	<li style="cursor:pointer;"><img src="images/denglong.png"></li>
        	<li style="cursor:pointer;"><img src="images/denglong.png"></li>
        	<li style="cursor:pointer;"><img src="images/denglong.png"></li>
        	<li style="cursor:pointer;"><img src="images/denglong.png"></li>
        </ul>
    	<a class="s2" href="http://kb88dc16.com/" target="_blank"></a>
        <div class="m key-m">
        	<p>活动期间每位用户每日均有一次猜灯机会使用；</p>
        	<p>限青青草在线视频网站有效优惠域名猜奖兑换有效；</p>
        	<p>活动期间内有存款且满足存款≥100会员参与；</p>
        </div>
    </div>
</div>
<script "text/javascript">
{literal}
$(function(){
	var beastUrl = '/qhd/newyear/yuanxiao.php';
	$('#denglong li').click(function(){
		var index = $(this).index();
		$.post(beastUrl,{'yx_index':index},function(d){
			if(d){
				switch(d.code){
					case 0:
						$('#success').html(d.msg);
						$("#cdOK").show();
						break;
					case -2:
						window.location.href = '/login';
						alert(d.msg);
						break;
					case -3:
						$("#cdfailure").show();
						break;
					case -4:
						$("#cderror").show();
						break;
					default:
						alert(d.msg);
						break;
				}
			}
		},'json');
	});
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
	$("#scrollTop").click(function(){
		$("body,html").animate({"scrollTop":0});	
	})
});
{/literal}
</script>
<!-- 第三屏 -->
<!-- 第四屏 -->
<div class="min1200 moration-div4">
	<div class="width870">
    	<strong>向青青草网站送出你的祝福，每日均有一次点击送祝福机会，每成功发出一条你的祝福，青青草账号可获赠一个色币免费看
视频！活动期间累计，累计送出祝福最多的前三甲，活动结束后次日2017.2.12派发情人节特别赠礼，所以参与活动的亲爱
的们记得附上您的联系QQ哦以方便客服联系为您送出三甲赠礼！</strong>
		<ul>
        	<li><img src="images/4-01.png" alt="" title="" /></li>
        	<li><img src="images/4-02.png" alt="" title="" /></li>
        	<li><img src="images/4-03.png" alt="" title="" /></li>
        </ul>
        <input type="button" value="" / id="blessing">
        <em>活动时间：2017年1月27号—2017年2月11号</em>
        <div class="m">
        	<p>限每个IP用户日均一次送出祝福机会；</p>
        	<p>前三甲限3个名额，祝福数量一致优先选择有提供联系QQ方式的领取</p>
        	<p>均有QQ号联系取祝福送的最好者送礼！</p>
        	<p> 赠礼兑换联系QQ： <a href="javascript:;">2880465614</a></p>
        </div>
    </div>
</div>
<!-- 第四屏 -->
<!-- 第五屏 -->
<div class="min1200 moration-div5">
	
</div>
<!-- 第五屏 -->
<div style="position: fixed;bottom: 0;right: 0;width: 4%;">
    <div><a href="/" target="_blank"><img src="/templates/frontend/frontend-default/img/show_index.png"></a></div>
    <div><a href="javascript:void(0);" id="scrollTop"><img src="/templates/frontend/frontend-default/img/scroll_top.png"></a></div>
  </div>
</body>
</html>