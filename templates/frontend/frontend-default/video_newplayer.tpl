{if $video.embed_code != ''}
	<div class="video-embedded">
		{$video.embed_code}
	</div>
{else}
<script type="text/javascript" src="{$baseurl}/media/player/js/swfobject.js"></script>
<div id="play_videos">
	<div id="play_video" style="display:none;"><img src="/images/wating.gif"/></div>
	<div id="flash" class="video-container">
	{if $video.iphone == 1}
		<div id="mobile_player">
			<video controls poster="{insert name=thumb_path vid=$video.VID}/default.jpg" width="100%" height="100%"> <source type="video/mp4"></video>
		</div>
	{else}
		<center>
			<div class="text-danger">{t c='video.not_available'}</div>
		</center>
	{/if}
</div></div>
{if !$guest_limit}
<script type="text/javascript">
var token = '{$distributeds_token}';
var vid = '{$vid}';
var ads_view = parseInt('{$ads_view}');
</script>
{literal}
<script type="text/javascript" src="/media/new_player/player.js?t=10" charset="utf-8"></script>
<script type="text/javascript">
var flashvars={
{/literal}
	f:'', a:'', s:'0', c:'0', x:'', i:'', d:'{$player_ads.stop_ads}', u:'{$player_ads.stop_ads_uri}', {if $ads_view}l:'{$front_ads.src}',r:'{$front_ads.href}',
	t:'{$front_ads.time}',{/if} y:'',e:'3',v:'80',p:'1', h:'4', q:'',m:'',o:'',w:'',g:'',j:'',k:'30|60',wh:'',lv:'0',loaded:'loadedHandler'
{literal}
};
	var params={bgcolor:'#FFF',allowFullScreen:true,allowScriptAccess:'always',wmode:'transparent'};
	var video = [];
	CKobject.embed('/media/new_player/player.swf','flash','flash_player_id','100%','100%',false,flashvars,video,params);
	$(function(){
		var time = setTimeout(function(){
			loadAjax(0);
		},3000);
	});
	var isload = true;
	function loadAjax(index){
		var url = '';
		$.ajax({
			url:'/ajax/get_video_url',
			type:'post',
			data:{'token':token,'vid':vid,'index':index},
			cache:false,
			dataType:'json',
			async:true,
			error:function(){
				alert('网络请求错误!');
			},
			success:function(data){
				if(data._furl && !data.code && data._furl != ''){
					url = data._furl;
				}else{
					//window.location.reload();
				}
				if(isload && data.servers){
					var str = '';
					$(data.servers).each(function(i,j){
						str += '<li class="line btn span6 offset4 line_'+i+'"><a href="javascript:void(0);" onclick="loadAjax('+i+');">'+j.gname+'</a></li>';
					});
					$('.line_title').after(str);
					isload = false;
				}
				if( url != ''){
					loadVideo(url);
					$('.line_'+index).css({'background-color':'#1bbc9d'}).siblings('li').css({'background-color':'#424242'});
				}
			}
		});
	}
	function loadVideo(url){
		var flash_player_id = CKobject.getObjectById('flash_player_id');
		if(!flash_player_id) return;
		if(flash_player_id.getType && flash_player_id.getType()){
			flash_player_id.newAddress('{html5->'+url+'->video/mp4}{s->0}');
			flash_player_id.videoPlay();
		}else{
			if(flash_player_id.newAddress)
				flash_player_id.newAddress('{f->'+url+'}{s->0}');
		}
	}
	var ispay = true;
	var loadComplete_count = 0;
	function ckplayer_status(str){
		if(str === 'loadComplete'){
			//提示用户选择其他路线
			if(loadComplete_count > 200){
				$('.modal-body').html('亲爱的用户，当前线路不能很好的为您服务，请切换其它线路!');
				show_sebi();
				setTimeout(function(){
		        	$('#mysebi').fadeOut();
		        	$('.modal-backdrop').fadeOut();
		        },10000);
		        loadComplete_count = 0;
			}
			loadComplete_count ++;
		}
		if(str == 'loadedmetadata'){
			$('#play_video').attr('status',str).hide(1000);
		}else{
			if(!ads_view)
				loadMsg();
		}
		if(str.indexOf('totaltime:')>0){
			return false;
		}
		if(str.indexOf('time:') >= 0){
			if(!ispay)return false;
			var time_arr = str.split(':');
			if( time_arr[1] > 30 ){
				ispay = false;
				$.ajax({
					url:'/ajax/pay_sebi',
					type:'post',
					data:{'vid':vid},
					cache:false,
					dataType:'json',
					async:false,
					error:function(){},
					success:function(data){
						if(data && data.num && data.sebi_surplus){
							if($('.rv').length > 0){
								$('.rv').html('还剩余'+(data.sebi_surplus - data.num)+'个色币');
							}
							if($('.sebi_surplus').length > 0){
								$('.sebi_surplus').html('还剩余'+(data.sebi_surplus - data.num)+'个体验币');
							}
						}
					}
				});
			}
		}
	}
	function loadMsg(){
		var pv_status = $('#play_video').attr('status');
		if(!pv_status){
			var flash_width = $('#flash').width();
			var flash_height = $('#flash').height();
			var pv_width = flash_width.toString().indexOf('%') > -1 ? flash_width : flash_width+'px';
			var pv_height = flash_height.toString().indexOf('%') > -1 ? flash_height : flash_height+'px';
			$('#play_video').attr('style','width:'+pv_width+';height:'+pv_height+';margin: 0px auto; position: absolute; text-align: center;z-index:999; background-color: #151515;line-height:'+pv_height).show();
		}
	}
	function createAdsDiv(){
		var div = $('<div />');
		div.css({'position':'absolute','width':'100%','height':'100%','display':'inline-table','text-align':'center','z-index':'9999'});
		return div;
	}
	function createAdsImg(src){
		var img = $('<img />');
		img.css('width','70%').attr('src',src);
		return img;
	}
	function createAdsA(src){
		var a = $('<a />');
		a.attr({'href':src,'target':'_blank'}).css('display','block');
		return a;
	}
	var clearTime;
	function intAds(index){
		var f = flashvars;
		if(f.l =='' || f.r == '' || f.t == ''){
			loadMsg();
			return;
		}
		var l_arr = f.l.split('|');
		var r_arr = f.r.split('|');
		var t_arr = f.t.split('|');
		if(l_arr.length !== t_arr.length){
			loadMsg();
			return;
		}
		var bdiv = bdiv || createAdsDiv();
		var tdiv = tdiv || $('<div />');
		tdiv.html('广告剩余：<font style="color:red;">'+t_arr[index]+'</font>秒');
		var a = a || createAdsA(r_arr[index]);
		var img = img || createAdsImg(l_arr[index]);
		a.append(img);
		bdiv.append(tdiv).append(a);
		bdiv.insertBefore($('#flash_player_id'));
		var t_arr_len = t_arr.length;
		var total_t = 0;
		for(var i = 0;i < t_arr_len;i++){
			total_t += parseInt(t_arr[i]);
		}
		var ctime = 0;
		var stime = t_arr[index];
		clearTime = setInterval(function(){
			if(ctime > t_arr[index]){
				clearInterval(clearTime);
				if(bdiv){
					bdiv.remove();
				}
				index++;
				if(index < t_arr.length){
					ctime = 0;
					stime = t_arr[index];
					tdiv.html('');
					a.attr('href','');
					img.attr('src','');
					intAds(index);
				}
			}else{
				tdiv.html('广告剩余：<font style="color:red;">'+(stime--)+'</font>秒');
				ctime++;
			}
		},1000);
	}

	function pauseAds(){
		var f = flashvars;
		if(f.d == '')
			return;
		var bdiv = bdiv || createAdsDiv();
		var idiv = idiv || $('<div />');
		idiv.css({'width':'70%','margin':'0 auto','padding-top':'3%'});
		bdiv.append(idiv);

		var tdiv = tdiv || $('<div />');
		tdiv.css({'width':'70%','text-align':'right','position':'absolute'});
		idiv.append(tdiv);

		var cimg = $('<img />');
		cimg.css({'width':'9%'});
		cimg.attr('src','/templates/frontend/frontend-default/img/X.png');
		cimg.click(function(){
			if(bdiv)
				bdiv.remove();
			clickHandler();
		});
		tdiv.append(cimg);

		var a = a || createAdsA(f.u);
		var img = img || $('<img />');
		img.attr('src',f.d).css({'width':'100%'});
		a.append(img);
		idiv.append(a);
		bdiv.insertBefore($('#flash_player_id'));
	}
	function loadedHandler(){
		var ck = CKobject.getObjectById('flash_player_id');
		if(ck.getType()){
			intAds(0);
			if(!ads_view)
				loadMsg();
			ck.addListener('pause',pausekHandler);
		}
	}
	function pausekHandler(){
		var ck = CKobject.getObjectById('flash_player_id');
		if(!ck.seeking()){
			pauseAds();
		}
	}
	function clickHandler(){
		var ck = CKobject.getObjectById('flash_player_id');
		if(!ck.getStatus().play){
			ck.videoPlay();
		}else{
			ck.videoPause();
		}
	}
</script>
{/literal}
{/if}
{/if}