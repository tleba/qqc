<!DOCTYPE html>
<html>
<head>
	<title>最新活动</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="templates/css/base.css">
	<link rel="stylesheet" type="text/css" href="templates/css/swiper.min.css">
	<link rel="stylesheet" type="text/css" href="/templates/frontend/frontend-default/css/bootstrap.min.css?t=2"/>
	<link rel="stylesheet" type="text/css" href="/templates/frontend/frontend-default/css/colors.css?t=2016021231"/>
	<link rel="stylesheet" type="text/css" href="templates/css/index.css?t=1">
	
	<link rel="stylesheet" type="text/css" href="/templates/frontend/frontend-default/css/style.css?t=2016021231"/>


	<script type="text/javascript" src="templates/js/jquery.js"></script>
	<script type="text/javascript" src="/templates/frontend/frontend-default/js/bootstrap.min.js?v=20151015"></script>
	{literal}
	<style type="text/css">
		 .swiper-container {
	        width: 100%;
	        height: 100%;
	    }
	    .swiper-slide {
	        text-align: center;
	        font-size: 18px;
	        background: #fff;
	        display: -webkit-box;
	        display: -ms-flexbox;
	        display: -webkit-flex;
	        display: flex;
	        -webkit-box-pack: center;
	        -ms-flex-pack: center;
	        -webkit-justify-content: center;
	        justify-content: center;
	        -webkit-box-align: center;
	        -ms-flex-align: center;
	        -webkit-align-items: center;
	        align-items: center;
	    }
	    .swiper-slide a{width: 100%;}
	    .swiper-slide a img{width: 100%;}
	    .container_skitter{height:auto!important;}
	    .label_skitter{width:100%!important;}
	</style>
	{/literal}
</head>
<body>
	<div class="top-nav">
		<div class="container">
			<ul class="top-menu">
				<div class="pull-left">
					<li class="hidden-xs"><a data-toggle="modal" href="/"><span style="color:white">欢迎光临青青草在线视频</span></a></li>
					<li class="hidden-xs visible-mo"><a data-toggle="modal" href="http://www.sowo99.com/" target="_blank"><span style="color:white">请收藏青青草地址发布页</span></a></li>
					<li class="visible-xs" style="color: white;">青青草手机版欢迎你</li>
				</div>
				<div id="login" class="pull-right"></div>
			<div class="clearfix"></div>
			</ul>
		</div>
	</div>
 <link rel="stylesheet" type="text/css" href="/qhd/templates/css/slider.css" />
 <link rel="stylesheet" type="text/css" href="/qhd/templates/css/skitter.styles.css" media="all" />
	<div class="content">
		<div class="banner">
		<div id="outerslider" >
        	<div id="slidercontainer">
            	<section id="slider">
                <div class="box_skitter box_skitter_large">
                    <ul class="ads_119"></ul>
                </div>
                </section>
            </div>
        </div>
		</div>
		<div class="activity">
			<div class="seek">
				<ul>
				
					<li><label class="seekActiveity">搜活动</label></li>
					<li class="seekbutton">
					<form name="search" id="search" method="get" action="/qhd/index.php">
						<input type="text" name="keyword" value="{$keyword}" placeholder="请输入活动关键词" >
						<input type="hidden" name="search_btn" value="search"/>
						<a href="javascript:void(0);"><span id="seek"><img src="templates/images/seek_03.jpg"></span></a><!--搜索按钮-->
					</form>
					</li>
				</ul>
			</div>
			<div class="activityContent">
				<div class="actiContLeft">
					<ul id="activeList">
					<li {if $cid == 0}class="active"{/if}>
							<span><i><img src="templates/images/san_07.png"></i><a href="/qhd/">全部活动</a></span>
					</li>
					{section name=i loop=$categories}
						<li {if $cid == $categories[i].id}class="active"{/if}>
							<span><i><img src="templates/images/san_07.png"></i><a href="/qhd/?cid={$categories[i].id}">{$categories[i].name}</a></span>
						</li>
					{/section}
					</ul>
				</div>
				<div class="actiContRight" style="display: block;">
					<ul class="list">
					{section name=i loop=$hds}
						<li class="active">
							<div class="RlistCont">
								<div class="listLeft">
									<a target="_blank" rel="noopener noreferrer" href="{if $hds[i].url != ''}{$hds[i].url}{else}/qhd/show.php?id={$hds[i].id}{/if}"><img src="/media/hd/{$hds[i].id}.jpg"></a>
								</div>
								<div class="listRight">
									<h3>{$hds[i].title}</h3>
									<p class="text">{$hds[i].context|clear_trim}</p>
									<p><a target="_blank" rel="noopener noreferrer" href="{if $hds[i].url != ''}{$hds[i].url}{else}/qhd/show.php?id={$hds[i].id}{/if}">查看详情</a></p>	
									<p class="activiTime">
										<span class="newTime">活动时间：{$hds[i].stime|ddate_format}-{$hds[i].etime|ddate_format}</span>
										<span id="hint"></span>
										{if $curtime < $hds[i].etime && $hds[i].ispopular == 1}<span class="status hot"></span>
										{else}
											{if $curtime < $hds[i].stime}
												<span class="status NotStarted"></span>
											{elseif $curtime > $hds[i].stime && $curtime < $hds[i].etime}
												<span class="status underwa"></span>
											{else}
												<span class="status over"></span>
											{/if}
										{/if}
									</p>	
								</div>
							</div>
						</li>
					{/section}
					</ul>
					<div class="xz" style="text-align:center;">
					<ul class="pagination">
					{$paging}
					</ul>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
<div class="footer-container visible-xs" style="position:relative;">
	<div class="footer-links">
		<div class="container">
			<div class="row">
				<div class="list-unstyled bottom-nav">
					<li><a href="{$relative}/static/advertise" rel="nofollow">{translate c='footer.advertise'}</a></li>
					<li><a href="{$relative}/invite" rel="nofollow">{translate c='global.invite_friends'}</a></li>
					<li><a href="{$relative}/static/faq" rel="nofollow">{translate c='footer.faq'}</a></li>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-copy hidden-xs">
		<div class="container">
			<div class="row text-muted">
			  <p>站点申明：我们立足于美利坚合众国,对全球华人服务,受北美法律保护。版权所有,未经授权禁止复制或建立镜像。</p> <p>警告︰青青草在线视频（www.qqc2015.com）只适合18岁或以上人士观看。本网站内容可能令人反感！切不可将本站的内容出售、出租、交给或借予年龄未满18岁的人士或将本网站内容向未满18岁人士出示、播放或放映。如果您发现本站的某些影片内容不合适，或者某些影片侵犯了您的的版权，请联系我们删除影片。</p><p> WARNING: This Site Contains Adult Contents, No Entry For Less Than 18-Years-Old !</p>
			</div>
			
		</div>
	</div>

	<div class="footer">
		<div class="container">
			<div class="hidden-xs">
				<span>{t c='footer.copyright'} &#169; 2008-2014</span> {$site_name}
				<div class="clearfix"></div>
			</div>
			<div class="visible-xs">
				<span>{t c='footer.copyright'} &#169; 2008-2014</span> {$site_name}
			</div>
		</div>
	</div>
</div>
<div class="footer hidden-xs">
	<div class="footerContent">
		<div class="footerLeft">
			<a href="/"><img src="/templates/frontend/frontend-default/img/logo.png" style="margin-right:10px;"></a>
		</div>
		<div class="footerMian">
			<img src="/templates/frontend/frontend-default/img/qq_15.jpg">
			<ul>
				<li style="line-height:20px;"><span style="font-size:13px;">活动客服：在线咨询</span><a href="http://www8.53kf.com/webCompany.php?style=1&arg=10138776"></a></li>
				<li style="line-height:20px;"><span style="font-size:13px;">活动客服：401309722</span><a href="tencent://message/?uin=401309722&Site=www.luoxiao123.cn&Menu=yes"></a></li>
				<li style="line-height:20px;"><span style="font-size:13px;">活动客服：529330164</span><a href="tencent://message/?uin=529330164&Site=www.luoxiao123.cn&Menu=yes"></a></li>
				<li style="line-height:18px;"><span>在线时间：13:00--22:00</span></li>
			</ul>
		</div>
		<div class="footerRight">
			<img src="/templates/frontend/frontend-default/img/generate.gif" style="height:110px;">
			<ul>
				<li>手机扫一扫【安卓版】  </li>
				<li>扫描二维码下载青青草APP</li>
				<li>IOS版本正在开发中敬请期待</li>
			</ul>
		</div>
	</div>
	<div class="side_bar ads_85" style="width:240px;height:auto;cursor:pointer;bottom:0;position:absolute;right:0px;top:0px;margin-top:0;"></div>
</div>
	<script type="text/javascript" src="/ads/data.js"></script>
	{literal}
		<script type="text/javascript">
		function ismobile(){
			var sUserAgent = navigator.userAgent.toLowerCase();
			var bIsIpad = sUserAgent.match(/ipad/i) == "ipad";
		    var bIsIphoneOs = sUserAgent.match(/iphone os/i) == "iphone os";
		    var bIsMidp = sUserAgent.match(/midp/i) == "midp";
		    var bIsUc7 = sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";
		    var bIsUc = sUserAgent.match(/ucweb/i) == "ucweb";
		    var bIsAndroid = sUserAgent.match(/android/i) == "android";
		    var bIsCE = sUserAgent.match(/windows ce/i) == "windows ce";
		    var bIsWM = sUserAgent.match(/windows mobile/i) == "windows mobile";
		    if (bIsIpad || bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM )
		        return 1;
		    else
		    	return 0;
		}
		function showAds(options){
			if(ads){
				var cWidth = parseInt($('.container').css('width').replace('px',''));
				var pcContainerWidth = 1150;
				var ismo = ismobile();
				var opts = {
					class:''
				};
				$.extend(opts,options);
				
				$.each(ads,function(i,r){
					
					var width = r.width;
					
					var height = r.height;
					
					var advs = $('.ads_'+i);
					
					if(r.ads && advs.length > 0){
						var oft = document.createDocumentFragment();
						$.each(r.ads,function(j,adv){
							var $div = $('<li />');
							$div.addClass(opts.class);
							var url = '';
							if(ismo != parseInt(adv.ismobile)) return;
							$img = $('<img />');
							$img.attr('src', (adv.media != '') ? adv.media : adv.relogopic);
							$img.attr('title', adv.name);
						
							$img.attr('style', "width:"+width+"px;height:"+height+"px;");
	
							$a = $('<a />');
						
							if(adv.id && adv.relname != '' && adv.relogopic != '') {
								url = '/tiaozhuan.php?id=' + adv.id;
							}else{
								url = adv.url;
							}
							$a.attr('href', url);
							$a.attr('target', '_blank');
							var id = 0;
							if(adv.id){
								id = adv.id;
							}
							var name =  "";
							if(adv.name){
								name =  adv.name;
							}
							var zone_name = "";
							if(adv.zone_name){
								zone_name = adv.zone_name;
							}
							$a.on({
								'click':function(){
									$.post('/ajax/adv_count',{'id':id,'title':name,'zone_name':zone_name},function(resutl){});
								}
							});
							var $idiv = $('<div />');
							$idiv.addClass('label_text').html('<span>'+adv.name+'</span>');
							$a.append($img);
							$a.append($idiv);
							$div.append($a);
							$(oft).append($div);
						});
						$(advs).css({'width':width,'margin-bottom':'10px'}).append(oft);
					}
				});
			}
		}
			$(function(){
				showAds();
				$('#login').load('/site_login.php');
				var oHeight = $(".banner").height()+$(".activity").height();
				$(".content").height(oHeight-100)
				$("#activeList li").click(function(){
					var index  = $(this).index();
					var oHeights = $(".activityContent").find(".actiContRight").eq(index).height();
					var bHeight = $(".banner").height();
					var cont =  $(".banner").height()+oHeights;	
					$(".content").height(cont+80);
					$(this).addClass("active").siblings().removeClass("active");
					$(".actiContLeft").height($(".activityContent").find(".actiContRight").eq(index).height());
					$(".activityContent").find(".actiContRight").eq(index).show().siblings(".actiContRight").hide();
				})
		$(".actiContLeft").height($(".actiContRight").height());
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
					window.location.reload();
				}else{
					$("#msg").remove();
					$('<div id="errmsg" />').html(json.msg).css("color","#fff").appendTo('.sub').fadeOut(2000);

					jQuery("button.btn").removeAttr('disabled');
					return false;
				}
			}
		});
	});
			});
		</script>
	    <script>
	    $('#seek').parent().click(function(){
	    	$('#search').submit();
	    });
	    </script>{/literal}
<script type="text/javascript" src="/qhd/templates/js/jquery.animate-colors-min.js"></script>
<script type="text/javascript" src="/qhd/templates/js/jquery.slider.js"></script>
<script type="text/javascript" src="/qhd/templates/js/jquery.easing.1.3.js"></script>
</body>
</html>  