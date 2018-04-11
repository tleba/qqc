<?php /* Smarty version 2.6.20, created on 2018-04-06 15:21:46
         compiled from v.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'v.tpl', 11, false),array('function', 't', 'v.tpl', 17, false),array('function', 'url', 'v.tpl', 19, false),array('modifier', 'clean', 'v.tpl', 84, false),array('modifier', 'escape', 'v.tpl', 94, false),array('insert', 'thumb_path', 'v.tpl', 86, false),array('insert', 'duration', 'v.tpl', 90, false),array('insert', 'time_range', 'v.tpl', 97, false),)), $this); ?>
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
<div class="container">
	<div class="well well-filters new_filters">
			<div class="pull-left">
				<h4><i class="fa fa-thumbs-o-up green"></i>&nbsp;本站推荐的视频</h4>
			</div>

			<div class="pull-right btn-line-height m-l-20">
				<a class="btn btn-primary" href="<?php echo $this->_tpl_vars['relative']; ?>
/videos?o=mr"><span class="hidden-xs"><i class="fa fa-plus"></i> <?php echo smarty_function_translate(array('c' => 'index.most_recent_videos_more'), $this);?>
</span><span class="visible-xs"><i class="fa fa-plus"></i></span></a>
			</div>

			<!--<div class="pull-right m-l-20">
							<div class="hidden-xs">
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if ($this->_tpl_vars['type'] == ''): ?><?php echo smarty_function_t(array('c' => 'global.type'), $this);?>
<?php elseif ($this->_tpl_vars['type'] == 'public'): ?><?php echo smarty_function_t(array('c' => 'global.public'), $this);?>
<?php else: ?><?php echo smarty_function_t(array('c' => 'global.private'), $this);?>
<?php endif; ?> <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li <?php if ($this->_tpl_vars['type'] == ''): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => ''), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['type'] == 'public'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'public'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.public'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['type'] == 'private'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'private'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.private'), $this);?>
</a></li>
									</ul>
								</div>

								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if ($this->_tpl_vars['timeframe'] == 'a'): ?><?php echo smarty_function_t(array('c' => 'global.timeline'), $this);?>
<?php elseif ($this->_tpl_vars['timeframe'] == 't'): ?><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.today'), $this);?>
<?php elseif ($this->_tpl_vars['timeframe'] == 'w'): ?><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_week'), $this);?>
<?php else: ?><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_month'), $this);?>
<?php endif; ?> <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li <?php if ($this->_tpl_vars['timeframe'] == 'a'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'a'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['timeframe'] == 't'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 't'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.today'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['timeframe'] == 'w'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'w'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_week'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['timeframe'] == 'm'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'm'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_month'), $this);?>
</a></li>
									</ul>
								</div>

								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if ($this->_tpl_vars['order'] == 'bw'): ?><?php echo smarty_function_t(array('c' => 'global.being_watched'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'mr'): ?><?php echo smarty_function_t(array('c' => 'global.most_recent'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'mv'): ?><?php echo smarty_function_t(array('c' => 'global.most_viewed'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'tr'): ?><?php echo smarty_function_t(array('c' => 'global.top_rated'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'md'): ?><?php echo smarty_function_t(array('c' => 'global.most_commented'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'tf'): ?><?php echo smarty_function_t(array('c' => 'global.top_favorites'), $this);?>
<?php else: ?><?php echo smarty_function_t(array('c' => 'global.longest'), $this);?>
<?php endif; ?> <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li <?php if ($this->_tpl_vars['order'] == 'bw'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'bw'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.being_watched'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'mr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_recent'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'mv'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mv'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_viewed'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'md'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'md'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_commented'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'tr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_rated'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'tf'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tf'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_favorites'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'lg'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'lg'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.longest'), $this);?>
</a></li>
									</ul>
								</div>
							</div>
							<div class="visible-xs">
								<div class="btn-group">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
									<ul class="dropdown-menu">
										<li <?php if ($this->_tpl_vars['type'] == ''): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => ''), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['type'] == 'public'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'public'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.public'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['type'] == 'private'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'private'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.private'), $this);?>
</a></li>
										<li class="divider"></li>
										<li <?php if ($this->_tpl_vars['timeframe'] == 'a'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'a'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['timeframe'] == 't'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 't'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.today'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['timeframe'] == 'w'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'w'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_week'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['timeframe'] == 'm'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'm'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_month'), $this);?>
</a></li>
										<li class="divider"></li>
										<li <?php if ($this->_tpl_vars['order'] == 'bw'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'bw'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.being_watched'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'mr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_recent'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'mv'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mv'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_viewed'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'md'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'md'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_commented'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'tr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_rated'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'tf'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tf'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_favorites'), $this);?>
</a></li>
										<li <?php if ($this->_tpl_vars['order'] == 'lg'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'lg'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.longest'), $this);?>
</a></li>
									</ul>
								</div>
							</div>
						</div>-->

			<div class="clearfix"></div>
	</div>

	<div class="row row-boder">
		<div class="col-md-12">
            <?php if ($this->_tpl_vars['featured_videos']): ?>
			<div class="row">
            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['featured_videos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

				<div class="col-sm-4 col-md-3 col-lg-3">
					<div class="well well-sm">
						<a href="<?php echo $this->_tpl_vars['relative']; ?>
/video/<?php echo $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['VID']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
">
							<div class="thumb-overlay">
								<img src="<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'thumb_path', 'vid' => $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['VID'])), $this); ?>
/<?php echo $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['thumb']; ?>
.jpg"  id="rotate_<?php echo $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['VID']; ?>
_<?php echo $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['thumbs']; ?>
_<?php echo $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['thumb']; ?>
_recent" class="img-responsive <?php if ($this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['type'] == 'private'): ?><?php endif; ?>"/>
								<?php if ($this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['type'] == 'public'): ?><div class="label-private"><?php echo smarty_function_t(array('c' => 'global.PRIVATE'), $this);?>
</div><?php else: ?><div class="label-vip">&nbsp;</div><?php endif; ?>
								<?php if ($this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['hd'] == 1): ?><div class="hd-text-icon">HD</div><?php endif; ?>
								<div class="duration">
									<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'duration', 'assign' => 'duration', 'duration' => $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['duration'])), $this); ?>

									<?php echo $this->_tpl_vars['duration']; ?>

								</div>
							</div>
							<span class="video-title title-truncate m-t-5"><?php echo ((is_array($_tmp=$this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
						</a>
						<div class="video-added">
							<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'time_range', 'assign' => 'addtime', 'time' => $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['addtime'])), $this); ?>

							<?php echo $this->_tpl_vars['addtime']; ?>

						</div>
						<div class="video-views pull-left">
							<i class="fa fa-eye"></i>&nbsp;<?php echo $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['viewnumber']; ?>

						</div>
						<div class="video-rating pull-right <?php if ($this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>">
							<i class="fa fa-thumbs-up video-rating-heart <?php if ($this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>"></i> <b><?php if ($this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>-<?php else: ?><?php echo $this->_tpl_vars['featured_videos'][$this->_sections['i']['index']]['rate']; ?>
%<?php endif; ?></b>
						</div>
						<div class="clearfix"></div>

					</div>
				</div>

            <?php endfor; endif; ?>
			</div>
            <?php else: ?>
			<div class="well well-sm">
				<span class="text-danger">暂无推荐的视频！(标志为:featured).</span>
			</div>
            <?php endif; ?>
		</div>
	</div>

<div class="ps-body">
	<div class="ps-pc"><div class="ps_39"></div></div>
</div>



	<div class="well well-filters new_filters">
	<div class="pull-left">
		<h4><i class="fa fa-clock-o green"></i>&nbsp;<?php echo smarty_function_translate(array('c' => 'index.most_recent_videos'), $this);?>
</h4>
	</div>

	<div class="pull-right btn-line-height m-l-20">
		<a class="btn btn-primary" href="<?php echo $this->_tpl_vars['relative']; ?>
/videos?o=mr"><span class="hidden-xs"><i class="fa fa-plus"></i> <?php echo smarty_function_translate(array('c' => 'index.most_recent_videos_more'), $this);?>
</span><span class="visible-xs"><i class="fa fa-plus"></i></span></a>
	</div>

	<!--<div class="pull-right m-l-20">
					<div class="hidden-xs">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if ($this->_tpl_vars['type'] == ''): ?><?php echo smarty_function_t(array('c' => 'global.type'), $this);?>
<?php elseif ($this->_tpl_vars['type'] == 'public'): ?><?php echo smarty_function_t(array('c' => 'global.public'), $this);?>
<?php else: ?><?php echo smarty_function_t(array('c' => 'global.private'), $this);?>
<?php endif; ?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li <?php if ($this->_tpl_vars['type'] == ''): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => ''), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['type'] == 'public'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'public'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.public'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['type'] == 'private'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'private'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.private'), $this);?>
</a></li>
							</ul>
						</div>

						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if ($this->_tpl_vars['timeframe'] == 'a'): ?><?php echo smarty_function_t(array('c' => 'global.timeline'), $this);?>
<?php elseif ($this->_tpl_vars['timeframe'] == 't'): ?><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.today'), $this);?>
<?php elseif ($this->_tpl_vars['timeframe'] == 'w'): ?><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_week'), $this);?>
<?php else: ?><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_month'), $this);?>
<?php endif; ?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li <?php if ($this->_tpl_vars['timeframe'] == 'a'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'a'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['timeframe'] == 't'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 't'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.today'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['timeframe'] == 'w'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'w'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_week'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['timeframe'] == 'm'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'm'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_month'), $this);?>
</a></li>
							</ul>
						</div>

						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if ($this->_tpl_vars['order'] == 'bw'): ?><?php echo smarty_function_t(array('c' => 'global.being_watched'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'mr'): ?><?php echo smarty_function_t(array('c' => 'global.most_recent'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'mv'): ?><?php echo smarty_function_t(array('c' => 'global.most_viewed'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'tr'): ?><?php echo smarty_function_t(array('c' => 'global.top_rated'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'md'): ?><?php echo smarty_function_t(array('c' => 'global.most_commented'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'tf'): ?><?php echo smarty_function_t(array('c' => 'global.top_favorites'), $this);?>
<?php else: ?><?php echo smarty_function_t(array('c' => 'global.longest'), $this);?>
<?php endif; ?> <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li <?php if ($this->_tpl_vars['order'] == 'bw'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'bw'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.being_watched'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'mr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_recent'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'mv'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mv'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_viewed'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'md'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'md'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_commented'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'tr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_rated'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'tf'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tf'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_favorites'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'lg'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'lg'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.longest'), $this);?>
</a></li>
							</ul>
						</div>
					</div>
					<div class="visible-xs">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
							<ul class="dropdown-menu">
								<li <?php if ($this->_tpl_vars['type'] == ''): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => ''), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['type'] == 'public'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'public'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.public'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['type'] == 'private'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'private'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.private'), $this);?>
</a></li>
								<li class="divider"></li>
								<li <?php if ($this->_tpl_vars['timeframe'] == 'a'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'a'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['timeframe'] == 't'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 't'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.today'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['timeframe'] == 'w'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'w'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_week'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['timeframe'] == 'm'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'm'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_month'), $this);?>
</a></li>
								<li class="divider"></li>
								<li <?php if ($this->_tpl_vars['order'] == 'bw'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'bw'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.being_watched'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'mr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_recent'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'mv'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mv'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_viewed'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'md'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'md'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_commented'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'tr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_rated'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'tf'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tf'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_favorites'), $this);?>
</a></li>
								<li <?php if ($this->_tpl_vars['order'] == 'lg'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'lg'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.longest'), $this);?>
</a></li>
							</ul>
						</div>
					</div>
				</div>-->

	<div class="clearfix"></div>
</div>

<div class="row row-boder">
	<div class="col-sm-9 hidden-xs hidden-sm">
	    <?php if ($this->_tpl_vars['recent_videos']): ?>
		<div class="row">
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['recent_videos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

			<div class="col-sm-6 col-md-4 col-lg-4">
				<div class="well well-sm">
					<a href="<?php echo $this->_tpl_vars['relative']; ?>
/video/<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['VID']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
">
						<div class="thumb-overlay">
							<img src="<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'thumb_path', 'vid' => $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['VID'])), $this); ?>
/<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['thumb']; ?>
.jpg"  id="rotate_<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['VID']; ?>
_<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['thumbs']; ?>
_<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['thumb']; ?>
_recent" class="img-responsive <?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['type'] == 'private'): ?><?php endif; ?>"/>
							<?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['type'] == 'public'): ?><div class="label-private"><?php echo smarty_function_t(array('c' => 'global.PRIVATE'), $this);?>
</div><?php else: ?><div class="label-vip">&nbsp;</div><?php endif; ?>
							<?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['hd'] == 1): ?><div class="hd-text-icon">HD</div><?php endif; ?>
							<div class="duration">
								<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'duration', 'assign' => 'duration', 'duration' => $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['duration'])), $this); ?>

								<?php echo $this->_tpl_vars['duration']; ?>

							</div>
						</div>
						<span class="video-title title-truncate m-t-5"><?php echo ((is_array($_tmp=$this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
					</a>
					<div class="video-added">
						<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'time_range', 'assign' => 'addtime', 'time' => $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['addtime'])), $this); ?>

						<?php echo $this->_tpl_vars['addtime']; ?>

					</div>
					<div class="video-views pull-left">
						<i class="fa fa-eye"></i>&nbsp;<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['viewnumber']; ?>

					</div>
					<div class="video-rating pull-right <?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>">
						<i class="fa fa-thumbs-up video-rating-heart <?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>"></i> <b><?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>-<?php else: ?><?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['rate']; ?>
%<?php endif; ?></b>
					</div>
					<div class="clearfix"></div>

				</div>
			</div>


		<?php endfor; endif; ?>


		</div>
	    <?php else: ?>
		<div class="well well-sm">
			<span class="text-danger"><?php echo smarty_function_t(array('c' => 'videos.no_videos_found'), $this);?>
.</span>
		</div>
	    <?php endif; ?>


	</div>

	<div class="col-sm-8 visible-xs visible-sm">
	    <?php if ($this->_tpl_vars['recent_videos']): ?>
		<div class="row">
		<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['recent_videos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

			<div class="col-sm-6 col-md-4 col-lg-4">
				<div class="well well-sm">
					<a href="<?php echo $this->_tpl_vars['relative']; ?>
/video/<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['VID']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
">
						<div class="thumb-overlay">
							<img src="<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'thumb_path', 'vid' => $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['VID'])), $this); ?>
/<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['thumb']; ?>
.jpg"  id="rotate_<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['VID']; ?>
_<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['thumbs']; ?>
_<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['thumb']; ?>
_recent" class="img-responsive <?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['type'] == 'private'): ?><?php endif; ?>"/>
							<?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['type'] == 'public'): ?><div class="label-private"><?php echo smarty_function_t(array('c' => 'global.PRIVATE'), $this);?>
</div><?php else: ?><div class="label-vip">&nbsp;</div><?php endif; ?>
							<?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['hd'] == 1): ?><div class="hd-text-icon">HD</div><?php endif; ?>
							<div class="duration">
								<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'duration', 'assign' => 'duration', 'duration' => $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['duration'])), $this); ?>

								<?php echo $this->_tpl_vars['duration']; ?>

							</div>
						</div>
						<span class="video-title title-truncate m-t-5"><?php echo ((is_array($_tmp=$this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
					</a>
					<div class="video-added">
						<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'time_range', 'assign' => 'addtime', 'time' => $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['addtime'])), $this); ?>

						<?php echo $this->_tpl_vars['addtime']; ?>

					</div>
					<div class="video-views pull-left">
						<i class="fa fa-eye"></i>&nbsp;<?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['viewnumber']; ?>

					</div>
					<div class="video-rating pull-right <?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>">
						<i class="fa fa-thumbs-up video-rating-heart <?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>"></i> <b><?php if ($this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>-<?php else: ?><?php echo $this->_tpl_vars['recent_videos'][$this->_sections['i']['index']]['rate']; ?>
%<?php endif; ?></b>
					</div>
					<div class="clearfix"></div>

				</div>
			</div>


		<?php endfor; endif; ?>


		</div>
	    <?php else: ?>
		<div class="well well-sm">
			<span class="text-danger"><?php echo smarty_function_t(array('c' => 'videos.no_videos_found'), $this);?>
.</span>
		</div>
	    <?php endif; ?>


	</div>



<div class="col-md-3 col-sm-4">

<div class="ps-body">

<div class="ps-pc">
	<div style="margin-bottom:20px;">
	<div class="ps_41"></div>
	</div>
	<div>
	<div class="ps_42"></div>
	</div>
</div>

</div>

</div>


</div>


<div class="ps-body">

<div class="ps-pc">
<div class="ps_40"></div>
</div>

</div>



	<div class="well well-filters new_filters">
		<div class="pull-left">
			<h4><i class="fa fa-fire green"></i>&nbsp;最受欢迎的视频</h4>
		</div>

		<div class="pull-right btn-line-height m-l-20">
			<a class="btn btn-primary" href="<?php echo $this->_tpl_vars['relative']; ?>
/videos?o=mr"><span class="hidden-xs"><i class="fa fa-plus"></i> <?php echo smarty_function_translate(array('c' => 'index.most_recent_videos_more'), $this);?>
</span><span class="visible-xs"><i class="fa fa-plus"></i></span></a>
		</div>

		<!--<div class="pull-right m-l-20">
						<div class="hidden-xs">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if ($this->_tpl_vars['type'] == ''): ?><?php echo smarty_function_t(array('c' => 'global.type'), $this);?>
<?php elseif ($this->_tpl_vars['type'] == 'public'): ?><?php echo smarty_function_t(array('c' => 'global.public'), $this);?>
<?php else: ?><?php echo smarty_function_t(array('c' => 'global.private'), $this);?>
<?php endif; ?> <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li <?php if ($this->_tpl_vars['type'] == ''): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => ''), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['type'] == 'public'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'public'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.public'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['type'] == 'private'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'private'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.private'), $this);?>
</a></li>
								</ul>
							</div>

							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if ($this->_tpl_vars['timeframe'] == 'a'): ?><?php echo smarty_function_t(array('c' => 'global.timeline'), $this);?>
<?php elseif ($this->_tpl_vars['timeframe'] == 't'): ?><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.today'), $this);?>
<?php elseif ($this->_tpl_vars['timeframe'] == 'w'): ?><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_week'), $this);?>
<?php else: ?><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_month'), $this);?>
<?php endif; ?> <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li <?php if ($this->_tpl_vars['timeframe'] == 'a'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'a'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['timeframe'] == 't'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 't'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.today'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['timeframe'] == 'w'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'w'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_week'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['timeframe'] == 'm'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'm'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_month'), $this);?>
</a></li>
								</ul>
							</div>

							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><?php if ($this->_tpl_vars['order'] == 'bw'): ?><?php echo smarty_function_t(array('c' => 'global.being_watched'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'mr'): ?><?php echo smarty_function_t(array('c' => 'global.most_recent'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'mv'): ?><?php echo smarty_function_t(array('c' => 'global.most_viewed'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'tr'): ?><?php echo smarty_function_t(array('c' => 'global.top_rated'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'md'): ?><?php echo smarty_function_t(array('c' => 'global.most_commented'), $this);?>
<?php elseif ($this->_tpl_vars['order'] == 'tf'): ?><?php echo smarty_function_t(array('c' => 'global.top_favorites'), $this);?>
<?php else: ?><?php echo smarty_function_t(array('c' => 'global.longest'), $this);?>
<?php endif; ?> <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li <?php if ($this->_tpl_vars['order'] == 'bw'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'bw'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.being_watched'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'mr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_recent'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'mv'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mv'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_viewed'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'md'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'md'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_commented'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'tr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_rated'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'tf'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tf'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_favorites'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'lg'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'lg'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.longest'), $this);?>
</a></li>
								</ul>
							</div>
						</div>
						<div class="visible-xs">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Filters <span class="caret"></span></button>
								<ul class="dropdown-menu">
									<li <?php if ($this->_tpl_vars['type'] == ''): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => ''), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['type'] == 'public'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'public'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.public'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['type'] == 'private'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'type','value' => 'private'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.private'), $this);?>
</a></li>
									<li class="divider"></li>
									<li <?php if ($this->_tpl_vars['timeframe'] == 'a'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'a'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.all'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['timeframe'] == 't'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 't'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.today'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['timeframe'] == 'w'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'w'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_week'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['timeframe'] == 'm'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 't','value' => 'm'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.added'), $this);?>
 <?php echo smarty_function_t(array('c' => 'global.this_month'), $this);?>
</a></li>
									<li class="divider"></li>
									<li <?php if ($this->_tpl_vars['order'] == 'bw'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'bw'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.being_watched'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'mr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_recent'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'mv'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'mv'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_viewed'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'md'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'md'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.most_commented'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'tr'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tr'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_rated'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'tf'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'tf'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.top_favorites'), $this);?>
</a></li>
									<li <?php if ($this->_tpl_vars['order'] == 'lg'): ?>class="active"<?php endif; ?>><a href="<?php echo smarty_function_url(array('base' => 'videos','strip' => 'o','value' => 'lg'), $this);?>
"><?php echo smarty_function_t(array('c' => 'global.longest'), $this);?>
</a></li>
								</ul>
							</div>
						</div>
					</div>-->

		<div class="clearfix"></div>
	</div>

	<div class="row row-boder">
		<div class="col-sm-12">
	        <?php if ($this->_tpl_vars['viewed_videos']): ?>
			<div class="row">
	        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['viewed_videos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

				<div class="col-sm-4 col-md-3 col-lg-3">
					<div class="well well-sm">
						<a href="<?php echo $this->_tpl_vars['relative']; ?>
/video/<?php echo $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['VID']; ?>
/<?php echo ((is_array($_tmp=$this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('clean', true, $_tmp) : smarty_modifier_clean($_tmp)); ?>
">
							<div class="thumb-overlay">
							<img src="<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'thumb_path', 'vid' => $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['VID'])), $this); ?>
/<?php echo $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['thumb']; ?>
.jpg" id="rotate_<?php echo $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['VID']; ?>
_<?php echo $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['thumbs']; ?>
_<?php echo $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['thumb']; ?>
_recent" class="img-responsive <?php if ($this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['type'] == 'private'): ?><?php endif; ?>"/>
								<?php if ($this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['type'] == 'public'): ?><div class="label-private"><?php echo smarty_function_t(array('c' => 'global.PRIVATE'), $this);?>
</div><?php else: ?><div class="label-vip">&nbsp;</div><?php endif; ?>
								<?php if ($this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['hd'] == 1): ?><div class="hd-text-icon">HD</div><?php endif; ?>
								<div class="duration">
									<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'duration', 'assign' => 'duration', 'duration' => $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['duration'])), $this); ?>

									<?php echo $this->_tpl_vars['duration']; ?>

								</div>
							</div>
							<span class="video-title title-truncate m-t-5"><?php echo ((is_array($_tmp=$this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
						</a>
						<div class="video-added">
							<?php require_once(SMARTY_CORE_DIR . 'core.run_insert_handler.php');
echo smarty_core_run_insert_handler(array('args' => array('name' => 'time_range', 'assign' => 'addtime', 'time' => $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['addtime'])), $this); ?>

							<?php echo $this->_tpl_vars['addtime']; ?>

						</div>
						<div class="video-views pull-left">
							<i class="fa fa-eye"></i>&nbsp;<?php echo $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['viewnumber']; ?>

						</div>
						<div class="video-rating pull-right <?php if ($this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>">
							<i class="fa fa-thumbs-up video-rating-heart <?php if ($this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>no-rating<?php endif; ?>"></i> <b><?php if ($this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['rate'] == 0 && $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['dislikes'] == 0): ?>-<?php else: ?><?php echo $this->_tpl_vars['viewed_videos'][$this->_sections['i']['index']]['rate']; ?>
%<?php endif; ?></b>
						</div>
						<div class="clearfix"></div>

					</div>
				</div>

	        <?php endfor; endif; ?>
			</div>
	        <?php else: ?>
			<div class="well well-sm">
				<span class="text-danger"><?php echo smarty_function_t(array('c' => 'videos.no_videos_found'), $this);?>
.</span>
			</div>
	        <?php endif; ?>
		</div>
	</div>

<!--首页分页-->
<div class="index-pages">
	<?php if ($this->_tpl_vars['page_link']): ?>
		<div style="text-align: center;" class="hidden-xs">
			<ul class="pagination"><?php echo $this->_tpl_vars['page_link']; ?>
</ul>
		</div>
		<div style="text-align: center;" class="visible-xs">
			<ul class="pagination pagination-lg"><?php echo $this->_tpl_vars['page_link']; ?>
</ul>
		</div>
	<?php endif; ?>
</div>
<!--首页分页-->
</div>
<div class="ps_hd"><div class="ps_123"></div></div>
<div style="position: fixed;left:2%;bottom: 5%;z-index: 99999;width: 150px;display:none;"><a href="javascript:void(0);" id="nyhiddenme" onclick="hiddenme(this);"><img src="/templates/frontend/frontend-default/img/snewyear.png"></a></div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>