<?php /* Smarty version 2.6.20, created on 2018-04-06 15:21:43
         compiled from header.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title>AVS Admin Control Panel</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="<?php echo $this->_tpl_vars['relative_tpl']; ?>
/css/style_admin.css?v=7" type="text/css" rel="stylesheet">
    <script type="text/javascript">
    var base_url = '<?php echo $this->_tpl_vars['baseurl']; ?>
';
    </script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['relative_tpl']; ?>
/js/jquery-1.2.6.pack.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['relative_tpl']; ?>
/js/jquery.corner.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['relative_tpl']; ?>
/js/jquery.livequery.pack.js"></script>
    <?php if (isset ( $this->_tpl_vars['crop'] )): ?><script type="text/javascript" src="<?php echo $this->_tpl_vars['relative_tpl']; ?>
/js/jquery.album-0.1.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['relative_tpl']; ?>
/js/jquery.imgareaselect-0.6.1.min.js"></script>
    <?php endif; ?>
    <?php if (isset ( $this->_tpl_vars['editor'] )): ?>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['baseurl']; ?>
/addons/markitup/jquery.markitup.js"></script>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['baseurl']; ?>
/addons/markitup/sets/<?php echo $this->_tpl_vars['editor_set']; ?>
/set.js"></script>    
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseurl']; ?>
/addons/markitup/skins/<?php echo $this->_tpl_vars['editor_skin']; ?>
/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['baseurl']; ?>
/addons/markitup/sets/<?php echo $this->_tpl_vars['editor_set']; ?>
/style.css" />
    <?php endif; ?>
    <script type="text/javascript" src="<?php echo $this->_tpl_vars['relative_tpl']; ?>
/js/jquery.admin-0.1.js?t=1"></script>

</head>
<div id="container">
    <div id="header">
        <div id="menu">
		<img src="<?php echo $this->_tpl_vars['relative_tpl']; ?>
/images/logo.png" style="margin-left: 15px;">		
        <ul>
        	<?php $_from = $this->_tpl_vars['menus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
        		<li><?php if ($this->_tpl_vars['active_menu'] == $this->_tpl_vars['v']): ?><span><?php echo $this->_tpl_vars['admin_lang'][$this->_tpl_vars['v']]; ?>
</span><?php else: ?><a href="<?php echo $this->_tpl_vars['v']; ?>
.php"><?php echo $this->_tpl_vars['admin_lang'][$this->_tpl_vars['v']]; ?>
</a><?php endif; ?></li>
        	<?php endforeach; endif; unset($_from); ?>
        </ul>
        </div>
    </div>
    <div id="content">