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
	<link rel="apple-touch-icon" href="/templates/frontend/frontend-default/img/webapp-icon.png">

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

<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery.inputbox.js"></script>

<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/bootstrap.css" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/html5shiv.min.js"></script>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/respond.min.js"></script>
<![endif]-->

<script type="text/javascript" src="/templates/frontend/frontend-default/js/jscroller2-1.5.js"></script>

<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/colors.css" />
<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/responsive.css" />
<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/style.css?t=20150730" />
<link type="text/css" rel="stylesheet" href="/css/qq.css?v=201508131503" />
 <script type="text/javascript">
 {literal}
$(function(){

	$('div[name="stype"]').inputbox({
		height:31,
		width:55
	});

});

function load_loginbox(){
	$('#login').load('/site_login.php');
}

// JavaScript Document
$(function(){
	/*加载登陆*/
	load_loginbox();

	$("#user").focus();
	$("input:text,textarea,input:password").focus(function() {
		$(this).addClass("cur_select");
    });
    $("input:text,textarea,input:password").blur(function() {
		$(this).removeClass("cur_select");
    });
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
					var div = "<li class='hidden-xs' style='color: #fff;'>级别:<span style='color: red; margin-right: 10px;' class='nm'>"+json.PremiumNikename+"</span><span class='rv'>"+json.PremiumRemainingView+"</span></li><li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'> <span class='visible-xs'><div class='badge'></div> "+json.user+"<span class='caret'></span></span> <span class='hidden-xs'><div class='badge'></div>"+json.user+"<span class='caret'></span></span></a> <ul class='dropdown-menu pull-right m-t-0'> <li><a href='/user'>控制面板</a></li> <li><a href='/user/"+json.user+"/videos'>Videos</a></li> <li><a href='/user/"+json.user+"/albums'>Photo</a></li> <li><a href='/user/"+json.user+"/games'>Game</a></li> <li><a href='/user/"+json.user+"/blog'>BLOG</a></li> <li><a href='/feeds'>FEEDS</a></li> <li><a href='/requests'><span class='pull-left'>请求</span></a></li> </ul></li>"+json.bbs_login+" <li><a id='logout' href='/logout'>退出</a></li>";
					$("#login").append(div);
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
    $(".close").click(function(){
        $(".side_bar").hide();
    })
});
 {/literal}
 </script>
</head>

<body>
{$sso_bbs}
<div class="top-nav">
	<div class="container">
		<ul class="top-menu">
			{if $multi_language}
				<div class="pull-left">
					{insert name=language assign=flag}
					<li class="hidden-xs"><a data-toggle="modal" href="/"><span style="color:red">欢迎光临青青草在线视频</span></a></li>

          <li class="hidden-xs"><a data-toggle="modal" href="http://www.5188yy.com/ad/fanbb.rar"><span style="color:red">地址发布器</span></a></li>

					<li class="hidden-xs"><a data-toggle="modal" href="http://www.qingqingcao.cc/" target="_blank"><span style="color:red">请收藏青青草地址发布页</span></a></li>
					<li class="visible-xs" style="color: white;">青青草手机版欢迎你</li>
					</div>

			{/if}
			<div id="login" class="pull-right">

			</div>
			<div class="clearfix"></div>
		</ul>
	</div>
</div>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">


<div class="mobile_search visible-xs visible-sm pull-right">
 <form method="post" action="/all_search"> <input type="text" name="title" placeholder="请输入内容" class="search_input" value="" style="  ">
    			    <div name="stype" type="selectbox">
    			    		<div class="opts">
    			    			<a href="javascript:;" class="selected" val="videos">电影</a>
    			    			<a href="javascript:;" val="bbs">论坛</a>
    			    		</div>
    			    	</div>



    			     <input class="search_submit" type="submit" name="submit" value="搜索"/> </form> </div>



		<div class="pull-left">
			<a class="navbar-brand" href="{$relative}/">
                <img src="/templates/frontend/frontend-default/img/logo.png?t=2">
            </a>
            <a class="navbar-brand hidden-xs" style="margin-left: 15px;" href="{$relative}/"><img src="/templates/frontend/frontend-default/img/logo.gif"/></a>
			</div>

			<div class="search_header hidden-xs hidden-sm pull-right">

			<!--头部广告-->
			<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=36"></script>

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
    <li><a href="/videos?c=10">动漫电影</a></li>
    <li><a href="/videos?c=25">欧美电影</a></li>
    <!--<li><a href="/videos?c=28">日韩无码</a></li>-->
        				<li class="dropdown">
        					<a href="/videos?c=26" class="dropdown-toggle" data-toggle="dropdown">日韩无码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="/videos?c=4">无码丝袜</a></li>
    <li><a href="/videos?c=5">无码中文字幕</a></li>
    <li><a href="/videos?c=6">无码乱伦</a></li>
    <li><a href="/videos?c=28">无码人妻</a></li>
    <li><a href="/videos?c=9">无码制服</a></li>
    <li><a href="/videos?c=11">无码口交</a></li>
    <li><a href="/videos?c=27">无码强奸</a></li>

    </ul>
        				</li>

    <li class="dropdown">
        					<a href="/videos?c=26" class="dropdown-toggle" data-toggle="dropdown">日韩有码 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="/videos?c=35">有码乱伦</a></li>
    <li><a href="/videos?c=32">有码人妻</a></li>
    <li><a href="/videos?c=37">有码出轨</a></li>
    <li><a href="/videos?c=34">有码制服</a></li>
    <li><a href="/videos?c=33">有码口交</a></li>
    <li><a href="/videos?c=31">有码巨乳</a></li>
    <li><a href="/videos?c=36">有码强奸</a></li>

    </ul>
        				</li>

    <li class="dropdown">
        					<a href="/videos?c=26" class="dropdown-toggle" data-toggle="dropdown">国产电影 <b class="caret"></b></a>
        						<ul class="dropdown-menu">

    <li><a href="/videos?c=3">国产三级</a></li>
    <li><a href="/videos?c=19">真实自拍</a></li>
    <li><a href="/videos?c=40">裸聊视频</a></li>
    </ul>
        				</li>

    <li><a href="/videos?c=41">明星热门</a></li>
    <li><a href="/yamei/vip">加入VIP</a></li>

    <!--<li><a href="#" class="videos-icon" data-toggle="collapse" data-target=".navbar-inverse-collapse"><em>青青草视频</em></a></li>
    <li><a class="bbs-icon" href="javascript:;" onclick="location.href='http://bbs.'+domain"><em>青青草社区</em></a></li>-->
    <!--<li><a class="shop-icon" href="{$bbsdomain}/plugin.php?id=it618_scoremall:scoremall"><em>青青草商城</em></a></li>
    <li><a class="service-icon" href="/yamei/vip" target="_blank"><em>加入vip</em></a></li>-->
     </ul>

    </div>
    <!--Mobile-->

    <div class="navbar-collapse pc-navbar collapse navbar-inverse-collapse">

    	<div class="container">

    			<ul class="hidden-xs nav navbar-nav navbar-navwd">
    			    <li><a href="/">首页</a></li>
                <li><a class="{if $menu == 'index'}home-link-style {/if}hidden-xs" href="/videos">最新更新</a></li>
                    <li><a href="{$relative}/hd">高清视频</a></li>
                    <li><a href="/videos?c=10">动漫电影</a></li>
                    <li><a href="/videos?c=25">欧美电影</a></li>
                    <li><a href="/videos?c=28">日韩无码</a></li>
                    <li><a href="/videos?c=36">日韩有码</a></li>
                    <li><a href="/videos?c=39">国产电影</a></li>
                    <li><a href="/videos?c=41">明星热门</a></li>
                    <li><a href="/yamei/vip">加入VIP</a></li>

    			    <div class="search_nav hidden-xs hidden-sm"> <form method="post" action="/all_search"> <input type="text" name="title" placeholder="请输入搜索内容" class="search_input" value="">
    			     <input class="search_submit" type="submit" name="submit" value="搜索"/> </form> </div>
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
<div id="wrapper">
<div class="container">

<div class="ad-body " style="padding:0;margin-top:-15px">

<div class="adv-pc hidden-xs">
	<div style="float:left ;">
	<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=37"></script>
	</div>
	<div style="float:right">
	<script type="text/javascript" src="{$baseurl}/ads/adv.js?pos=38"></script>
	</div>
</div>

</div>
</div>
{/if}
