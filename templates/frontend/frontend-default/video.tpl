{include file="header.tpl"}
{include file="errors.tpl"}
{include file="messages.tpl"}
<script type="text/javascript">
var lang_favoriting = "{t c='global.favoriting'}";
var lang_posting = "{t c='global.posting'}";
var video_width = "{$video_width}";
var video_height = "{$video_height}";
var evideo_id = "{$video.VID}";
{literal}
$( document ).ready(function() {

    var vdiv = $('.video-container');
	var width = vdiv.width();
	height =  Math.round(width / (video_width / video_height));
	vdiv.css("height" , height);

var evdiv = $('.video-embedded');
var ewidth = evdiv.width();
eheight =  Math.round(ewidth / 1.777);
evdiv.css("height" , eheight);

	$(window).resize(function() {
	var vwidth = $('.video-container').width();
	vheight =  Math.round(vwidth / (video_width / video_height));
	$('.video-container').css("height" , vheight);
	$('#video-body').css("height" , vheight);

	var evwidth = $('.video-embedded').width();
	evheight =  Math.round(evwidth / 1.777);
	$('.video-embedded').css("height" , evheight);

	});

	$(window).load(function() {

		var checker = setInterval(function(){
			if ( $('.at15t_compact').length > 0) {
				clearInterval(checker);
			}
            jQuery.each($("span[class*='at15t_']"), function() {

                var this_class    = $(this).attr('class');
				var class_split    = this_class.split('_');
				var item_name    = class_split[1];
				$(this).removeClass();
				$(this).addClass("at4-icon aticon-" + item_name);

			});
		}, 100);
	});

});
{/literal}
</script>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery.voting-video-0.1.js"></script>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery.video-0.2.js"></script>
<div class="container">
	{if $is_friend}
		<div class="row">
			<div class="col-md-8">
			{if !$guest_limit}
			<div id="player_line" class="col-md-12 choose_line">
				<div class="line_title">线路选择：</div>
				 {if $type_of_user != 'premium'}<li class="hidden-xs line btn span6 offset4"><a target="_blank" href="/hdong/vip">体验高速VIP线路请加入VIP</a></li><li class="visible-xs line btn span6 offset4"><a href="javascript:alert('请加入VIP体验');">高速VIP线路</a></li>{/if}
			</div>
			{/if}
				<div id="video-body" style=" clear: both;  overflow: hidden;background: #000; position:relative ">

 <script type="text/javascript">
 {literal}
 function show_sebi(){
 	     $('#mysebi').modal({
        	show:true,
       	 	backdrop:false,
       	 	keyboard:false
        });
        var h = ($('#mysebi').height()-$('.modal-dialog').height())/4;
 		$('.modal-dialog').css({'top':h});
 }

 {/literal}
 </script>
<!-- Modal -->
<div class="modal fade" id="mysebi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="position: absolute;">
  <div class="modal-dialog modal-sm">
    <div class="modal-content" style="background:url('/templates/frontend/frontend-default/img/s1.png') no-repeat!important;">
      <div class="modal-header" style="border-bottom:none;background:none;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="background: url('/templates/frontend/frontend-default/img/s4.png') 3px 15px no-repeat!important;padding: 10px;width: 10px;color: #fff;vertical-align: middle;"></span><span class="sr-only">关闭</span></button>
        <h4 class="modal-title" id="myModalLabel" <h4 class="modal-title" id="myModalLabel" style="color: white;padding-left: 35px;margin-top: -3px;font-size: 18px;
">温馨提示</h4>
      </div>
      <div class="modal-body" style="border-bottom:none;background:none;color: #000;font-size: 16px;padding-left: 40px;padding-right: 40px;">
        {$vmsg}
      </div>
      <div class="modal-footer" style="text-align:center;padding-top:5px;img max-width:60%">
        {if $type_of_user != 'premium'}
			<a href="/hdong/vip/" style="margin-right:10px;">
				<img src="/templates/frontend/frontend-default/img/s2.png" style="width:100px">
			</a>
			<a href="/qhd/songsb/pc/" id="sebMessage">
				<img src="/templates/frontend/frontend-default/sebMessage/images/sebi.png" style="width:100px">
			</a>
			<a href="/spread" style="margin-left:10px;" class="hidden-xs">
				<img src="/templates/frontend/frontend-default/img/s3.png" style="width:100px">
			</a>
		{/if}
      </div>
    </div>
  </div>
</div>
{if $guest_limit}
 <script type="text/javascript">
 {literal}
   $(function(){
       if(ismobile()){
			$("#sebMessage").attr('href','/qhd/songsb/h5/')
	   }
	   show_sebi();
    });
 {/literal}
 </script>
{/if}
{include file='video_newplayer.tpl'}

				</div>

			<div class="col-md-12 video_player_tools" style="margin-bottom:10px;">

			<!--title-->
			<div class="row nopadding">
				{if $guest_limit}
					<!--<div class="col-xs-12">
						<div class="text-danger">{t c='video.limit'}</div>
					</div>-->
				{elseif !$is_friend}
					<div class="col-xs-12">
						<div class="well well-sm">
							<div class="text-danger">{t c='video.private' r=$relative s=$video.username sn=$video.username}</div>
						</div>
					</div>
				{else}
					<div class="col-md-12">
							<h3 class="hidden-xs big-title-truncate m-t-0">{$video.title|escape:'html'}</h3>
							<h4 class="visible-xs big-title-truncate m-t-0">{$video.title|escape:'html'}</h4>
					</div>
				{/if}
			</div>
			<!--title-->
			<div class="pages-view">
			{insert name=time_range assign=addtime time=$video.addtime}
			<div class="pull-left big-views hidden-xs">
				<span class="text-black">{$addtime}</span>,
				<span class="text-black"><i class="fa fa-eye green"></i> {$video.viewnumber}</span>
			</div>
			<div class="pull-left big-views-xs visible-xs">
				<span class="text-black">{$addtime}</span>,
				<span class="text-black"><i class="fa fa-eye green"></i> {$video.viewnumber}</span>
			</div>
			</div>

				<div class="vote-box col-xs-7 col-sm-2 col-md-2">
					<div class="dislikes {if $video.likes == 0 and $video.dislikes == 0}not-voted{/if}">
						<div id="video_rate" class="likes" style="width: {$video.rate}%;"></div>
					</div>
					<div id="vote_msg" class="vote-msg">
						<div class="pull-left">
							<i class="glyphicon glyphicon-thumbs-up"></i> <span id="video_likes" class="text-black">{$video.likes}</span>
						</div>
						<div class="pull-right">
							<i class="glyphicon glyphicon-thumbs-down"></i> <span id="video_dislikes" class="text-black">{$video.dislikes}</span>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="pull-right visible-xs">
					<div class="pull-left m-t-15">
						<a href="#" class="btn btn-primary" id="vote_like_{$video.VID}" ><i class="glyphicon glyphicon-thumbs-up"></i></a>
						<a href="#" class="btn btn-primary" id="vote_dislike_{$video.VID}"><i class="glyphicon glyphicon-thumbs-down"></i></a>
					</div>
				</div>
				<div class="clearfix visible-xs"></div>
				<div class="pull-left m-l-5 hidden-xs">
					<div class="pull-left m-t-15">
						<a href="#" class="btn btn-primary" id="vote_like_{$video.VID}" ><i class="glyphicon glyphicon-thumbs-up"></i></a>
						<a href="#" class="btn btn-primary" id="vote_dislike_{$video.VID}"><i class="glyphicon glyphicon-thumbs-down"></i></a>
					</div>
				</div>
				<div class="pull-right m-t-15">
					<div class="ps_131"></div>
					<!--<div id="share_video" class="pull-right"><a href="#share_video" class="btn btn-default"><i class="glyphicon glyphicon-share-alt"></i> <span class="hidden-xs font-song-12 blod">{t c='global.share'}</span></a></div>-->
					{if isset($smarty.session.uid)}
						<!--<div id="flag_video" class="pull-right m-r-5"><a href="#flag_video" class="btn btn-default"><i class="glyphicon glyphicon-flag"></i> <span class="hidden-xs font-song-12 blod">{t c='global.flag'}</span></a></div>-->
						<div id="favorite_video" class="pull-right m-r-5"><a href="#favorite_video" class="btn btn-default" id="favorite_video_{$video.VID}"><i class="glyphicon glyphicon-heart"></i> <span class="hidden-xs blod font-song-12">{t c='global.favorite'}</span></a></div>
					{/if}
						{if $video_embed == '1' && $video.embed_code != '' && $is_friend}
						<div id="embed_video" class="pull-right m-r-5"><a href="#embed_video" class="btn btn-default"><i class="glyphicon glyphicon-link"></i> <span class="hidden-xs font-song-12 blod">{t c='global.embed'}</span></a></div>
						{/if}
					<div class="clearfix"></div>
				</div>


				{if $downloads == '1' && $video.embed_code == '' && $is_friend}
					<div class="pull-right m-t-15 m-r-5">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-download-alt"></i><span class="hidden-xs hidden-sm hidden-sm hidden-md hidden-lg font-song-12 blod"> {t c='global.download'}</span> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="{$baseurl}/download.php?id={$video.VID}">SD (FLV)</a></li>
								{if $hd == '1'}<li><a href="{$baseurl}/download_hd.php?id={$video.VID}">HD (MP4)</a></li>{/if}
								{if $video.iphone == '1'}<li><a href="{$baseurl}/download_mobile.php?id={$video.VID}">Mobile (MP4)</a></li>{/if}
							</ul>
						</div>
					</div>
				{/if}
				<div class="clearfix"></div>
				<div id="response_message" style="display: none;"></div>
				{if $video_embed == '1' && $video.embed_code == '' && $is_friend}
				<div id="embed_video_box" class="m-t-15" style="display: none;">
					<a href="#close_embed" id="close_embed" class="close">&times;</a>
					<div class="separator">{t c='video.EMBED'}</div>
					<div class="form-horizontal">
						<div class="form-group">
							<label for="video_embed_code" class="col-lg-3 control-label">{t c='video.embed_code'}</label>
							<div class="col-lg-9">
								{include file='video_embed_vplayer.tpl'}
							</div>
						</div>
						<div id="custom_size" class="form-group">
							<label for="custom_width" class="col-lg-3 control-label">{t c='video.embed_custom_size'}</label>
							<div class="col-lg-9">
								<div class="pull-left">
									<input id="custom_width" type="text" class="form-control" value="" placeholder="{t c='video.width'}" style="width: 100px!important;"/>
								</div>
								<div class="pull-left m-l-5 m-r-5" style="line-height: 38px;">
									&times;
								</div>
								<div class="pull-left m-r-15">
									<input id="custom_height" type="text" class="form-control" value="" placeholder="{t c='video.height'}" style="width: 100px!important;"/>
								</div>
								<div class="pull-left" style="line-height: 38px;">
									{t c='video.embed_custom_size_min'}
								</div>
							</div>
						</div>
					</div>
				</div>
				{/if}
				{if isset($smarty.session.uid)}
					<div id="flag_video_box" class="m-t-15" style="display: none;">
						<a href="#close_flag" id="close_flag" class="close">&times;</a>
						<div class="separator">{t c='video.flag'}</div>
						<div id="flag_video_response" style="display: none;"></div>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-lg-3 control-label">{t c='video.flag'}</label>
								<div class="col-lg-9">
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="inappropriate" checked="yes" />
											{t c='flag.inappr'}
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="underage" />
											{t c='flag.underage'}
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="copyrighted" />
											{t c='flag.copyright'}
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="not_playing" />
											{t c='flag.not_playing'}
										</label>
									</div>
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="other" />
											{t c='flag.other'}
										</label>
									</div>
									<div id="flag_reason_error" class="text-danger m-t-5" style="display: none;"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="flag_message" class="col-lg-3 control-label">{t c='flag.reason'}</label>
								<div class="col-lg-9">
									<textarea name="flag_message" class="form-control" rows="3" id="flag_message"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<input name="submit_flag" type="button" value=" {t c='video.flag'} " id="submit_flag_video_{$video.VID}" class="btn btn-primary" />
								</div>
							</div>
						</div>
					</div>
				{/if}
				<div id="share_video_box" class="m-t-15" style="display: none;">
					<a href="#close_share" id="close_share" class="close">&times;</a>
					<div class="separator">{t c='video.SHARE'}</div>
					<div id="share_video_response" style="display: none;"></div>
					<div id="share_video_form">
						<form class="form-horizontal" name="share_video_form" method="post" action="#share_video">
							<div class="form-group">
								<label for="share_from" class="col-lg-3 control-label">{t c='global.from'}</label>
								<div class="col-lg-9">
									<input name="from" type="text" class="form-control" value="{if isset($smarty.session.uid)}{if $smarty.session.fname != ''}{$smarty.session.fname}{else}{$smarty.session.username}{/if}{/if}" id="share_from" placeholder="{t c='global.from'}" />
									<div id="share_from_error" class="text-danger m-t-5" style="display: none;"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="share_to" class="col-lg-3 control-label">{t c='global.To'}</label>
								<div class="col-lg-9">
									<textarea name="to" class="form-control" rows="3" id="share_to" placeholder="{t c='global.share_expl' s=$site_name}"></textarea>
									<div id="share_to_error" class="text-danger m-t-5" style="color: red; display: none;"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="share_message" class="col-lg-3 control-label">{t c='global.message_opt'}</label>
								<div class="col-lg-9">
									<textarea name="message" class="form-control" rows="3" id="share_message" placeholder="{t c='global.message_opt'}" ></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									 <input name="submit_share" type="button" value=" {t c='video.share'} " id="send_share_video_{$video.VID}" class="btn btn-primary" />
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="separator m-t-15 p-0"></div>
				<div class="tools-left">
				<div class="pull-left user-container">
					发布者：<a href="{$relative}/user/{$video.username}"><img class="medium-avatar" src="{$relative}/media/users/{if $video.photo == ''}nopic-{$video.gender}.gif{else}{$video.photo}{/if}" /><span>{$video.username}</span></a>
				</div>

				<div class="clearfix"></div>
				<div class="m-t-10 font-song-12 overflow-hidden">
				{$video.description}
				</div>
				<div class="m-t-10 font-song-12 overflow-hidden">
					{assign var='keywords' value=$video.keyword}
					<i class="fa fa-tags"></i>{t c='global.tags'}:
					{section name=i loop=$keywords}
						<a class="tag font-song-12" href="{$relative}/search?search_type=videos&search_query={$keywords[i]}">{$keywords[i]}</a>{if !$smarty.section.i.last},{/if}
					{/section}
				</div>
				</div>
				<div class="m-t-10 m-b-15 tools-right">
					<!-- Go to www.addthis.com/dashboard to customize your tools -->
					<div class="addthis_sharing_toolbox"></div>
					<!-- Go to www.addthis.com/dashboard to customize your tools -->
					<!--<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=avsbookmark"></script>-->
				</div>
				<div style="clear:both;"></div>
				</div>
				<div class="col-md-12 video_player_tools" style="margin-bottom:10px;padding: 15px;color: #000;">
  <div>视频推广链接(您登陆账户后（只有在登陆后链接才有效），可以把此接发到其他论坛或部落格。当有人访问该地址时，就可以赚取色币！)</div>
  <div style="line-height:30px;margin-top"10px;"><font style="color:red;">视频推广链接：</font><input id="textfield3" type="text" style="width:502px;text-align:center;" readonly="readonly" value="分享一个我收藏很久了的看片神器！你懂的！ {$remotehost}/tuiguang.php?fromuid={$smarty.session.uid}"> <input type="button" onclick="$('#textfield3').select();CopyUrl($('#textfield3').val());"  value="复制地址">  <font style="color:red;">注册成功后，推广连接生效，告诉身边朋友，马上获得色币，免费观看视频</font></div>
</div>
				<div class="ps-pc hidden-xs">
					<div class="ps_79"></div>
					<div class="ps_81"></div>
					<div class="ps_83"></div>
					<div style="clear:both;"></div>
				</div>

			</div>
			<div class="col-md-4 unvisible hidden-xs">
				<div class="ps-body">
					<div class="ps-pc">
					<div class="ps_46"></div>
					</div>
				</div>
				<div class="ps-body">
					<div class="ps-pc">
					<div class="ps_47"></div>
					</div>
				</div>
				<div class="ps-body">
					<div class="ps-pc">
					<div class="ps_48"></div>
					</div>
				</div>
				<div class="ps-body">
					<div class="ps-pc">
					<div class="ps_109"></div>
					</div>
				</div>
			</div>
			<div class="ps_95 visible-xs" style="width: auto;margin-bottom: 10px;text-align:center;"></div>
		</div>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#related_videos" data-toggle="tab">{t c='video.RELATED'}{if $videos_total > 0} <div class="badge">{$videos_total}</div>{/if}</a></li>
			<li class=""><a href="#comments" data-toggle="tab">{t c='global.COMMENTS'}{if $comments_total > 0} <div class="badge" id="total_video_comments">{$comments_total}</div>{/if}</a></li>
		</ul>
		<div class="tab-content m-b-20">
			<div class="tab-pane fade active in" id="related_videos">
			 {if $videos}
		        <input name="current_page_related_videos" type="hidden" value="1" id="current_page_related_videos" />
				<div class="row row-boder">
				{section name=i loop=$videos}
					<div class="col-sm-6 col-md-3 col-lg-3">
						<div class="well well-sm m-b-0 m-t-20">
							<a href="{$relative}/video/{$videos[i].VID}/{$videos[i].title|clean}">
								<div class="thumb-overlay">
									<img src="{insert name=thumb_path vid=$videos[i].VID}/{$videos[i].thumb}.jpg" title="{$videos[i].title|escape:'html'}" alt="{$videos[i].title|escape:'html'}" id="rotate_{$videos[i].VID}_{$videos[i].thumbs}_{$videos[i].thumb}" class="img-responsive {if $videos[i].type == 'private'}img-private{/if}"/>
									{if $videos[i].type == 'public'}<div class="label-private">{t c='global.PRIVATE'}</div>{else}<div class="label-vip">&nbsp;</div>{/if}
									{if $videos[i].hd==1}<div class="hd-text-icon">HD</div>{/if}
									<div class="duration">
										{insert name=duration assign=duration duration=$videos[i].duration}
										{$duration}
									</div>
								</div>
								<span class="video-title title-truncate m-t-5">{$videos[i].title|escape:'html'}</span>
							</a>
							<div class="video-added">
								{insert name=time_range assign=addtime time=$videos[i].addtime}
								{$addtime}
							</div>
							<div class="video-views pull-left">
							<i class="fa fa-eye"></i>&nbsp;{$videos[i].viewnumber}
							</div>
							<div class="video-rating pull-right {if $videos[i].rate == 0 && $videos[i].dislikes == 0}no-rating{/if}">
								<i class="fa fa-thumbs-up video-rating-heart {if $videos[i].rate == 0 && $videos[i].dislikes == 0}no-rating{/if}"></i> <b>{if $videos[i].rate == 0 && $videos[i].dislikes == 0}-{else}{$videos[i].rate}%{/if}</b>
							</div>
							<div class="clearfix"></div>

						</div>
					</div>
				{/section}
				</div>
				<div id="related_videos_container_1"></div>

				{if $videos_total > 8}
					<center>
						<div class="center_related" style="display: none;  margin: -6px 0 -26px 0;"><img src="{$relative_tpl}/img/loading-bubbles.svg"></div>
						<ul class="pager">
						  <li><a href="#prev_related_videos" id="prev_related_videos_{$video.VID}" style="display: none;">{t c='global.hide'}</a></li>
						  <li><a href="#next_related_videos" id="next_related_videos_{$video.VID}" >{t c='global.show_more'}</a></li>
						</ul>
					</center>
				{/if}

			{else}
			<div class="row row-boder well-sm m-b-0">
				<span class="text-danger">{t c='videos.no_videos_found'}.</span>
			</div>
			{/if}

			</div>

			<div class="tab-pane fade" id="comments">
			<div class="row row-boder pd-lr20">
				<div class="m-b-20"></div>
				{if isset($smarty.session.uid) && $video_comments == '1'}
					<div id="post_comment">
						<form class="form-horizontal"name="postVideoComment" id="postVideoComment" method="post" action="#">
							<div class="form-group">
								<div class="col-xs-12 col-sm-10 col-sm-offset-1">
									<textarea name="video_comment" id="video_comment" rows="5" class="form-control" placeholder="{t c='global.add_comment'}">{$comment}</textarea>
									<div id="post_message" class="text-danger m-t-5" style="display: none;">{t c='global.comment_empty'}!</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12 col-sm-10 col-sm-offset-1">
									<div class="pull-left">
										<input name="submit_comment" type="button" value=" {t c='global.post'} " id="post_video_comment_{$video.VID}" class="btn btn-primary" />
									</div>
									<div class="pull-right">
										<span id="chars_left">1000</span> {t c='global.chars_left'}
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</form>
					</div>
				{/if}

				<div id="video_comments_{$video.VID}">
					{if $comments}
						{t c='global.showing'} <span class="text-black">{$start_num}</span> {t c='global.to'} <span id="end_num" class="text-black">{$end_num}</span> {t c='global.of'} <span id="total_comments" class="text-black">{$comments_total}</span> {t c='global.comments'}.
					{/if}
					<div id="video_response" style="display: none;"></div>
					<div id="comments_delimiter" style="display: none;"></div>

					{if $comments}
						{section name=i loop=$comments}

							<div id="video_comment_{$video.VID}_{$comments[i].CID}" class="col-xs-12 m-t-15">
								<div class="row">
									<div class="pull-left">
										<a href="{$relative}/user/{$comments[i].username}">
											<img src="{$relative}/media/users/{if $comments[i].photo != ''}{$comments[i].photo}{else}nopic-{$comments[i].gender}.gif{/if}" title="{$comments[i].username}'s avatar" alt="{$comments[i].username}'s avatar" class="img-responsive comment-avatar" />
										</a>
									</div>
									<div class="comment">
										<div class="comment-info">
											{insert name=time_range assign=addtime time=$comments[i].addtime}
											<a href="{$relative}/user/{$comments[i].username}">{$comments[i].username}</a>&nbsp;-&nbsp;<span class="">{$addtime}</span>
										</div>
										<div class="comment-body overflow-hidden">{$comments[i].comment|nl2br}</div>
										{if isset($smarty.session.uid)}
											<div class="comment-actions">
												{if $smarty.session.uid == $comments[i].UID}
													<a href="#delete_comment" id="delete_comment_video_{$comments[i].CID}_{$video.VID}">{t c='global.delete'}</a> <span id="delete_response_{$comments[i].CID}" style="display: none;"></span>
												{else}
													<span id="reported_spam_{$comments[i].CID}_{$video.VID}"><a href="#report_spam" id="report_spam_video_{$comments[i].CID}_{$video.VID}">{t c='global.report_spam'}</a></span>
												{/if}
											</div>
										{/if}
									</div>
									<div class="clearfix"></div>
								</div>

							</div>

						{/section}

						{if $page_link_comments}
							<div class="visible-xs center m-b--15">
								<ul class="pagination pagination-lg">{$page_link_comments}</ul>
							</div>
							<div class="hidden-xs center m-b--15">
								<ul class="pagination">{$page_link_comments}</ul>
							</div>
						{/if}
					{elseif !isset($smarty.session.uid)}
						<div class="row row-boder well-sm m-b-0">
							<span class="text-danger">{t c='global.comments.none'}.</span>
						</div>
					{/if}
				</div>
				<div class="clearfix"></div>
			</div>
			</div>
		</div>
	{/if}

	<div class="ps-body">
		<p class="ad-title">{t c='global.sponsors'}</p>
		{insert name=adv assign=adv group='video_bottom'}
		{if $adv}{$adv}{/if}
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
{include file="footer.tpl"}