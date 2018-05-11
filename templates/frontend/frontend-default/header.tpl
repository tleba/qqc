<!DOCTYPE html>
<html lang="Zh-hans" {if $module === 'index'}class="index"{/if}>

<head{if $view} prefix="og: http://ogp.me/ns#"{/if}>
	{if $view}
		{assign var='vtags' value=$video.keyword}

		<meta property="og:site_name" content="{$site_name}">
		<meta property="og:title" content="{$video.title|escape:'html'}">
		<meta property="og:url" content="{$baseurl}/video/{$video.VID}/{$video.title|clean}">
		<meta property="og:type" content="video">
		<meta property="og:image" content="{insert name=thumb_path vid=$video.VID}/{if $video.embed_code != ''}1{else}default{/if}.jpg">
		<meta property="og:description" content="{if $video.description}{$video.description|escape:'html'}{else}{$video.title|escape:'html'}{/if}">
	{section name=i loop=$vtags}
	<meta property="video:tag" content="{$vtags[i]}">
	{/section}

	{/if}

    <title>{if isset($self_title) && $self_title != ''}{$self_title|escape:'html'}{else}{$site_name}{/if}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="robots" content="index, follow" />
    <meta name="revisit-after" content="1 days" />
    <meta name="author" content="QQC 2015 Themes" />
    <meta name="copyright" content="2015 QQC Video Inc." />
    <meta name="keywords" content="{if isset($self_keywords) && $self_keywords != ''}{$self_keywords|escape:'html'}{else}{$meta_keywords}{/if}" />
    <meta name="description" content="{if isset($self_description) && $self_description != ''}{$self_description|escape:'html'}{else}{$meta_description}{/if}" />
	<link rel="Shortcut Icon" type="image/ico" href="/favicon.ico" />
	<link rel="apple-touch-icon" href="/favicon.ico">

    <script type="text/javascript">
    var base_url = "{$baseurl}";
    var max_thumb_folders = "{$max_thumb_folders}";
    var tmb_speed_url = "{$tmb_speed_url}";
    var tpl_url = "{$relative_tpl}";
	{if isset($video.VID)}var video_id = "{$video.VID}";{/if}
	var lang_deleting = "{t c='global.deleting'}";
	var lang_flaging = "{t c='global.flaging'}";
	var lang_loading = "{t c='global.loading'}";
	var lang_sending = "{t c='global.sending'}";
	var lang_share_name_empty = "{t c='share.name_empty'}";
	var lang_share_rec_empty = "{t c='share.recipient'}";


	{literal}
	function getRealDomain(domains){
		if(domains == '127.0.0.1' || domains == 'localhost')
			return domains;
		var redomain = '';
		var domainArray = new Array("com" , "net" , "org" , "gov" , "edu", "me", "us", 'info', 'la');
		var domains_array = domains.split('.');
		var domain_count = domains_array.length-1;
		var flag = false;
		if(domains_array[domain_count]=='cn'){
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

	{/literal}


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
 {literal}
function load_loginbox(){
	$('#login').load('/site_login.php');
	$("#sebimsg").load('/sebi.php');
}

// JavaScript Document
$(function(){
	$('.wrapper_bg_c').click(function(){
		$.post('/ajax/adv_count',{'id':62,'title':'背景广告链接访问','zone_name':"背景广告"},function(resutl){});
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
	$('#wrapper').removeAttr('style');
	$(document).on('click', ".login_submit", function(){
		var user = $("#user").val();
		var pass = $("#pass").val();
		if(user==""){
			$('<div id="msg" />').html("用户名不能为空！").appendTo('.sub').fadeOut(2000);
			$("#user").focus();
			return false;
		}
		if(pass==""){
			$('<div id="msg" />').html("密码不能为空！").appendTo('.sub').fadeOut(2000);
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
				$('<div id="msg" />').html("正在登录...").appendTo('.sub').fadeOut(2000);
				$("#pass").focus();
			},
			success: function(json){
				if(json.success==1){
					$("#login_form").remove();
					$("#login").html(json.html);
				}else{
					$("#msg").remove();
					$('<div id="errmsg" />').html(json.msg).css("color","#fff").appendTo('.sub').fadeOut(2000);

					jQuery("button.btn").removeAttr('disabled');
					return false;
				}
			}
		});
	});

	$("#logout").on('click',function(){
		$.post("login.php?action=logout",function(msg){
			if(msg==1){
			    $("#result").remove();
			    var div = "<div id='login_form'><p><label>用户名：</label> <input type='text' class='input' name='user' id='user' /></p><p><label>密 码：</label> <input type='password' class='input' name='pass' id='pass' /></p><div class='sub'><input type='submit' class='btn' value='登 录' /></div></div>";
			    $("#login").append(div);
			}
		});
	});
	if($('div[name="stype"]') && $('div[name="stype"]').inputbox){
		$('div[name="stype"]').inputbox({
			height:31,
			width:55
		});
	}
});
 {/literal}
 </script>


</head>

<body>
<div class="ps_121"></div>
<div id="sebimsg"></div>
<div class="top-nav">
	<div class="container">
		<ul class="top-menu">
			{if $multi_language}
				<div class="pull-left">
					{insert name=language assign=flag}
					<li class="hidden-xs"><a data-toggle="modal" href="/"><span style="color:white">欢迎光临青青草在线视频</span></a></li>

          <!--<li class="hidden-xs"><a data-toggle="modal" href="http://www.5188yy.com/ad/fanbb.rar"><span style="color:white">地址发布器</span></a></li>-->

					<li class="hidden-xs visible-mo"><a data-toggle="modal" href="http://www.sowo999.com/" target="_blank"><span style="color:white">请收藏青青草地址发布页</span></a></li>
					<li class="hidden-xs visible-mo"><a data-toggle="modal" href="/qqcfabu.rar" target="_blank"><span style="color:white">请下载青青草地址发布器</span></a></li>
					<li class="visible-xs" style="color: white;">青青草手机版欢迎你</li>
					</div>

			{/if}
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
			<a class="navbar-brand" href="{$relative}/">
                <img src="/templates/frontend/frontend-default/img/logo.png?t=3">
            </a>
            <a class="navbar-brand hidden-xs" style="margin-left: 15px;" href="{$relative}/"><img src="/templates/frontend/frontend-default/img/logo.gif"/></a>
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
    <li><a class="{if $menu == 'index'}home-link-style {/if}" href="/videos">最新更新</a></li>
    <li><a href="{$relative}/hd">高清视频</a></li>
    <li><a href="{surl dir='videos' val='10' file='index.html'}">动漫电影</a></li>
    <li><a href="{surl dir='videos' val='25' file='index.html'}">欧美电影</a></li>
    <!--<li><a href="{surl dir='videos' val='28' file='index.html'}">日韩无码</a></li>-->
        				<li class="dropdown">
        					<a href="{surl dir='videos' val='26' file='index.html'}" class="dropdown-toggle" data-toggle="dropdown">日韩无码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="{surl dir='videos' val='4' file='index.html'}">无码丝袜</a></li>
    <li><a href="{surl dir='videos' val='6' file='index.html'}">无码乱伦</a></li>
    <li><a href="{surl dir='videos' val='28' file='index.html'}">无码人妻</a></li>
    <li><a href="{surl dir='videos' val='9' file='index.html'}">无码制服</a></li>
    <li><a href="{surl dir='videos' val='11' file='index.html'}">无码口交</a></li>
    <li><a href="{surl dir='videos' val='27' file='index.html'}">无码强奸</a></li>

    </ul>
        				</li>

    <li class="dropdown">
        					<a href="{surl dir='videos' val='26' file='index.html'}" class="dropdown-toggle" data-toggle="dropdown">日韩有码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="{surl dir='videos' val='35' file='index.html'}">有码乱伦</a></li>
    <li><a href="{surl dir='videos' val='32' file='index.html'}">有码人妻</a></li>
    <li><a href="{surl dir='videos' val='37' file='index.html'}">有码出轨</a></li>
    <li><a href="{surl dir='videos' val='34' file='index.html'}">有码制服</a></li>
    <li><a href="{surl dir='videos' val='33' file='index.html'}">有码口交</a></li>
    <li><a href="{surl dir='videos' val='31' file='index.html'}">有码巨乳</a></li>
    </ul>
    </li>
    <li class="dropdown">
    <a href="{surl dir='videos' val='26' file='index.html'}" class="dropdown-toggle" data-toggle="dropdown">国产电影 <b class="caret"></b></a>
    <ul class="dropdown-menu">
    <li><a href="{surl dir='videos' val='8' file='index.html'}">偷拍视频</a></li>
    <li><a href="{surl dir='videos' val='19' file='index.html'}">真实自拍</a></li>
    <li><a href="{surl dir='videos' val='41' file='index.html'}">明星热门</a></li>
    </ul>
	</li>
	<li><a href="{surl dir='videos' val='67' file='index.html'}">加勒比VIP</a></li>
    <li><a href="{surl dir='videos' val='40' file='index.html'}">裸聊视频</a></li>
	<li><a href="{surl dir='yinshi' val='63' file='index.html'}">VR影院</a></li>
	<li><a href="{surl dir='yinshi' val='65' file='index.html'}">青草拍客</a></li>
	<li><a href="{surl dir='videos' val='36' file='index.html'}">有码强奸</a></li>
	<li><a href="{surl dir='videos' val='5' file='index.html'}">无码中文</a></li>
	<li><a href="/hdong/vip" target="_blank">加入VIP</a></li>
    <!--<li><a href="#" class="videos-icon" data-toggle="collapse" data-target=".navbar-inverse-collapse"><em>青青草视频</em></a></li>
    <li><a class="bbs-icon" href="javascript:;" onclick="location.href='http://bbs.'+domain"><em>青青草社区</em></a></li>-->
    <!--<li><a class="shop-icon" href="{$bbsdomain}/plugin.php?id=it618_scoremall:scoremall"><em>青青草商城</em></a></li>
    <li><a class="service-icon" href="/hdong/vip" target="_blank"><em>加入vip</em></a></li>-->
     </ul>

    </div>
    <!--Mobile-->

    <div class="navbar-collapse pc-navbar collapse navbar-inverse-collapse">

    	<div class="container">

    			<ul class="hidden-xs nav navbar-nav navbar-navwd">
    			    <li style="width:45px"><a href="/">首页</a></li>
                <li><a class="{if $menu == 'index'}home-link-style {/if}hidden-xs" href="/videos">最新更新</a></li>
                    <li><a href="{$relative}/hd">高清视频</a></li>
                    <li><a href="{surl dir='videos' val='10' file='index.html'}">动漫电影</a></li>
                    <li><a href="{surl dir='videos' val='25' file='index.html'}">欧美电影</a></li>
<li class="dropdown" style="width:82px">
        					<a href="{surl dir='videos' val='26' file='index.html'}" class="dropdown-toggle" data-toggle="dropdown">日韩无码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="{surl dir='videos' val='4' file='index.html'}">无码丝袜</a></li>
    <li><a href="{surl dir='videos' val='5' file='index.html'}">无码中文字幕</a></li>
    <li><a href="{surl dir='videos' val='6' file='index.html'}">无码乱伦</a></li>
    <li><a href="{surl dir='videos' val='28' file='index.html'}">无码人妻</a></li>
    <li><a href="{surl dir='videos' val='9' file='index.html'}">无码制服</a></li>
    <li><a href="{surl dir='videos' val='11' file='index.html'}">无码口交</a></li>
    <li><a href="{surl dir='videos' val='27' file='index.html'}">无码强奸</a></li>

    </ul>
        				</li>

    <li class="dropdown" style="width:82px">
        					<a href="{surl dir='videos' val='26' file='index.html'}" class="dropdown-toggle" data-toggle="dropdown">日韩有码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="{surl dir='videos' val='35' file='index.html'}">有码乱伦</a></li>
    <li><a href="{surl dir='videos' val='32' file='index.html'}">有码人妻</a></li>
    <li><a href="{surl dir='videos' val='37' file='index.html'}">有码出轨</a></li>
    <li><a href="{surl dir='videos' val='34' file='index.html'}">有码制服</a></li>
    <li><a href="{surl dir='videos' val='33' file='index.html'}">有码口交</a></li>
    <li><a href="{surl dir='videos' val='31' file='index.html'}">有码巨乳</a></li>
    <li><a href="{surl dir='videos' val='36' file='index.html'}">有码强奸</a></li>

    </ul>
        				</li>

    <li class="dropdown" style="width:82px">
	<a href="{surl dir='videos' val='26' file='index.html'}" class="dropdown-toggle" data-toggle="dropdown">国产电影 <b class="caret"></b></a>
	<ul class="dropdown-menu">
    <li><a href="{surl dir='videos' val='8' file='index.html'}">偷拍视频</a></li>
    <li><a href="{surl dir='videos' val='19' file='index.html'}">真实自拍</a></li>
    <li><a href="{surl dir='videos' val='40' file='index.html'}">裸聊视频</a></li>
    <li><a href="{surl dir='videos' val='41' file='index.html'}">明星热门</a></li>
    </ul>
    </li>
        			<li style="width:78px;"><a href="{surl dir='videos' val='67' file='index.html'}">加勒比VIP</a></li>
                    <li class="dropdown visible-mo" style="width:82px">
                 	<a class="dropdown-toggle" data-toggle="dropdown" href="/novels/index.html">小说图片<b class="caret"></b></a>
             		<ul class="dropdown-menu">
             			<li><a href="/novels/index.html">成人小说</a></li>
             			<li><a href="/pictures/index.html">成人图片</a></li>
             		</ul>
                 	</li>
                	<li class="visible-mo"><a href="/qhd" target="_blank">活动专区</a></li>
					<li class="dropdown" style="width:82px"><img src="/templates/frontend/frontend-default/img/new.png" style="position: absolute;left: 23px;"/><a href="{surl dir='yinshi' val='61' file='index.html'}" class="dropdown-toggle" data-toggle="dropdown">青草影视<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="{surl dir='yinshi' val='63' file='index.html'}">VR影院</a></li>
					<li><a href="{surl dir='yinshi' val='65' file='index.html'}">青草拍客</a></li>
					</ul>
					</li>
					<li class="visible-mo"><a href="/hdong/vip" class="luntan" target="_blank">加入VIP</a></li>
    			    <div class="search_nav hidden-xs hidden-sm"> <form method="post" action="/all_search"> <input type="text" name="title" placeholder="请输入搜索内容" class="search_input" value="">
    			     <input class="search_submit" type="submit" name="submit" value="搜索"/> </form> </div><div style="clear:both;"></div>
    			</ul>
    			</div>
    		</div>
    		{if $module != 'index'}
    		<div class="pc-tags cats hidden-xs hidden-sm navbar-collapse navbar-inverse-collapse">


    			<div class="container" style="display:none">



    					</div>

    				</div>
    	{/if}



</div>
{if $module != 'index'}
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
<a id="wrapper_left_bg" class="wrapper_bg_c hidden-xs" target="_blank" href="{$set_left_btn_url}"></a>
<a id="wrapper_right_bg" class="wrapper_bg_c hidden-xs" target="_blank" href="{$set_right_btn_url}"></a>
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
{*<div style="font-size: 14px;color: red;text-align: center;">广告为联盟推广与本站无关</div>*}
{/if}