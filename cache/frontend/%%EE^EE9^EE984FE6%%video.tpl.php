<?php /* Smarty version 2.6.20, created on 2018-04-13 18:41:37
         compiled from video.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 't', 'video.tpl', 5, false),array('modifier', 'escape', 'video.tpl', 144, false),array('modifier', 'clean', 'video.tpl', 412, false),array('modifier', 'nl2br', 'video.tpl', 509, false),array('insert', 'time_range', 'video.tpl', 151, false),array('insert', 'thumb_path', 'video.tpl', 414, false),array('insert', 'duration', 'video.tpl', 418, false),array('insert', 'adv', 'video.tpl', 549, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "messages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
var lang_favoriting = "<?php echo smarty_function_t(array('c' => 'global.favoriting'), $this);?>
";
var lang_posting = "<?php echo smarty_function_t(array('c' => 'global.posting'), $this);?>
";
var video_width = "<?php echo $this->_tpl_vars['video_width']; ?>
";
var video_height = "<?php echo $this->_tpl_vars['video_height']; ?>
";
var evideo_id = "<?php echo $this->_tpl_vars['video']['VID']; ?>
";
<?php echo '
$( document ).ready(function() {

    var vdiv = $(\'.video-container\');
	var width = vdiv.width();
	height =  Math.round(width / (video_width / video_height));
	vdiv.css("height" , height);

var evdiv = $(\'.video-embedded\');
var ewidth = evdiv.width();
eheight =  Math.round(ewidth / 1.777);
evdiv.css("height" , eheight);

	$(window).resize(function() {
	var vwidth = $(\'.video-container\').width();
	vheight =  Math.round(vwidth / (video_width / video_height));
	$(\'.video-container\').css("height" , vheight);
	$(\'#video-body\').css("height" , vheight);

	var evwidth = $(\'.video-embedded\').width();
	evheight =  Math.round(evwidth / 1.777);
	$(\'.video-embedded\').css("height" , evheight);

	});

	$(window).load(function() {

		var checker = setInterval(function(){
			if ( $(\'.at15t_compact\').length > 0) {
				clearInterval(checker);
			}
            jQuery.each($("span[class*=\'at15t_\']"), function() {

                var this_class    = $(this).attr(\'class\');
				var class_split    = this_class.split(\'_\');
				var item_name    = class_split[1];
				$(this).removeClass();
				$(this).addClass("at4-icon aticon-" + item_name);

			});
		}, 100);
	});

});
'; ?>

</script>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery.voting-video-0.1.js"></script>
<script type="text/javascript" src="/templates/frontend/frontend-default/js/jquery.video-0.2.js"></script>
<div class="container">
	<?php if ($this->_tpl_vars['is_friend']): ?>
		<div class="row">
			<div class="col-md-8">
			<?php if (! $this->_tpl_vars['guest_limit']): ?>
			<div id="player_line" class="col-md-12 choose_line">
				<div class="line_title">线路选择：</div>
				 <?php if ($this->_tpl_vars['type_of_user'] != 'premium'): ?><li class="hidden-xs line btn span6 offset4"><a target="_blank" href="/hdong/vip">体验高速VIP线路请加入VIP</a></li><li class="visible-xs line btn span6 offset4"><a href="javascript:alert('请加入VIP体验');">高速VIP线路</a></li><?php endif; ?>
			</div>
			<?php endif; ?>
				<div id="video-body" style=" clear: both;  overflow: hidden;background: #000; position:relative ">

 <script type="text/javascript">
 <?php echo '
 function show_sebi(){
 	     $(\'#mysebi\').modal({
        	show:true,
       	 	backdrop:false,
       	 	keyboard:false
        });
        var h = ($(\'#mysebi\').height()-$(\'.modal-dialog\').height())/4;
 		$(\'.modal-dialog\').css({\'top\':h});
 }

 '; ?>

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
        <?php echo $this->_tpl_vars['vmsg']; ?>

      </div>
      <div class="modal-footer" style="text-align:center;padding-top:5px;img max-width:60%">
        <?php if ($this->_tpl_vars['type_of_user'] != 'premium'): ?>
			<a href="/hdong/vip/" style="margin-right:10px;">
				<img src="/templates/frontend/frontend-default/img/s2.png" style="width:100px">
			</a>
			<a href="/qhd/songsb/pc/" id="sebMessage">
				<img src="/templates/frontend/frontend-default/sebMessage/images/sebi.png" style="width:100px">
			</a>
			<a href="/spread" style="margin-left:10px;" class="hidden-xs">
				<img src="/templates/frontend/frontend-default/img/s3.png" style="width:100px">
			</a>
		<?php endif; ?>
      </div>
    </div>
  </div>
</div>
<?php if ($this->_tpl_vars['guest_limit']): ?>
 <script type="text/javascript">
 <?php echo '
   $(function(){
       if(ismobile()){
			$("#sebMessage").attr(\'href\',\'/qhd/songsb/h5/\')
	   }
	   show_sebi();
    });
 '; ?>

 </script>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'video_newplayer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

				</div>

			<div class="col-md-12 video_player_tools" style="margin-bottom:10px;">

			<!--title-->
			<div class="row nopadding">
				<?php if ($this->_tpl_vars['guest_limit']): ?>
					<!--<div class="col-xs-12">
						<div class="text-danger"><?php echo smarty_function_t(array('c' => 'video.limit'), $this);?>
</div>
					</div>-->
				<?php elseif (! $this->_tpl_vars['is_friend']): ?>
					<div class="col-xs-12">
						<div class="well well-sm">
							<div class="text-danger"><?php echo smarty_function_t(array('c' => 'video.private','r' => $this->_tpl_vars['relative'],'s' => $this->_tpl_vars['video']['username'],'sn' => $this->_tpl_vars['video']['username']), $this);?>
</div>
						</div>
					</div>
				<?php else: ?>
					<div class="col-md-12">
							<h3 class="hidden-xs big-title-truncate m-t-0"><?php echo ((is_array($_tmp=$this->_tpl_vars['video']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</h3>
							<h4 class="visible-xs big-title-truncate m-t-0"><?php echo ((is_array($_tmp=$this->_tpl_vars['video']['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</h4>
					</div>
				<?php endif; ?>
			</div>
			<!--title-->
			<div class="pages-view">
			<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'time_range', 'assign' => 'addtime', 'time' => $this->_tpl_vars['video']['addtime'])), $this); ?>

			<div class="pull-left big-views hidden-xs">
				<span class="text-black"><?php echo $this->_tpl_vars['addtime']; ?>
</span>,
				<span class="text-black"><i class="fa fa-eye green"></i> <?php echo $this->_tpl_vars['video']['viewnumber']; ?>
</span>
			</div>
			<div class="pull-left big-views-xs visible-xs">
				<span class="text-black"><?php echo $this->_tpl_vars['addtime']; ?>
</span>,
				<span class="text-black"><i class="fa fa-eye green"></i> <?php echo $this->_tpl_vars['video']['viewnumber']; ?>
</span>
			</div>
			</div>

				<div class="vote-box col-xs-7 col-sm-2 col-md-2">
					<div class="dislikes <?php if ($this->_tpl_vars['video']['likes'] == 0 && $this->_tpl_vars['video']['dislikes'] == 0): ?>not-voted<?php endif; ?>">
						<div id="video_rate" class="likes" style="width: <?php echo $this->_tpl_vars['video']['rate']; ?>
%;"></div>
					</div>
					<div id="vote_msg" class="vote-msg">
						<div class="pull-left">
							<i class="glyphicon glyphicon-thumbs-up"></i> <span id="video_likes" class="text-black"><?php echo $this->_tpl_vars['video']['likes']; ?>
</span>
						</div>
						<div class="pull-right">
							<i class="glyphicon glyphicon-thumbs-down"></i> <span id="video_dislikes" class="text-black"><?php echo $this->_tpl_vars['video']['dislikes']; ?>
</span>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="pull-right visible-xs">
					<div class="pull-left m-t-15">
						<a href="#" class="btn btn-primary" id="vote_like_<?php echo $this->_tpl_vars['video']['VID']; ?>
" ><i class="glyphicon glyphicon-thumbs-up"></i></a>
						<a href="#" class="btn btn-primary" id="vote_dislike_<?php echo $this->_tpl_vars['video']['VID']; ?>
"><i class="glyphicon glyphicon-thumbs-down"></i></a>
					</div>
				</div>
				<div class="clearfix visible-xs"></div>
				<div class="pull-left m-l-5 hidden-xs">
					<div class="pull-left m-t-15">
						<a href="#" class="btn btn-primary" id="vote_like_<?php echo $this->_tpl_vars['video']['VID']; ?>
" ><i class="glyphicon glyphicon-thumbs-up"></i></a>
						<a href="#" class="btn btn-primary" id="vote_dislike_<?php echo $this->_tpl_vars['video']['VID']; ?>
"><i class="glyphicon glyphicon-thumbs-down"></i></a>
					</div>
				</div>
				<div class="pull-right m-t-15">
					<div class="ps_131"></div>
					<!--<div id="share_video" class="pull-right"><a href="#share_video" class="btn btn-default"><i class="glyphicon glyphicon-share-alt"></i> <span class="hidden-xs font-song-12 blod"><?php echo smarty_function_t(array('c' => 'global.share'), $this);?>
</span></a></div>-->
					<?php if (isset ( $_SESSION['uid'] )): ?>
						<!--<div id="flag_video" class="pull-right m-r-5"><a href="#flag_video" class="btn btn-default"><i class="glyphicon glyphicon-flag"></i> <span class="hidden-xs font-song-12 blod"><?php echo smarty_function_t(array('c' => 'global.flag'), $this);?>
</span></a></div>-->
						<div id="favorite_video" class="pull-right m-r-5"><a href="#favorite_video" class="btn btn-default" id="favorite_video_<?php echo $this->_tpl_vars['video']['VID']; ?>
"><i class="glyphicon glyphicon-heart"></i> <span class="hidden-xs blod font-song-12"><?php echo smarty_function_t(array('c' => 'global.favorite'), $this);?>
</span></a></div>
					<?php endif; ?>
						<?php if ($this->_tpl_vars['video_embed'] == '1' && $this->_tpl_vars['video']['embed_code'] != '' && $this->_tpl_vars['is_friend']): ?>
						<div id="embed_video" class="pull-right m-r-5"><a href="#embed_video" class="btn btn-default"><i class="glyphicon glyphicon-link"></i> <span class="hidden-xs font-song-12 blod"><?php echo smarty_function_t(array('c' => 'global.embed'), $this);?>
</span></a></div>
						<?php endif; ?>
					<div class="clearfix"></div>
				</div>


				<?php if ($this->_tpl_vars['downloads'] == '1' && $this->_tpl_vars['video']['embed_code'] == '' && $this->_tpl_vars['is_friend']): ?>
					<div class="pull-right m-t-15 m-r-5">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-download-alt"></i><span class="hidden-xs hidden-sm hidden-sm hidden-md hidden-lg font-song-12 blod"> <?php echo smarty_function_t(array('c' => 'global.download'), $this);?>
</span> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li><a href="<?php echo $this->_tpl_vars['baseurl']; ?>
/download.php?id=<?php echo $this->_tpl_vars['video']['VID']; ?>
">SD (FLV)</a></li>
								<?php if ($this->_tpl_vars['hd'] == '1'): ?><li><a href="<?php echo $this->_tpl_vars['baseurl']; ?>
/download_hd.php?id=<?php echo $this->_tpl_vars['video']['VID']; ?>
">HD (MP4)</a></li><?php endif; ?>
								<?php if ($this->_tpl_vars['video']['iphone'] == '1'): ?><li><a href="<?php echo $this->_tpl_vars['baseurl']; ?>
/download_mobile.php?id=<?php echo $this->_tpl_vars['video']['VID']; ?>
">Mobile (MP4)</a></li><?php endif; ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>
				<div class="clearfix"></div>
				<div id="response_message" style="display: none;"></div>
				<?php if ($this->_tpl_vars['video_embed'] == '1' && $this->_tpl_vars['video']['embed_code'] == '' && $this->_tpl_vars['is_friend']): ?>
				<div id="embed_video_box" class="m-t-15" style="display: none;">
					<a href="#close_embed" id="close_embed" class="close">&times;</a>
					<div class="separator"><?php echo smarty_function_t(array('c' => 'video.EMBED'), $this);?>
</div>
					<div class="form-horizontal">
						<div class="form-group">
							<label for="video_embed_code" class="col-lg-3 control-label"><?php echo smarty_function_t(array('c' => 'video.embed_code'), $this);?>
</label>
							<div class="col-lg-9">
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'video_embed_vplayer.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
							</div>
						</div>
						<div id="custom_size" class="form-group">
							<label for="custom_width" class="col-lg-3 control-label"><?php echo smarty_function_t(array('c' => 'video.embed_custom_size'), $this);?>
</label>
							<div class="col-lg-9">
								<div class="pull-left">
									<input id="custom_width" type="text" class="form-control" value="" placeholder="<?php echo smarty_function_t(array('c' => 'video.width'), $this);?>
" style="width: 100px!important;"/>
								</div>
								<div class="pull-left m-l-5 m-r-5" style="line-height: 38px;">
									&times;
								</div>
								<div class="pull-left m-r-15">
									<input id="custom_height" type="text" class="form-control" value="" placeholder="<?php echo smarty_function_t(array('c' => 'video.height'), $this);?>
" style="width: 100px!important;"/>
								</div>
								<div class="pull-left" style="line-height: 38px;">
									<?php echo smarty_function_t(array('c' => 'video.embed_custom_size_min'), $this);?>

								</div>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<?php if (isset ( $_SESSION['uid'] )): ?>
					<div id="flag_video_box" class="m-t-15" style="display: none;">
						<a href="#close_flag" id="close_flag" class="close">&times;</a>
						<div class="separator"><?php echo smarty_function_t(array('c' => 'video.flag'), $this);?>
</div>
						<div id="flag_video_response" style="display: none;"></div>
						<div class="form-horizontal">
							<div class="form-group">
								<label class="col-lg-3 control-label"><?php echo smarty_function_t(array('c' => 'video.flag'), $this);?>
</label>
								<div class="col-lg-9">
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="inappropriate" checked="yes" />
											<?php echo smarty_function_t(array('c' => 'flag.inappr'), $this);?>

										</label>
									</div>
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="underage" />
											<?php echo smarty_function_t(array('c' => 'flag.underage'), $this);?>

										</label>
									</div>
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="copyrighted" />
											<?php echo smarty_function_t(array('c' => 'flag.copyright'), $this);?>

										</label>
									</div>
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="not_playing" />
											<?php echo smarty_function_t(array('c' => 'flag.not_playing'), $this);?>

										</label>
									</div>
									<div class="radio">
										<label>
											<input name="flag_reason" type="radio" value="other" />
											<?php echo smarty_function_t(array('c' => 'flag.other'), $this);?>

										</label>
									</div>
									<div id="flag_reason_error" class="text-danger m-t-5" style="display: none;"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="flag_message" class="col-lg-3 control-label"><?php echo smarty_function_t(array('c' => 'flag.reason'), $this);?>
</label>
								<div class="col-lg-9">
									<textarea name="flag_message" class="form-control" rows="3" id="flag_message"></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<input name="submit_flag" type="button" value=" <?php echo smarty_function_t(array('c' => 'video.flag'), $this);?>
 " id="submit_flag_video_<?php echo $this->_tpl_vars['video']['VID']; ?>
" class="btn btn-primary" />
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<div id="share_video_box" class="m-t-15" style="display: none;">
					<a href="#close_share" id="close_share" class="close">&times;</a>
					<div class="separator"><?php echo smarty_function_t(array('c' => 'video.SHARE'), $this);?>
</div>
					<div id="share_video_response" style="display: none;"></div>
					<div id="share_video_form">
						<form class="form-horizontal" name="share_video_form" method="post" action="#share_video">
							<div class="form-group">
								<label for="share_from" class="col-lg-3 control-label"><?php echo smarty_function_t(array('c' => 'global.from'), $this);?>
</label>
								<div class="col-lg-9">
									<input name="from" type="text" class="form-control" value="<?php if (isset ( $_SESSION['uid'] )): ?><?php if ($_SESSION['fname'] != ''): ?><?php echo $_SESSION['fname']; ?>
<?php else: ?><?php echo $_SESSION['username']; ?>
<?php endif; ?><?php endif; ?>" id="share_from" placeholder="<?php echo smarty_function_t(array('c' => 'global.from'), $this);?>
" />
									<div id="share_from_error" class="text-danger m-t-5" style="display: none;"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="share_to" class="col-lg-3 control-label"><?php echo smarty_function_t(array('c' => 'global.To'), $this);?>
</label>
								<div class="col-lg-9">
									<textarea name="to" class="form-control" rows="3" id="share_to" placeholder="<?php echo smarty_function_t(array('c' => 'global.share_expl','s' => $this->_tpl_vars['site_name']), $this);?>
"></textarea>
									<div id="share_to_error" class="text-danger m-t-5" style="color: red; display: none;"></div>
								</div>
							</div>
							<div class="form-group">
								<label for="share_message" class="col-lg-3 control-label"><?php echo smarty_function_t(array('c' => 'global.message_opt'), $this);?>
</label>
								<div class="col-lg-9">
									<textarea name="message" class="form-control" rows="3" id="share_message" placeholder="<?php echo smarty_function_t(array('c' => 'global.message_opt'), $this);?>
" ></textarea>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									 <input name="submit_share" type="button" value=" <?php echo smarty_function_t(array('c' => 'video.share'), $this);?>
 " id="send_share_video_<?php echo $this->_tpl_vars['video']['VID']; ?>
" class="btn btn-primary" />
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="separator m-t-15 p-0"></div>
				<div class="tools-left">
				<div class="pull-left user-container">
					发布者：<a href="<?php echo $this->_tpl_vars['relative']; ?>
/user/<?php echo $this->_tpl_vars['video']['username']; ?>
"><img class="medium-avatar" src="<?php echo $this->_tpl_vars['relative']; ?>
/media/users/<?php if ($this->_tpl_vars['video']['photo'] == ''): ?>nopic-<?php echo $this->_tpl_vars['video']['gender']; ?>
.gif<?php else: ?><?php echo $this->_tpl_vars['video']['photo']; ?>
<?php endif; ?>" /><span><?php echo $this->_tpl_vars['video']['username']; ?>
</span></a>
				</div>

				<div class="clearfix"></div>
				<div class="m-t-10 font-song-12 overflow-hidden">
				<?php echo $this->_tpl_vars['video']['description']; ?>

				</div>
				<div class="m-t-10 font-song-12 overflow-hidden">
					<?php $this->assign('keywords', $this->_tpl_vars['video']['keyword']); ?>
					<i class="fa fa-tags"></i><?php echo smarty_function_t(array('c' => 'global.tags'), $this);?>
:
					<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['keywords']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<a class="tag font-song-12" href="<?php echo $this->_tpl_vars['relative']; ?>
/search?search_type=videos&search_query=<?php echo $this->_tpl_vars['keywords'][$this->_sections['i']['index']]; ?>
"><?php echo $this->_tpl_vars['keywords'][$this->_sections['i']['index']]; ?>
</a><?php if (! $this->_sections['i']['last']): ?>,<?php endif; ?>
					<?php endfor; endif; ?>
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
  <div style="line-height:30px;margin-top"10px;"><font style="color:red;">视频推广链接：</font><input id="textfield3" type="text" style="width:502px;text-align:center;" readonly="readonly" value="分享一个我收藏很久了的看片神器！你懂的！ <?php echo $this->_tpl_vars['remotehost']; ?>
/tuiguang.php?fromuid=<?php echo $_SESSION['uid']; ?>
"> <input type="button" onclick="$('#textfield3').select();CopyUrl($('#textfield3').val());"  value="复制地址">  <font style="color:red;">注册成功后，推广连接生效，告诉身边朋友，马上获得色币，免费观看视频</font></div>
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
			<li class="active"><a href="#related_videos" data-toggle="tab"><?php echo smarty_function_t(array('c' => 'video.RELATED'), $this);?>
<?php if ($this->_tpl_vars['videos_total'] > 0): ?> <div class="badge"><?php echo $this->_tpl_vars['videos_total']; ?>
</div><?php endif; ?></a></li>
			<li class=""><a href="#comments" data-toggle="tab"><?php echo smarty_function_t(array('c' => 'global.COMMENTS'), $this);?>
<?php if ($this->_tpl_vars['comments_total'] > 0): ?> <div class="badge" id="total_video_comments"><?php echo $this->_tpl_vars['comments_total']; ?>
</div><?php endif; ?></a></li>
		</ul>
		<div class="tab-content m-b-20">
			<div class="tab-pane fade active in" id="related_videos">
			 <?php if ($this->_tpl_vars['videos']): ?>
		        <input name="current_page_related_videos" type="hidden" value="1" id="current_page_related_videos" />
				<div class="row row-boder">
				<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['videos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<div class="col-sm-6 col-md-3 col-lg-3">
						<div class="well well-sm m-b-0 m-t-20">
							<a href="<?php echo $this->_tpl_vars['relative']; ?>
/video/<?php echo $this->_tpl_vars['videos'][$this->_sections['i']['index']]['VID']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
">
								<div class="thumb-overlay">
									<img src="<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'thumb_path', 'vid' => $this->_tpl_vars['videos'][$this->_sections['i']['index']]['VID'])), $this); ?>
/<?php echo $this->_tpl_vars['videos'][$this->_sections['i']['index']]['thumb']; ?>
.jpg" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" id="rotate_<?php echo $this->_tpl_vars['videos'][$this->_sections['i']['index']]['VID']; ?>
_<?php echo $this->_tpl_vars['videos'][$this->_sections['i']['index']]['thumbs']; ?>
_<?php echo $this->_tpl_vars['videos'][$this->_sections['i']['index']]['thumb']; ?>
" class="img-responsive <?php if ($this->_tpl_vars['videos'][$this->_sections['i']['index']]['type'] == 'private'): ?>img-private<?php endif; ?>"/>
									<?php if ($this->_tpl_vars['videos'][$this->_sections['i']['index']]['type'] == 'public'): ?><div class="label-private"><?php echo smarty_function_t(array('c' => 'global.PRIVATE'), $this);?>
</div><?php else: ?><div class="label-vip">&nbsp;</div><?php endif; ?>
									<?php if ($this->_tpl_vars['videos'][$this->_sections['i']['index']]['hd'] == 1): ?><div class="hd-text-icon">HD</div><?php endif; ?>
									<div class="duration">
										<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'duration', 'assign' => 'duration', 'duration' => $this->_tpl_vars['videos'][$this->_sections['i']['index']]['duration'])), $this); ?>

										<?php echo $this->_tpl_vars['duration']; ?>

									</div>
								</div>
								<span class="video-title title-truncate m-t-5"><?php echo ((is_array($_tmp=$this->_tpl_vars['videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
							</a>
							<div class="video-added">
								<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'time_range', 'assign' => 'addtime', 'time' => $this->_tpl_vars['videos'][$this->_sections['i']['index']]['addtime'])), $this); ?>

								<?php echo $this->_tpl_vars['addtime']; ?>

							</div>
							<div class="video-views pull-left">
							<i class="fa fa-eye"></i>&nbsp;<?php echo $this->_tpl_vars['videos'][$this->_sections['i']['index']]['viewnumber']; ?>

							</div>
							<div class="video-rating pull-right <?php if ($this->_tpl_vars['videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>">
								<i class="fa fa-thumbs-up video-rating-heart <?php if ($this->_tpl_vars['videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>"></i> <b><?php if ($this->_tpl_vars['videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>-<?php else: ?><?php echo $this->_tpl_vars['videos'][$this->_sections['i']['index']]['rate']; ?>
%<?php endif; ?></b>
							</div>
							<div class="clearfix"></div>

						</div>
					</div>
				<?php endfor; endif; ?>
				</div>
				<div id="related_videos_container_1"></div>

				<?php if ($this->_tpl_vars['videos_total'] > 8): ?>
					<center>
						<div class="center_related" style="display: none;  margin: -6px 0 -26px 0;"><img src="<?php echo $this->_tpl_vars['relative_tpl']; ?>
/img/loading-bubbles.svg"></div>
						<ul class="pager">
						  <li><a href="#prev_related_videos" id="prev_related_videos_<?php echo $this->_tpl_vars['video']['VID']; ?>
" style="display: none;"><?php echo smarty_function_t(array('c' => 'global.hide'), $this);?>
</a></li>
						  <li><a href="#next_related_videos" id="next_related_videos_<?php echo $this->_tpl_vars['video']['VID']; ?>
" ><?php echo smarty_function_t(array('c' => 'global.show_more'), $this);?>
</a></li>
						</ul>
					</center>
				<?php endif; ?>

			<?php else: ?>
			<div class="row row-boder well-sm m-b-0">
				<span class="text-danger"><?php echo smarty_function_t(array('c' => 'videos.no_videos_found'), $this);?>
.</span>
			</div>
			<?php endif; ?>

			</div>

			<div class="tab-pane fade" id="comments">
			<div class="row row-boder pd-lr20">
				<div class="m-b-20"></div>
				<?php if (isset ( $_SESSION['uid'] ) && $this->_tpl_vars['video_comments'] == '1'): ?>
					<div id="post_comment">
						<form class="form-horizontal"name="postVideoComment" id="postVideoComment" method="post" action="#">
							<div class="form-group">
								<div class="col-xs-12 col-sm-10 col-sm-offset-1">
									<textarea name="video_comment" id="video_comment" rows="5" class="form-control" placeholder="<?php echo smarty_function_t(array('c' => 'global.add_comment'), $this);?>
"><?php echo $this->_tpl_vars['comment']; ?>
</textarea>
									<div id="post_message" class="text-danger m-t-5" style="display: none;"><?php echo smarty_function_t(array('c' => 'global.comment_empty'), $this);?>
!</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-xs-12 col-sm-10 col-sm-offset-1">
									<div class="pull-left">
										<input name="submit_comment" type="button" value=" <?php echo smarty_function_t(array('c' => 'global.post'), $this);?>
 " id="post_video_comment_<?php echo $this->_tpl_vars['video']['VID']; ?>
" class="btn btn-primary" />
									</div>
									<div class="pull-right">
										<span id="chars_left">1000</span> <?php echo smarty_function_t(array('c' => 'global.chars_left'), $this);?>

									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</form>
					</div>
				<?php endif; ?>

				<div id="video_comments_<?php echo $this->_tpl_vars['video']['VID']; ?>
">
					<?php if ($this->_tpl_vars['comments']): ?>
						<?php echo smarty_function_t(array('c' => 'global.showing'), $this);?>
 <span class="text-black"><?php echo $this->_tpl_vars['start_num']; ?>
</span> <?php echo smarty_function_t(array('c' => 'global.to'), $this);?>
 <span id="end_num" class="text-black"><?php echo $this->_tpl_vars['end_num']; ?>
</span> <?php echo smarty_function_t(array('c' => 'global.of'), $this);?>
 <span id="total_comments" class="text-black"><?php echo $this->_tpl_vars['comments_total']; ?>
</span> <?php echo smarty_function_t(array('c' => 'global.comments'), $this);?>
.
					<?php endif; ?>
					<div id="video_response" style="display: none;"></div>
					<div id="comments_delimiter" style="display: none;"></div>

					<?php if ($this->_tpl_vars['comments']): ?>
						<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['comments']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

							<div id="video_comment_<?php echo $this->_tpl_vars['video']['VID']; ?>
_<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['CID']; ?>
" class="col-xs-12 m-t-15">
								<div class="row">
									<div class="pull-left">
										<a href="<?php echo $this->_tpl_vars['relative']; ?>
/user/<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['username']; ?>
">
											<img src="<?php echo $this->_tpl_vars['relative']; ?>
/media/users/<?php if ($this->_tpl_vars['comments'][$this->_sections['i']['index']]['photo'] != ''): ?><?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['photo']; ?>
<?php else: ?>nopic-<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['gender']; ?>
.gif<?php endif; ?>" title="<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['username']; ?>
's avatar" alt="<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['username']; ?>
's avatar" class="img-responsive comment-avatar" />
										</a>
									</div>
									<div class="comment">
										<div class="comment-info">
											<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'time_range', 'assign' => 'addtime', 'time' => $this->_tpl_vars['comments'][$this->_sections['i']['index']]['addtime'])), $this); ?>

											<a href="<?php echo $this->_tpl_vars['relative']; ?>
/user/<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['username']; ?>
"><?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['username']; ?>
</a>&nbsp;-&nbsp;<span class=""><?php echo $this->_tpl_vars['addtime']; ?>
</span>
										</div>
										<div class="comment-body overflow-hidden"><?php echo ((is_array($_tmp=$this->_tpl_vars['comments'][$this->_sections['i']['index']]['comment'])) ? $this->_run_mod_handler('nl2br', true, $_tmp) : smarty_modifier_nl2br($_tmp)); ?>
</div>
										<?php if (isset ( $_SESSION['uid'] )): ?>
											<div class="comment-actions">
												<?php if ($_SESSION['uid'] == $this->_tpl_vars['comments'][$this->_sections['i']['index']]['UID']): ?>
													<a href="#delete_comment" id="delete_comment_video_<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['CID']; ?>
_<?php echo $this->_tpl_vars['video']['VID']; ?>
"><?php echo smarty_function_t(array('c' => 'global.delete'), $this);?>
</a> <span id="delete_response_<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['CID']; ?>
" style="display: none;"></span>
												<?php else: ?>
													<span id="reported_spam_<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['CID']; ?>
_<?php echo $this->_tpl_vars['video']['VID']; ?>
"><a href="#report_spam" id="report_spam_video_<?php echo $this->_tpl_vars['comments'][$this->_sections['i']['index']]['CID']; ?>
_<?php echo $this->_tpl_vars['video']['VID']; ?>
"><?php echo smarty_function_t(array('c' => 'global.report_spam'), $this);?>
</a></span>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									</div>
									<div class="clearfix"></div>
								</div>

							</div>

						<?php endfor; endif; ?>

						<?php if ($this->_tpl_vars['page_link_comments']): ?>
							<div class="visible-xs center m-b--15">
								<ul class="pagination pagination-lg"><?php echo $this->_tpl_vars['page_link_comments']; ?>
</ul>
							</div>
							<div class="hidden-xs center m-b--15">
								<ul class="pagination"><?php echo $this->_tpl_vars['page_link_comments']; ?>
</ul>
							</div>
						<?php endif; ?>
					<?php elseif (! isset ( $_SESSION['uid'] )): ?>
						<div class="row row-boder well-sm m-b-0">
							<span class="text-danger"><?php echo smarty_function_t(array('c' => 'global.comments.none'), $this);?>
.</span>
						</div>
					<?php endif; ?>
				</div>
				<div class="clearfix"></div>
			</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="ps-body">
		<p class="ad-title"><?php echo smarty_function_t(array('c' => 'global.sponsors'), $this);?>
</p>
		<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'adv', 'assign' => 'adv', 'group' => 'video_bottom')), $this); ?>

		<?php if ($this->_tpl_vars['adv']): ?><?php echo $this->_tpl_vars['adv']; ?>
<?php endif; ?>
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
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>