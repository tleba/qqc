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
	<link type="text/css" rel="stylesheet" href="/templates/frontend/frontend-default/css/style.css" />

 <script type="text/javascript"> 
 {literal}
$(function(){

	$('div[name="stype"]').inputbox({
		height:31,
		width:55
	});
	
});


// JavaScript Document
$(function(){
	$("#user").focus();
	$("input:text,textarea,input:password").focus(function() {
		$(this).addClass("cur_select");
    });
    $("input:text,textarea,input:password").blur(function() {
		$(this).removeClass("cur_select");
    });

	
	$(".btn").on('click',function(){
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
			data: {"user":user,"pass":pass},
			beforeSend: function(){
				$('<div id="msg" />').html("正在登录...").appendTo('.sub').fadeOut(2000);
				$("#pass").focus();
			},
			success: function(json){
				if(json.success==1){
					$("#login_form").remove();
					var div = "<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href='#'> <span class='visible-xs'><div class='badge'></div> "+json.user+"<span class='caret'></span></span> <span class='hidden-xs'><div class='badge'></div>"+json.user+"<span class='caret'></span></span></a> <ul class='dropdown-menu pull-right m-t-0'> <li><a href='/user'>控制面板</a></li> <li><a href='/user/"+json.user+"/videos'>Videos</a></li> <li><a href='/user/"+json.user+"/albums'>Photo</a></li> <li><a href='/user/"+json.user+"/games'>Game</a></li> <li><a href='/user/"+json.user+"/blog'>BLOG</a></li> <li><a href='/feeds'>FEEDS</a></li> <li><a href='/requests'><span class='pull-left'>请求</span></a></li> </ul></li>"+json.bbs_login+" <li><a id='logout' href='/logout'>退出</a></li>";
					$("#login").append(div);
				}else{
					$("#msg").remove();
					$('<div id="errmsg" />').html(json.msg).css("color","#fff").appendTo('.sub').fadeOut(2000);
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
					<li class="hidden-xs"><a data-toggle="modal" href="#"><span style="colorred">欢迎光临青青草在线视频</span></a></li>					
					<li class="hidden-xs"><a data-toggle="modal" href="/fabu.rar"><span style="colorred">地址发布器</span></a></li>
					<li class="visible-xs" style="color: white;">青青草手机版欢迎你</li>		
					</div>
		
			{/if}
			<div id="login" class="pull-right">
<!--User--> 
<!--User--> <li  class="hidden-xs" style=" color: #fff; ">{if $type_of_user==='guest'}{elseif $type_of_user==='free'}免费用户{else}级别:<span style=" color: red; margin-right: 10px; " class="nm">{$PremiumNikename}</span><span class="rv">{$PremiumRemainingView}</span>{/if}</li><!--End-->

			{if isset($smarty.session.uid)}
				<li class="dropdown">
					<a class="dropdown-toggle"  data-toggle="dropdown" href="#">
						<span class="visible-xs">
							{if $requests_count > 0 || $mails_count > 0}<div class="badge">{$requests_count+$mails_count}</div>{/if} {$smarty.session.username|truncate:15:"..."} <span class="caret"></span>
						</span>
						<span class="hidden-xs">
							{if $requests_count > 0 || $mails_count > 0}<div class="badge">{$requests_count+$mails_count}</div>{/if} {$smarty.session.username|truncate:35:"..."} <span class="caret"></span>
						</span>
					</a>
					<ul class="dropdown-menu pull-right m-t-0">
					<li><a href="#">{if $type_of_user==='guest'}游客{elseif $type_of_user==='free'}免费用户{else}级别:{$PremiumNikename}
					</a>
					</li>
					<li><a class="rv">{$PremiumRemainingView}</a>{/if}</li>
						<li><a href="{$relative}/user">{t c='topnav.my_profile'}</a></li>
						{if $video_module == '1'}<li><a href="{$relative}/user/{$smarty.session.username}/videos">{t c='topnav.my_videos'}</a></li>{/if}
						{if $photo_module == '1'}<li><a href="{$relative}/user/{$smarty.session.username}/albums">{t c='topnav.my_photos'}</a></li>{/if}
						{if $game_module == '1'}<li><a href="{$relative}/user/{$smarty.session.username}/games">{t c='topnav.my_games'}</a></li>{/if}
						<li><a href="{$relative}/user/{$smarty.session.username}/blog">{t c='topnav.my_blog'}</a></li>
						<li><a href="{$relative}/feeds">{translate c='global.my_feeds'}</a></li>
						<li><a href="{$relative}/requests"><span class="pull-left">{translate c='global.requests'}</span>{if $requests_count > 0}<div class="badge pull-right">{$requests_count}</div>{/if}<div class="clearfix"></div></a></li>
						<li><a href="{$relative}/mail/inbox"><span class="pull-left">{translate c='global.inbox'}</span>{if $mails_count > 0}<div class="badge pull-right">{$mails_count}</div>{/if}<div class="clearfix"></div></a></li>
						
					</ul>
				</li>			
				<li><a href="{$relative}/logout">{translate c='global.sign_out'}</a></li>
			{else}
				
			
				          <div class='hidden-xs' id="login_form">
				        <p><label>账号:</label> <input type="text" class="input" name="user" id="user" /></p>
				        <p><label>密码:</label> <input type="password" class="input" name="pass" id="pass" /></p>
				        <input type="hidden" name="submit_login" value="login" />
				        <button type="submit" class="btn"><span>登录</span></button>
				        <a class="lost" href="/lost">找回密码</a>
				        <button onclick="window.location.href('/signup')" type="button" class="reg"><span>注册</span></button>
				        <div class="sub"></div>
				    </div>
				     <div class="visible-xs">
				     <li><a href="/login" rel="nofollow">登录</a> &nbsp;&nbsp;&nbsp;&nbsp; <a href="/signup" rel="nofollow">注册</a></li>
				     </div>
					
			{/if}
			</div>
			<div class="clearfix"></div>
		</ul> 
	</div>
</div>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">


<div class="mobile_search visible-xs pull-right">
 <form method="post" action="/all_search"> <input type="text" name="title" placeholder="请输入内容" class="search_input" value="" style="  ">
    			    <div name="stype" type="selectbox">
    			    		<div class="opts">
    			    			<a href="javascript:;" class="selected" val="videos">电影</a>
    			    			<a href="javascript:;" val="bbs">论坛</a>
    			    		</div>
    			    	</div>
    			    
    			     
    			     
    			     <input class="search_submit" type="submit" name="submit" value="搜索"/> </form> </div>
                         

	
		<div class="pull-left">
			<a class="navbar-brand" href="{$relative}/"><img src="/templates/frontend/frontend-default/img/logo.png"></a> 
			</div>
			
			<div class="search_header hidden-xs pull-right">
			
			<a href="http://w66883.com/sports_evergrande_index.htm"><img src="http://www.5188yy.com/ad/ll-zh600x60.gif"/></a>
			
			</div>
			
		</div>
		
		<!--/.nav-collapse -->
    </div>
    
    <!--Mobile-->
    <div class="mobile_navbar_collapse  visible-xs">
    <ul>
    
    <li><a href="#" class="videos-icon" data-toggle="collapse" data-target=".navbar-inverse-collapse"><em>青青草视频</em></a></li>
    <li><a class="bbs-icon" href="{$bbsdomain}"><em>青青草社区</em></a></li>
    <li><a class="shop-icon" href="{$bbsdomain}/plugin.php?id=it618_scoremall:scoremall"><em>青青草商城</em></a></li>
    <li><a class="service-icon" href="#"><em>VIP客服</em></a></li>
     </ul>
    
    </div>
    <!--Mobile-->
    
    <div class="navbar-collapse pc-navbar collapse navbar-inverse-collapse">
    
    	<div class="container">
   <ul class="visible-xs nav navbar-nav">

    				{if $video_module == '1'}<li><a href="{$relative}/hd" {if $menu == 'hd'} class="home-link-style hidden-xs"{/if}><i class="fa video-hdhd"></i> 高清视频</a></li>{/if}
    				{if $video_module == '1'}<li><a href="{$relative}/videos">全部视频</a></li>{/if}
    			
 <li{if $menu == 'games'} class="active"{/if}><a href="/videos?c=10">动漫电影</a></li>
	<li class="pad_view_off {if $menu == 'games'}active{/if}"><a href="/videos?c=25">欧美电影</a></li>
    				<li{if $menu == 'games'} class="active"{/if} style="display:none;"><a href="/videos?c=26">日韩无码</a></li>
    				<li class="dropdown">
    					<a href="/videos?c=26" class="dropdown-toggle" data-toggle="dropdown">日韩无码 <b class="caret"></b></a>
    						<ul class="dropdown-menu">
    						{section name=i loop=$subcategories26}
    							<li><a href="/videos?c={$subcategories26[i].CHID}">{$subcategories26[i].name}</a></li>
    						{/section}
    						</ul>
    				</li>
    				<li{if $menu == 'games'} class="active"{/if} style="display:none;"><a href="/videos?c=29">日韩有码</a></li>
    				<li class="dropdown">
    					<a href="/videos?c=29" class="dropdown-toggle" data-toggle="dropdown">日韩有码 <b class="caret"></b></a>
    						<ul class="dropdown-menu">
    						{section name=i loop=$subcategories29}
    							<li><a href="/videos?c={$subcategories29[i].CHID}">{$subcategories29[i].name}</a></li>
    						{/section}
    						</ul>
    				</li>
    				
    				<li style="display:none;"><a href="/videos?c=39">国产电影</a></li>
    				<li class="dropdown">
    					<a href="/videos?c=39" class="dropdown-toggle" data-toggle="dropdown">国产电影 <b class="caret"></b></a>
    						<ul class="dropdown-menu">
    						{section name=i loop=$subcategories39}
    							<li><a href="/videos?c={$subcategories39[i].CHID}">{$subcategories39[i].name}</a></li>
    						{/section}
    						</ul>
    				</li>
    
    <li class="{if $menu == 'games'}active{/if}"><a href="/videos?c=41">明星热门</a></li>
    				
</ul> 
    			<ul class="hidden-xs nav navbar-nav">
    			    <li><a class="{if $menu == 'index'}home-link-style {/if}hidden-xs" href="/"><i class="index-icon"></i>首页</a></li>
    			    <li><a class="{if $menu == 'v'}home-link-style {/if}" href="/v"><i class="index-videos-icon"></i>青青草视频</a></li>
    			    <li><a href="{$bbsdomain}"><i class="index-bbs-icon"></i>青青草社区</a></li>
    			    <li><a href="{$bbsdomain}/plugin.php?id=it618_scoremall:scoremall"><i class="index-shop-icon"></i>青青草商城</a></li>
    			    <li><a href="#"><i class="index-service-icon"></i>VIP客服</a></li>
    			    
    			    <div class="search_nav hidden-xs"> <form method="post" action="/all_search"> <input type="text" name="title" placeholder="请输入搜索内容" class="search_input" value="" style="  ">
    			    <div name="stype" type="selectbox">
    			    		<div class="opts">
    			    			<a href="javascript:;" class="selected" val="videos">电影</a>
    			    			<a href="javascript:;" val="bbs">论坛</a>
    			    		</div>
    			    	</div>
    			    
    			     
    			     
    			     <input class="search_submit" type="submit" name="submit" value="搜索"/> </form> </div>
    				    			
 
	
    				
    				
    				
    				
    				
    				
    				
    
    
    
    
    	
    								
    			</ul>
    			
    			</div>
    			
    		</div>
    		
    		
    		{if $module != 'index'}
    		
    		<div class="navbar-collapse pc-tags cats hidden-xs collapse navbar-inverse-collapse">
    		
    			<div class="container">
    		
<a href="{$relative}/hd">高清视频</a>
<a href="{$relative}/videos">全部视频</a>
<a href="/videos?c=10">动漫电影</a>	   			
<a href="/videos?c=25">欧美电影</a> 				
<a href="/videos?c=28">日韩无码</a>
<a href="/videos?c=36">日韩有码</a> 				   				
<a href="/videos?c=39">国产电影</a> <a href="/videos?c=41">明星热门</a>
    					
    					</div>
    					
    				</div>
    	{/if}
    	
    			 				   				
    
</div>
{if $module != 'index'}
<div id="wrapper">
<div class="container">
<div class="ad-body">

<div class="adv-pc">
<script type="text/javascript" src="/ads/nav.js"></script>
</div>

</div>
</div>
{/if}
