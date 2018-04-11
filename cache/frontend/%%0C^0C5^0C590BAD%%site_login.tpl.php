<?php /* Smarty version 2.6.20, created on 2018-04-06 15:21:47
         compiled from site_login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'site_login.tpl', 9, false),array('function', 't', 'site_login.tpl', 19, false),array('function', 'translate', 'site_login.tpl', 25, false),)), $this); ?>
<?php if (isset ( $_SESSION['uid'] )): ?>
			<!--User--><!--User--> <li  class="hidden-xs" style=" color: #fff; "><?php if ($this->_tpl_vars['premium'] == 0): ?>级别：<span style="color:red;margin-right: 10px;" class="nm">普通用户</span><span style="margin:0 10px; ">体验币：<font class="sebi_surplus" style="color:red;"><?php echo $this->_tpl_vars['PremiumRemainingView']; ?>
</font><img src="/templates/frontend/frontend-default/img/12x12.png" style="margin-left:5px;"/></span><?php else: ?>级别:<span style="color:red;margin-right: 10px;" class="nm"><?php echo $this->_tpl_vars['rank']; ?>
</span>(<?php echo $this->_tpl_vars['user_range']; ?>
)<span style="margin-left:10px;" class="rv"><?php echo $this->_tpl_vars['PremiumRemainingView']; ?>
</span><?php endif; ?></li><!--End-->
				<li class="dropdown">
					<?php if ($this->_tpl_vars['zb_isshow']): ?>
					<div id="searchTip" style="left: 15%;top: 25px;z-index: 1005;background-color: transparent;position: absolute;margin-left: -145px;"><div class="tipbox" id="step1" style="visibility: visible; display: block;"><div class="tipword"><span class="tipboxBtn" style="position: absolute;display: inline-block;width: 25px;height: 25px;left:182px;top: 7px;cursor: pointer;" onclick="$('#searchTip').hide();"></span><img src="/templates/frontend/frontend-default/img/a<?php echo $this->_tpl_vars['zb_index']; ?>
.png?t=<?php echo $this->_tpl_vars['zb_index']; ?>
2"></div></div></div>
					<?php endif; ?>
					<a class="dropdown-toggle"  data-toggle="dropdown" href="#">
						<span class="visible-xs">
							<?php if (! $this->_tpl_vars['isgameUserNull']): ?><div class="badge" style="background-color:#c00;">领</div><?php endif; ?> <?php if ($this->_tpl_vars['requests_count'] > 0 || $this->_tpl_vars['mails_count'] > 0): ?><div class="badge"><?php echo $this->_tpl_vars['requests_count']+$this->_tpl_vars['mails_count']; ?>
</div><?php endif; ?> <?php echo ((is_array($_tmp=$_SESSION['username'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, "...") : smarty_modifier_truncate($_tmp, 15, "...")); ?>
 <span class="caret"></span>
						</span>
						<span class="hidden-xs">
							<?php if (! $this->_tpl_vars['isgameUserNull']): ?><div class="badge" style="background-color:#c00;">领</div><?php endif; ?> <?php if ($this->_tpl_vars['requests_count'] > 0 || $this->_tpl_vars['mails_count'] > 0): ?><div class="badge"><?php echo $this->_tpl_vars['requests_count']+$this->_tpl_vars['mails_count']; ?>
</div><?php endif; ?> <?php echo ((is_array($_tmp=$_SESSION['username'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 35, "...") : smarty_modifier_truncate($_tmp, 35, "...")); ?>
 <span class="caret"></span>
						</span>
					</a>
					<ul class="dropdown-menu pull-right m-t-0">
						<li class="visible-xs"><?php if ($this->_tpl_vars['premium'] == 0): ?><a style="color:red;" class="nm">级别：普通用户</a><a>体验币：<font class="sebi_surplus" style="color:#c00;"><?php echo $this->_tpl_vars['PremiumRemainingView']; ?>
</font><img src="/templates/frontend/frontend-default/img/12x12.png" style="margin-left:5px;"/></a><?php else: ?><a style="color:red;" class="nm">级别:<?php echo $this->_tpl_vars['rank']; ?>
</a><a>(<?php echo $this->_tpl_vars['user_range']; ?>
)</a><a class="rv"><?php echo $this->_tpl_vars['PremiumRemainingView']; ?>
</a><?php endif; ?></li>
						<li><?php if ($this->_tpl_vars['isgameUserNull']): ?><a href="javascript:void(0);" onclick="sebi();">绑定游戏账号</a><?php else: ?><a href="<?php if ($this->_tpl_vars['istask']): ?>/qhd/task/<?php else: ?>javascript:void(0);<?php endif; ?>" target="_blank"><div class="badge" style="background-color:#c00;">领</div> <?php echo $this->_tpl_vars['game']; ?>
账号：<font style="color:red;"><?php echo $this->_tpl_vars['gusername']; ?>
</font></a><?php endif; ?></li>
						<li><a href="javascript://" onClick="show_it();">推广赚积分</a></li>
						<li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/user"><?php echo smarty_function_t(array('c' => 'topnav.my_profile'), $this);?>
</a></li>
						<?php if ($this->_tpl_vars['type_of_user'] === 'free'): ?><li><a href="#"><span class="pull-left">可用体验币</span><div class="sebi_surplus badge pull-right"><?php echo $this->_tpl_vars['sebi_surplus']; ?>
个</div><div class="clearfix"></div></a></li><?php endif; ?>
						<?php if ($this->_tpl_vars['video_module'] == '0'): ?><li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/user/<?php echo $_SESSION['username']; ?>
/videos"><?php echo smarty_function_t(array('c' => 'topnav.my_videos'), $this);?>
</a></li><?php endif; ?>
						<?php if ($this->_tpl_vars['photo_module'] == '1'): ?><li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/user/<?php echo $_SESSION['username']; ?>
/albums"><?php echo smarty_function_t(array('c' => 'topnav.my_photos'), $this);?>
</a></li><?php endif; ?>
						<?php if ($this->_tpl_vars['game_module'] == '1'): ?><li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/user/<?php echo $_SESSION['username']; ?>
/games"><?php echo smarty_function_t(array('c' => 'topnav.my_games'), $this);?>
</a></li><?php endif; ?>
						<!--<li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/user/<?php echo $_SESSION['username']; ?>
/blog"><?php echo smarty_function_t(array('c' => 'topnav.my_blog'), $this);?>
</a></li>
						<li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/feeds"><?php echo smarty_function_translate(array('c' => 'global.my_feeds'), $this);?>
</a></li>-->
						<li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/user/<?php echo $_SESSION['username']; ?>
/playlist">播放记录</a></li>
						<li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/user/<?php echo $_SESSION['username']; ?>
/favorite/videos">收藏视频</a></li>
						<li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/requests"><span class="pull-left"><?php echo smarty_function_translate(array('c' => 'global.requests'), $this);?>
</span><?php if ($this->_tpl_vars['requests_count'] > 0): ?><div class="badge pull-right"><?php echo $this->_tpl_vars['requests_count']; ?>
</div><?php endif; ?><div class="clearfix"></div></a></li>
						<li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/mail/inbox"><span class="pull-left"><?php echo smarty_function_translate(array('c' => 'global.inbox'), $this);?>
</span><?php if ($this->_tpl_vars['mails_count'] > 0): ?><div class="badge pull-right"><?php echo $this->_tpl_vars['mails_count']; ?>
</div><?php endif; ?><div class="clearfix"></div></a></li>
					</ul>
				</li>
				<li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/logout"><?php echo smarty_function_translate(array('c' => 'global.sign_out'), $this);?>
</a></li>
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
        	<li class="l2"><input id="textfield2" type="text" value="分享一个我收藏很久了的看片神器！你懂的！<?php echo $this->_tpl_vars['remotehost']; ?>
/tuiguang.php?fromuid=<?php echo $_SESSION['uid']; ?>
"></li>
        	<li class="l3"><input type="button" onclick="CopyUrl($('#textfield2').val());$('#textfield2').select();"  value="复制地址"></li>
        </ul>
    </div>
</div>

<script type="text/javascript">
 <?php echo '
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
            alert("!!被浏览器拒绝！\\n请在浏览器地址栏输入\'about:config\'并回车\\n然后将\'signed.applets.codebase_principal_support\'设置为\'true\'");
        }
        var clip = Components.classes[\'@mozilla.org/widget/clipboard;1\'].createInstance(Components.interfaces.nsIClipboard);
        if (!clip)
            return;
        var trans = Components.classes[\'@mozilla.org/widget/transferable;1\'].createInstance(Components.interfaces.nsITransferable);
        if (!trans)
            return;
        trans.addDataFlavor(\'text/unicode\');
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
       alert("!!被浏览器拒绝！\\n请手动复制推广链接！");
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
		document.getElementById(\'ls_pop_window\').style.display = "block";
		}
	function ls_close_it(){
		document.getElementById(\'ls_pop_window\').style.display = "none";
		}
 '; ?>

</script>
			<?php else: ?>


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

			<?php endif; ?>
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
<?php if ($this->_tpl_vars['isstart'] == 1): ?>
<!--红包-->
<div class='visible-xs' style="position:fixed;z-index:99999;bottom:7%;">
	<a style="display:block;text-align:center;" href="/qhd/hongbao/" target="_blank"><img style="width:100%;height:100%;" src="/templates/frontend/frontend-default/img/min.png"/></a>
</div>

<div class='hidden-xs' style="position:fixed;z-index:99999;bottom:40px;right:40px">
	<a style="display:block;text-align:center;" href="/qhd/hongbao/" target="_blank"><img style="width:100%;height:100%;" src="/templates/frontend/frontend-default/img/min.png"/></a>
</div>
<?php if (! $this->_tpl_vars['isshow']): ?>
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
<?php endif; ?>
<!--红包-->
<?php endif; ?>
<script type="text/javascript">
 <?php echo '
 function close_hg(obj){
 	console.log($(obj).parents(\'div.hongbao\'));
 	$(obj).parents(\'div.hongbao\').remove();
 }
 function sebi(){
        var h = (window.screen.availHeight / 4) - ($(\'#bindguser .modal-dialog\').height() / 2);
 		$(\'#bindguser .modal-dialog\').css({\'top\':h});
 		$(\'#bindguser\').modal(\'show\');
 }
 $(function(){
 	$(\'button[name="sebi_ok"]\').click(function(){
 			var guname = $(\'input[name="guname"]\');
 			var val = $.trim($(guname).val());
			if(val == \'\')
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
						$(\'#smsg\').html(\'<span class="tips error">\'+data.msg+\'</span>\');
						setTimeout(function(){
							$(\'#smsg\').html(\'\');
						},3000);
					}else{
						$(\'#smsg\').html(\'<span class="tips error">\'+data.msg+\'</span>\');
						window.location.reload();
					}
				}
			});
 	});
 });
  '; ?>

</script>