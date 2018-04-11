<?php
define('_VALID', true);
require 'include/config.php';
require 'include/function_global.php';
require 'include/function_smarty.php';
/*
# 各级会员友好提示
# 开发时间：20150407
# 作者：office.frontend@gmail.com
*/

$request    = ( isset($_SERVER['REQUEST_URI']) ) ? $_SERVER['REQUEST_URI'] : NULL;
$query      = explode('/', $request);

$vid = get_request_arg('video');
if ( !$vid ) {
    VRedirect::go($config['BASE_URL']. '/error/video_missing');
}


//$smarty->assign('message', $message);
//$smarty->assign('title', $title);
//$smarty->assign('VID', $VID);
$smarty->assign('type_of_user', $type_of_user);
$smarty->assign('menu', 'home');
$smarty->assign('categories', get_categories());
$smarty->display('header.tpl');
$smarty->display('messages.tpl');
$smarty->display('limited.tpl');
$smarty->display('footer.tpl');
$smarty->gzip_encode();
?>
