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
	<div class="banner"><div class="w-1000"><a href=""></a></div></div>
	<div class="bj1">
		{if $isstart == 0 || $isstart == 1 || $isstart == 2}	
		<!-- 拆 -->
		<div class="w-1000 hongbao"><a href="javascript:void(0);" onclick="{if $isstart == 0}alert('对不起，此活动目前不可用!');{elseif $isstart == 1}alert('对不起，您还未登陆！请先登陆后再来操作');window.location.href='/login';{elseif $isstart == 2}window.location.href='/qhd/hongbao/?a=chai';{/if}"></a></div>
		<!-- 拆 -->
		{else}
		<!--拆以后-->
		<div class="w-1000 hongbao2">
			<font class="huang">{$totalamount}</font>
			<span>（还剩{$amount50}元/{$amount100}元即可0元获取50元/100元的VIP视频）</span>
			<div class="lj">
				<a class="fl cd-popup-trigger aa" href="#"></a>
				<div class="cd-popup" role="alert">

        <div class="cd-popup-container">

            <ul class="cd-buttons">

                <li><a href="http://kb88dc15.com/newRegister.htm"><span></span></a><span style="margin-top: 50px;color: red;font-size: 20px;">仅需存{$amount50}元</span></li>

                <li><a href="http://kb88dc15.com/newRegister.htm"><span></span></a><span style="margin-top: 50px;color: red;font-size: 20px;">仅需存{$amount100}元</span></li>

            </ul>

            <a href="#0" class="cd-popup-close img-replace">Close</a>
</div>
        </div>
        
			<a class="fr a2 aa" href=""></a>
			<div class="a2-popup" role="alert">
			<div class="cd-popup-container a2-popup-container">
				<div class="tck">
				<input class="fl" type="text" id="bian" readonly value="{$url}" />
				<a class="fr fuzhi" href="javascript:void(0);" onclick="CopyUrl($('#bian').val());$('#bian').select();" readonly></a>
				</div>
	<!-- JiaThis Button BEGIN -->
<script "text/javascript">
var url = '{$url}';
{literal}
var title = encodeURIComponent("双诞（旦）福利：领变大红包0元获取VIP");
var summary = encodeURIComponent("双旦快乐！这里有免费红包礼可以抢我已先领到了，朋友们下手狠点帮我再多抢点儿，自己也想要的赶紧点进分享的链接下手啊~");
var jiathis_config = { 
	url: url, 
	title: title, 
	summary:summary
}
function copyToClipboard(txt) {  
    if(window.clipboardData)  
    {  
        //window.clipboardData.clearData();  
        window.clipboardData.setData("Text", txt);  
    }  
    else if(navigator.userAgent.indexOf("Opera") != -1)  
    {   
        window.location = txt;  
    }  
    else if (window.netscape)  
    {   
        try {  
            netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");  
        }  
        catch (e)  
        {  
            alert("!!被浏览器拒绝！\n请在浏览器地址栏输入'about:config'并回车\n然后将'signed.applets.codebase_principal_support'设置为'true'");  
        }  
        var clip = Components.classes['@mozilla.org/widget/clipboard;1'].createInstance(Components.interfaces.nsIClipboard);  
        if (!clip)  
            return;  
        var trans = Components.classes['@mozilla.org/widget/transferable;1'].createInstance(Components.interfaces.nsITransferable);  
        if (!trans)  
            return;  
        trans.addDataFlavor('text/unicode');  
        var str = new Object();  
        var len = new Object();  
        var str = Components.classes["@mozilla.org/supports-string;1"].createInstance(Components.interfaces.nsISupportsString);  
        var copytext = txt;  
        str.data = copytext;  
        trans.setTransferData("text/unicode",str,copytext.length*2);  
        var clipid = Components.interfaces.nsIClipboard;  
        if (!clip)  
            return false;  
        clip.setData(trans,null,clipid.kGlobalClipboard);  
    }
    else{
       alert("!!被浏览器拒绝！\n请手动复制推广链接！"); 
       return false;
    }
    return true;  
}
//复制
function CopyUrl(txt)
{
	if (copyToClipboard(txt))
	{
		alert("复制成功，发布到朋友圈、网站或论坛，你将获得相应积分奖励！");
		return true;
	}
	return false;
}
{/literal}
</script>
<div class="jiathis_style_32x32">
	<a class="jiathis_button_qzone"></a>
	<a class="jiathis_button_tsina"></a>
	<a class="jiathis_button_tqq"></a>
	<a class="jiathis_button_weixin"></a>
	<a class="jiathis_button_renren"></a>
	<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
</div>
<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
<!-- JiaThis Button END -->
            <a href="#0" class="cd-popup-close img-replace">Close</a>
</div>
			</div>
		</div>
	</div>
		<!--拆以后-->
{/if}
	</div>
	<div class="bj2"><div class="w-1000"><span>我的红包 共累计 <font class="hong">{$totalamount}</font> 元（含领取{$amount}元）</span>
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
</body>
<script src="js/jquery.1.11.1.js"></script>
<script src="js/main.js"></script>
</html>