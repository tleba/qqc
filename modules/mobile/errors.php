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

$module						= 'errors';
// ------------------------------------------------------------------------------
$error_type = '';
$error_type = get_request_arg('errors','STRING');



switch ( $error_type ) {
    case 'video_private':
        $message = 'This video is private.<br />You must be friends with the owner to view this video!';
		$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - Error: Private video'.
        break;
    case 'album_private':
        $message = 'This album is private.<br />You must be friends with the owner to view this album!';
	    $seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - Error: Private album'.
        break;
    case 'photo_private':
        $message = 'This photo is private.<br />You must be friends with the owner to view this photo!';
	    $seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - Error: Private photo'.
        break;
    case 'video_missing':
        $message = 'This video cannot be found.<br />Are you sure you typed in the correct url?';
        break;
    case 'category_missing':
        $message = 'This category cannot be found.<br />Are you sure you typed in the correct url?';
	    $seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - Error: Category missing';
        break;
    case 'album_missing':
        $message = 'This album cannot be found.<br />Are you sure you typed in the correct url?';
        break;
    case 'photo_missing':
        $message = 'This photo cannot be found.<br />Are you sure you typed in the correct url?';
	    $seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - Error: Photo not found';
        break;
    case 'registration_disabled':
        $message = 'User registration is currently disabled.<br />Please try again later!';
        break;
    default:
        $message = 'Unexpected error!<br />Please contact us and tell us more how you got to this page!';
		$seo['mobile_title'] 		= $mconfig['mobile_sitename'].' - Unexpected error';
        break;
}


$smarty->assign('error', $message);

// Assign Mobile Meta Data
$smarty->assign('self_title', $seo['mobile_title']);
$smarty->assign('self_description', $seo['mobile_desc']);
$smarty->assign('self_keywords', $seo['mobile_keywords']);

// Assign Nav Tab
$smarty->assign('mobile_menu','');
$smarty->assign('mconfig',$mconfig);
// Display Mobile Pages
$smarty->display('mobile_header.tpl');
$smarty->display('mobile_'.$module.'.tpl');
$smarty->display('mobile_footer.tpl');
$smarty->gzip_encode();

?>
