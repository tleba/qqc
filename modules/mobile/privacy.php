<?php
/*|******************************************************
|*|	iPhone / iPod - Mobile Webapp Module Version 2.0
|*| -----------------------------
|*| AVS Version 2.0+
|*| 12-03-2009
|*|******************************************************
|*/

$errors = '';
$messages = '';
$module						= 'privacy';
// ------------------------------------------------------------------------------

// Assign Mobile Meta Data
$smarty->assign('self_title', $mconfig['mobile_sitename'].' - '.$lang['footer.privacy']);

// Assign Nav Tab
$smarty->assign('content',$static['privacy']);
$smarty->assign('mobile_menu','');
$smarty->assign('mconfig',$mconfig);
// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
