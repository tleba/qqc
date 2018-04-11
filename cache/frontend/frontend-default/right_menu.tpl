<link rel="stylesheet" type="text/css" href="/templates/frontend/frontend-default/css/base.css?t=39">
<div class="quick_links_wrap hidden-xs">
	<div class="quick_links_panel">
		<div id="quick_links" class="quick_links">
			<li>
				<a href="/qhd/member/" class="my_qlinks"><span class="huodong">青<br />青<br />草<br />会<br />员<br />日</span></a>
				<div class="ibar_login_box " style="display: none;">
					<a href="/qhd/member/"><img src="/templates/frontend/frontend-default/img/huodong.jpg"/></a>
					<i class="iconfont icon_arrow_white">&#xe607;</i></div>
			</li>
			<li>
				<a href="#" class="my_qlinks app" style="height:85px;"><i class="iconfont">&#xe603;</i>SVIP<br/>免费福利</a>
				<div class="ibar_login_box app_box " style="display: none;">
					<a href="/qhd/20171102/index.html" target="__blank">
						<img src="/templates/frontend/frontend-default/img/qqc_svip.jpg" style="width:180px;" alt="" />
					</a>
					<i class="iconfont icon_arrow_white">&#xe607;</i></div>
			</li>
			<li>
				<a href="/login" class="my_qlinks app dl"><i class="iconfont">&#xe601;</i>登录 </a>
				<!--<div class="ibar_login_box app_box dlk" style="display: none;">
					<div class="dlk-db"><span>登录</span></div>
					<span class="wz">用户名</span><input class="k" type="text" name="" id="" style="border:1px solid #ebebeb!important" placeholder="用户名"/><br />
					<span class="wz">&nbsp;&nbsp;&nbsp;&nbsp;密码</span><input class="k" type="password" name="" id="" style="border:1px solid #ebebeb!important" placeholder="密码"/>
					<div class="x"><div class="dx"><input type="checkbox" name="check1" value="check1" id="check1"><label for="check1">两周内免登录</label></div>
					<a href="/lost">忘记密码？</a><br />
					</div>
					<input class="dlan" type="submit" value="登录"/>
					<i class="iconfont icon_arrow_white">&#xe607;</i></div>-->
			</li>
			<li>
				<a href="/signup" class="my_qlinks app m0" style="line-height:54px;">注册 </a>
				<!--<div class="ibar_login_box app_box dlk zck" style="display: none;">
					<div class="dlk-db"><span>登录</span></div>
					<form class="form1" action="" method="post">
						<span class="wz yy">用户名</span><input class="k yy" type="text" name="" id="" value="" placeholder="用户名"/><br />
						<span class="wz yy">&nbsp;&nbsp;&nbsp;密码</span><input class="k yy" type="password" name="" id="" value="" placeholder="密码"/><br />
						<span class="wz">重新输入密码</span><input class="k" type="password" name="" id="" value="" placeholder="重新输入密码"/><br />
						<span class="wz yy">&nbsp;&nbsp;&nbsp;邮箱</span><input class="k yy" type="text" name="" id="" value="" placeholder="邮箱"/><br />
						<span class="wz yy xb">&nbsp;&nbsp;&nbsp;性别</span>
						<div class="qb">
						<div class="xzk"><input type="radio" name="demo1" id="demo11" checked="checked"><label for="demo11">男</label><br />
				<input type="radio" name="demo1" id="demo12"><label for="demo12">女</label></div>
				<div class=" xzk2">
					<input class="bz" type="checkbox" name="check1" value="check1" id="check1"><label for="check1">我保证年满18岁！</label><br />
				<input type="checkbox" name="check1" value="check1" id="check1"><label for="check1">我同意<span class="tk" href="">使用条款</span>和<span class="tk"  href="">隐私政策</span></label>
				</div>
				</div>
						<input class="dlan dlan2" type="submit" value="注册"/>
					</form>
					<i class="iconfont icon_arrow_white">&#xe607;</i></div>-->
			</li>
			<li>
				<a href="https://f18.livechatvalue.com/chat/chatClient/chatbox.jsp?companyID=869866&configID=75470&jid=2696669831&s=1" target="_blank" class="my_qlinks app m0"><i class="iconfont">&#xe600;</i>客服 </a>
			</li>
			<li>
				<a href="/hdong/vip/" class="my_qlinks app wd m0"><i class="iconfont">&#xe606;</i>加入<br />VIP </a>
			</li>
			<li>
				<a href="" class="my_qlinks app m0"><i class="iconfont">&#xe605;</i>反馈 </a>
			</li>
			<li>
				<a href="javascript:goTop();" class="my_qlinks app m0 top"><i class="iconfont">&#xe602;</i>TOP</a>
			</li>
			<li>
				<a  href="javascript:void(0);" class="my_qlinks app m0 gb"><img id="ct" src="/templates/frontend/frontend-default/img/X.png"/></a>
			</li>
		</div>
	</div>
</div>
<img id="an" class="an" src="/templates/frontend/frontend-default/img/anniu.png" alt="" />
<!--[if lte IE 8]>
<script src="/templates/frontend/frontend-default/js/ieBetter.js"></script>
<![endif]-->
<script type="text/javascript">
{literal}
$(".quick_links_panel li").mouseenter(function() {

	$(this).children(".mp_tooltip").animate({
		left: -92,
		queue: true
	});

	$(this).children(".mp_tooltip").css("visibility", "visible");

	$(this).children(".ibar_login_box").css("display", "block");

});

$(".quick_links_panel li").mouseleave(function() {

	$(this).children(".mp_tooltip").css("visibility", "hidden");

	$(this).children(".mp_tooltip").animate({
		left: -121,
		queue: true
	});

	$(this).children(".ibar_login_box").css("display", "none");

});

$(".quick_toggle li").mouseover(function() {

	$(this).children(".mp_qrcode").show();

});

$(".quick_toggle li").mouseleave(function() {

	$(this).children(".mp_qrcode").hide();

});
function goTop(){
	$('html,body').animate({'scrollTop':0},600);
}
</script>
<script type="text/javascript">
	$(function(){
    $("#ct").click(function(){
        //关闭id=left的div
        $(".quick_links_wrap").animate({right:'-40px'},function(){
        	$("#an").animate({right:'0px'});
        });
     });
     $("#an").click(function(){
        //关闭id=left的div
        $("#an").animate({right:'-77px'},function(){
        	$(".quick_links_wrap").animate({right:'0px'});
        });
     });           
})
{/literal}
</script>