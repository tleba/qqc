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
$mobile_menu				= 'videos';
$seo['mobile_title'] 		= $seo['mobile_title'].' - '.$lang['footer.terms'];
$module						= 'terms';
// ------------------------------------------------------------------------------



// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title'].' - '.$lang['footer.terms']);

// Assign Nav Tab
$smarty->assign('content',$static['terms']);
$smarty->assign('mobile_menu','');
$smarty->assign('mconfig',$mconfig);
// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
