<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>双诞（旦）福利：领变大红包0元获取VIP</title>
		<link rel="stylesheet" type="text/css" href="css/default.css"/>
		<link rel="stylesheet" type="text/css" href="css/index.css"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
        <script src="js/modernizr.js"></script>
		</head>
	<body>
<div class="zt">
{if $isstart == 2}
<div class="w-1000">
<div class="tc " role="alert">
			<div class="w-870 cd-popup-container tc-container">
			<a class="aa fl" href="/qhd/hongbao/bian.php?a=increase&uid={$uid}"></a>
			<a class="aa fr" href="/qhd/hongbao/"></a>
             <a href="#0" class="cd-popup-close img-replace">Close</a>
			</div>
            </div>
			<!--<a class="gb" href="#">×</a>-->
		</div>
		{/if}
	<div class="banner"><div class="w-1000"><a href=""></a></div>
	</div>
	<div class="bj1">
		<div class="w-1000 hongbao"><a href="{if $isstart == 0 || $isstart==1}javascript:void(0);{/if}" onclick="{if $isstart == 0}alert('对不起，此活动目前不可用!');{elseif $isstart == 1}alert('对不起，您还未登陆！请先登陆后再来操作');window.location.href='/login';{/if}"></a></div>
	</div>
	<div class="bj2"><div class="w-1000"><span>好友红包 共累计 <font class="hong">{$totalamount}</font> 元（含领取{$amount}元）</span>
    <ul>
    		{section name=i loop=$hbarr}
				<li>
					<font class="s9">{$hbarr[i].username}</font>
					<font class="s7">{$hbarr[i].bamount}元</font>
					{insert name=time_range assign=strtime time=$hbarr[i].rtime}
					<font class="s8">{$strtime}</font>
				</li>
			{/section}
    </ul>
    </div>
	</div>
	<div class="bj3"><div class="w-1000">
		<div class="f-l">
			<ul>
			{section name=i loop=$hdresult}
				<li>
					<span class="s1">{$hdresult[i].username}	</span>
					<span class="s2">红包金额{$hdresult[i].total}</span>
					<span class="s3">{$hdresult[i].money}元购买VIP视频</span>
				</li>
			{/section}				
			</ul>
		</div>
		<div class="f-r">
			<marquee direction="up" class="list_con"  scrollamount="3" style="height:235px;">
			<ul>
			{section name=i loop=$nhbarr}
				{insert name=time_range assign=strtime time=$nhbarr[i].rtime}
				<li><span class="s5">{$nhbarr[i].username}帮助红包变大<font class="huang">{$nhbarr[i].bamount}元</font></span><span class="s6">{$strtime}</span></li>
			{/section}
			</ul>
			</marquee>
		</div>	
	</div>
	</div>
	<div class="bj4"><div class="w-1000">
		<span>
1.分享给的好友按不同IP地址下不同好友计入，2017年1月2日24点00分（北京时间）前分享计入的统计有效；<br />
2.限青青草在线视频网站上活动优惠域名下注册的游戏账号存款开通有效；<br />
3.立即购买仅可选择价值50元及以上VIP，减去红包内金额充值相应金额使用【如：红包内赚取10元，存款需≥40元可开始购买到价值≥50元的相应青青草VIP】，新老用户均可参与；<br />
4.变大红包成功满额50获赠的免费VIP按50色币添加使用，不享受其他充值福利；红包满50后额度将不再增加，需要直接联系青青草客服进行兑换；<br />
5.活动期间每位用户均有一次参与机会；<br />
6.活动时间的终止及内容规则等修改，最终解释权归青青草在线视频官网所有。<br />
		</span>
	</div>
	</div>
</div>
<script src="js/jquery.1.11.1.js"></script>
<script src="js/main.js"></script>
	</body>
</html>