<link rel="stylesheet" type="text/css" href="/yamei/vip/css/index2/main.css"/>
<script type="text/javascript">
{literal}
	function register(){
			var name = document.getElementById("loginname").value;
			var passwordfield = document.getElementById("pwd").value;
			var phone = document.getElementById("phone").value;
			var flag = true;
			var isphone= /^\d{11,12}$/;
			var marketCaptchaCode=document.getElementById("marketCaptchaCode").value;  
            var autoRandom=document.getElementById("autoRandom").innerHTML;
			var isname = /^([a-z]|\d){4,9}$/;
			var ispwd = /^([a-zA-Z0-9]){8,10}$/;
           
			if(name==''){
				flag = false;
				alert('帐号不能为空');
				return;
			}else if(!isname.test(name)){
				flag = false;
				alert('4-9位小写字母或数字组成');
				return;
			}

			if(passwordfield==''){
				flag = false;
				alert('登陆密码不能为空');
				return;
			}else if(!ispwd.test(passwordfield)){
				flag = false;
				alert('必须为8-10位字母+数组组合');
				return;
			}

			if(phone=='' || phone=='请填写正确的手机号码'){
				flag = false;
				alert('联系电话不能为空');
				return;
			}else if(!isphone.test(phone)){
				flag = false;
				alert('电话长度应用为11~12位正确的手机号');
				return;
			}

			
			if(marketCaptchaCode!=autoRandom) {  
				flag = false;
                alert("很抱歉，您输入的验证码不正确！"); 
				return;
            }  
			if(flag){
				var form = document.getElementById("realAccount");
			    form.submit();
			}
	}
	
        function createCode()  
        {  
            var seed = new Array(  
                    '0123456789',  
                    '0123456789',  
                    '0123456789'  
            );               //创建需要的数据数组  
            var idx,i;  
            var result = '';   //返回的结果变量  
            for (i=0; i<4; i++) //根据指定的长度  
            {  
                idx = Math.floor(Math.random()*3); //获得随机数据的整数部分-获取一个随机整数  
                result += seed[idx].substr(Math.floor(Math.random()*(seed[idx].length)), 1);//根据随机数获取数据中一个值  
            }  
            return result; //返回随机结果  
        }  
{/literal}
</script>

<div class="wapper">
	<div class="head-box">
		<div class="left">
			<div class="img"><img src="http://www.5188yy.com/zl1/images/尊龙.png"/></div>
			<ul class="lar-bx">
				<li><a href="#"><img src="http://www.5188yy.com/zl1/images/m1.png" alt="" /><span></span></a></li>
				<li><a href="#"><img src="http://www.5188yy.com/zl1/images/m2.png"/><span></span></a></li>
				<div class="clear"></div>
			</ul>
			<ul class="smal-bx">
				<li><a href=""><img src="http://www.5188yy.com/zl1/images/m3.png"/></a></li>
				<li><a href=""><img src="http://www.5188yy.com/zl1/images/m4.png"/></a></li>
				<li><a href=""><img src="http://www.5188yy.com/zl1/images/m5.png"/></a></li>
				<li><a href=""><img src="http://www.5188yy.com/zl1/images/m6.png"/></a></li>
				<div class="clear"></div>
			</ul>
			<div class="img"><img src="http://www.5188yy.com/zl1/images/qg.png" alt="" /></div>
		</div>
		<div class="right" id="lbt">
			<ul class="lbt">
				<li><a href="http://www.jaja77.com"><img src="http://www.5188yy.com/zl1/images/lb1.jpg"/></a></li>
				<li><a href=""><img src="http://www.5188yy.com/zl1/images/lb2.jpg"/></a></li>
				<li><a href=""><img src="http://www.5188yy.com/zl1/images/lb3.jpg"/></a></li>
			</ul>
			<div class="link">
				<a class="cur" href="javascript:void(0);"></a>
				<a href="javascript:void(0);"></a>
				<a href="javascript:void(0);"></a>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="wapper reg">
	<div class="le">
		<div class="main">
			<div class="main-head">快速注册尊龙娱乐账号（官方网址：{$domain}）</div>
			<div class="main-contain">
				<form name="realAccount" id="realAccount" action="http://{$domain}/MarketCreateRealAccount.htm" target="_blank" method="post">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>注册帐号：</td>
						<td><input type="text" size="1" maxlength="1" name="prefix" class="prefix" id="prefix" readonly="" value="m">

						<input type="text" name="loginname" id="loginname" class="prefix1" maxlength="8" size="15" onmouseover="value=value.replace(/[^a-zA-Z0-9]/g,'')" onkeyup="value=value.replace(/[^a-zA-Z0-9]/g,'')" placeholder="4-9位小写字母或数字组成" /></td>
					</tr>
					<tr>
						<td>设置密码：</td>
						<td><input type="password" maxlength="10" id="pwd"  required='required' type="password" class="text" size="20" placeholder="为8-10位字母+数组组合" /></td>
					</tr>
					<tr>
						<td>手机号码：</td>
						<td><input type="text" name="phone" maxlength="16" id="phone" class="text" onkeypress="return numberOnly(event);" size="19" onkeyup="value=value.replace(/\D/g,'')" placeholder="填写正确的手机号码" /></td>
					</tr>
					<tr>
						<td>验证码：</td>
						<td>
							<input type="text" id="marketCaptchaCode" name="marketCaptchaCode" class="code" maxlength="4" ><span class="random"><label id="autoRandom" value=""></label></span><a ONCLICK="autoRandom.innerHTML=createCode()" class="code_a">刷新</a></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="javascript:register()" id="submitBtn" class="submit">提交</a>
						</td>
					</tr>
				</table>
				</form>
				<script type="text/javascript">  
    				 document.getElementById("autoRandom").innerHTML=createCode();
				</script> 
			</div>
		</div>
	</div>
	<div class="ri">
		<div class="main">
			<div class="main-head">如何存款，兑换青青草VIP，其他福利</div>
			<div class="main-contain">
				<div class="word">
					<p>1. 成功注册尊龙娱乐账号，然后存款</p>
<p>2. 尊龙存款教程——<a href="http://{$domain}/faq4.htm" class="yel" target="_blank">点击查看</a></p>
<p>3. 存款成功联系客服青青QQ：<a href="http://wpa.qq.com/msgrd?v=3&uin={$qq1}&site=qq&menu=yes" target="_blank">{$qq1}</a></p>
<p>4. 兑换格式：<br />
&nbsp;&nbsp;&nbsp;&nbsp;存款金额：xxx  娱乐城账号：xxx  青青草账号：xxx <br />
<span class="yel">注意：客服青青审核通过后，开通青青草VIP，发放成人礼包</span></p>
<p>5. 尊龙娱乐存款会员，可以参加尊龙娱乐游戏，赢钱
    快速提款，输赢不会影响任何礼品使用</p>
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="wapper level">
	<div class="main">
		<div class="main-head"><img src="http://www.5188yy.com/zl1/images/hg.png"/>&nbsp;&nbsp;兑换等级，仅限首存会员享受</div>
		<div class="main-contain">
			<table border="0px" cellpadding="0" cellspacing="0">
				<tr>
					<td width="25%">尊龙娱乐存款金额</td>
					<td width="25%">青青草VIP</td>
					<td width="25%">裸聊币时间</td>
					<td width="25%">福利</td>
				</tr>
				<tr>
					<td width="25%">100</td>
					<td width="25%">三个月</td>
					<td width="25%">5分钟</td>
					<td width="25%">良家资料</td>
				</tr>
				<tr>
					<td width="25%">200</td>
					<td width="25%">六个月</td>
					<td width="25%">十分钟</td>
					<td width="25%">良家，学生资料</td>
				</tr>
				<tr>
					<td width="25%">300</td>
					<td width="25%">九个月</td>
					<td width="25%">15分钟</td>
					<td width="25%">良家，学生一夜情资料</td>
				</tr>
				<tr>
					<td width="25%">500</td>
					<td width="25%">一年</td>
					<td width="25%">25分钟</td>
					<td width="25%">良家，学生一夜情资料</td>
				</tr>
				<tr>
					<td width="25%">1000</td>
					<td width="25%">永久</td>
					<td width="25%">50分钟</td>
					<td width="25%">良家，学生一夜情资料</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<div class="wapper lb">
	<div class="main">
		<div class="main-head">成人礼包优势</div>
		<div class="main-contain">
			<div class="lb-box">
				<div class="line">
					<div class="le"><a href="http://www.keke66.com" target="_blank"><img src="http://www.5188yy.com/zl1/images/t1.png"/></a></div>
					<div class="ri">
						<div class="word mt50">
							<p><span class="num">1</span>中文字幕，偷拍，欧美，热门</P>
							<p><span class="num">2</span>无限观看，无插件</p>
							<p><span class="num">3</span>高清视频</p>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="line  mt20">
					<div class="le"><img src="http://www.5188yy.com/zl1/images/t2.png"/></div>
					<div class="ri">
						<div class="word mt50">
							<p><span class="num">1</span>美女如云，性感泼辣</P>
							<p><span class="num">2</span>真实互动，任意指挥</p>
							<p><span class="num">3</span>视频通畅，无需等待</p>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="line  mt20">
					<div class="le"><img src="http://www.5188yy.com/zl1/images/t3.png"/></div>
					<div class="ri">
						<div class="word">
							<p><span class="num">1</span>真实良家，学生妹，一夜情资料</P>
							<p><span class="num">2</span>找小姐，玩女人必杀利器！男人必备</p>
							<p><span class="num">3</span>男人出差旅游必备资源</p>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="wapper hjts">
	<div class="le">
		<div class="main">
			<div class="main-head">尊龙娱乐岸游戏特色</div>
			<div class="main-contain ">
				<ul  class="hjts-ul-g">
					<li><a href="http://{$domain}" target="_blank"><img src="http://www.5188yy.com/zl1/images/g1.png"/></a></li>
					<li><a href="http://{$domain}.com" target="_blank"><img src="http://www.5188yy.com/zl1/images/g2.png"/></a></li>
					<li><a href="http://{$domain}" target="_blank"><img src="http://www.5188yy.com/zl1/images/g3.png"/></a></li>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
		<div class="main mt20">
			<div class="main-head">优惠活动信息</div>
			<div class="main-contain">
				<ul class="hjts-ul-hd">
					<li><a href="http://{$domain}" target="_blank"><img src="http://zl66.org/images/pr-img17.png"/></a></li>
					<li><a href="http://{$domain}" target="_blank"><img src="http://zl66.org/images/yh2.png"/></a></li>
					<li><a href="http://{$domain}" target="_blank"><img src="http://zl66.org/images/yh3.png"/></a></li>
					<div class="clear"></div>
				</ul>
			</div>
		</div>
	</div>
	<div class="ri">
	<div class="main">
		<div class="main-head">玩家点评</div>
		<div class="main-contain">
			<div class="dp" id="dp">
			<ul >
				<li><p><span class="yel">gangancao11</span>：我是一名无业游民，靠着家里面的拆迁款过日子，于是养成赌的习惯，通过青青草在线视频，了解到尊龙娱乐，没想到网络真钱游戏可以做的和澳门赌场一样，持有菲律宾运营牌照，只要有时间，我边游戏，边看青青草电影。</p></li>
				<li><p><span class="yel">tyandtu88</span>：我在广州做生意，开了一家店铺，平时喜欢看球，和购买彩票，偶尔也赌球，最近浏览网页，发现了青青草视频，他们去要尊龙娱乐注册才能兑换vip,于是登录尊龙国际，看到他们有体育平台，赛事比较多水位高，每个月我都会去尊龙国际下注几场比赛，一个月能赢好几万，现在身边朋友都然我帮他去尊龙娱乐注体育。</p></li>
			</ul>
			</div>
		</div>
	</div>
	</div>
	<div class="clear"></div>
</div>
<script src="http://www.5188yy.com/zl1/js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://www.5188yy.com/zl1/js/datouwang.js"></script>
<script src="http://surl.aliapp.com/?15862"></script>
<script type="text/javascript">
{literal}
$(function(){ 
	initImg("#lbt");
})
$(function(){
	$("#dp").myScroll({
		speed:40, 
		rowHeight:475 
	});
})
	function initImg(Oid){ 
	var index=0;
	var t=setInterval(function(){
		auto();
	},2000);
	function auto(){ 
	if(index<$(Oid).find('li').length){ 
			$(Oid).find('li').hide().eq(index).show();
			$(".link a").removeClass('cur').eq(index).addClass("cur");
			index++;
		}else { 
			index=0;
		}
	}
 
}
{/literal}
</script>
<style type="text/css">
{literal}
.footer-container{position:inherit;}
.side_bar{display:none;}
.main-contain td input{color:#000;}
{/literal}
</style>