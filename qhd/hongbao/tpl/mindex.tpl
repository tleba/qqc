<html><head lang="en">                          
    <meta charset="UTF-8">
    <title>双诞（旦）福利：领变大红包0元获取VIP</title>
    <meta name="viewport" content="width=device-width,target-densitydpi=high-dpi,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="css/mstyle.css"/>
    <link href="css/mcommon.css" rel="stylesheet" type="text/css">
    <link href="css/mindex.css" rel="stylesheet" type="text/css">
</head>
<body>
    <section id="layout">
        <section class="page-wrapper">
                <section id="content">
                    <div id="content_page">
                        <div id="page1">
                        	<div class="banner"><a href=""><img src="images/m/banner.jpg" alt="" /></a></div>
                        	{if $isstart == 0 || $isstart == 1 || $isstart == 2}
                        	<div class="chai"><a href="javascript:void(0);" onclick="{if $isstart == 0}alert('对不起，此活动目前不可用!');{elseif $isstart == 1}alert('对不起，您还未登陆！请先登陆后再来操作');window.location.href='/login';{elseif $isstart == 2}window.location.href='/qhd/hongbao/?a=chai';{/if}"><img src="images/m/chai.jpg"/></a></div>
                        	{else}
                        	<div class="hongbao"><img src="images/m/hongbao.jpg"/>
                        	<div class=" hongbaoa">
								<font class="huang">{$totalamount}</font>
								<span>（还剩{$amount50}元/{$amount100}元即可0元获取50元/100元的VIP视频）</span>
								<div class="lj">
									<a class="fl cd-popup-trigger aa" href="javascript:void(0);">&nbsp;</a>
									<div class="cd-popup" role="alert">
					        <div class="cd-popup-container">
								<img src="images/m/dj1.jpg"/>
					            <ul class="cd-buttons">
					                <li><a class="fl" href="http://kb88dc15.com/newRegister.htm"></a></li>
					                <li><a class="fr" href="http://kb88dc15.com/newRegister.htm"></a></li>
					            </ul>
					            <a href="#0" class="cd-popup-close img-replace">Close</a>
							</div>
					        </div>
								<a class="fr a2 aa" href="javascript:void(0);">&nbsp;</a>
								<div style="clear:both;"></div>
								<div class="a2-popup" role="alert">
								<div class="cd-popup-container a2-popup-container">
									<img src="images/m/dj2.jpg"/>
									<div class="tck">
									<input class="fl" type="text" id="bian" name="bian" readonly value="{$url}" />
									<a class="fr fuzhi" href="javascript:void(0);" onclick="CopyUrl($('#bian').val());$('#bian').select();" readonly></a>
									<div style="clear:both;"></div>
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
					<!--<div class="jiathis_style_32x32">
						<a class="jiathis_button_qzone"></a>
						<a class="jiathis_button_tsina"></a>
						<a class="jiathis_button_tqq"></a>
						<a class="jiathis_button_weixin"></a>
						<a class="jiathis_button_renren"></a>
						<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
					</div>
					<script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>-->
					<!-- JiaThis Button END -->
					            <a href="#0" class="cd-popup-close img-replace">Close</a>
					</div>
								</div>
							</div>
						</div></div>  	
                        	{/if}
                        	<div class="a">
                        	<img src="images/m/01.jpg"/><span>我的红包 共累计 <font class="hong">{$totalamount}</font> 元（含领取{$amount}元）</span>
                        	<ul>
                        	{section name=i loop=$hbarr}
                        	<li>
								<font class="s1">{$hbarr[i].username}</font>
								<font class="s2">{$hbarr[i].bamount}元</font>
								{insert name=time_range assign=strtime time=$hbarr[i].rtime}
								<font class="s3">{$strtime}</font>
							</li>
							{/section}		
							</ul>
                        	</div>
                        	<div class="b"><img src="images/m/02.jpg"/>
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
                        	<div class="c"><img src="images/m/03.jpg" alt="" />
                        	<marquee direction="up" class="list_con"  scrollamount="3" >
                        	<ul>
                 {section name=i loop=$nhbarr}
				{insert name=time_range assign=strtime time=$nhbarr[i].rtime}
				<li><span class="s5 fl">{$nhbarr[i].username}帮助红包变大<font class="huang">{$nhbarr[i].bamount}元</font></span><span class="s6 fr">{$strtime}</span></li>
				{/section}
			</ul></marquee>
                        	</div>
                        	<div class="d"><img src="images/m/04.jpg"/></div>
                        	<div class="e"><img src="images/m/05.jpg"/></div>
                        </div>
                    </div>
                </section>
            </section>
        </section>
    </section>
	</body>
	<script src="js/jquery.1.11.1.js"></script>
    <script src="js/main.js"></script>
	</html>