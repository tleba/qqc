<?php /* Smarty version 2.6.20, created on 2018-04-06 16:32:57
         compiled from header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'header.tpl', 9, false),array('modifier', 'clean', 'header.tpl', 10, false),array('insert', 'thumb_path', 'header.tpl', 12, false),array('insert', 'language', 'header.tpl', 192, false),array('function', 't', 'header.tpl', 41, false),array('function', 'surl', 'header.tpl', 258, false),)), $this); ?>
<!DOCTYPE html>
<html lang="Zh-hans" <?php if ($this->_tpl_vars['module'] === 'index'): ?>class="index"<?php endif; ?>>

<head<?php if ($this->_tpl_vars['view']): ?> prefix="og: http://ogp.me/ns#"<?php endif; ?>>
	<?php if ($this->_tpl_vars['view']): ?>
		<?php $this->assign('vtags', $this->_tpl_vars['video']['keyword']); ?>

		<meta property="og:site_name" content="<?php echo $this->_tpl_vars['site_name']; ?>
">
		<meta property="og:title" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['video']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
		<meta property="og:url" content="<?php echo $this->_tpl_vars['baseurl']; ?>
/video/<?php echo $this->_tpl_vars['video']['VID']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['video']['title'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
">
		<meta property="og:type" content="video">
		<meta property="og:image" content="<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'thumb_path', 'vid' => $this->_tpl_vars['video']['VID'])), $this); ?>
/<?php if ($this->_tpl_vars['video']['embed_code'] != ''): ?>1<?php else: ?>default<?php endif; ?>.jpg">
		<meta property="og:description" content="<?php if ($this->_tpl_vars['video']['description']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['video']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['video']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php endif; ?>">
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['vtags']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
	<meta property="video:tag" content="<?php echo $this->_tpl_vars['vtags'][$this->_sections['i']['index']]; ?>
">
	<?php endfor; endif; ?>

	<?php endif; ?>

    <title><?php if (isset ( $this->_tpl_vars['self_title'] ) && $this->_tpl_vars['self_title'] != ''): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['self_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php else: ?><?php echo $this->_tpl_vars['site_name']; ?>
<?php endif; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="1 days" />
    <meta name="author" content="QQC 2015 Themes" />
    <meta name="copyright" content="2015 QQC Video Inc." />
    <meta name="keywords" content="<?php if (isset ( $this->_tpl_vars['self_keywords'] ) && $this->_tpl_vars['self_keywords'] != ''): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['self_keywords'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php else: ?><?php echo $this->_tpl_vars['meta_keywords']; ?>
<?php endif; ?>" />
    <meta name="description" content="<?php if (isset ( $this->_tpl_vars['self_description'] ) && $this->_tpl_vars['self_description'] != ''): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['self_description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
<?php else: ?><?php echo $this->_tpl_vars['meta_description']; ?>
<?php endif; ?>" />
	<link rel="Shortcut Icon" type="image/ico" href="/favicon.ico" />
	<link rel="apple-touch-icon" href="/favicon.ico">

    <script type="text/javascript">
    var base_url = "<?php echo $this->_tpl_vars['baseurl']; ?>
";
    var max_thumb_folders = "<?php echo $this->_tpl_vars['max_thumb_folders']; ?>
";
    var tmb_speed_url = "<?php echo $this->_tpl_vars['tmb_speed_url']; ?>
";
    var tpl_url = "<?php echo $this->_tpl_vars['relative_tpl']; ?>
";
	<?php if (isset ( $this->_tpl_vars['video']['VID'] )): ?>var video_id = "<?php echo $this->_tpl_vars['video']['VID']; ?>
";<?php endif; ?>
	var lang_deleting = "<?php echo smarty_function_t(array('c' => 'global.deleting'), $this);?>
";
	var lang_flaging = "<?php echo smarty_function_t(array('c' => 'global.flaging'), $this);?>
";
	var lang_loading = "<?php echo smarty_function_t(array('c' => 'global.loading'), $this);?>
";
	var lang_sending = "<?php echo smarty_function_t(array('c' => 'global.sending'), $this);?>
";
	var lang_share_name_empty = "<?php echo smarty_function_t(array('c' => 'share.name_empty'), $this);?>
";
	var lang_share_rec_empty = "<?php echo smarty_function_t(array('c' => 'share.recipient'), $this);?>
";


	<?php echo '
	function getRealDomain(domains){
		if(domains == \'127.0.0.1\' || domains == \'localhost\')
			return domains;
		var redomain = \'\';
		var domainArray = new Array("com" , "net" , "org" , "gov" , "edu", "me", "us", \'info\', \'la\');
		var domains_array = domains.split(\'.\');
		var domain_count = domains_array.length-1;
		var flag = false;
		if(domains_array[domain_count]==\'cn\'){
			for(i=0;i<domainArray.length;i++){
				if(domains_array[domain_count-1] == domainArray[i]){
					flag =true;
					break;
				}
			}

			if(flag==true){
				redomain = domains_array[domain_count-2]+"."+domains_array[domain_count-1]+"."+domains_array[domain_count];
			}else{
				redomain = domains_array[domain_count-1]+"."+domains_array[domain_count];
			}
		}else{
			redomain = domains_array[domain_count-1]+"."+domains_array[domain_count];
		}
		return redomain;
	}

	domain = getRealDomain(location.host);
	document.domain = domain;

	'; ?>



	</script>

<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery-1.11.1.min.js?t=2"></script>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery.inputbox.js"></script>

<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/bootstrap.min.css?t=2" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/respond.min.js"></script>
<![endif]-->

<script type="text/javascript" src="/templates/frontend/frontend-default/js/jscroller2-1.5.js"></script>

	<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/colors.css?t=201509121" />
	<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/font-awesome.min.css" />
	<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/responsive.css?t=20170930" />
	<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/style.css?t=201609294" />
	<link type="text/css" rel="stylesheet" href="/css/qq.css?v=20160212093"/>
 <script type="text/javascript">
 <?php echo '
function load_loginbox(){
	$(\'#login\').load(\'/site_login.php\');
	$("#sebimsg").load(\'/sebi.php\');
}

// JavaScript Document
$(function(){
	$(\'.wrapper_bg_c\').click(function(){
		$.post(\'/ajax/adv_count\',{\'id\':62,\'title\':\'背景广告链接访问\',\'zone_name\':"背景广告"},function(resutl){});
	});
	/*加载登陆*/
	load_loginbox();
	$("#user").focus();
	$("input:text,textarea,input:password").focus(function() {
		$(this).addClass("cur_select");
    });
    $("input:text,textarea,input:password").blur(function() {
		$(this).removeClass("cur_select");
    });
	$(\'#wrapper\').removeAttr(\'style\');
	$(document).on(\'click\', ".login_submit", function(){
		var user = $("#user").val();
		var pass = $("#pass").val();
		if(user==""){
			$(\'<div id="msg" />\').html("用户名不能为空！").appendTo(\'.sub\').fadeOut(2000);
			$("#user").focus();
			return false;
		}
		if(pass==""){
			$(\'<div id="msg" />\').html("密码不能为空！").appendTo(\'.sub\').fadeOut(2000);
			$("#pass").focus();
			return false;
		}
		$.ajax({
			type: "GET",
			url: "/login_ajax?action=login",
			dataType: "jsonp",
			cache: false,
			data: {"user":user,"pass":pass},
			beforeSend: function(){
				jQuery("button.login_submit").attr({"disabled": "disabled"});
				$(\'<div id="msg" />\').html("正在登录...").appendTo(\'.sub\').fadeOut(2000);
				$("#pass").focus();
			},
			success: function(json){
				if(json.success==1){
					$("#login_form").remove();
					$("#login").html(json.html);
				}else{
					$("#msg").remove();
					$(\'<div id="errmsg" />\').html(json.msg).css("color","#fff").appendTo(\'.sub\').fadeOut(2000);

					jQuery("button.btn").removeAttr(\'disabled\');
					return false;
				}
			}
		});
	});

	$("#logout").on(\'click\',function(){
		$.post("login.php?action=logout",function(msg){
			if(msg==1){
			    $("#result").remove();
			    var div = "<div id=\'login_form\'><p><label>用户名：</label> <input type=\'text\' class=\'input\' name=\'user\' id=\'user\' /></p><p><label>密 码：</label> <input type=\'password\' class=\'input\' name=\'pass\' id=\'pass\' /></p><div class=\'sub\'><input type=\'submit\' class=\'btn\' value=\'登 录\' /></div></div>";
			    $("#login").append(div);
			}
		});
	});
	if($(\'div[name="stype"]\') && $(\'div[name="stype"]\').inputbox){
		$(\'div[name="stype"]\').inputbox({
			height:31,
			width:55
		});
	}
});
 '; ?>

 </script>


</head>

<body>
<div class="ps_121"></div>
<div id="sebimsg"></div>
<div class="top-nav">
	<div class="container">
		<ul class="top-menu">
			<?php if ($this->_tpl_vars['multi_language']): ?>
				<div class="pull-left">
					<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'language', 'assign' => 'flag')), $this); ?>

					<li class="hidden-xs"><a data-toggle="modal" href="/"><span style="color:white">欢迎光临青青草在线视频</span></a></li>

          <!--<li class="hidden-xs"><a data-toggle="modal" href="http://www.5188yy.com/ad/fanbb.rar"><span style="color:white">地址发布器</span></a></li>-->

					<li class="hidden-xs visible-mo"><a data-toggle="modal" href="http://www.sowo999.com/" target="_blank"><span style="color:white">请收藏青青草地址发布页</span></a></li>
					<li class="hidden-xs visible-mo"><a data-toggle="modal" href="/qqcfabu.rar" target="_blank"><span style="color:white">请下载青青草地址发布器</span></a></li>
					<li class="visible-xs" style="color: white;">青青草手机版欢迎你</li>
					</div>

			<?php endif; ?>
			<div id="login" class="pull-right">

			</div>
			<div class="clearfix"></div>
		</ul>
	</div>
</div>
<div class="navbar navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">


<div class="mobile_search visible-xs visible-sm pull-right">
 <form method="post" action="/all_search"> <input type="text" name="title" placeholder="请输入内容" class="search_input" value="" style="  ">
    			    <!--<div name="stype" type="selectbox">
    			    		<div class="opts">
    			    			<a href="javascript:;" class="selected" val="videos">电影</a>
    			    			<a href="javascript:;" val="bbs">论坛</a>
    			    		</div>
    			    	</div>-->



    			     <input class="search_submit" type="submit" name="submit" value="搜索"/> </form> </div>



		<div class="pull-left">
			<a class="navbar-brand" href="<?php echo $this->_tpl_vars['relative']; ?>
/">
                <img src="/templates/frontend/frontend-default/img/logo.png?t=3">
            </a>
            <a class="navbar-brand hidden-xs" style="margin-left: 15px;" href="<?php echo $this->_tpl_vars['relative']; ?>
/"><img src="/templates/frontend/frontend-default/img/logo.gif"/></a>
			</div>

			<div class="search_header hidden-xs hidden-sm pull-right">

			<!--头部广告-->
			<div class="ps_117" style="float:left;margin-right:5px;"></div>
			<div class="ps_36" style="float:left;"></div>
			<div class="ps_161" style="float:left;"></div>
			<div style="clear:both;"></div>
			</div>

		</div>

		<!--/.nav-collapse -->
    </div>

    <!--Mobile-->
    <div class="mobile_navbar_collapse  visible-xs">
    <ul>

    <li><a href="/">首页</a></li>
    <li><a class="<?php if ($this->_tpl_vars['menu'] == 'index'): ?>home-link-style <?php endif; ?>" href="/videos">最新更新</a></li>
    <li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/hd">高清视频</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '10','file' => 'index.html'), $this);?>
">动漫电影</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '25','file' => 'index.html'), $this);?>
">欧美电影</a></li>
    <!--<li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '28','file' => 'index.html'), $this);?>
">日韩无码</a></li>-->
        				<li class="dropdown">
        					<a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '26','file' => 'index.html'), $this);?>
" class="dropdown-toggle" data-toggle="dropdown">日韩无码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '4','file' => 'index.html'), $this);?>
">无码丝袜</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '6','file' => 'index.html'), $this);?>
">无码乱伦</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '28','file' => 'index.html'), $this);?>
">无码人妻</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '9','file' => 'index.html'), $this);?>
">无码制服</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '11','file' => 'index.html'), $this);?>
">无码口交</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '27','file' => 'index.html'), $this);?>
">无码强奸</a></li>

    </ul>
        				</li>

    <li class="dropdown">
        					<a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '26','file' => 'index.html'), $this);?>
" class="dropdown-toggle" data-toggle="dropdown">日韩有码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '35','file' => 'index.html'), $this);?>
">有码乱伦</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '32','file' => 'index.html'), $this);?>
">有码人妻</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '37','file' => 'index.html'), $this);?>
">有码出轨</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '34','file' => 'index.html'), $this);?>
">有码制服</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '33','file' => 'index.html'), $this);?>
">有码口交</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '31','file' => 'index.html'), $this);?>
">有码巨乳</a></li>
    </ul>
    </li>
    <li class="dropdown">
    <a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '26','file' => 'index.html'), $this);?>
" class="dropdown-toggle" data-toggle="dropdown">国产电影 <b class="caret"></b></a>
    <ul class="dropdown-menu">
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '8','file' => 'index.html'), $this);?>
">偷拍视频</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '19','file' => 'index.html'), $this);?>
">真实自拍</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '41','file' => 'index.html'), $this);?>
">明星热门</a></li>
    </ul>
	</li>
	<li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '67','file' => 'index.html'), $this);?>
">加勒比VIP</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '40','file' => 'index.html'), $this);?>
">裸聊视频</a></li>
	<li><a href="<?php echo smarty_function_surl(array('dir' => 'yinshi','val' => '63','file' => 'index.html'), $this);?>
">VR影院</a></li>
	<li><a href="<?php echo smarty_function_surl(array('dir' => 'yinshi','val' => '65','file' => 'index.html'), $this);?>
">青草拍客</a></li>
	<li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '36','file' => 'index.html'), $this);?>
">有码强奸</a></li>
	<li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '5','file' => 'index.html'), $this);?>
">无码中文</a></li>
	<li><a href="/hdong/vip" target="_blank">加入VIP</a></li>
    <!--<li><a href="#" class="videos-icon" data-toggle="collapse" data-target=".navbar-inverse-collapse"><em>青青草视频</em></a></li>
    <li><a class="bbs-icon" href="javascript:;" onclick="location.href='http://bbs.'+domain"><em>青青草社区</em></a></li>-->
    <!--<li><a class="shop-icon" href="<?php echo $this->_tpl_vars['bbsdomain']; ?>
/plugin.php?id=it618_scoremall:scoremall"><em>青青草商城</em></a></li>
    <li><a class="service-icon" href="/hdong/vip" target="_blank"><em>加入vip</em></a></li>-->
     </ul>

    </div>
    <!--Mobile-->

    <div class="navbar-collapse pc-navbar collapse navbar-inverse-collapse">

    	<div class="container">

    			<ul class="hidden-xs nav navbar-nav navbar-navwd">
    			    <li style="width:45px"><a href="/">首页</a></li>
                <li><a class="<?php if ($this->_tpl_vars['menu'] == 'index'): ?>home-link-style <?php endif; ?>hidden-xs" href="/videos">最新更新</a></li>
                    <li><a href="<?php echo $this->_tpl_vars['relative']; ?>
/hd">高清视频</a></li>
                    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '10','file' => 'index.html'), $this);?>
">动漫电影</a></li>
                    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '25','file' => 'index.html'), $this);?>
">欧美电影</a></li>
<li class="dropdown" style="width:82px">
        					<a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '26','file' => 'index.html'), $this);?>
" class="dropdown-toggle" data-toggle="dropdown">日韩无码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '4','file' => 'index.html'), $this);?>
">无码丝袜</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '5','file' => 'index.html'), $this);?>
">无码中文字幕</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '6','file' => 'index.html'), $this);?>
">无码乱伦</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '28','file' => 'index.html'), $this);?>
">无码人妻</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '9','file' => 'index.html'), $this);?>
">无码制服</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '11','file' => 'index.html'), $this);?>
">无码口交</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '27','file' => 'index.html'), $this);?>
">无码强奸</a></li>

    </ul>
        				</li>

    <li class="dropdown" style="width:82px">
        					<a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '26','file' => 'index.html'), $this);?>
" class="dropdown-toggle" data-toggle="dropdown">日韩有码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '35','file' => 'index.html'), $this);?>
">有码乱伦</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '32','file' => 'index.html'), $this);?>
">有码人妻</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '37','file' => 'index.html'), $this);?>
">有码出轨</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '34','file' => 'index.html'), $this);?>
">有码制服</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '33','file' => 'index.html'), $this);?>
">有码口交</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '31','file' => 'index.html'), $this);?>
">有码巨乳</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '36','file' => 'index.html'), $this);?>
">有码强奸</a></li>

    </ul>
        				</li>

    <li class="dropdown" style="width:82px">
	<a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '26','file' => 'index.html'), $this);?>
" class="dropdown-toggle" data-toggle="dropdown">国产电影 <b class="caret"></b></a>
	<ul class="dropdown-menu">
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '8','file' => 'index.html'), $this);?>
">偷拍视频</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '19','file' => 'index.html'), $this);?>
">真实自拍</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '40','file' => 'index.html'), $this);?>
">裸聊视频</a></li>
    <li><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '41','file' => 'index.html'), $this);?>
">明星热门</a></li>
    </ul>
    </li>
        			<li style="width:78px;"><a href="<?php echo smarty_function_surl(array('dir' => 'videos','val' => '67','file' => 'index.html'), $this);?>
">加勒比VIP</a></li>
                    <li class="dropdown visible-mo" style="width:82px">
                 	<a class="dropdown-toggle" data-toggle="dropdown" href="/novels/index.html">小说图片<b class="caret"></b></a>
             		<ul class="dropdown-menu">
             			<li><a href="/novels/index.html">成人小说</a></li>
             			<li><a href="/pictures/index.html">成人图片</a></li>
             		</ul>
                 	</li>
                	<li class="visible-mo"><a href="/qhd" target="_blank">活动专区</a></li>
					<li class="dropdown" style="width:82px"><img src="/templates/frontend/frontend-default/img/new.png" style="position: absolute;left: 23px;"/><a href="<?php echo smarty_function_surl(array('dir' => 'yinshi','val' => '61','file' => 'index.html'), $this);?>
" class="dropdown-toggle" data-toggle="dropdown">青草影视<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="<?php echo smarty_function_surl(array('dir' => 'yinshi','val' => '63','file' => 'index.html'), $this);?>
">VR影院</a></li>
					<li><a href="<?php echo smarty_function_surl(array('dir' => 'yinshi','val' => '65','file' => 'index.html'), $this);?>
">青草拍客</a></li>
					</ul>
					</li>
					<li class="visible-mo"><a href="/hdong/vip" class="luntan" target="_blank">加入VIP</a></li>
    			    <div class="search_nav hidden-xs hidden-sm"> <form method="post" action="/all_search"> <input type="text" name="title" placeholder="请输入搜索内容" class="search_input" value="">
    			     <input class="search_submit" type="submit" name="submit" value="搜索"/> </form> </div><div style="clear:both;"></div>
    			</ul>
    			</div>
    		</div>
    		<?php if ($this->_tpl_vars['module'] != 'index'): ?>
    		<div class="pc-tags cats hidden-xs hidden-sm navbar-collapse navbar-inverse-collapse">


    			<div class="container" style="display:none">



    					</div>

    				</div>
    	<?php endif; ?>



</div>
<?php if ($this->_tpl_vars['module'] != 'index'): ?>
<div class="ps_93 visible-xs" style="width: auto;text-align:center;padding: 0 5px;"></div>
<!--手机端顶部广告-->
<div class="pic_group">
	<div class="pic_box">
		<div class="block ps_137"></div>
		<div class="block ps_139"></div>
		<div class="clear">&nbsp;</div>
	</div>
	<div class="pic_box">
		<div class="block ps_141">	</div>
		<div class="block ps_143">	</div>
		<div class="clear">&nbsp;</div>
	</div>
	<div class="pic_box">
		<div class="block ps_145">	</div>
		<div class="block ps_147">	</div>
		<div class="clear">&nbsp;</div>
	</div>
</div>
<a id="wrapper_left_bg" class="wrapper_bg_c hidden-xs" target="_blank" href="<?php echo $this->_tpl_vars['set_left_btn_url']; ?>
"></a>
<a id="wrapper_right_bg" class="wrapper_bg_c hidden-xs" target="_blank" href="<?php echo $this->_tpl_vars['set_right_btn_url']; ?>
"></a>
<div id="wrapper">
<div class="container hidden-xs">

<div class="ps-body " style="padding:0;margin-top:6px;">
<div class="ps-pc hidden-xs">
	<div style="float:left ;">
	<div class="ps_37"></div>
	</div>
	<div style="float:right;margin-left:1.1%;">
	<div class="ps_77"></div>
	</div>
	<div style="float:right">
	<div class="ps_38"></div>
	</div>
	<div style="clear:both;"></div>
</div>
</div>

<div class="ps-body " style="padding:0;">
<div class="ps-pc hidden-xs">
	<div style="float:left ;">
	<div class="ps_125"></div>
	</div>
	<div style="float:right;margin-left:1.1%;">
	<div class="ps_129"></div>
	</div>
	<div style="float:right">
	<div class="ps_127"></div>
	</div>
	<div style="clear:both;"></div>
</div>
</div>

<div class="ps-body " style="padding:0;">
	<div class="ps-pc hidden-xs">
		<div style="float:left ;">

		<div class="ps_103"></div>
		</div>
		<div style="float:right;margin-left:1.1%;">
		<div class="ps_105"></div>
		</div>
		<div style="float:right">
		<div class="ps_107"></div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<div class="ps-body " style="padding:0;">
<div class="ps-pc hidden-xs">
	<div style="float:left ;">
	<div class="ps_97"></div>
	</div>
	<div style="float:right;margin-left:1.1%;">
	<div class="ps_99"></div>
	</div>
	<div style="float:right">
	<div class="ps_101"></div>
	</div>
	<div style="clear:both;"></div>
</div>
</div>

<div class="ps-body " style="padding:0;">
	<div class="ps-pc hidden-xs">
		<div style="float:left;">
		<div class="ps_49"></div>
		</div>
		<div style="float:right;margin-left:1.1%;">
		<div class="ps_51"></div>
		</div>
		<div style="float:right;">
		<div class="ps_53"></div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<div class="ps-body " style="padding:0;">
	<div class="ps-pc hidden-xs">
		<div style="float:left;">
			<div class="ps_87"></div>
		</div>
		<div style="float:right;margin-left:1.1%;">
			<div class="ps_91"></div>
		</div>
		<div style="float:right;">
			<div class="ps_89"></div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>

<div class="ps-body " style="padding:0;">
	<div class="ps-pc hidden-xs">
		<div style="float:left;">
			<div class="ps_111"></div>
		</div>
		<div style="float:right;margin-left:1.1%;">
			<div class="ps_113"></div>
		</div>
		<div style="float:right;">
			<div class="ps_115"></div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
</div>
<div style="font-size: 14px;color: red;text-align: center;">广告为联盟推广与本站无关</div>
<?php endif; ?>