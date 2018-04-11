<?php /* Smarty version 2.6.20, created on 2018-04-06 15:22:50
         compiled from video_embed_vplayer.tpl */ ?>
<textarea name="video_embed_code" rows="6" id="video_embed_code" class="form-control">
<embed width="<?php echo $this->_tpl_vars['embed_width']; ?>
" height="<?php echo $this->_tpl_vars['embed_auto_height']; ?>
" quality="high" wmode="transparent" name="main" id="main" allowfullscreen="true" allowscriptaccess="always" src="<?php echo $this->_tpl_vars['baseurl']; ?>
/media/embed/embed_zhiboav.swf?zhiboav_me_id=<?php echo $this->_tpl_vars['video']['VID']; ?>
&hurl=1" type="application/x-shockwave-flash" />
</textarea>