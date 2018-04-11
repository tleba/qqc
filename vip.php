<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
/*
# 会员引导页面
# 开发时间：20150506
# 作者：office.frontend@gmail.com
*/
$smarty->assign('message', $message);
$smarty->assign('title', $title);
$smarty->assign('VID', $VID);
$smarty->assign('type_of_user', $type_of_user);
$smarty->assign('menu', 'home');
$smarty->assign('categories', get_categories());
$smarty->display('header.tpl');
//$smarty->display('messages.tpl');
$smarty->display('vip.tpl');
$smarty->gzip_encode();
?>
