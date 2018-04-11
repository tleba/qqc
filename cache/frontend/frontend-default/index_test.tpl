{include file="header.tpl"}
{include file="errors.tpl"}
{include file="messages.tpl"}
<base target="_blank">
<div class="index_wrapper">

<div class="hidden-xs hidden-sm index_home_ads">

<div style="float:left ;"><a href="http://www.zhiboav.me/huodong/am/"><img width="535" height="75" src="http://www.5188yy.com/ad/ya-zh.gif"/></a></div>
<div style="float:right ;"><a href="http://d88883.com"><img width="535" height="75" src="http://www.5188yy.com/ad/zl-zh.gif"/></a></div>

</div>

<div class="hidden-xs hidden-sm index_mod_recommend">
<div class="hidden-xs hidden-sm shows_index_carousel">
<!--幻灯-->
<script src="/templates/frontend/frontend-default/js/carousel.js"></script>
<script>
var bbsdomain = '{$bbsdomain}';
{literal}  
$(document).ready(function(){

// videos_tab END
// bbs_tab


// 论坛精品推荐 END

// 论坛精品推荐

 $.ajax({
        type : "get",  
        async:false,  
        url : bbsdomain+"/index_json.php?t=bbs_bbspicture_main",  
        dataType : "jsonp",  
        success : function(data){  
            $(".custom-body-column-right-main").html(data.html)  
        },  
        error:function(){  
            alert('网络问题,加载失败...');  
        }  
    });   



// 论坛精品推荐 END

$("#rand").click(function(){
			var tz = 0;
			var val = tz + 8;
			if(val>=8){
			val = val+8;
			}
       $.ajax({
        type : "get",  
        async:false,  
        url : bbsdomain+"/index_jsonp.php?t=bbs_bbspicture_main&p=" + val +"",  
        dataType : "jsonp",  
        success : function(data){  
            $(".bbs_bbspicture_main").html(data.html)  
        },  
        error:function(){  
            alert('网络问题,加载失败...');  
        }  
    });   
	        
});

$('#index-carousel').owlCarousel({ items: 1 });

});


</script>
<link href="/templates/frontend/frontend-default/css/owl.carousel.css" rel="stylesheet"/>
<link href="/templates/frontend/frontend-default/css/owl.theme.css" rel="stylesheet"/>
<style>
.footer-container{
	  position: relative;
}
.owl-theme .owl-controls {
  bottom: 5px;
  position: absolute;
  right: 10px;
}
.alert{display:none}
#index-carousel {
    width: 560px;
    margin-left: auto;
    margin-right: auto;
}
#index-carousel .item {
    display: block;
}
#index-carousel img {
    display: block;
    width: 100%;
}
.owl-theme .owl-controls .owl-page span {
  display: block;
  width: 12px;
  height: 12px;
  margin: 5px 7px;
  background: #fff;
  overflow: hidden;
  opacity: 1;
}
.owl-theme .owl-controls .owl-page.active span, .owl-theme .owl-controls.clickable .owl-page:hover span {
  background-color: #17937b;
}
</style>
{/literal}  

<!--幻灯-->
<div id="index-carousel" class="hidden-xs hidden-sm index_carousel">
{$advertisement_sm}
</div>
<!--幻灯-->


</div>




<div class="tables hidden-xs hidden-sm">

<ul class="index-tabs hidden-xs hidden-sm" id="index-tabs"> 
      <li><a href="#videos_tab">成人电影推荐</a></li> 
      <li><a href="#bbs_tab">本周成人推荐</a></li> 
    </ul> 
       
<div class="hidden-xs hidden-sm tab-content"> 
      <div class="tab-pane hidden-xs hidden-sm" id="videos_tab">
      
      {section name=i loop=$featureds}
      <li style='line-height: 19px; '><img src='/templates/frontend/frontend-default/img/2.png' style='  float: left; margin-right: 8px; '><a href='{$relative}/video/{$featureds[i].VID}/{$featureds[i].title|clean}'>{$featureds[i].title|escape:'html'}</a><em><img src='/templates/frontend/frontend-default/img/3.png'></em></li>	
      {/section}
      
      </div> 
      <div class="tab-pane hidden-xs hidden-sm" id="bbs_tab">
	{$bbs_tab_sm}
	</div> 
</div> 
  {literal}  
    <script> 
      $(document).ready(function(){
        $('#index-tabs a:first').tab('show');//初始化显示哪个tab 
      
        $('#index-tabs a').click(function (e) { 
          e.preventDefault();//阻止a链接的跳转行为 
          $(this).tab('show');//显示当前选中的链接及关联的content 
        }) 
      });
      
      $(document).ajaxSuccess(function(evt, request, settings){  
              console.log("青青草AJAX执行完毕");
              console.log("...............");
       });
    </script>
   {/literal}   
   
</div>

</div>

<div class="index_mod_videos hidden-xs hidden-sm">
<div class="index_title hidden-xs hidden-sm">
<h2>在线成人推荐</h2>
<a href="/v" class="index_more">更多...</a>
</div>

<div class="videos_mian hidden-xs hidden-sm">

{section name=i loop=$featured_videos}

<li class="videos_item"> <a href="{$relative}/video/{$featured_videos[i].VID}/{$featured_videos[i].title|clean}"><img src="{insert name=thumb_path vid=$featured_videos[i].VID}/{$featured_videos[i].thumb}.jpg"/></a><div class="figure_sign"><i class="triangle_right"></i></div>
<div class="figure_caption figure_caption_sign"> <strong class="index-title-te">{$featured_videos[i].title|escape:'html'}</strong><span class="index-page-view" style="">热度:{$featured_videos[i].viewnumber}</span> </div></li>
{/section}

</div>

</div>

<div class="index_bbs_commendable hidden-xs hidden-sm">

<div class="index_title hidden-xs hidden-sm">
<h2>成人精品推荐</h2>
<a href="{$bbsdomain}" class="index_more">更多...</a>
</div>

<div class="commendable_mian hidden-xs hidden-sm">

<div class="commendable_mian_l hidden-xs hidden-sm">{$commendable_mian_l_sm}</div>
<div class="commendable_mian_r hidden-xs hidden-sm">{$commendable_mian_r_sm}</div>


</div>

</div>



{literal}  

<style type="text/css">
	

	
	.clearfix:after{content:".";display:block;height:0;clear:both;visibility:hidden}
	.clearfix{*+height:1%;}
	
	.custom-block{
		margin:0px 0 10px 0;
	}
	
	.custom-block a{
		color: #333;
		color: #1f262e;
		font-size: 14px;
		text-decoration: none;
	}
	
	.custom-block a:hover{
		  color: #FF9900;
		text-decoration: none;
	}

	.custom-block .custom-body{

		font: 12px/1.8 'Microsoft Yahei','Simsun';
		color: #444;

		background-color: #ffffff !important;
		background-image: none !important;

	}
	
	.custom-block .custom-body-column-left{
		border-right: 1px #ededed solid;
		float:left;
		width:66%;
		height:400px;
		overflow:hidden;
	}
	
	.custom-block .custom-body-column-right{
		width:33%;
		float:right;


	}
	
	
	.custom-block .custom-body-column-left-row  {

	}
	
	.custom-block .custom-body-column-left-row ul{
		padding:0;
		marign:0;
	}
	
	.custom-block .custom-body-column-left-row  li {
		width: 700px;
		height: 195px;
		margin: 10px 0px;
		border-bottom: 1px dashed #CCC;
	}
	
	
	.custom-block .custom-body-column-left-row ul li .custom-l{
		width: 250px;
		height: 180px;
		float: left;
		margin-right: 25px;
	}
	
	.custom-block .custom-body-column-left-row ul li .custom-r{
		width: 415px;
		float: left;
		overflow: hidden;
		position: relative;
	}
	
	.custom-block .custom-body-column-left-row ul li .custom-r .param{
		position:relative;
		min-height:63px;
		
	}
	
	.custom-block .custom-body-column-left-row ul li .custom-r .param .detail{
		position:absolute;
		width: 70px;
		height: 30px;
		float: right;
		top:10px;
		right:10px;
		background: #8CBAFF url(/templates/frontend/frontend-default/img/itinerary_bg.png) no-repeat left;
	}
	
	.custom-block .custom-body-column-left-row ul li .custom-r .param .detail a{
		width: 70px;
		text-align: center;
		line-height: 30px;
		display: block;
		color: #FFF;
	}
	
	.custom-block .custom-body-column-left-row ul li img  {
		
		
	}
	
	
	.custom-block .custom-body-column-left-row .custom-t {
		
		height: 40px;
		background: url(/templates/frontend/frontend-default/img/divider.png) repeat-x left bottom;
		overflow: hidden;
	}
	
	.custom-block .custom-body-column-left-row .custom-t a  {
		font-size: 16px;
		line-height: 40px;
		font-weight: bold;
		overflow: hidden;
	}
	
	.custom-block .custom-body-column-left-row ul li .info  {
		padding-top:15px;
		max-height:78px;
		overflow:hidden;
	}
	
	.custom-block .custom-body-column-left-row ul li .info em  {
		font-style:normal
	}
	 
	.custom-block .custom-body-column-right-title{
		font-size: 18px;
		color: #1c262f;
		font-weight: normal;
		border-bottom: 2px #ededed solid;
		line-height: 30px;
		padding: 10px 0 6px 0;
	}
	
	
		
	
	
	
	
	.custom-block .custom-body-column-right ul{
		margin:0; 
		padding:0;
		list-style:none;
	}
	
	.custom-block .custom-body-column-right ul li{
		margin-top: 10px;
		height: 80px;
		padding:5px 10px;
	}
	
	.custom-block .custom-body-column-right ul li .img{
		margin-right: 10px;
		font-size: 16px;
		border: 1px solid #DDDDDD;
		padding: 4px;
		float:left;

		width:80px;
	}
	
	.custom-block .custom-body-column-right ul li .text{
		display:block;
		float:left;
		width:240px;
		overflow:hidden;

		
	}
	
	.custom-block .custom-body-column-right ul li .text p {
		height:40px;
		overflow:hidden;
	}
	
	.custom-block .custom-body-column-right ul li .img img{
		width: 70px;
		height: 70px;
	}


  
  </style>
  
  
  
  <script>
	$.ajax({
        type : "get",  
        async:false,  
        url : bbsdomain+"/index_json.php?",  
        dataType : "jsonp",  
        success : function(data){  
            $(".custom-body-column-left-main").html(data.bbs_photo_1) ;
			$(".custom-body-column-right-main").html(data.bbs_photo_2) ;
        },  
        error:function(){  
            alert('网络问题,加载失败...');  
        }  
    });   

</script>
  
  {/literal}  
  
  <div class="index_bbs_photo">
	<div class="index_title hidden-xs hidden-sm">
		<h2>精品推荐</h2>
		<a href="/v" class="index_more">更多...</a>
	</div>

	<div class="custom-block clearfix">
	
		<div class="custom-body clearfix">
			<div class="custom-body-column-left ">
				<div class="custom-body-column-left-row clearfix">
				<ul  class="custom-body-column-left-main"></ul>
				</div>
			</div>
			<div class="custom-body-column-right">
				<div class="custom-body-column-right-title">凤楼信息</div>
				 <ul class="custom-body-column-right-main"></ul>
			</div>
		</div>
	</div>
</div>
  
  
  
  


</div>


<div class="visible-sm visible-xs container">

<div class="well well-filters new_filters">
	<div class="pull-left">
		<h4><i class="fa fa-clock-o green"></i>&nbsp;{translate c='index.most_recent_videos'}</h4>
	</div>
	
	<div class="pull-right btn-line-height m-l-20">
		<a class="btn btn-primary" href="{$relative}/videos?o=mr"><span class="hidden-xs"><i class="fa fa-plus"></i> {translate c='index.most_recent_videos_more'}</span><span class="visible-xs"><i class="fa fa-plus"></i></span></a>
	</div>
	
	<div class="pull-right m-l-20">
					<div class="hidden-xs">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $type == ''}{t c='global.type'}{elseif $type == 'public'}{t c='global.public'}{else}{t c='global.private'}{/if} <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
								<li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
								<li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>
							</ul>
						</div>
						
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $timeframe == 'a'}{t c='global.timeline'}{elseif $timeframe == 't'}{t c='global.added'} {t c='global.today'}{elseif $timeframe == 'w'}{t c='global.added'} {t c='global.this_week'}{else}{t c='global.added'} {t c='global.this_month'}{/if} <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>							
								<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
								<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
								<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
							</ul>
						</div>					
	
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $order == 'bw'}{t c='global.being_watched'}{elseif $order == 'mr'}{t c='global.most_recent'}{elseif $order == 'mv'}{t c='global.most_viewed'}{elseif $order == 'tr'}{t c='global.top_rated'}{elseif $order == 'md'}{t c='global.most_commented'}{elseif $order == 'tf'}{t c='global.top_favorites'}{else}{t c='global.longest'}{/if} <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>						
								<li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
								<li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
								<li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
								<li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>							
								<li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
								<li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
							</ul>
						</div>					
					</div>	
					<div class="visible-xs">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
								<li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
								<li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>						
								<li class="divider"></li>
								<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>							
								<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
								<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
								<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
								<li class="divider"></li>				
								<li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>						
								<li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
								<li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
								<li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
								<li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>							
								<li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
								<li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
							</ul>
						</div>				
					</div>
				</div>
			
	<div class="clearfix"></div>
</div>

<div class="row row-boder">
	<div class="col-sm-8">
        {if $recent_videos}
		<div class="row">
		{section name=i loop=$recent_videos}
			
			<div class="col-sm-6 col-md-4 col-lg-4">
				<div class="well well-sm">
					<a href="{$relative}/video/{$recent_videos[i].VID}/{$recent_videos[i].title|clean}">
						<div class="thumb-overlay">
							<img src="{insert name=thumb_path vid=$recent_videos[i].VID}/{$recent_videos[i].thumb}.jpg" title="{$recent_videos[i].title|escape:'html'}" alt="{$recent_videos[i].title|escape:'html'}" id="rotate_{$recent_videos[i].VID}_{$recent_videos[i].thumbs}_{$recent_videos[i].thumb}_recent" class="img-responsive {if $recent_videos[i].type == 'private'}{/if}"/>
							{if $recent_videos[i].type == 'public'}<div class="label-private">{t c='global.PRIVATE'}</div>{else}<div class="label-vip">&nbsp;</div>{/if}
							{if $recent_videos[i].hd==1}<div class="hd-text-icon">HD</div>{/if}
							<div class="duration">
								{insert name=duration assign=duration duration=$recent_videos[i].duration}
								{$duration}
							</div>
						</div>
						<span class="video-title title-truncate m-t-5">{$recent_videos[i].title|escape:'html'}</span>
					</a>
					<div class="video-added">
						{insert name=time_range assign=addtime time=$recent_videos[i].addtime}
						{$addtime}
					</div>
					<div class="video-views pull-left">
						<i class="fa fa-eye"></i>&nbsp;{$recent_videos[i].viewnumber} 
					</div>
					<div class="video-rating pull-right {if $recent_videos[i].rate == 0 && $recent_videos[i].dislikes == 0}no-rating{/if}">
						<i class="fa fa-thumbs-up video-rating-heart {if $recent_videos[i].rate == 0 && $recent_videos[i].dislikes == 0}no-rating{/if}"></i> <b>{if $recent_videos[i].rate == 0 && $recent_videos[i].dislikes == 0}-{else}{$recent_videos[i].rate}%{/if}</b>
					</div>	
					<div class="clearfix"></div>
					
				</div>				
			</div>
			
						
		{/section}
		
		
		</div>
        {else}
		<div class="well well-sm">
			<span class="text-danger">{t c='videos.no_videos_found'}.</span>
		</div>
        {/if}	
        
        		
	</div>
	
	
	
<div class="col-md-3 col-sm-4">

<div class="ad-body">

<div class="adv-pc">
<script type="text/javascript" src="/ads/new-upload.js"></script>
</div>

</div>

</div>
	
	
</div>


<div class="ad-body">

<div class="adv-pc">
<script type="text/javascript" src="/ads/new-upload-bottom.js"></script>
</div>

</div>


	<div class="well well-filters new_filters">
			<div class="pull-left">
				<h4><i class="fa fa-thumbs-o-up green"></i>&nbsp;本站推荐的视频</h4>
			</div>
			
			<div class="hidden-xs pull-right btn-line-height m-l-20">
				<a class="btn btn-primary" href="{$relative}/videos?o=mr"><span><i class="fa fa-plus"></i> {translate c='index.most_recent_videos_more'}</span><span class="visible-xs"><i class="fa fa-plus"></i></span></a>
			</div>
			
			<div class="pull-right m-l-20">
							<div>
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $type == ''}{t c='global.type'}{elseif $type == 'public'}{t c='global.public'}{else}{t c='global.private'}{/if} <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
										<li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
										<li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>
									</ul>
								</div>
								
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $timeframe == 'a'}{t c='global.timeline'}{elseif $timeframe == 't'}{t c='global.added'} {t c='global.today'}{elseif $timeframe == 'w'}{t c='global.added'} {t c='global.this_week'}{else}{t c='global.added'} {t c='global.this_month'}{/if} <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>							
										<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
										<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
										<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
									</ul>
								</div>					
			
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $order == 'bw'}{t c='global.being_watched'}{elseif $order == 'mr'}{t c='global.most_recent'}{elseif $order == 'mv'}{t c='global.most_viewed'}{elseif $order == 'tr'}{t c='global.top_rated'}{elseif $order == 'md'}{t c='global.most_commented'}{elseif $order == 'tf'}{t c='global.top_favorites'}{else}{t c='global.longest'}{/if} <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>						
										<li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
										<li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
										<li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
										<li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>							
										<li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
										<li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
									</ul>
								</div>					
							</div>	
							<div class="visible-xs">
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
										<li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
										<li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>						
										<li class="divider"></li>
										<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>							
										<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
										<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
										<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
										<li class="divider"></li>				
										<li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>						
										<li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
										<li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
										<li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
										<li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>							
										<li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
										<li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
									</ul>
								</div>				
							</div>
						</div>
					
			<div class="clearfix"></div>
	</div>

	<div class="row row-boder">
		<div class="col-md-12">
            {if $featured_videos}
			<div class="row">
            {section name=i loop=$featured_videos}
				
				<div class="col-sm-4 col-md-3 col-lg-3">
					<div class="well well-sm">
						<a href="{$relative}/video/{$featured_videos[i].VID}/{$featured_videos[i].title|clean}">
							<div class="thumb-overlay">
								<img src="{insert name=thumb_path vid=$featured_videos[i].VID}/{$featured_videos[i].thumb}.jpg" title="{$featured_videos[i].title|escape:'html'}" alt="{$featured_videos[i].title|escape:'html'}" id="rotate_{$featured_videos[i].VID}_{$featured_videos[i].thumbs}_{$featured_videos[i].thumb}_recent" class="img-responsive {if $featured_videos[i].type == 'private'}{/if}"/>
								{if $featured_videos[i].type == 'public'}<div class="label-private">{t c='global.PRIVATE'}</div>{else}<div class="label-vip">&nbsp;</div>{/if}
								{if $featured_videos[i].hd==1}<div class="hd-text-icon">HD</div>{/if}
								<div class="duration">
									{insert name=duration assign=duration duration=$featured_videos[i].duration}
									{$duration}
								</div>
							</div>
							<span class="video-title title-truncate m-t-5">{$featured_videos[i].title|escape:'html'}</span>
						</a>
						<div class="video-added">
							{insert name=time_range assign=addtime time=$featured_videos[i].addtime}
							{$addtime}
						</div>
						<div class="video-views pull-left">
							<i class="fa fa-eye"></i>&nbsp;{$featured_videos[i].viewnumber} 
						</div>
						<div class="video-rating pull-right {if $featured_videos[i].rate == 0 && $featured_videos[i].dislikes == 0}no-rating{/if}">
							<i class="fa fa-thumbs-up video-rating-heart {if $featured_videos[i].rate == 0 && $featured_videos[i].dislikes == 0}no-rating{/if}"></i> <b>{if $featured_videos[i].rate == 0 && $featured_videos[i].dislikes == 0}-{else}{$featured_videos[i].rate}%{/if}</b>
						</div>	
						<div class="clearfix"></div>
						
					</div>				
				</div>
							
            {/section}
			</div>
            {else}
			<div class="well well-sm">
				<span class="text-danger">暂无推荐的视频！(标志为:featured).</span>
			</div>
            {/if}			
						

		</div>
		
		
	</div>
	
	
	<div class="ad-body">
	
<div class="adv-pc">
<script type="text/javascript" src="/ads/featured-video-bottom.js"></script>
</div>
	
	</div>
	
	
	<div class="well well-filters new_filters">
		<div class="pull-left">
			<h4><i class="fa fa-fire green"></i>&nbsp;最受欢迎的视频</h4>
		</div>
		
		<div class="hidden-xs pull-right btn-line-height m-l-20">
			<a class="btn btn-primary" href="{$relative}/videos?o=mr"><span><i class="fa fa-plus"></i> {translate c='index.most_recent_videos_more'}</span><span class="visible-xs"><i class="fa fa-plus"></i></span></a>
		</div>
		
		<div class="pull-right m-l-20">
						<div>
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $type == ''}{t c='global.type'}{elseif $type == 'public'}{t c='global.public'}{else}{t c='global.private'}{/if} <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
									<li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
									<li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $timeframe == 'a'}{t c='global.timeline'}{elseif $timeframe == 't'}{t c='global.added'} {t c='global.today'}{elseif $timeframe == 'w'}{t c='global.added'} {t c='global.this_week'}{else}{t c='global.added'} {t c='global.this_month'}{/if} <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>							
									<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
									<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
									<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
								</ul>
							</div>					
		
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">{if $order == 'bw'}{t c='global.being_watched'}{elseif $order == 'mr'}{t c='global.most_recent'}{elseif $order == 'mv'}{t c='global.most_viewed'}{elseif $order == 'tr'}{t c='global.top_rated'}{elseif $order == 'md'}{t c='global.most_commented'}{elseif $order == 'tf'}{t c='global.top_favorites'}{else}{t c='global.longest'}{/if} <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>						
									<li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
									<li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
									<li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
									<li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>							
									<li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
									<li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
								</ul>
							</div>					
						</div>	
						<div class="visible-xs">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li {if $type == ''}class="active"{/if}><a href="{url base='videos' strip='type' value=''}">{t c='global.all'}</a></li>
									<li {if $type == 'public'}class="active"{/if}><a href="{url base='videos' strip='type' value='public'}">{t c='global.public'}</a></li>
									<li {if $type == 'private'}class="active"{/if}><a href="{url base='videos' strip='type' value='private'}">{t c='global.private'}</a></li>						
									<li class="divider"></li>
									<li {if $timeframe == 'a'}class="active"{/if}><a href="{url base='videos' strip='t' value='a'}">{t c='global.all'}</a></li>							
									<li {if $timeframe == 't'}class="active"{/if}><a href="{url base='videos' strip='t' value='t'}">{t c='global.added'} {t c='global.today'}</a></li>
									<li {if $timeframe == 'w'}class="active"{/if}><a href="{url base='videos' strip='t' value='w'}">{t c='global.added'} {t c='global.this_week'}</a></li>
									<li {if $timeframe == 'm'}class="active"{/if}><a href="{url base='videos' strip='t' value='m'}">{t c='global.added'} {t c='global.this_month'}</a></li>
									<li class="divider"></li>				
									<li {if $order == 'bw'}class="active"{/if}><a href="{url base='videos' strip='o' value='bw'}">{t c='global.being_watched'}</a></li>						
									<li {if $order == 'mr'}class="active"{/if}><a href="{url base='videos' strip='o' value='mr'}">{t c='global.most_recent'}</a></li>
									<li {if $order == 'mv'}class="active"{/if}><a href="{url base='videos' strip='o' value='mv'}">{t c='global.most_viewed'}</a></li>
									<li {if $order == 'md'}class="active"{/if}><a href="{url base='videos' strip='o' value='md'}">{t c='global.most_commented'}</a></li>
									<li {if $order == 'tr'}class="active"{/if}><a href="{url base='videos' strip='o' value='tr'}">{t c='global.top_rated'}</a></li>							
									<li {if $order == 'tf'}class="active"{/if}><a href="{url base='videos' strip='o' value='tf'}">{t c='global.top_favorites'}</a></li>
									<li {if $order == 'lg'}class="active"{/if}><a href="{url base='videos' strip='o' value='lg'}">{t c='global.longest'}</a></li>
								</ul>
							</div>				
						</div>
					</div>
						
		<div class="clearfix"></div>
	</div>
	
	<div class="row row-boder">
		<div class="col-sm-12">
	        {if $viewed_videos}
			<div class="row">
	        {section name=i loop=$viewed_videos}
				
				<div class="col-sm-4 col-md-3 col-lg-3">
					<div class="well well-sm">
						<a href="{$relative}/video/{$viewed_videos[i].VID}/{$viewed_videos[i].title|clean}">
							<div class="thumb-overlay">
							<img src="{insert name=thumb_path vid=$viewed_videos[i].VID}/{$viewed_videos[i].thumb}.jpg" title="{$viewed_videos[i].title|escape:'html'}" alt="{$viewed_videos[i].title|escape:'html'}" id="rotate_{$viewed_videos[i].VID}_{$viewed_videos[i].thumbs}_{$viewed_videos[i].thumb}_recent" class="img-responsive {if $viewed_videos[i].type == 'private'}{/if}"/>
								{if $viewed_videos[i].type == 'public'}<div class="label-private">{t c='global.PRIVATE'}</div>{else}<div class="label-vip">&nbsp;</div>{/if}
								{if $viewed_videos[i].hd==1}<div class="hd-text-icon">HD</div>{/if}
								<div class="duration">
									{insert name=duration assign=duration duration=$viewed_videos[i].duration}
									{$duration}
								</div>
							</div>
							<span class="video-title title-truncate m-t-5">{$viewed_videos[i].title|escape:'html'}</span>
						</a>
						<div class="video-added">
							{insert name=time_range assign=addtime time=$viewed_videos[i].addtime}
							{$addtime}
						</div>
						<div class="video-views pull-left">
							<i class="fa fa-eye"></i>&nbsp;{$viewed_videos[i].viewnumber} 
						</div>
						<div class="video-rating pull-right {if $viewed_videos[i].rate == 0 && $viewed_videos[i].dislikes == 0}no-rating{/if}">
							<i class="fa fa-thumbs-up video-rating-heart {if $viewed_videos[i].rate == 0 && $viewed_videos[i].dislikes == 0}no-rating{/if}"></i> <b>{if $viewed_videos[i].rate == 0 && $viewed_videos[i].dislikes == 0}-{else}{$viewed_videos[i].rate}%{/if}</b>
						</div>	
						<div class="clearfix"></div>
						
					</div>				
				</div>
							
	        {/section}
			</div>
	        {else}
			<div class="well well-sm">
				<span class="text-danger">{t c='videos.no_videos_found'}.</span>
			</div>
	        {/if}			
		</div>
	</div>
	
<!--首页分页-->	
<div class="index-pages">
	{if $videos}
		{if $page_link}	
			<div style="text-align: center;">
				<ul class="pagination">{$page_link}</ul>
			</div>
		{/if}
	{/if}
	
				{if $videos}
					{if $page_link}			
						<div style="text-align: center;" class="visible-xs">
							<ul class="pagination pagination-lg">{$page_link}</ul>
						</div>
					{/if}
				{/if}
</div>
<!--首页分页-->	
	
</div>

{include file="footer.tpl"}

