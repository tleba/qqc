{if isset($smarty.session.uid)}
			<!--User--><!--User--> <li  class="hidden-xs" style=" color: #fff; ">{if $premium == 0}级别：<span style="color:red;margin-right: 10px;" class="nm">普通用户</span><span style="margin:0 10px; ">体验币：<font class="sebi_surplus" style="color:red;">{$PremiumRemainingView}</font><img src="/templates/frontend/frontend-default/img/12x12.png" style="margin-left:5px;"/></span>{else}级别:<span style="color:red;margin-right: 10px;" class="nm">{$rank}</span>({$user_range})<span style="margin-left:10px;" class="rv">{$PremiumRemainingView}</span>{/if}</li><!--End-->
				<li class="dropdown">
					{if $zb_isshow}
					<div id="searchTip" style="left: 15%;top: 25px;z-index: 1005;background-color: transparent;position: absolute;margin-left: -145px;"><div class="tipbox" id="step1" style="visibility: visible; display: block;"><div class="tipword"><span class="tipboxBtn" style="position: absolute;display: inline-block;width: 25px;height: 25px;left:182px;top: 7px;cursor: pointer;" onclick="$('#searchTip').hide();"></span><img src="/templates/frontend/frontend-default/img/a{$zb_index}.png?t={$zb_index}2"></div></div></div>
					{/if}
					<a class="dropdown-toggle"  data-toggle="dropdown" href="#">
						<span class="visible-xs">
							{if !$isgameUserNull}<div class="badge" style="background-color:#c00;">领</div>{/if} {if $requests_count > 0 || $mails_count > 0}<div class="badge">{$requests_count+$mails_count}</div>{/if} {$smarty.session.username|truncate:15:"..."} <span class="caret"></span>
						</span>
						<span class="hidden-xs">
							{if !$isgameUserNull}<div class="badge" style="background-color:#c00;">领</div>{/if} {if $requests_count > 0 || $mails_count > 0}<div class="badge">{$requests_count+$mails_count}</div>{/if} {$smarty.session.username|truncate:35:"..."} <span class="caret"></span>
						</span>
					</a>
					<ul class="dropdown-menu pull-right m-t-0">
						<li class="visible-xs">{if $premium == 0}<a style="color:red;" class="nm">级别：普通用户</a><a>体验币：<font class="sebi_surplus" style="color:#c00;">{$PremiumRemainingView}</font><img src="/templates/frontend/frontend-default/img/12x12.png" style="margin-left:5px;"/></a>{else}<a style="color:red;" class="nm">级别:{$rank}</a><a>({$user_range})</a><a class="rv">{$PremiumRemainingView}</a>{/if}</li>
						<li>{if $isgameUserNull}<a href="javascript:void(0);" onclick="sebi();">绑定游戏账号</a>{else}<a href="{if $istask}/qhd/task/{else}javascript:void(0);{/if}" target="_blank"><div class="badge" style="background-color:#c00;">领</div> {$game}账号：<font style="color:red;">{$gusername}</font></a>{/if}</li>
						<li><a href="javascript://" onClick="show_it();">推广赚积分</a></li>
						<li><a href="{$relative}/user">{t c='topnav.my_profile'}</a></li>
						{if $type_of_user==='free'}<li><a href="#"><span class="pull-left">可用体验币</span><div class="sebi_surplus badge pull-right">{$sebi_surplus}个</div><div class="clearfix"></div></a></li>{/if}
						{if $video_module == '0'}<li><a href="{$relative}/user/{$smarty.session.username}/videos">{t c='topnav.my_videos'}</a></li>{/if}
						{if $photo_module == '1'}<li><a href="{$relative}/user/{$smarty.session.username}/albums">{t c='topnav.my_photos'}</a></li>{/if}
						{if $game_module == '1'}<li><a href="{$relative}/user/{$smarty.session.username}/games">{t c='topnav.my_games'}</a></li>{/if}
						<!--<li><a href="{$relative}/user/{$smarty.session.username}/blog">{t c='topnav.my_blog'}</a></li>
						<li><a href="{$relative}/feeds">{translate c='global.my_feeds'}</a></li>-->
						<li><a href="{$relative}/user/{$smarty.session.username}/playlist">播放记录</a></li>
						<li><a href="{$relative}/user/{$smarty.session.username}/favorite/videos">收藏视频</a></li>
						<li><a href="{$relative}/requests"><span class="pull-left">{translate c='global.requests'}</span>{if $requests_count > 0}<div class="badge pull-right">{$requests_count}</div>{/if}<div class="clearfix"></div></a></li>
						<li><a href="{$relative}/mail/inbox"><span class="pull-left">{translate c='global.inbox'}</span>{if $mails_count > 0}<div class="badge pull-right">{$mails_count}</div>{/if}<div class="clearfix"></div></a></li>
					</ul>
				</li>
				<li><a href="{$relative}/logout">{translate c='global.sign_out'}</a></li>
<!-- 弹出框 开始 -->
<link href="/templates/frontend/frontend-default/pop_tips/pop.css" rel="stylesheet" type="text/css">
<div class="ls_pop_window" id="ls_pop_window" style="display:none;">
	<div class="ls_pop_header">
    	<div class="ls_pop_title">我要推广</div>
    	<div class="ls_pop_btn">
        	<a href="javascript://" onClick="ls_close_it();">关闭</a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="ls_pop_body">
    	<ul>
        	<li class="l1">将以下链接发布到朋友圈、网站或论坛，你将获得相应 积分奖励</li>
        	<li class="l2"><input id="textfield2" type="text" value="分享一个我收藏很久了的看片神器！你懂的！{$remotehost}/tuiguang.php?fromuid={$smarty.session.uid}"></li>
        	<li class="l3"><input type="button" onclick="CopyUrl($('#textfield2').val());$('#textfield2').select();"  value="复制地址"></li>
        </ul>
    </div>
</div>

<script type="text/javascript">
 {literal}
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
	function show_it(){
		document.getElementById('ls_pop_window').style.display = "block";
		}
	function ls_close_it(){
		document.getElementById('ls_pop_window').style.display = "none";
		}
 {/literal}
</script>
			{else}


				          <div class='hidden-xs' id="login_form">
				        <p><label>账号:</label> <input type="text" class="input" name="user" id="user" /></p>
				        <p><label>密码:</label> <input type="password" class="input" name="pass" id="pass" /></p>
				        <input type="hidden" name="submit_login" value="login" />
				        <button type="submit" class="btn login_submit"><span>登录</span></button>
				        <!--<a class="lost" href="/lost">找回密码</a>-->
				        <button onclick="window.location.href='/signup';" type="button" class="reg"><span>注册</span></button>
				        <div class="sub"></div>
				    </div>
				     <div class="visible-xs">
				     <li><a href="/login" rel="nofollow">登录</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="/signup" rel="nofollow">注册</a></li>
				     </div>

			{/if}
<!-- Modal -->
<div class="modal fade" id="bindguser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">关闭</span></button>
        <h4 class="modal-title" id="myModalLabel" style="color:#fff;">绑定游戏账号</h4>
      </div>
      <div class="modal-body" style="color:#000;padding:5px;">
            <table width="100%" cellpadding="0" cellspacing="5" border="0" style="background-color:#e1e1e1;">
            <tr>
                <td style="padding-top:10px;color:#000;">游戏账号：</td>
                <td style="text-align:left!important;"><input type="text" name="guname" style="color:black;padding:0 10px;border:1px solid #bbbaba!important"/></td>
            </tr>
            <tr><td colspan="2"><p id="smsg" style="color:red;height:20px;"></p><p><font style="color:red;">*绑定游戏账号可额外得到10个色币或体验币的奖励哦*</font></p></td></tr>
            </table>
      </div>
      <div class="modal-footer" style="padding:0 5px;">
      	<input type="hidden" name="uid" value=""/>
      	<button type="button" class="btn btn-default" name="sebi_ok">绑定账号</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
{if $isstart == 1}
<!--红包-->
<div class='visible-xs' style="position:fixed;z-index:99999;bottom:7%;">
	<a style="display:block;text-align:center;" href="/qhd/hongbao/" target="_blank"><img style="width:100%;height:100%;" src="/templates/frontend/frontend-default/img/min.png"/></a>
</div>

<div class='hidden-xs' style="position:fixed;z-index:99999;bottom:40px;right:40px">
	<a style="display:block;text-align:center;" href="/qhd/hongbao/" target="_blank"><img style="width:100%;height:100%;" src="/templates/frontend/frontend-default/img/min.png"/></a>
</div>
{if !$isshow}
<div class='visible-xs hongbao' style="position:fixed;z-index:99999;top:0;left:0;bottom:0;right:0;width:100%;height:100%;text-align:center;">
	<a href="javascript:void(0);" onclick="close_hg(this);" style="display:block;position: absolute;width: 100%;height: 35px;top:24%;"></a>
	<a href="/qhd/hongbao/" style="display:block;text-align:center;position: absolute;width: 100%;height: 10%;top:42%;"></a>
	<img style="width:100%;height:auto;" src="/templates/frontend/frontend-default/img/max.png"/>
</div>
<div class='hidden-xs hongbao' style="position:fixed;z-index:99999;top:0;left:0;bottom:0;right:0;width:100%;height:100%;text-align:center;">
	<div style="background: url(/templates/frontend/frontend-default/img/max.png) 50% no-repeat;width: 100%;height: 100%;">
		<div style="width:311px;margin:0 auto;height:100%;position:relative;">
			<a href="javascript:void(0);" onclick="close_hg(this);" style="display:block;position: absolute;width: 100%;height: 50px;top: 40%;"></a>
			<a href="/qhd/hongbao/" style="display:block;position: absolute;width: 100%;height: 65px;bottom: 26%;"></a>
		</div>
	</div>
</div>
{/if}
<!--红包-->
{/if}
<script type="text/javascript">
 {literal}
 function close_hg(obj){
 	console.log($(obj).parents('div.hongbao'));
 	$(obj).parents('div.hongbao').remove();
 }
 function sebi(){
        var h = (window.screen.availHeight / 4) - ($('#bindguser .modal-dialog').height() / 2);
 		$('#bindguser .modal-dialog').css({'top':h});
 		$('#bindguser').modal('show');
 }
 $(function(){
 	$('button[name="sebi_ok"]').click(function(){
 			var guname = $('input[name="guname"]');
 			var val = $.trim($(guname).val());
			if(val == '')
				return;
			$.ajax({
				type:"post",
				url:"/ajax/bind_game_user",
				data:{guname: val},
				dataType:"json",
				cache:false,
				async:false,
				success:function(data){
					if(data.flag==false){
						$('#smsg').html('<span class="tips error">'+data.msg+'</span>');
						setTimeout(function(){
							$('#smsg').html('');
						},3000);
					}else{
						$('#smsg').html('<span class="tips error">'+data.msg+'</span>');
						window.location.reload();
					}
				}
			});
 	});
 });
  {/literal}
</script>