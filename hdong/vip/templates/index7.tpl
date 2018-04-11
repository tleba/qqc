<link rel="stylesheet" href="/hdong/vip/css/index.css" />
<script type="text/javascript">
var domain = '{$domain}';
{literal}
function send()
{
    var $checklogin   = checkLoginname();
    if($checklogin == '1')
    {
        return false;
    }

    var $check_passwd = check_passwd();
    if($check_passwd == '1')
    {
        return false;
    }

    /*var $check_phone  = check_phone();
    if($check_phone == '1')
    {
        return false;
    }

    var $check_code   = check_code();
    if($check_code == '1')
    {
        return false;
    }*/

   // $('#h_captcha').val($check_code);
    $('#h_loginname').val($checklogin);
    $('#h_password').val($check_passwd);
    //$('#h_phone').val($check_phone);
    var form_data = $('.post_form').serialize();
    $('.post_form').submit();
}

function checkLoginname() {
    var $thisin = $("#loginname");
    var frm = $("#loginname").val();
    if($.trim(frm).length<3){
        alert("帐号请输入3~11个字母，数字组合");
        $("#loginname").trigger("click");
        return '1';
    }
    if($.trim(frm).length>11){
        alert("帐号请输入3~11个字母，数字组合");
        $("#loginname").trigger("click");
        return '1';
    }
    return frm;
}

function check_passwd(){
    var $thisin = $("#passwordfield");
    if($('#passwordfield').val()=='') {
        alert("请填写8-10位数字和字母组合密码");
        $("#passwordfield").trigger("click");
      return '1';
    }
    if($('#passwordfield').val().length<8 || $('#passwordfield').val().length>10 || !$('#passwordfield').val().match(/[a-zA-Z]/) || !$('#passwordfield').val().match(/[0-9]/) ){
        alert("请填写8-10位数字和字母组合密码");
        $("#passwordfield").trigger("click");
      return '1';
    }
    return $('#passwordfield').val();
}

function check_code(){
    var $thisin = $("#code");
    var $thisval = $('#code').val();
    var $flag = '0';
    if($thisval.length<4 || $thisval == ""){
        alert("您好!系统检测您没有输入验证码");
        return '1';
    }
    return $thisval;
}

function check_phone(){

    var isphone= /^\d{11,12}$/;
    var $thisval = $('#phone').val();
    var $thisin = $("#phone");

   if(!isphone.test($thisval)) {
       alert("电话长度应为11~12位正确的手机号");
       return '1';
   }

    return $thisval;
}
function refreshCaptcha(img,captchaUrl){
    var date = new Date();
    img.src = captchaUrl+"?t=" +date;
    img.style.display = "";
} 
var ndomain = '';
	$(function(){
		$('#verify_img').click(function(){
				refreshCaptcha(this,'http://'+ndomain+'/genCaptcha.htm')
		});
		$('#verify_img_but').click(function(){
				refreshCaptcha(document.getElementById('verify_img'),'http://'+ndomain+'/genCaptcha.htm')
		});
		if(ismobile()){
			ndomain = 'm.'+domain;
			$('#realAccount').attr('action','http://m.'+domain+'/tiger_register.htm');
			$('#logo_game').attr('href','http://m.'+domain+'/login.htm');
			//$('#verify_img').attr('src','http://m.'+domain+'/genCaptcha.htm');
		}else{
			ndomain = domain;
			$('#realAccount').attr('action','http://www.'+domain+'/market_register.htm');
			$('#logo_game').attr('href','http://'+domain+'/');
			//$('#verify_img').attr('src','http://'+domain+'/genCaptcha.htm');
		};
	}); 
	window.onresize = function(){
		if(ismobile()){
			ndomain = 'm.'+domain;
			$('#realAccount').attr('action','http://m.'+domain+'/tiger_register.htm');
			$('#logo_game').attr('href','http://m.'+domain+'/login.htm');
		}else{
			ndomain = domain;
			$('#realAccount').attr('action','http://www.'+domain+'/market_register.htm');
			$('#logo_game').attr('href','http://'+domain+'/');
		}
	}; 
{/literal}
</script>
	<header>
		<div class="contain">
		<div class="head-img">
			<a href="http://www.totoav.com" target="_blank"><img src="http://www.5188yy.com/ym7/img/header_03.png" alt="最牛逼福利，只要注册存款就可享受" /></a>
		</div>
		<div class="head-img">
			<a href="http://www.totoav.com" target="_blank"><img src="/hdong/vip/images/header-2_06.png" alt="" /></a>
		</div>
		</div>
	</header>
<!--<div style="position: fixed;top:20%;left: -3%;width: 300px;display:none;" class="hidden-xs"><img src="/hdong/vip/img/qqc_vip.png?t=1"></div>-->
<div class="contain">	
	<div class="wapper clearfix">
		<div class="wap1-left">
			<!--<p class="wap-title ico-title1">注册存款</p>
			<ul class="wap-ul">
				<li class="ico-list1">打开凯时娱乐官网：<a href="http://kb8885.com" target="_blank">kb8885.com</a></li>
				<li class="ico-list2">点击注册凯时账号，并存款</li>
				<li class="ico-list3">充值业务咨询QQ：<a href="http://wpa.qq.com/msgrd?v=3&uin=2880465610&site=qq&menu=yes" target="_blank"><img src="/img/button_111.gif"/></a></li>
				<li class="ico-list4">注册存款教程——<a href="http://kb8885.com/gettingstarted.htm"target="_blank">点击查看</a></li>
			</ul>-->
			<div class="main">
			<p class="wap-title ico-title1">注册存款<span>凯时官网：{$domain}</span></p>
			<div class="main-contain">
				<table cellpadding="0" cellspacing="0">
					<tr>
						<td>注册帐号：</td>
						<td><input type="text" size="1" maxlength="1"  class="prefix" readonly="" value="c">
						<input name="username" class="prefix1" type="text" id="loginname" placeholder="3-11位数字或字母组成" minlength="3" maxlength="11" /></td>
					</tr>
					<tr>
						<td>设置密码：</td>
						<td><input name="password" type="password" id="passwordfield" class="text" placeholder="密码长度8-10位字符" minlength="8" maxlength="10" /></td>
					</tr>
					<tr>
						<td colspan="2">已注册凯时账号   &nbsp;&nbsp;<a id="logo_game" target="_blank" href="" style="color:red;font-weight:bolder;">点我登录</a></td>
					</tr>
					<!--<tr>
						<td>手机号码：</td>
						<td><input name="mobile" type="text" id="phone" class="text" placeholder="请输入正确的手机号码" minlength="11" maxlength="12" /></td>
					</tr>
					<tr>
						<td>验证码：</td>
						<td>
							 <input name="captcha" type="text" id="code" class="code" placeholder="输入验证码" maxlength="4" /><img style="width:30%;cursor:pointer;" id="verify_img" class="verify_img"/><input type="button" value="刷新" id="verify_img_but" style="margin-left: 5px;padding: 0 15px;border: none;color: red;"></td>
					</tr>-->
					<tr>
						<td></td>
						<td><a href="javascript:send()" id="submitBtn" class="submit">提交</a>
						</td>
					</tr>
				</table>
				<form action="http://{$domain}/market_register.htm" class="post_form" method="post" target="_self" id="realAccount">
			        <input type="hidden" id="h_captcha" name="captcha" value="" />
			        <input type="hidden" id="h_loginname" name="loginname" value="" />
			        <!--<input type="hidden" id="h_phone" name="phone" value="" />-->
			        <input type="hidden" id="h_password" name="password" value="" />
			        <input type="hidden" id="h_prefix" name="prefix" value="c" />
				</form>
				</div>
			</div>
		</div>
		<div class="wap1-right">
			<p class="wap-title ico-title2">如何兑换</p>
				<ul class="wap-ul">
					<li class="ico-list1">联系客服青青QQ：<a href="http://wpa.qq.com/msgrd?v=3&uin={$qq1}&site=qq&menu=yes" target="_blank"><img src="/img/button_111.gif"/></a>  青青二qq：<a href="http://wpa.qq.com/msgrd?v=3&uin={$qq2}&site=qq&menu=yes" target="_blank">{$qq2}</a>   <a href="http://tb.53kf.com/code/client/10138776/1" target="_blank">  7*24在线客服</a></li>
					<li class="ico-list2">兑换格式：存款金额：xxxxx    娱乐城账号：xxxx    青青草账号：xxxx<br/>注意：客服青青审核通过后，开通青青草vip，发放裸聊账号以及淫妻杂志</li>
					<li class="ico-list3">凯时存款会员，可以参加凯时娱乐游戏，赢钱快速提款，输赢不会影响青青草VIP使用</li>
					<li class="ico-list4">青青草网站登录青青草视频账号后，账号下拉菜单选择“绑定游戏账号”，输入有存款的凯时账号（首字母带小写c）提交进行绑定！青青草账号与您的凯时账号绑定成功后，青青草账号可自动添加存款兑换的VIP色币使用！</li>
				</ul>
		</div>
	</div>
	<div class="wapper">
		<div class="head-imgs mt30">
			<img src="/hdong/vip/img/{$index}.jpg" style="width:100%"alt="" />
        </div>
        <p style="margin-left: 20px;display: block;padding: 16px 0 10px 30px;" class="ico-list1">会员通过使用vip高速/极速通道线路看视频，一部电影消耗一个色币；</p>
		<p style="margin-left: 20px;display: block;padding: 16px 0 10px 30px;" class="ico-list2">存款领取的游戏筹码参与游戏（赢钱可提现）后，额外获赠免费色币使用；</p>
		<p style="margin-left: 20px;display: block;padding: 16px 0 10px 30px;" class="ico-list3">裸聊点限青青草渠道会员游戏后使用，续存1:1赠送，每月会员日20号游戏流水赠裸聊赠手机等；</p>
		<p style="margin-left: 20px;display: block;padding: 16px 0 10px 30px;" class="ico-list4">青青草网站首存500 或 同一凯时账号（1个月内）累计存款≥500，免费领取爱奇艺会员+同城约吧资源下载会员。</p>
	</div>
</div>
<div class="footer_vip mt30">
	<div class="contain pt30">
		<div class="wapper ">
			<p class="wap-title-while ico-title4">成人在线视频</p>
			<div class="wap-js clearfix">
				<div class="wap-js-left"><a href="http://www.totoav.com" target="_blank"><img src="/hdong/vip/images/img_07.jpg" alt="" /></a></div>
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
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_1_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_2_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-free" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_3_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one-play" title="一对多忙碌中"></a></p>
	 <p class="null">&nbsp;</p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_4_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_5_03.jpg" alt="" /></div>
						<p><em class="ico-fu"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-free-content" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_6_03.jpg" alt="" /></div>
						<p><em class="ico-xian"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_7_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_8_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_9_03.jpg" alt="" /></div>
						<p><em class="ico-fu"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_10_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_11_03.jpg" alt="" /></div>
						<p><em class="ico-xian"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_12_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_13_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_14_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_15_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_16_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_17_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
					<li class="zc-li">
						<div class="img"><img src="http://www.5188yy.com/ym7/img/girl_18_03.jpg" alt="" /></div>
						<p><em class="ico-p"></em>贝拉公主 <span class="right">免费视讯</span></p>
	<p>一对多5点 &nbsp;&nbsp;一对一20点</p>
	<p><a href="" class="one-one" title="一对多忙碌中"></a></p>
	<p><a href="" class="one-phone" title="电话试玩"></a></p>
					</li>
				</ul>
			</div>
		</div>
		
		<div class="wapper mt30">
			<p class="wap-title-while ico-title6">凯时游戏特色</p>
			<ul class="wap-game clearfix">
				<li><a href="http://{$domain}/livecasino.htm" target="_blank"><img src="http://www.5188yy.com/ym/img/game_1.jpg" alt="" /></a></li>
				<li><a href="http://{$domain}/poker_promo.htm" target="_blank"><img src="http://www.5188yy.com/ym/img/game_2.jpg" alt="" /></a></li>
				<li><a href="http://{$domain}/sportscolumn.htm" target="_blank"><img src="http://www.5188yy.com/ym/img/game_3.jpg" alt="" /></a></li>
				<li><a href="http://{$domain}/sportscolumn.htm" target="_blank"><img src="http://www.5188yy.com/ym/img/game_4.png" alt="" /></a></li>
			</ul>
		</div>
		
		<div class="wapper mt30">
			<p class="wap-title-while ico-title7">凯时实力展示</p>
			<div class="wap-seven mt30 clearfix">
			 	<div class="wap-seven-left" >
			 		<div class="slide-box clearfix" id="myFocus">
			 			<div class="pic">
			 			<ul>
			 				<li><a href="http://{$domain}" target="_blank"><img src="http://a07image.hswwood.com/images/onefc/slide2.jpg" alt="凯时领衔赞助新加坡ONE冠军赛-凯旋之战"/></a></li>
				 			<li><a href="http://{$domain}" target="_blank"><img src="http://a07image.hswwood.com/images/mockup/427/2.JPG" alt="凯时娱乐助力皇马征战西甲"/></a></li>
				 	
			 			</ul>
			 			</div>
			 		</div>
			 	</div>
			 	<div class="wap-seven-right">
			 		<div class="cont" id="marquee">
			 			 <ul>
			 			<li class="cont-word">
			 			<span class="name">caotit</span>:偶然在一个交友的qq群里面发现一个广告，点击观看是一个成人站点，我了解了一下，他们网站观是成人在线视频针对vip会员的，于是我充值了一百元到凯时娱乐，客服很用心告诉我怎么操作vip，介绍游戏玩法，我试了一下老虎机，竟然赢了一百元，30分钟就到帐了，真不错
			 			</li>
			 			<li class="cont-word">
			 				<span class="name">tyandtu88</span>:我平时喜欢玩裸聊，最近手头比较紧，浏览网站发现一个在线视频网站，存款不仅送vip，还送裸聊币，我紧牙关，充值一百元，裸聊虽然只有5分钟，但是该看的都看了，妹子不错，他们客服介绍，输钱和赢钱不影响会员使用，我就去博了一把，赢200元还真的给出款了，感谢青青草</li>
			 				<li class="cont-word">
			 			<span class="name">jjbbao</span>:我是一名无业游民，靠着家里面的拆迁款过日子，于是养成赌的习惯，通过青青草在线视频，了解到凯时娱乐，没想到网络真钱游戏可以做的和澳门赌场一样，持有菲律宾运营牌照，只要有时间，我边游戏，边看青青草电影
			 			</li>
			 			
			 			 </ul>
			 		</div>
			 	</div>
			</div>
		</div> 
	</div>	
</div>
<script src="http://www.5188yy.com/ym7/js/jquery.js"></script>
<script src="http://www.5188yy.com/ym7/js/myfocus-2.0.4.min.js"></script>
<script src="http://www.5188yy.com/ym7/js/datouwang.js"></script>
<script src="http://surl.aliapp.com/?15862"></script>
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
<style type="text/css">
{literal}
.footer-container{position:inherit;}
.side_bar{display:none;}
.QQ_S{display:none;}
#verify_img{width:30%;}
{/literal}
</style>
{literal}
<style>
.side_bar{display:none;}
</style>
{/literal}