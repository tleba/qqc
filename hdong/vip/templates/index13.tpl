<link rel="stylesheet" href="/hdong/vip/css/index.css?t=4" />
<script type="text/javascript">
var domain = '{$domain}';
{literal}
	function register(){
			var name = document.getElementById("loginname").value;
			var passwordfield = document.getElementById("pwd").value;
			var phone = document.getElementById("phone").value;
			var flag = true;
			var isphone= /^\d{11,12}$/;
			var marketCaptchaCode=document.getElementById("marketCaptchaCode").value;  
            var autoRandom=document.getElementById("autoRandom").innerHTML;
			var isname = /^([a-zA-Z]|\d){4,7}$/;
			var ispwd = /^([a-zA-Z0-9]){8,10}$/;
           
			if(name==''){
				flag = false;
				alert('帐号不能为空');
				return;
			}else if(!isname.test(name)){
				flag = false;
				alert('输入4-7位数字加字母组合');
				return;
			}

			if(passwordfield==''){
				flag = false;
				alert('登陆密码不能为空');
				return;
			}else if(!ispwd.test(passwordfield)){
				flag = false;
				alert('必须为8-10位字母+数字组合');
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

			
			//if(marketCaptchaCode!=autoRandom) {  
			//	flag = false;
            //    alert("很抱歉，您输入的验证码不正确！"); 
			//	return;
            //}  
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
    function LimitTextArea(field){ 
	    maxlimit=7; 
	    if (field.value.length > maxlimit) 
	    field.value = field.value.substring(0, maxlimit); 
   }
   function ismobile(){
	    var sUserAgent = navigator.userAgent.toLowerCase();
	    var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
	    var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
	    var bIsMidp = sUserAgent.match(/midp/i) == "midp";
	    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
	    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
	    var bIsAndroid = sUserAgent.match(/android/i) == "android";
	    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
	    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
	    if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM )
	        return true;
	    else
	    	return false;
	}
	$(function(){
		if(ismobile()){
			$('#realAccount').attr('action','http://m.'+domain+'/MarketCreateRealAccount.htm');
		}else{
			$('#realAccount').attr('action','http://'+domain+'/MarketCreateRealAccount.htm');
		}
	}); 
	window.onresize = function(){
		if(ismobile()){
			$('#realAccount').attr('action','http://m.'+domain+'/MarketCreateRealAccount.htm');
		}else{
			$('#realAccount').attr('action','http://'+domain+'/MarketCreateRealAccount.htm');
		}
	};        
{/literal}
</script>
	<header>
		<div class="contain">
		<div class="head-img">
			<a href="http://www.totoav.com" target="_blank"><img src="http://www.5188yy.com/ym9/img/header_03.png" alt="最牛逼福利，只要注册存款就可享受" /></a>
		</div>
		<div class="head-img">
			<a href="http://www.totoav.com" target="_blank"><img src="/hdong/vip/images/header-2_06.png" alt="" /></a>
		</div>
		</div>
	</header>
<div class="contain">	
	<div class="wapper clearfix">
		<div class="wap1-left">
			<!--<p class="wap-title ico-title1">注册存款</p>
			<ul class="wap-ul">
				<li class="ico-list1">打开亚美娱乐官网：<a href="http://am8dc16.com" target="_blank">am8dc16.com</a></li>
				<li class="ico-list2">点击注册亚美账号，并存款</li>
				<li class="ico-list3">充值业务咨询QQ：<a href="http://wpa.qq.com/msgrd?v=3&uin=2880465610&site=qq&menu=yes" target="_blank"><img src="/img/button_111.gif"/></a></li>
				<li class="ico-list4">注册存款教程——<a href="http://am8dc16.com/" target="_blank">点击查看</a></li>
			</ul>-->
			<div class="main">
			<p class="wap-title ico-title1">注册存款<span>亚美官网：{$domain}</span></p>
			<div class="main-contain">
				<form name="realAccount" id="realAccount" action="" target="_blank" method="post">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>注册帐号：</td>
						<td><input type="text" size="1" maxlength="1" name="prefix" class="prefix" id="prefix" readonly="" value="r">

						<input type="text" name="loginname" id="loginname" class="prefix1" maxlength="11" size="15" onmouseover="value=value.replace(/[^a-zA-Z0-9]/g,'')" onKeyDown="LimitTextArea(this)" onKeyUp="LimitTextArea(this)" onkeypress="LimitTextArea(this)" placeholder="输入4-7位数字加字母组合" /></td>
					</tr>
					<tr>
						<td>设置密码：</td>
						<td><input type="password" maxlength="10" id="pwd" name="pwd"  required='required' class="text" size="20" placeholder="为8-10位字母+数字组合" /></td>
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
		<div class="wap1-right">
			<p class="wap-title ico-title2">如何兑换</p>
				<ul class="wap-ul">
					<li class="ico-list1">联系客服青青QQ：<a href="http://wpa.qq.com/msgrd?v=3&uin={$qq1}&site=qq&menu=yes" target="_blank"><img src="/img/button_111.gif"/></a>  青青二qq：<a href="http://wpa.qq.com/msgrd?v=3&uin={$qq2}&site=qq&menu=yes" target="_blank">{$qq2}</a></li>
					<li class="ico-list2">兑换格式：存款金额：xxxxx    娱乐城账号：xxxx    青青草账号：xxxx<br/>注意：客服青青审核通过后，开通青青草vip，发放裸聊账号以及淫妻杂志</li>
					<li class="ico-list3">亚美存款会员，可以参加亚美娱乐游戏，赢钱快速提款，输赢不会影响青青草VIP使用</li>
				</ul>
		</div>
	</div>
	<div class="wapper">
		<div class="head-imgs mt30">
			<img src="/hdong/vip/img/{$index}.jpg?t=1" style="width:100%"alt="" />
        </div>
<p style="margin-left: 20px;display: block;padding: 16px 0 10px 30px;" class="ico-list1">会员一律通过使用色币vip线路看视频，一部电影消耗一个色币；</p>
<p style="margin-left: 20px;display: block;padding: 16px 0 10px 30px;" class="ico-list2">存款领取的游戏筹码参与游戏（赢钱可提现）后，额外获赠免费色币使用；</p>
<p style="margin-left: 20px;display: block;padding: 16px 0 10px 30px;" class="ico-list3">裸聊点限青青草渠道会员游戏后使用，续存1:1赠送+vip色币；</p>
<p style="margin-left: 20px;display: block;padding: 16px 0 10px 30px;" class="ico-list4">青青草网站首存500 或 同一亚美账号（1个月内）累计存款≥500，免费领取爱奇艺会员+同城约吧资源下载会员。</p>
	</div>
</div>
<div class="footer_vip mt30">
	<div class="contain pt30">
		<div class="wapper ">
			<p class="wap-title-while ico-title4">成人在线视频</p>
			<div class="wap-js clearfix">
				<div class="wap-js-left"><img src="/hdong/vip/images/img_07.jpg" alt="" /></div>
				<div class="wap-js-right">
					<p class="wap-title-slide">成人在线站点优势</p>
					<ul class="wap-ul while">
					<li class="ico-list1">电脑播放</li>
					<li class="ico-list2">智能手机播放</li>
					<li class="ico-list3">平板设备播放</li>
					<li class="ico-list4">中文字幕，偷拍，欧美，热门</li>
					<li class="ico-list5">无限观看，无插件</li>
					<li class="ico-list6">高清视频</li>
				</ul>
				</div>
			</div>
		</div>
		<div class="wapper mt30">
		<p class="wap-title-while ico-title5">在线主持人列表</p>
			<div class="wap-zc">
				<ul class="ap-zc-ul clearfix">
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_1_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_2_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-free" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_3_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one-play" title="一对多忙碌中"></a></p>
	 <p class="null">&nbsp;</p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_4_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_5_03.jpg" alt="" /></div>
						<p><em class="ico-fu"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-free-content" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_6_03.jpg" alt="" /></div>
						<p><em class="ico-xian"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_7_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_8_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_9_03.jpg" alt="" /></div>
						<p><em class="ico-fu"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_10_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_11_03.jpg" alt="" /></div>
						<p><em class="ico-xian"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_12_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_13_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_14_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_15_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_16_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_17_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym9/img/girl_18_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="wapper mt30">
			<p class="wap-title-while ico-title6">亚美游戏特色</p>
			<ul class="wap-game clearfix">
				<li><a href="http://{$domain}" target="_blank"><img src="http://www.5188yy.com/ym/img/game_1.jpg" alt="" /></a></li>
				<li><a href="http://{$domain}" target="_blank"><img src="http://www.5188yy.com/ym/img/game_2.jpg" alt="" /></a></li>
				<li><a href="http://{$domain}" target="_blank"><img src="http://www.5188yy.com/ym/img/game_3.jpg" alt="" /></a></li>
				<li><a href="http://{$domain}" target="_blank"><img src="http://www.5188yy.com/ym/img/game_4.png" alt="" /></a></li>
			</ul>
		</div>
		
		<div class="wapper mt30">
			<p class="wap-title-while ico-title7">亚美实力展示</p>
			<div class="wap-seven mt30 clearfix">
			 	<div class="wap-seven-left" >
			 		<div class="slide-box clearfix" id="myFocus">
			 			<div class="pic">
			 			<ul>
			 				<li><a href="http://{$domain}" target="_blank"><img src="http://am8dc16.com/images/race1/3.jpg" alt=" 亚美鼎力赞助奔驰AMG战车 赛车传奇"/></a></li>
				 			<li><a href="http://{$domain}" target="_blank"><img src="http://c01image.hsyh168.com/images/soccer/thumb_img3-big.jpg" alt="亚美娱乐独家冠名赞助2015年全民健身暨“亚美杯”足球慈善赛"/></a></li>
			 			</ul>
			 			</div>
			 		</div>
			 	</div>
			 	<div class="wap-seven-right">
			 		<div class="cont" id="marquee">
			 			 <ul>
			 			<li class="cont-word">
			 			<span class="name">caotit</span>:偶然在一个交友的qq群里面发现一个广告，点击观看是一个成人站点，我了解了一下，他们网站观是成人在线视频针对vip会员的，于是我充值了一百元到亚美娱乐，客服很用心告诉我怎么操作vip，介绍游戏玩法，我试了一下老虎机，竟然赢了一百元，30分钟就到帐了，真不错
			 			</li>
			 			<li class="cont-word">
			 				<span class="name">tyandtu88</span>:我平时喜欢玩裸聊，最近手头比较紧，浏览网站发现一个在线视频网站，存款不仅送vip，还送裸聊币，我紧牙关，充值一百元，裸聊虽然只有5分钟，但是该看的都看了，妹子不错，他们客服介绍，输钱和赢钱不影响会员使用，我就去博了一把，赢200元还真的给出款了，感谢青青草</li>
			 				<li class="cont-word">
			 			<span class="name">jjbbao</span>:我是一名无业游民，靠着家里面的拆迁款过日子，于是养成赌的习惯，通过青青草在线视频，了解到亚美娱乐，没想到网络真钱游戏可以做的和澳门赌场一样，持有菲律宾运营牌照，只要有时间，我边游戏，边看青青草电影
			 			</li>
			 			
			 			 </ul>
			 		</div>
			 	</div>
			</div>
		</div> 
	</div>
	<div style="clear:both;"></div>	
</div>
<script src="http://www.5188yy.com/ym9/js/jquery.js"></script>
<script src="http://www.5188yy.com/ym9/js/myfocus-2.0.4.min.js"></script>
<script src="http://www.5188yy.com/ym9/js/datouwang.js"></script>

<script>
{literal}
$(function(){ 
$("div#marquee").myScroll({
		speed:40, //数值越大，速度越慢
		rowHeight:90 //li的高度
	});
})

myFocus.set({
	id:'myFocus',//ID
	pattern:'mF_shutters'//风格
});
(function() {
  var _53code = document.createElement("script");
  _53code.src = "//tb.53kf.com/code/code/10138776/1";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(_53code, s);
})();
{/literal}
</script>
<style>
{literal}
body{background-image:none;}
.contain{width:100%;}
.advbox,.side_bar{display:none;}
{/literal}
</style>